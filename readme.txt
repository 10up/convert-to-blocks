=== Convert to Blocks ===
Contributors:      10up, dsawardekar, tlovett1, jeffpaul
Tags:              gutenberg, block, block migration, gutenberg migration, gutenberg conversion, convert to blocks
Requires at least: 5.7
Tested up to:      6.4
Requires PHP:      8.0
Stable tag:        1.2.2
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

= 1.2.2 - 2023-10-16 =
* **Changed:** Bump WordPress "tested up to" version to 6.3 (props [@kmgalanakis](https://github.com/kmgalanakis), [@faisal-alvi](https://github.com/faisal-alvi), [@jeffpaul](https://github.com/jeffpaul), [@peterwilsoncc](https://github.com/peterwilsoncc) via [#132](https://github.com/10up/convert-to-blocks/pull/132), [#134](https://github.com/10up/convert-to-blocks/pull/134)
* **Security:** Bump `@cypress/request` from 2.88.11 to 3.0.1 and `cypress` from 10.11.0 to 13.3.0 (props [@dependabot](https://github.com/apps/dependabot), [@iamdharmesh](https://github.com/apps/iamdharmesh), [@ravinderk](https://github.com/apps/ravinderk) via [#138](https://github.com/10up/convert-to-blocks/pull/138)).
* **Security:** Bump `postcss` from 8.4.20 to 8.4.31 (props [@dependabot](https://github.com/apps/dependabot), [@dkotter](https://github.com/apps/dkotter) via [#139](https://github.com/10up/convert-to-blocks/pull/139)).
* **Security:** Bump `fsevents` from 1.2.9 to 1.2.13 (props [@dependabot](https://github.com/apps/dependabot), [@ravinderk](https://github.com/apps/ravinderk) via [#140](https://github.com/10up/convert-to-blocks/pull/140)).

= 1.2.1 - 2023-07-26 =
* **Added:** More robust minimum PHP version check (props [@dkotter](https://github.com/dkotter), [@ravinderk](https://github.com/ravinderk) via [#129](https://github.com/10up/convert-to-blocks/pull/129)).
* **Changed:** Bump minimum required PHP version from 7.4 to 8.0 in our `composer.json` config (props [@c0ntax](https://github.com/c0ntax), [@Sidsector9](https://github.com/Sidsector9) via [#122](https://github.com/10up/convert-to-blocks/pull/122)).
* **Fixed:** Parse error caused by a comma (props [@Sidsector9](https://github.com/Sidsector9), [@iamdharmesh](https://github.com/iamdharmesh), [@ravinderk](https://github.com/ravinderk), [@felipeelia](https://github.com/felipeelia) via [#123](https://github.com/10up/convert-to-blocks/pull/123)).
* **Security:** Bump `minimist` from 1.2.0 to 1.2.7 and `mkdirp` from 0.5.1 to 0.5.6 (props [@dependabot](https://github.com/apps/dependabot) via [#117](https://github.com/10up/convert-to-blocks/pull/117)).
* **Security:** Bump `ini` from 1.3.5 to 1.3.8 (props [@dependabot](https://github.com/apps/dependabot) via [#119](https://github.com/10up/convert-to-blocks/pull/119)).
* **Security:** Bump `browser-sync` from 2.27.10 to 2.29.3 and removes `qs` (props [@dependabot](https://github.com/apps/dependabot) via [#120](https://github.com/10up/convert-to-blocks/pull/120)).
* **Security:** Bump `word-wrap` from 1.2.3 to 1.2.5 (props [@dependabot](https://github.com/apps/dependabot) via [#127](https://github.com/10up/convert-to-blocks/pull/127)).

= 1.2.0 - 2023-06-27 =
**Note that this release bumps the WordPress minimum version from 5.7 to 6.1 and the PHP minimum version from 7.4 to 8.0.**

* **Added:** Settings UI for managing supported post types (props [@akshitsethi](https://github.com/akshitsethi), [@dinhtungdu](https://github.com/dinhtungdu), [@Sidsector9](https://github.com/Sidsector9), [@jayedul](https://github.com/jayedul), [@dsawardekar](https://github.com/dsawardekar), [@terrance-orletsky-d7](https://github.com/terrance-orletsky-d7), [@ouun](https://github.com/ouun) via [#66](https://github.com/10up/convert-to-blocks/pull/66), [#104](https://github.com/10up/convert-to-blocks/pull/104), [#112](https://github.com/10up/convert-to-blocks/pull/112), [#114](https://github.com/10up/convert-to-blocks/pull/114)).
* **Added:** Filter hook `convert_to_blocks_update_posts_query_params` to modify `WP_Query` parameters to query posts that need to be migrated (props [@kmgalanakis](https://github.com/kmgalanakis), [@Sidsector9](https://github.com/Sidsector9), [@sanketio](https://github.com/sanketio) via [#113](https://github.com/10up/convert-to-blocks/pull/113)).
* **Added:** Cypress end-to-end tests (props [@barneyjeffries](https://github.com/barneyjeffries), [@jeffpaul](https://github.com/jeffpaul), [@iamdharmesh](https://github.com/iamdharmesh), [@Sidsector9](https://github.com/Sidsector9), [@vikrampm1](https://github.com/vikrampm1) via [#106](https://github.com/10up/convert-to-blocks/pull/106)).
* **Changed:** Bump PHP minimum supported version from 7.4 to 8.0 (props [@barneyjeffries](https://github.com/barneyjeffries), [@jeffpaul](https://github.com/jeffpaul), [@iamdharmesh](https://github.com/iamdharmesh), [@Sidsector9](https://github.com/Sidsector9), [@vikrampm1](https://github.com/vikrampm1) via [#106](https://github.com/10up/convert-to-blocks/pull/106)).
* **Changed:** Bump WordPress minimum supported version from 5.7 to 6.1 (props [@barneyjeffries](https://github.com/barneyjeffries), [@jeffpaul](https://github.com/jeffpaul), [@iamdharmesh](https://github.com/iamdharmesh), [@Sidsector9](https://github.com/Sidsector9), [@vikrampm1](https://github.com/vikrampm1) via [#106](https://github.com/10up/convert-to-blocks/pull/106)).
* **Changed:** Bump WordPress "tested up to" version 6.2 (props [@Sidsector9](https://github.com/Sidsector9) via [#115](https://github.com/10up/convert-to-blocks/pull/115)).
* **Changed:** Updated the Dependency Review GitHub Action (props [@jeffpaul](https://github.com/jeffpaul) via [#109](https://github.com/10up/convert-to-blocks/pull/109)).
* **Changed:** WordPress.org Deploy action updated to use Node 16 (props [@dkotter](https://github.com/dkotter) via [#116](https://github.com/10up/convert-to-blocks/pull/116)).

= 1.1.1 - 2023-01-05 =
**Note that this version bumps the minimum PHP version from 7.0 to 7.4 and the minimum WordPress version from 5.4 to 5.7.**

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

= 1.2.0 =
Note that this release bumps the WordPress minimum version from 5.7 to 6.1 and the PHP minimum version from 7.4 to 8.0.

= 1.1.1 =
Note that this version bumps the minimum PHP version from 7.0 to 7.4 and the minimum WordPress version from 5.4 to 5.7.
