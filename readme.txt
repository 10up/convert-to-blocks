=== Convert to Blocks ===
Contributors:      10up, dsawardekar, tlovett1
Tags:              gutenberg, block, block migration, gutenberg migration, gutenberg conversion, convert to blocks
Requires at least: 5.4
Tested up to:      5.8
Requires PHP:      7.0
Stable tag:        1.0.2
License:           GPLv2 or later
License URI:       http://www.gnu.org/licenses/gpl-2.0.html

Convert to Blocks transforms classic editor content to blocks on-the-fly.

== Description ==

Convert to Blocks is a WordPress plugin that transforms classic editor content to blocks on-the-fly.  After installing Gutenberg or upgrading to WordPress 5.0+, your content will be displayed in "Classic Editor Blocks".  While these blocks are completely functional and will display fine on the frontend of your website, they do not empower editors to fully make use of the block editing experience.  In order to do so, your classic editor posts need to be converted to blocks.  This plugin does that for you "on the fly".  When an editor goes to edit a classic post, the content will be parsed into blocks.  When the editor saves the post, the new structure will be saved into the database.  This strategy reduces risk as you are only altering database values for content that needs to be changed.

**Note that Inner Blocks Transforms is only supported with the Gutenberg Plugin 10.9.0+.**

== Installation ==

= Manual Installation =

1. Upload the entire `/convert-to-blocks` directory to the `/wp-content/plugins/` directory.
2. Activate Convert to Blocks through the 'Plugins' menu in WordPress.

== Frequently Asked Questions ==

= How Do I Know It's Working? =

Find a classic editor in the post, try to navigate away from the page. You will get an error saying your changes will be discarded. This is because Convert to Blocks converted your content to blocks on the fly and those changes will be saved when you update the post.

= Will Convert to Blocks Handle My Custom Blocks? =

By default it will not.

= Will Convert to Blocks Handle Nested Blocks? =

Nested / Inner Block support does not work with Gutenberg bundled with WordPress Core <=5.7.2. This feature needs the Gutenberg Plugin >=10.9.0.

== Screenshots ==


== Changelog ==

= 1.0.2 =
* **Changed:** Bump WordPress version "tested up to" 5.8 (props [@psorensen](https://profiles.wordpress.org/psorensen/), [@BBerg10up](https://github.com/BBerg10up), [@jeffpaul](https://profiles.wordpress.org/jeffpaul/)).
* **Changed:** Documentation updates (props [@hashimwarren](https://profiles.wordpress.org/hashimwarren/)).
* **Fixed:** Transform Classic Editor blocks nested inside other blocks recursively (props [@dsawardekar](https://profiles.wordpress.org/dsawardekar/), [@MadtownLems](https://profiles.wordpress.org/madtownlems/), [@dinhtungdu](https://profiles.wordpress.org/dinhtungdu/), [@jeffpaul](https://profiles.wordpress.org/jeffpaul/)).
* **Fixed:** Add Editor column to all supported post types (props [@dinhtungdu](https://profiles.wordpress.org/dinhtungdu/), [@scarne](https://profiles.wordpress.org/scarne/)).
* **Fixed:** Display current editor for hierarchical posts (props [@kreppar](https://profiles.wordpress.org/kreppar/)).
* **Security:** Bump `elliptic` from 6.5.3 to 6.5.4 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `y18n` from 3.2.1 to 3.2.2 (@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `ssri` from 6.0.1 to 6.0.2 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `lodash` from 4.17.20 to 4.17.21 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `hosted-git-info` from 2.7.1 to 2.8.9 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `browserslist` from 4.8.3 to 4.16.5 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `postcss` from 7.0.14 to 7.0.36 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `color-string` from 1.5.3 to 1.5.5 (props [@dependabot](https://github.com/apps/dependabot)).

= 1.0.1 =
* **Added:** Label and updated icons for Classic and Block Editor in Editor column of post table list view (props [@dinhtungdu](https://profiles.wordpress.org/dinhtungdu/)).
* **Added:**  Plugin banner and icon images (props [@dianapadron](https://profiles.wordpress.org/dianapadron/), [@jeffpaul](https://profiles.wordpress.org/jeffpaul/)).
* **Added:**  Documentation updates, unit tests, PHPCS fixes, GitHub Actions and continuous integration testing (props [@barryceelen](https://profiles.wordpress.org/barryceelen/), [@dsawardekar](https://profiles.wordpress.org/dsawardekar/), [@dinhtungdu](https://profiles.wordpress.org/dinhtungdu/), [@jeffpaul](https://profiles.wordpress.org/jeffpaul/)).
* **Fixed:** Issue where edit links force Classic Editor regardless of editor chosen (props [@dkotter](https://profiles.wordpress.org/dkotter/), [@tlovett1](https://profiles.wordpress.org/tlovett1/), [@dinhtungdu](https://profiles.wordpress.org/dinhtungdu/)).
* **Security:** Bump `lodash` from 4.17.15 to 4.17.20 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `elliptic` from 6.5.2 to 6.5.3 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `acorn` from 6.4.0 to 6.4.2 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `dot-prop` from 4.2.0 to 4.2.1 (props [@dependabot](https://github.com/apps/dependabot)).

= 1.0.0 =
* Initial release of Convert to Blocks.
