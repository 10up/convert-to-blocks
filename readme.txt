=== Convert to Blocks ===
Contributors:      10up, dsawardekar, tlovett1, jeffpaul
Tags:              block, block migration, gutenberg migration, gutenberg conversion, convert to blocks
Tested up to:      6.9
Stable tag:        1.3.4
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

= 1.3.4 - 2025-07-15 =
* **Fixed:** Ensure no PHP error is thrown on the plugin list screen when running PHP 8.0 (props [@dinhac](https://wordpress.org/support/users/dinhac/), [@dkotter](https://github.com/dkotter), [@faisal-alvi](https://github.com/faisal-alvi) via [#210](https://github.com/10up/convert-to-blocks/pull/210)).

= 1.3.3 - 2025-07-14 =
* **Added:** Link to settings page from the plugin list page (props [@badasswp](https://github.com/badasswp), [@dkotter](https://github.com/dkotter) via [#195](https://github.com/10up/convert-to-blocks/pull/195)).
* **Changed:** Bump WordPress "tested up to" version 6.8 (props [@jeffpaul](https://github.com/jeffpaul) via [#199](https://github.com/10up/convert-to-blocks/pull/199), [#200](https://github.com/10up/convert-to-blocks/pull/200)).
* **Changed:** Bump WordPress minimum supported version to 6.6 (props [@jeffpaul](https://github.com/jeffpaul) via [#199](https://github.com/10up/convert-to-blocks/pull/199), [#200](https://github.com/10up/convert-to-blocks/pull/200)).
* **Fixed:** Fix PHP warning due to undefined array key (props [@sksaju](https://github.com/sksaju), [@dkotter](https://github.com/dkotter) via [#202](https://github.com/10up/convert-to-blocks/pull/202)).
* **Fixed:** i18n functions being called too early, causing PHP Notices (props [@stormrockwell](https://github.com/stormrockwell), [@dkotter](https://github.com/dkotter), [@dsawardekar](https://github.com/dsawardekar) via [#203](https://github.com/10up/convert-to-blocks/pull/203)).
* **Security:** Bump `cookie` from 0.4.2 to 0.7.1, `express` from 4.21.0 to 4.21.2, `@wordpress/e2e-test-utils-playwright` from 1.7.0 to 1.18.0, `serialize-javascript` from 6.0.0 to 6.0.2 and `mocha` from 10.4.0 to 11.1.0 (props [@dependabot](https://github.com/apps/dependabot), [@Sidsector9](https://github.com/Sidsector9) via [#194](https://github.com/10up/convert-to-blocks/pull/194)).
* **Security:** Bump `axios` from 1.7.4 to 1.8.3 (props [@dependabot](https://github.com/apps/dependabot), [@iamdharmesh](https://github.com/iamdharmesh) via [#196](https://github.com/10up/convert-to-blocks/pull/196)).
* **Security:** Bump `http-proxy-middleware` from 2.0.6 to 2.0.9 and `tar-fs` from 3.0.8 to 3.1.0 (props [@dependabot](https://github.com/apps/dependabot), [@dkotter](https://github.com/dkotter) via [#206](https://github.com/10up/convert-to-blocks/pull/206)).

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

[View historical changelog details here](https://github.com/10up/convert-to-blocks/blob/develop/CHANGELOG.md).

== Upgrade Notice ==

= 1.3.3 =
Note that this release bumps the WordPress minimum version from 6.5 to 6.6.

= 1.3.1 =
Note that this release bumps the WordPress minimum version from 6.3 to 6.4.

= 1.2.0 =
Note that this release bumps the WordPress minimum version from 5.7 to 6.1 and the PHP minimum version from 7.4 to 8.0.

= 1.1.1 =
Note that this version bumps the minimum PHP version from 7.0 to 7.4 and the minimum WordPress version from 5.4 to 5.7.
