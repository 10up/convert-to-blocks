=== Convert to Blocks ===
Contributors:      10up, dsawardekar, tlovett1
Tags:              gutenberg, block, block migration, gutenberg migration, gutenberg conversion, convert to blocks
Requires at least: 5.4
Tested up to:      5.5
Requires PHP:      7.0
Stable tag:        1.0.1
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html

Convert to Blocks is a WordPress plugin that transforms classic editor content to blocks on the fly.

== Description ==

Convert to Blocks is a WordPress plugin that transforms classic editor content to blocks on the fly. After installing Gutenberg or upgrading to WordPress 5.0+, your content will be showing in "Classic Editor Blocks". While these blocks are completely functional and will display fine on the front of your website, they do not empower editors to fully make use of the block editor experience.  In order to do so, your classic editor posts need to be converted to blocks. This plugin does that for you "on the fly". When an editor goes to edit a classic post, the content will be parsed into blocks. When the editor saves the post, the new structure will be saved into the database. This strategy reduces risk as you are only altering database values for content that needs to be changed.

== Installation ==

= Manual Installation =

1. Upload the entire `/convert-to-blocks` directory to the `/wp-content/plugins/` directory.
2. Activate Convert to Blocks through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= How Do I Know It's Working? =

Find a classic editor in the post, try to navigate away from the page. You will get an error saying your changes will be discarded. This is because Convert to Blocks converted your content to blocks on the fly and those changes will be saved when you update the post.

= Will Convert to Blocks Handle My Custom Blocks? =

By default it will not.

== Screenshots ==


== Changelog ==

= 1.0.0 =
* Initial private release of Convert to Blocks.
