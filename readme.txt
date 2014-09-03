=== Author Bio Shortcode ===
Contributors: philipjohn
Donate link: http://philipjohn.co.uk/
Tags: author, bio, biography, user description, author description, shortcode, author-bio-shortcode
Requires at least: 3.5
Tested up to: 4.0
Stable tag: 2.5.3

Provides the [author_bio] shortcode for embedding the bio of an author anywhere in the post/page content.

== Description ==

This plugin allows you to enter [author_bio] anywhere within the content of a post or page to display the biography of the author of that post or page.

The output now contains HTML, which can be customised very easily with extra parameters - see Installation for a how-to - to sit around the bio, as defined in /wp-admin/profile.php.

By default the shortcode produces the author of that post or page. However, extra parameters enable you to specify a different user whose bio you want to print out - see usage instructions.

Feature requests welcomed with open arms!

== Installation ==

Simple install in /wp-content/plugins like any other!

= Usage =

Simply place [author_bio] anywhere within your post/page content.

Additionally, you can pass one of the following attributes to specify a different user;

* id - accepts the user ID
* username - accepts the username
* email - accepts the user e-mail address

For example;
`[author_bio]
[author_bio id="4"]
[author_bio username="admin"]
[author_bio email="user@example.com"]`

You can also have the author's avatar added, by using the avatar parameter like so;
`[author_bio avatar="yes"]`
Warning: if you don't want the avatar, do not change the above to "no" as it will not work, simply change back to `[author_bio]` alone.

It's possible to add the author's name, too by adding the name parameter;
`[author_bio name="yes"]`
Warning: As with the avatar option, leave the name parameter out completely to hide the name.

Additionally, you can make the author's name link to his/her website as defined in their profile;
`[author_bio name="yes" name_link="yes"]`  

You can also customise the HTML output which defaults to;
`<div class="author-bio-shortcode">
	<div class="avatar">
		<img .. />
	</div>
	<div class="bio">
		<p> ... the author bio ... </p>
	</div>
</div>`

There are 7 parameters that describe the HTML above;

* 'container_element' defaults to 'div' and creates the first div in the example above
* 'container_class' defaults to 'author_bio_shortcode' as seen above
* 'name_container' defaults to h3
* 'name_class' defaults to 'name'
* 'name_pre' is empty by default and can be used to add text before the author's name
* 'name_post' is empty by default and can be used to add text after the author's name
* 'avatar_container_element' defaults to 'div' and creates the element that surrounds the avatar image
* 'avatar_container_class' defaults to 'avatar' and adds itself to the 'avatar_container_element'
* 'bio_container_element' defaults to 'div' and wraps the bio text
* 'bio_container_class' defaults to 'bio' and is used in the bio container element
* 'bio_paragraph' defaults to true and decides whether to put the bio text into a Paragrah tag. Note, only a value of zero (0) will change it, e.g. `bio_paragraph=0`

Here is an example using all the HTML parameters to re-create the above example code;
`[author_bio container_element="div" container_class="author-bio-shortcode" avatar_container_element="div" avatar_container_class="avatar" bio_container_element="div" bio_container_class="bio" bio_paragraph="true"]`

This example shows how to remove the P tag from around the bio text;
`[author_bio bio_paragraph=0]`

== Changelog ==

= 1.0 =
* First commit

= 1.2 =
* Ensured compatibility with WordPress v3.2.1
* Added PHPDoc commenting
* New activation function to check version number
* Now using more obscure function naming
* Added extra options for specifying the user

= 1.2.1 =
* Tidied up PHP Notices (kudos to [Lee Willis](http://www.leewillis.co.uk) for pointing that out!)

= 2.0 =
* Added ability to include the author's avatar alongside the bio
* Added HTML to provide for easier styling
* Added additional parameters to change the default HTML output

= 2.1 =
* Added name parameters 

= 2.2 =
* Fix for deprecated function get_user_id_from_string()

= 2.3 =
* Versioning mishap (Phil can't count)

= 2.5.1 =
* Where did v2.4 go?
* i18n fixes

= 2.5.2 =
* PHP Notice fixes
* Made sure Author ID is always integer

= 2.5.3 =
* PHP Notice fixes
* 3.9 compatibility check
