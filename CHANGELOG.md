# Changelog

All notable changes to this project will be documented in this file, per [the Keep a Changelog standard](http://keepachangelog.com/), and will adhere to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased] - TBD

## [1.3.2] - 2025-02-03
### Changed
- Bump WordPress "tested up to" version 6.7 (props [@colinswinney](https://github.com/colinswinney), [@jeffpaul](https://github.com/jeffpaul) via [#188](https://github.com/10up/convert-to-blocks/pull/188), [#190](https://github.com/10up/convert-to-blocks/pull/190)).

### Security
- Bump `axios` from 1.6.8 to 1.7.4 (props [@dependabot](https://github.com/apps/dependabot), [@dkotter](https://github.com/dkotter) via [#180](https://github.com/10up/convert-to-blocks/pull/180)).
- Bump `webpack` from 5.91.0 to 5.94.0 (props [@dependabot](https://github.com/apps/dependabot), [@faisal-alvi](https://github.com/faisal-alvi) via [#181](https://github.com/10up/convert-to-blocks/pull/181)).
- Bump `ws` from 7.5.10 to 8.18.0 and `@wordpress/scripts` from 27.8.0 to 30.4.0 (props [@dependabot](https://github.com/apps/dependabot), [@faisal-alvi](https://github.com/faisal-alvi) via [#182](https://github.com/10up/convert-to-blocks/pull/182), [#189](https://github.com/10up/convert-to-blocks/pull/189)).
- Bump `express` from 4.19.2 to 4.21.0 (props [@dependabot](https://github.com/apps/dependabot), [@iamdharmesh](https://github.com/iamdharmesh) via [#185](https://github.com/10up/convert-to-blocks/pull/185)).

### Developer
- Fix broken link in the README (props [@GaryJones](https://github.com/GaryJones), [@dkotter](https://github.com/dkotter) via [#184](https://github.com/10up/convert-to-blocks/pull/184)).
- Add banner image to the README and update existing badges (props [@jeffpaul](https://github.com/jeffpaul), [@dkotter](https://github.com/dkotter) via [#183](https://github.com/10up/convert-to-blocks/pull/183)).

## [1.3.1] - 2024-08-20
**Note that this release bumps the WordPress minimum version from 6.3 to 6.4.**

### Changed
- Bump WordPress "tested up to" version 6.6 (props [@sudip-md](https://github.com/sudip-md), [@jeffpaul](https://github.com/jeffpaul), [@Sidsector9](https://github.com/Sidsector9), [@ankitguptaindia](https://github.com/ankitguptaindia) via [#174](https://github.com/10up/convert-to-blocks/pull/174)).
- Bump WordPress minimum from 6.3 to 6.4 (props [@sudip-md](https://github.com/sudip-md), [@jeffpaul](https://github.com/jeffpaul), [@Sidsector9](https://github.com/Sidsector9), [@ankitguptaindia](https://github.com/ankitguptaindia) via [#174](https://github.com/10up/convert-to-blocks/pull/174)).

### Fixed
- Issue with saving a post before the convert to blocks transform was completed (props [@mdesplenter](https://github.com/mdesplenter), [@Sidsector9](https://github.com/Sidsector9), [@dsawardekar](https://github.com/dsawardekar) via [#173](https://github.com/10up/convert-to-blocks/pull/173)).

### Security
- Bump `braces` from 3.0.2 to 3.0.3 (props [@dependabot](https://github.com/apps/dependabot), [@Sidsector9](https://github.com/Sidsector9) via [#168](https://github.com/10up/convert-to-blocks/pull/168)).
- Bump `ws` from 7.5.9 to 7.5.10 (props [@dependabot](https://github.com/apps/dependabot), [@Sidsector9](https://github.com/Sidsector9) via [#169](https://github.com/10up/convert-to-blocks/pull/169)).

### Developer
- Update code comments (props [@barryceelen](https://github.com/barryceelen), [@dkotter](https://github.com/dkotter) via [#175](https://github.com/10up/convert-to-blocks/pull/175)).
- Move from `actions/upload-release-asset` to `softprops/action-gh-release` Github action (props [@Sidsector9](https://github.com/Sidsector9), [@jeffpaul](https://github.com/jeffpaul) via [#176](https://github.com/10up/convert-to-blocks/pull/176)).
- Update repo badges, add WordPress Playground badge (props [@jeffpaul](https://github.com/jeffpaul), [@dkotter](https://github.com/dkotter) via [#177](https://github.com/10up/convert-to-blocks/pull/177)).

## [1.3.0] - 2024-05-14
### Added
- Block Catalog integration, and pagination support (props [@dsawardekar](https://github.com/dsawardekar), [@iamdharmesh](https://github.com/iamdharmesh) via [#164](https://github.com/10up/convert-to-blocks/pull/164)).

### Changed
- Adjust `enable_block_editor` method only to alter posts that support the gutenbridge (props [@stormrockwell](https://github.com/stormrockwell), [@Sidsector9](https://github.com/Sidsector9), [@jeffpaul](https://github.com/jeffpaul), [@dsawardekar](https://github.com/dsawardekar) via [#136](https://github.com/10up/convert-to-blocks/pull/136)).
- Bump WordPress "tested up to" version 6.5 (props [@QAharshalkadu](https://github.com/QAharshalkadu), [@jeffpaul](https://github.com/jeffpaul), [@Sidsector9](https://github.com/Sidsector9), [@sudip-md](https://github.com/sudip-md), [@dkotter](https://github.com/dkotter) via [#146](https://github.com/10up/convert-to-blocks/pull/146), [#161](https://github.com/10up/convert-to-blocks/pull/161)).
- Replaced [lee-dohm/no-response](https://github.com/lee-dohm/no-response) with [actions/stale](https://github.com/actions/stale) to help with closing no-response/stale issues (props [@jeffpaul](https://github.com/jeffpaul) via [#159](https://github.com/10up/convert-to-blocks/pull/159)).
- Bump Node version from 16 to 20 (props [@aaronjorbin](https://github.com/aaronjorbin), [@Sidsector9](https://github.com/Sidsector9), [@dkotter](https://github.com/dkotter) via [#160](https://github.com/10up/convert-to-blocks/pull/160)).
- Bump `actions/upload-artifact` from v3 to v4 (props [@iamdharmesh](https://github.com/iamdharmesh) via [#162](https://github.com/10up/convert-to-blocks/pull/162)).

### Security
- Bump `follow-redirects` from 1.15.2 to 1.15.4 (props [@dependabot](https://github.com/apps/dependabot), [@dkotter](https://github.com/dkotter) via [#153](https://github.com/10up/convert-to-blocks/pull/153)).
- Bump `browserify-sign` from 4.0.4 to 4.2.2 (props [@dependabot](https://github.com/apps/dependabot), [@dkotter](https://github.com/dkotter) via [#145](https://github.com/10up/convert-to-blocks/pull/145)).
- Bump `@babel/traverse` from 7.11.5 to 7.23.7 (props [@dependabot](https://github.com/apps/dependabot), [@dkotter](https://github.com/dkotter) via [#155](https://github.com/10up/convert-to-blocks/pull/155)).
- Remove old dependencies in favor of using `@wordpress/scripts` in our build workflow (props [@Sidsector9](https://github.com/Sidsector9), [@dkotter](https://github.com/dkotter) via [#167](https://github.com/10up/convert-to-blocks/pull/167)).

## [1.2.2] - 2023-10-16
### Changed
- Bump WordPress "tested up to" version to 6.3 (props [@kmgalanakis](https://github.com/kmgalanakis), [@faisal-alvi](https://github.com/faisal-alvi), [@jeffpaul](https://github.com/jeffpaul), [@peterwilsoncc](https://github.com/peterwilsoncc) via [#132](https://github.com/10up/convert-to-blocks/pull/132), [#134](https://github.com/10up/convert-to-blocks/pull/134)).

### Security
- Bump `@cypress/request` from 2.88.11 to 3.0.1 and `cypress` from 10.11.0 to 13.3.0 (props [@dependabot](https://github.com/apps/dependabot), [@iamdharmesh](https://github.com/apps/iamdharmesh), [@ravinderk](https://github.com/apps/ravinderk) via [#138](https://github.com/10up/convert-to-blocks/pull/138)).
- Bump `postcss` from 8.4.20 to 8.4.31 (props [@dependabot](https://github.com/apps/dependabot), [@dkotter](https://github.com/apps/dkotter) via [#139](https://github.com/10up/convert-to-blocks/pull/139)).
- Bump `fsevents` from 1.2.9 to 1.2.13 (props [@dependabot](https://github.com/apps/dependabot), [@ravinderk](https://github.com/apps/ravinderk) via [#140](https://github.com/10up/convert-to-blocks/pull/140)).

## [1.2.1] - 2023-07-26
### Added
- More robust minimum PHP version check (props [@dkotter](https://github.com/dkotter), [@ravinderk](https://github.com/ravinderk) via [#129](https://github.com/10up/convert-to-blocks/pull/129)).

### Changed
- Bump minimum required PHP version from 7.4 to 8.0 in our `composer.json` config (props [@c0ntax](https://github.com/c0ntax), [@Sidsector9](https://github.com/Sidsector9) via [#122](https://github.com/10up/convert-to-blocks/pull/122)).

### Fixed
- Parse error caused by a comma (props [@Sidsector9](https://github.com/Sidsector9), [@iamdharmesh](https://github.com/iamdharmesh), [@ravinderk](https://github.com/ravinderk), [@felipeelia](https://github.com/felipeelia) via [#123](https://github.com/10up/convert-to-blocks/pull/123)).

### Security
- Bump `minimist` from 1.2.0 to 1.2.7 and `mkdirp` from 0.5.1 to 0.5.6 (props [@dependabot](https://github.com/apps/dependabot) via [#117](https://github.com/10up/convert-to-blocks/pull/117)).
- Bump `ini` from 1.3.5 to 1.3.8 (props [@dependabot](https://github.com/apps/dependabot) via [#119](https://github.com/10up/convert-to-blocks/pull/119)).
- Bump `browser-sync` from 2.27.10 to 2.29.3 and removes `qs` (props [@dependabot](https://github.com/apps/dependabot) via [#120](https://github.com/10up/convert-to-blocks/pull/120)).
- Bump `word-wrap` from 1.2.3 to 1.2.5 (props [@dependabot](https://github.com/apps/dependabot) via [#127](https://github.com/10up/convert-to-blocks/pull/127)).

## [1.2.0] - 2023-06-27
**Note that this release bumps the WordPress minimum version from 5.7 to 6.1 and the PHP minimum version from 7.4 to 8.0.**

### Added
- Settings UI for managing supported post types (props [@akshitsethi](https://github.com/akshitsethi), [@dinhtungdu](https://github.com/dinhtungdu), [@Sidsector9](https://github.com/Sidsector9), [@jayedul](https://github.com/jayedul), [@dsawardekar](https://github.com/dsawardekar), [@terrance-orletsky-d7](https://github.com/terrance-orletsky-d7), [@ouun](https://github.com/ouun) via [#66](https://github.com/10up/convert-to-blocks/pull/66), [#104](https://github.com/10up/convert-to-blocks/pull/104), [#112](https://github.com/10up/convert-to-blocks/pull/112), [#114](https://github.com/10up/convert-to-blocks/pull/114)).
- Filter hook `convert_to_blocks_update_posts_query_params` to modify `WP_Query` parameters to query posts that need to be migrated (props [@kmgalanakis](https://github.com/kmgalanakis), [@Sidsector9](https://github.com/Sidsector9), [@sanketio](https://github.com/sanketio) via [#113](https://github.com/10up/convert-to-blocks/pull/113)).
- Cypress end-to-end tests (props [@barneyjeffries](https://github.com/barneyjeffries), [@jeffpaul](https://github.com/jeffpaul), [@iamdharmesh](https://github.com/iamdharmesh), [@Sidsector9](https://github.com/Sidsector9), [@vikrampm1](https://github.com/vikrampm1) via [#106](https://github.com/10up/convert-to-blocks/pull/106)).

### Changed
- Bump PHP minimum supported version from 7.4 to 8.0 (props [@barneyjeffries](https://github.com/barneyjeffries), [@jeffpaul](https://github.com/jeffpaul), [@iamdharmesh](https://github.com/iamdharmesh), [@Sidsector9](https://github.com/Sidsector9), [@vikrampm1](https://github.com/vikrampm1) via [#106](https://github.com/10up/convert-to-blocks/pull/106)).
- Bump WordPress minimum supported version from 5.7 to 6.1 (props [@barneyjeffries](https://github.com/barneyjeffries), [@jeffpaul](https://github.com/jeffpaul), [@iamdharmesh](https://github.com/iamdharmesh), [@Sidsector9](https://github.com/Sidsector9), [@vikrampm1](https://github.com/vikrampm1) via [#106](https://github.com/10up/convert-to-blocks/pull/106)).
- Bump WordPress "tested up to" version 6.2 (props [@Sidsector9](https://github.com/Sidsector9) via [#115](https://github.com/10up/convert-to-blocks/pull/115)).
- Updated the Dependency Review GitHub Action (props [@jeffpaul](https://github.com/jeffpaul) via [#109](https://github.com/10up/convert-to-blocks/pull/109)).
- WordPress.org Deploy action updated to use Node 16 (props [@dkotter](https://github.com/dkotter) via [#116](https://github.com/10up/convert-to-blocks/pull/116)).

## [1.1.1] - 2023-01-05
**Note that this release bumps the WordPress minimum version from 5.4 to 5.7 and the PHP minimum version from 7.0 to 7.4.**

### Added
- Bulk migration demo to readme (props [@jeffpaul](https://github.com/jeffpaul), [@dsawardekar](https://github.com/dsawardekar) via [#79](https://github.com/10up/convert-to-blocks/pull/79)).
- Release build GitHub Action to build a release zip used for testing (props [@dkotter](https://github.com/dkotter) via [#98](https://github.com/10up/convert-to-blocks/pull/98)).

### Changed
- Bump WordPress minimum version from 5.4 to 5.7 and PHP minimum version from 7.0 to 7.4 (props [@zamanq](https://github.com/zamanq), [@jeffpaul](https://github.com/jeffpaul), [@faisal-alvi](https://github.com/faisal-alvi), [@mehul0810](https://github.com/mehul0810) via [#80](https://github.com/10up/convert-to-blocks/pull/80)).
- Bump WordPress "tested up to" version to 6.1 props [@peterwilsoncc](https://github.com/peterwilsoncc), [@faisal-alvi](https://github.com/faisal-alvi), [@cadic](https://github.com/cadic) via [#88](https://github.com/10up/convert-to-blocks/pull/88), [#91](https://github.com/10up/convert-to-blocks/pull/91)).

### Removed
- `is-svg` as it is no longer used after updating ancestor dependency `postcss-svgo` (props [@dependabot](https://github.com/apps/dependabot) via [#85](https://github.com/10up/convert-to-blocks/pull/85)).

### Fixed
- WP-CLI helptext that is causing an unknown parameter error (props [@dsawardekar](https://github.com/dsawardekar), [@jeffpaul](https://github.com/jeffpaul), [@norcross](https://github.com/norcross) via [#78](https://github.com/10up/convert-to-blocks/pull/78)).

### Security
- Bump `socket.io-parser` from 3.2.0 to 4.2.1 and `browser-sync` from 2.26.7 to 2.27.10 (props [@dependabot](https://github.com/apps/dependabot) via [#81](https://github.com/10up/convert-to-blocks/pull/81)).
- Bump `minimatch` from 3.0.4 to 3.1.2 (props [@dependabot](https://github.com/apps/dependabot) via [#82](https://github.com/10up/convert-to-blocks/pull/82)).
- Bump `nth-check` from 1.0.2 to 2.1.1 and `cssnano` from 4.1.10 to 5.1.14 (props [@dependabot](https://github.com/apps/dependabot) via [#84](https://github.com/10up/convert-to-blocks/pull/84)).
- Bump `postcss-svgo` from 4.0.2 to 4.0.3 (props [@dependabot](https://github.com/apps/dependabot) via [#85](https://github.com/10up/convert-to-blocks/pull/85)).
- Bump `minimist` from 1.2.0 to 1.2.7 and `mkdirp` from 0.5.1 to 0.5.6 (props [@dependabot](https://github.com/apps/dependabot) via [#86](https://github.com/10up/convert-to-blocks/pull/86)).
- Bump `loader-utils` from 1.2.3 to 1.4.2 and `webpack-cli` from 3.3.10 to 3.3.12 (props [@dependabot](https://github.com/apps/dependabot) via [#89](https://github.com/10up/convert-to-blocks/pull/89)).
- Bump `glob-parent` from 5.1.0 to 5.1.2 and `watchpack` from 1.6.0 to 1.7.5 (props [@dependabot](https://github.com/apps/dependabot) via [#90](https://github.com/10up/convert-to-blocks/pull/90)).
- Bump `kind-of` from 6.0.2 to 6.0.3 (props [@dependabot](https://github.com/apps/dependabot) via [#93](https://github.com/10up/convert-to-blocks/pull/93)).
- Bump `serialize-javascript` from 2.1.2 to 4.0.0 and `terser-webpack-plugin` from 1.4.3 to 1.4.5 (props [@dependabot](https://github.com/apps/dependabot) via [#94](https://github.com/10up/convert-to-blocks/pull/94)).
- Bump `engine.io` from 6.2.0 to 6.2.1 (props [@dependabot](https://github.com/apps/dependabot) via [#95](https://github.com/10up/convert-to-blocks/pull/95)).
- Bump `decode-uri-component` from 0.2.0 to 0.2.2 (props [@dependabot](https://github.com/apps/dependabot) via [#97](https://github.com/10up/convert-to-blocks/pull/97)).

## [1.1.0] - 2022-07-28
### Added
- Support for bulk migrating Classic Editor items to the Block Editor, utilizing WP-CLI (props [@dsawardekar](https://github.com/dsawardekar), [@jeffpaul](https://github.com/jeffpaul), [@gthayer](https://github.com/gthayer), [@faisal-alvi](https://github.com/faisal-alvi) via [#70](https://github.com/10up/convert-to-blocks/pull/70)).
- Dependency security scanning (props [@jeffpaul](https://github.com/jeffpaul), [@Sidsector9](https://github.com/Sidsector9) via [#64](https://github.com/10up/convert-to-blocks/pull/64)).

### Fixed
- Added polyfill to fix PHPUnit tests (props [@cadic](https://github.com/cadic), [@iamdharmesh](https://github.com/iamdharmesh) via [#69](https://github.com/10up/convert-to-blocks/pull/69)).

### Changed
- Bump WordPress version "tested up to" 6.0 (props [@mohitwp](https://github.com/mohitwp), [@jeffpaul](https://github.com/jeffpaul), [@cadic](https://github.com/cadic), [@iamdharmesh](https://github.com/iamdharmesh) via [#59](https://github.com/10up/convert-to-blocks/pull/59), [#67](https://github.com/10up/convert-to-blocks/pull/67)).

### Security
- Bump `path-parse` from 1.0.6 to 1.0.7 (props [@dependabot](https://github.com/apps/dependabot) via [#55](https://github.com/10up/convert-to-blocks/pull/55)).
- Bump `ajv` from 6.10.0 to 6.12.6 (props [@dependabot](https://github.com/apps/dependabot) via [#60](https://github.com/10up/convert-to-blocks/pull/60)).
- Bump `tar` from 4.4.8 to 4.4.19 (props [@dependabot](https://github.com/apps/dependabot) via [#61](https://github.com/10up/convert-to-blocks/pull/61)).
- Bump `terser` from 4.6.0 to 4.8.1 (props [@dependabot](https://github.com/apps/dependabot) via [#74](https://github.com/10up/convert-to-blocks/pull/74)).

## [1.0.2] - 2021-07-12
### Changed
- Bump WordPress version "tested up to" 5.8 (props [@psorensen](https://github.com/psorensen), [@BBerg10up](https://github.com/BBerg10up), [@jeffpaul](https://github.com/jeffpaul) via [#47](https://github.com/10up/convert-to-blocks/pull/47), [#50](https://github.com/10up/convert-to-blocks/pull/50)).
- Documentation updates (props [@hashimwarren](https://github.com/hashimwarren) via [#34](https://github.com/10up/convert-to-blocks/pull/34)).

### Fixed
- Transform Classic Editor blocks nested inside other blocks recursively (props [@dsawardekar](https://github.com/dsawardekar), [@MadtownLems](https://github.com/MadtownLems), [@dinhtungdu](https://github.com/dinhtungdu), [@jeffpaul](https://github.com/jeffpaul) via [#46](https://github.com/10up/convert-to-blocks/pull/46)).
- Add Editor column to all supported post types (props [@dinhtungdu](https://github.com/dinhtungdu), [Simon Carne](https://profiles.wordpress.org/scarne/) via [#36](https://github.com/10up/convert-to-blocks/pull/36)).
- Display current editor for hierarchical posts (props [@rodrigo-arias](https://github.com/rodrigo-arias) via [#43](https://github.com/10up/convert-to-blocks/pull/43)).

### Security
- Bump `elliptic` from 6.5.3 to 6.5.4 (props [@dependabot](https://github.com/apps/dependabot) via [#33](https://github.com/10up/convert-to-blocks/pull/33)).
- Bump `y18n` from 3.2.1 to 3.2.2 (@dependabot](https://github.com/apps/dependabot) via [#35](https://github.com/10up/convert-to-blocks/pull/35)).
- Bump `ssri` from 6.0.1 to 6.0.2 (props [@dependabot](https://github.com/apps/dependabot) via [#37](https://github.com/10up/convert-to-blocks/pull/37)).
- Bump `lodash` from 4.17.20 to 4.17.21 (props [@dependabot](https://github.com/apps/dependabot) via [#39](https://github.com/10up/convert-to-blocks/pull/39)).
- Bump `hosted-git-info` from 2.7.1 to 2.8.9 (props [@dependabot](https://github.com/apps/dependabot) via [#40](https://github.com/10up/convert-to-blocks/pull/40)).
- Bump `browserslist` from 4.8.3 to 4.16.5 (props [@dependabot](https://github.com/apps/dependabot) via [#41](https://github.com/10up/convert-to-blocks/pull/41)).
- Bump `postcss` from 7.0.14 to 7.0.36 (props [@dependabot](https://github.com/apps/dependabot) via [#44](https://github.com/10up/convert-to-blocks/pull/44)).
- Bump `color-string` from 1.5.3 to 1.5.5 (props [@dependabot](https://github.com/apps/dependabot) via [#48](https://github.com/10up/convert-to-blocks/pull/48)).

## [1.0.1] - 2021-02-08
### Added
- Label and updated icons for Classic and Block Editor in Editor column of post table list view (props [@dinhtungdu](https://github.com/dinhtungdu) via [#12](https://github.com/10up/convert-to-blocks/pull/12)).
- Plugin banner and icon images (props [@dianapadron](https://profiles.wordpress.org/dianapadron), [@jeffpaul](https://github.com/jeffpaul) via [#14](https://github.com/10up/convert-to-blocks/pull/14)).
- Documentation updates, unit tests, PHPCS fixes, GitHub Actions and continuous integration testing (props [@barryceelen](https://github.com/barryceelen), [@dsawardekar](https://github.com/dsawardekar), [@dinhtungdu](https://github.com/dinhtungdu), [@jeffpaul](https://github.com/jeffpaul) via [#5](https://github.com/10up/convert-to-blocks/pull/5), [#6](https://github.com/10up/convert-to-blocks/pull/6), [#8](https://github.com/10up/convert-to-blocks/pull/8), [#11](https://github.com/10up/convert-to-blocks/pull/11), [#13](https://github.com/10up/convert-to-blocks/pull/13), [#18](https://github.com/10up/convert-to-blocks/pull/18)).

### Fixed
- Issue where edit links force Classic Editor regardless of editor chosen (props [@dkotter](https://github.com/dkotter), [@tlovett1](https://github.com/tlovett1), [@dinhtungdu](https://github.com/dinhtungdu) via [#17](https://github.com/10up/convert-to-blocks/pull/17)).

### Security
- Bump `lodash` from 4.17.15 to 4.17.20 (props [@dependabot](https://github.com/apps/dependabot) via [#2](https://github.com/10up/convert-to-blocks/pull/2)).
- Bump `elliptic` from 6.5.2 to 6.5.3 (props [@dependabot](https://github.com/apps/dependabot) via [#4](https://github.com/10up/convert-to-blocks/pull/4)).
- Bump `acorn` from 6.4.0 to 6.4.2 (props [@dependabot](https://github.com/apps/dependabot) via [#7](https://github.com/10up/convert-to-blocks/pull/7)).
- Bump `dot-prop` from 4.2.0 to 4.2.1 (props [@dependabot](https://github.com/apps/dependabot) via [#15](https://github.com/10up/convert-to-blocks/pull/15)).

## [1.0.0] - 2020-09-23
### Added
- Initial release of Convert to Blocks.

[Unreleased]: https://github.com/10up/convert-to-blocks/compare/trunk...develop
[1.3.2]: https://github.com/10up/convert-to-blocks/compare/1.3.1...1.3.2
[1.3.1]: https://github.com/10up/convert-to-blocks/compare/1.3.0...1.3.1
[1.3.0]: https://github.com/10up/convert-to-blocks/compare/1.2.1...1.3.0
[1.2.2]: https://github.com/10up/convert-to-blocks/compare/1.2.1...1.2.2
[1.2.1]: https://github.com/10up/convert-to-blocks/compare/1.2.0...1.2.1
[1.2.0]: https://github.com/10up/convert-to-blocks/compare/1.1.1...1.2.0
[1.1.1]: https://github.com/10up/convert-to-blocks/compare/1.1.0...1.1.1
[1.1.0]: https://github.com/10up/convert-to-blocks/compare/1.0.2...1.1.0
[1.0.2]: https://github.com/10up/convert-to-blocks/compare/1.0.1...1.0.2
[1.0.1]: https://github.com/10up/convert-to-blocks/compare/cf8c873...1.0.1
[1.0.0]: https://github.com/10up/convert-to-blocks/tree/cf8c873ae4f88286723f6e996fbab4c1f8cf2940
