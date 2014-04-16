<?php
/*
Plugin Name: Author Bio Shortcode
Plugin URI: http://philipjohn.co.uk/category/plugins/author-bio-shortcode/
Description: Provides the [author_bio] shortcode for embedding the bio of an author anywhere in the post/page content.
Version: 2.5.3
Author: Philip John
Author URI: http://philipjohn.co.uk
License: GPL2
Text Domain: author-bio-shortcode
*/

/**
 * Load the textdomain
 */
function pj_abs_load_textdomain(){
	load_plugin_textdomain( 'author-bio-shortcode', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
}
add_action('init', 'pj_abs_load_textdomain');

/**
 * Installs the plugin
 * 
 * Checks for the current version of WordPress and kills activation if the version is too old. Doesn't check for newer versions.
 * 
 */
function pj_abs_install(){
	if (version_compare(get_bloginfo('version'), '3.5', '<')){
		die(__("This plugin is not compatible with your version of WordPress. Please upgrade to at least v3.5", 'author-bio-shortcode'));
	}
}
register_activation_hook( __FILE__, 'pj_abs_install');

/**
 * Prints out the author bio
 *
 * Replaces the shortcode [author_bio] with the contents of the "Biographical Info" field in /wp-admin/profile.php
 * 
 * @param array $atts Any attributes used in the shortcode. Not used.
 */
function pj_abs_shortcode($atts){
	extract(shortcode_atts(array(
		'id' => NULL,
		'username' => NULL,
		'email' => NULL,
		'avatar' => NULL,
		'avatar_size' => 96,
		'name' => NULL,
		'name_container' => 'h3',
		'name_class' => 'name',
		'name_pre' => '',
		'name_post' => '',
		'name_link' => NULL,
		'container_element' => 'div',
		'container_class' => 'author_bio_shortcode',
		'avatar_container_element' => 'div',
		'avatar_container_class' => 'avatar',
		'bio_container_element' => 'div',
		'bio_container_class' => 'bio',
		'bio_paragraph' => true
		
	), $atts));
	
	// Make sure that, if set, the ID is an integer
	$id = (isset($id)) ? (int) $id : false;

	// Let's see if we want the current author, or someone else
	if (!empty($id) && is_int($id)){ // We're going on ID
		$the_author_id = $id;
	}
	else if (!empty($username)){ // We're going on username
		$the_author_id = get_user_by('login', $username);

		if ( $the_author_id )
			$the_author_id = $the_author_id->ID;

	}
	else if (!empty($email)){ // We're going on e-mail address
		$the_author_id = get_user_by('email', $email);

		if ( $the_author_id )
			$the_author_id = $the_author_id->ID;

	}
	else { // Just use the author
		global $post; // So we can grab the author ID of the current post
		$the_author_id = $post->post_author;
	}
	
	// Make sure the ID is an integer
	$the_author_id = intval($the_author_id);
	
	// Shall we add the user's avatar as well?
	if (!empty($avatar)){
		
		// Don't let avatar_size be higher than 512
		$avatar_size = ($avatar_size > 512) ? 512 : $avatar_size;
		
		$img = '<'.$avatar_container_element.' class="'.$avatar_container_class.'">';
		$img .= get_avatar($the_author_id, $avatar_size);
		$img .= "</$avatar_container_element>";
	}
	
	// Construct the name bit
	if (!empty($name)){
		$name1 = $name_pre.get_the_author_meta('display_name', $the_author_id).$name_post;
		$nameh = "<$name_container class=\"$name_class\">";
		$nameh .= (empty($name_link)) ? $name1 : '<a href="'.get_the_author_meta('user_url', $the_author_id).'">'.$name1.'</a>';
		$nameh .= "</$name_container>";
	}
	
	// construct the bio text bit
	$bio = '<'.$bio_container_element.' class="'.$bio_container_class.'">';
	$bio .= ($bio_paragraph) ? '<p>' : '';
	$bio .= get_the_author_meta('description', $the_author_id);
	$bio .= ($bio_paragraph) ? '</p>' : '';
	$bio .= "</$bio_container_element>";
	
	$all_aboard = '<'.$container_element.' class="'.$container_class.'">';
	if (!empty($avatar)) $all_aboard .= $img;
	if (!empty($name)) $all_aboard .= $nameh;
	$all_aboard .= $bio;
	$all_aboard .= "</$container_element>";
	
	return $all_aboard;
}
add_shortcode('author_bio', 'pj_abs_shortcode');

?>
