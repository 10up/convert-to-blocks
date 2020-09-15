=== Gutenbridge ===
Contributors:      10up, tlovett1
Tags: gutenberg, block, block migration, gutenberg migration, gutenberg conversion
Requires at least: 5.4
Tested up to:      5.5
Stable tag:        1.0

Gutenbridge is a WordPress plugin that transforms classic editor content to Gutenberg blocks on the fly.

== Description ==

Gutenbridge is a WordPress plugin that transforms classic editor content to [Gutenberg](https://wordpress.org/gutenberg/) blocks on the fly. After installing Gutenberg or upgrading to WordPress 5.0+, your content will be showing in "Classic Editor Blocks". While these blocks are completely functional and will display fine on the front of your website, they do not empower editors to fully make use of the Gutenberg experience.  In order to do so, your classic editor posts need to be converted to Gutenberg blocks. This plugin does that for you "on the fly". When an editor goes to edit a classic post, the content will be parsed into blocks. When the editor saves the post, the new structure will be saved into the database. This strategy reduces risk as you are only altering database values for content that needs to be changed.

== Installation ==

= Manual Installation =

1. Upload the entire `/gutenbridge` directory to the `/wp-content/plugins/` directory.
2. Activate Gutenbridge through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

__How Do I Know It's Working?__

Find a classic editor in the post, try to navigate away from the page. You will get an error saying your changes will be discarded. This is because Gutenbridge converted your content to blocks on the fly and those changes will be saved when you update the post.

__Will Gutenbridge Handle My Custom Blocks?__

By default it will not.

== Screenshots ==


== Changelog ==

= 1.0 =
* First release
