=== Convert to Blocks ===
Contributors:      10up, dsawardekar, tlovett1
Tags:              gutenberg, block, block migration, gutenberg migration, gutenberg conversion, convert to blocks
Requires at least: 5.7
Tested up to:      6.1
Requires PHP:      7.4
Stable tag:        1.1.1
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

1. Bulk migration using the `wp convert-to-blocks start` WP-CLI command that converts posts iteratively in the browser without requireing any manual input.

== Changelog ==

= 1.1.1 - 2023-01-05 =
* **Added:** Bulk migration demo to readme (props [@jeffpaul](https://github.com/jeffpaul), [@dsawardekar](https://github.com/dsawardekar) via [#79](https://github.com/10up/convert-to-blocks/pull/79)).
* **Added:** Release build GitHub Action to build a release zip used for testing (props [@dkotter](https://github.com/dkotter) via [#98](https://github.com/10up/convert-to-blocks/pull/98)).
* **Changed:** Bump WordPress minimum version from 5.4 to 5.7 and PHP minimum version from 7.0 to 7.4 (props [@zamanq](https://github.com/zamanq), [@jeffpaul](https://github.com/jeffpaul), [@faisal-alvi](https://github.com/faisal-alvi), [@mehul0810](https://github.com/mehul0810) via [#80](https://github.com/10up/convert-to-blocks/pull/80)).
* **Changed:** Bump WordPress "tested up to" version to 6.1 props [@peterwilsoncc](https://github.com/peterwilsoncc), [@faisal-alvi](https://github.com/faisal-alvi), [@cadic](https://github.com/cadic) via [#88](https://github.com/10up/convert-to-blocks/pull/88), [#91](https://github.com/10up/convert-to-blocks/pull/91)).
* **Removed:** `is-svg` as it is no longer used after updating ancestor dependency `postcss-svgo` (props [@dependabot](https://github.com/apps/dependabot) via [#85](https://github.com/10up/convert-to-blocks/pull/85)).
* **Fixed:** WP-CLI helptext that is causing an unknown parameter error (props [@dsawardekar](https://github.com/dsawardekar), [@jeffpaul](https://github.com/jeffpaul), [@norcross](https://github.com/norcross) via [#78](https://github.com/10up/convert-to-blocks/pull/78)).
* **Security:** Bump `socket.io-parser` from 3.2.0 to 4.2.1 and `browser-sync` from 2.26.7 to 2.27.10 (props [@dependabot](https://github.com/apps/dependabot) via [#81](https://github.com/10up/convert-to-blocks/pull/81)).
* **Security:** Bump `minimatch` from 3.0.4 to 3.1.2 (props [@dependabot](https://github.com/apps/dependabot) via [#82](https://github.com/10up/convert-to-blocks/pull/82)).
* **Security:** Bump `nth-check` from 1.0.2 to 2.1.1 and `cssnano` from 4.1.10 to 5.1.14 (props [@dependabot](https://github.com/apps/dependabot) via [#84](https://github.com/10up/convert-to-blocks/pull/84)).
* **Security:** Bump `postcss-svgo` from 4.0.2 to 4.0.3 (props [@dependabot](https://github.com/apps/dependabot) via [#85](https://github.com/10up/convert-to-blocks/pull/85)).
* **Security:** Bump `minimist` from 1.2.0 to 1.2.7 and `mkdirp` from 0.5.1 to 0.5.6 (props [@dependabot](https://github.com/apps/dependabot) via [#86](https://github.com/10up/convert-to-blocks/pull/86)).
* **Security:** Bump `loader-utils` from 1.2.3 to 1.4.2 and `webpack-cli` from 3.3.10 to 3.3.12 (props [@dependabot](https://github.com/apps/dependabot) via [#89](https://github.com/10up/convert-to-blocks/pull/89)).
* **Security:** Bump `glob-parent` from 5.1.0 to 5.1.2 and `watchpack` from 1.6.0 to 1.7.5 (props [@dependabot](https://github.com/apps/dependabot) via [#90](https://github.com/10up/convert-to-blocks/pull/90)).
* **Security:** Bump `kind-of` from 6.0.2 to 6.0.3 (props [@dependabot](https://github.com/apps/dependabot) via [#93](https://github.com/10up/convert-to-blocks/pull/93)).
* **Security:** Bump `serialize-javascript` from 2.1.2 to 4.0.0 and `terser-webpack-plugin` from 1.4.3 to 1.4.5 (props [@dependabot](https://github.com/apps/dependabot) via [#94](https://github.com/10up/convert-to-blocks/pull/94)).
* **Security:** Bump `engine.io` from 6.2.0 to 6.2.1 (props [@dependabot](https://github.com/apps/dependabot) via [#95](https://github.com/10up/convert-to-blocks/pull/95)).
* **Security:** Bump `decode-uri-component` from 0.2.0 to 0.2.2 (props [@dependabot](https://github.com/apps/dependabot) via [#97](https://github.com/10up/convert-to-blocks/pull/97)).

= 1.1.0 - 2022-07-27 =
* **Added:** Support for bulk migrating Classic Editor items to the Block Editor, utilizing WP-CLI (props [@dsawardekar](https://github.com/dsawardekar), [@jeffpaul](https://github.com/jeffpaul), [@gthayer](https://github.com/gthayer), [@faisal-alvi](https://github.com/faisal-alvi) via [#70](https://github.com/10up/convert-to-blocks/pull/70)).
* **Added:** Dependency security scanning (props [@jeffpaul](https://github.com/jeffpaul), [@Sidsector9](https://github.com/Sidsector9) via [#64](https://github.com/10up/convert-to-blocks/pull/64)).
* **Fixed:** Added polyfill to fix PHPUnit tests (props [@cadic](https://github.com/cadic), [@iamdharmesh](https://github.com/iamdharmesh) via [#69](https://github.com/10up/convert-to-blocks/pull/69)).
* **Changed:** Bump WordPress version "tested up to" 6.0 (props [@mohitwp](https://github.com/mohitwp), [@jeffpaul](https://github.com/jeffpaul), [@cadic](https://github.com/cadic), [@iamdharmesh](https://github.com/iamdharmesh) via [#59](https://github.com/10up/convert-to-blocks/pull/59), [#67](https://github.com/10up/convert-to-blocks/pull/67)).
* **Security:** Bump `path-parse` from 1.0.6 to 1.0.7 (props [@dependabot](https://github.com/apps/dependabot) via [#55](https://github.com/10up/convert-to-blocks/pull/55)).
* **Security:** Bump `ajv` from 6.10.0 to 6.12.6 (props [@dependabot](https://github.com/apps/dependabot) via [#60](https://github.com/10up/convert-to-blocks/pull/60)).
* **Security:** Bump `tar` from 4.4.8 to 4.4.19 (props [@dependabot](https://github.com/apps/dependabot) via [#61](https://github.com/10up/convert-to-blocks/pull/61)).
* **Security:** Bump `terser` from 4.6.0 to 4.8.1 (props [@dependabot](https://github.com/apps/dependabot) via [#74](https://github.com/10up/convert-to-blocks/pull/74)).

= 1.0.2 - 2021-07-12 =
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

= 1.0.1 - 2021-02-08 =
* **Added:** Label and updated icons for Classic and Block Editor in Editor column of post table list view (props [@dinhtungdu](https://profiles.wordpress.org/dinhtungdu/)).
* **Added:**  Plugin banner and icon images (props [@dianapadron](https://profiles.wordpress.org/dianapadron/), [@jeffpaul](https://profiles.wordpress.org/jeffpaul/)).
* **Added:**  Documentation updates, unit tests, PHPCS fixes, GitHub Actions and continuous integration testing (props [@barryceelen](https://profiles.wordpress.org/barryceelen/), [@dsawardekar](https://profiles.wordpress.org/dsawardekar/), [@dinhtungdu](https://profiles.wordpress.org/dinhtungdu/), [@jeffpaul](https://profiles.wordpress.org/jeffpaul/)).
* **Fixed:** Issue where edit links force Classic Editor regardless of editor chosen (props [@dkotter](https://profiles.wordpress.org/dkotter/), [@tlovett1](https://profiles.wordpress.org/tlovett1/), [@dinhtungdu](https://profiles.wordpress.org/dinhtungdu/)).
* **Security:** Bump `lodash` from 4.17.15 to 4.17.20 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `elliptic` from 6.5.2 to 6.5.3 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `acorn` from 6.4.0 to 6.4.2 (props [@dependabot](https://github.com/apps/dependabot)).
* **Security:** Bump `dot-prop` from 4.2.0 to 4.2.1 (props [@dependabot](https://github.com/apps/dependabot)).

= 1.0.0 - 2020-09-23 =
* Initial release of Convert to Blocks.

== Upgrade Notice ==

= 1.1.1 =
* Note that this version bumps the minimum PHP version from 7.0 to 7.4 and the minimum WordPress version from 5.4 to 5.7.
