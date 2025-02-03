=== Convert to Blocks ===
Contributors:      10up, dsawardekar, tlovett1, jeffpaul
Tags:              block, block migration, gutenberg migration, gutenberg conversion, convert to blocks
Tested up to:      6.7
Stable tag:        1.3.2
License:           GPL-2.0-or-later
License URI:       https://spdx.org/licenses/GPL-2.0-or-later.html

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

= 1.3.2 - 2025-02-03 =
* **Changed:** Bump WordPress "tested up to" version 6.7 (props [@colinswinney](https://github.com/colinswinney), [@jeffpaul](https://github.com/jeffpaul) via [#188](https://github.com/10up/convert-to-blocks/pull/188), [#190](https://github.com/10up/convert-to-blocks/pull/190)).
* **Security:** Bump `axios` from 1.6.8 to 1.7.4 (props [@dependabot](https://github.com/apps/dependabot), [@dkotter](https://github.com/dkotter) via [#180](https://github.com/10up/convert-to-blocks/pull/180)).
* **Security:** Bump `webpack` from 5.91.0 to 5.94.0 (props [@dependabot](https://github.com/apps/dependabot), [@faisal-alvi](https://github.com/faisal-alvi) via [#181](https://github.com/10up/convert-to-blocks/pull/181)).
* **Security:** Bump `ws` from 7.5.10 to 8.18.0 and `@wordpress/scripts` from 27.8.0 to 30.4.0 (props [@dependabot](https://github.com/apps/dependabot), [@faisal-alvi](https://github.com/faisal-alvi) via [#182](https://github.com/10up/convert-to-blocks/pull/182), [#189](https://github.com/10up/convert-to-blocks/pull/189)).
* **Security:** Bump `express` from 4.19.2 to 4.21.0 (props [@dependabot](https://github.com/apps/dependabot), [@iamdharmesh](https://github.com/iamdharmesh) via [#185](https://github.com/10up/convert-to-blocks/pull/185)).

= 1.3.1 - 2024-08-20 =
* **Changed:** Bump WordPress "tested up to" version 6.6 (props [@sudip-md](https://github.com/sudip-md), [@jeffpaul](https://github.com/jeffpaul), [@Sidsector9](https://github.com/Sidsector9), [@ankitguptaindia](https://github.com/ankitguptaindia) via [#174](https://github.com/10up/convert-to-blocks/pull/174)).
* **Changed:** Bump WordPress minimum from 6.3 to 6.4 (props [@sudip-md](https://github.com/sudip-md), [@jeffpaul](https://github.com/jeffpaul), [@Sidsector9](https://github.com/Sidsector9), [@ankitguptaindia](https://github.com/ankitguptaindia) via [#174](https://github.com/10up/convert-to-blocks/pull/174)).
* **Fixed:** Issue with saving a post before the convert to blocks transform was completed (props [@mdesplenter](https://github.com/mdesplenter), [@Sidsector9](https://github.com/Sidsector9), [@dsawardekar](https://github.com/dsawardekar) via [#173](https://github.com/10up/convert-to-blocks/pull/173)).
* **Security:** Bump `braces` from 3.0.2 to 3.0.3 (props [@dependabot](https://github.com/apps/dependabot), [@Sidsector9](https://github.com/Sidsector9) via [#168](https://github.com/10up/convert-to-blocks/pull/168)).
* **Security:** Bump `ws` from 7.5.9 to 7.5.10 (props [@dependabot](https://github.com/apps/dependabot), [@Sidsector9](https://github.com/Sidsector9) via [#169](https://github.com/10up/convert-to-blocks/pull/169)).

= 1.3.0 - 2024-05-14 =
* **Added:** Block Catalog integration, and pagination support (props [@dsawardekar](https://github.com/dsawardekar), [@iamdharmesh](https://github.com/iamdharmesh) via [#164](https://github.com/10up/convert-to-blocks/pull/164)).
* **Changed:** Adjust `enable_block_editor` method only to alter posts that support the gutenbridge (props [@stormrockwell](https://github.com/stormrockwell), [@Sidsector9](https://github.com/Sidsector9), [@jeffpaul](https://github.com/jeffpaul), [@dsawardekar](https://github.com/dsawardekar) via [#136](https://github.com/10up/convert-to-blocks/pull/136)).
* **Changed:** Bump WordPress "tested up to" version 6.5 (props [@QAharshalkadu](https://github.com/QAharshalkadu), [@jeffpaul](https://github.com/jeffpaul), [@Sidsector9](https://github.com/Sidsector9), [@sudip-md](https://github.com/sudip-md), [@dkotter](https://github.com/dkotter) via [#146](https://github.com/10up/convert-to-blocks/pull/146), [#161](https://github.com/10up/convert-to-blocks/pull/161)).
* **Changed:** Replaced [lee-dohm/no-response](https://github.com/lee-dohm/no-response) with [actions/stale](https://github.com/actions/stale) to help with closing no-response/stale issues (props [@jeffpaul](https://github.com/jeffpaul) via [#159](https://github.com/10up/convert-to-blocks/pull/159)).
* **Changed:** Bump Node version from 16 to 20 (props [@aaronjorbin](https://github.com/aaronjorbin), [@Sidsector9](https://github.com/Sidsector9), [@dkotter](https://github.com/dkotter) via [#160](https://github.com/10up/convert-to-blocks/pull/160)).
* **Changed:** Bump `actions/upload-artifact` from v3 to v4 (props [@iamdharmesh](https://github.com/iamdharmesh) via [#162](https://github.com/10up/convert-to-blocks/pull/162)).
* **Security:** Bump `follow-redirects` from 1.15.2 to 1.15.4 (props [@dependabot](https://github.com/apps/dependabot), [@dkotter](https://github.com/dkotter) via [#153](https://github.com/10up/convert-to-blocks/pull/153)).
* **Security:** Bump `browserify-sign` from 4.0.4 to 4.2.2 (props [@dependabot](https://github.com/apps/dependabot), [@dkotter](https://github.com/dkotter) via [#145](https://github.com/10up/convert-to-blocks/pull/145)).
* **Security:** Bump `@babel/traverse` from 7.11.5 to 7.23.7 (props [@dependabot](https://github.com/apps/dependabot), [@dkotter](https://github.com/dkotter) via [#155](https://github.com/10up/convert-to-blocks/pull/155)).
* **Security:** Remove old dependencies in favor of using `@wordpress/scripts` in our build workflow (props [@Sidsector9](https://github.com/Sidsector9), [@dkotter](https://github.com/dkotter) via [#167](https://github.com/10up/convert-to-blocks/pull/167)).

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

[View historical changelog details here](https://github.com/10up/convert-to-blocks/blob/develop/CHANGELOG.md).

== Upgrade Notice ==

= 1.3.1 =
Note that this release bumps the WordPress minimum version from 6.3 to 6.4.

= 1.2.0 =
Note that this release bumps the WordPress minimum version from 5.7 to 6.1 and the PHP minimum version from 7.4 to 8.0.

= 1.1.1 =
Note that this version bumps the minimum PHP version from 7.0 to 7.4 and the minimum WordPress version from 5.4 to 5.7.
