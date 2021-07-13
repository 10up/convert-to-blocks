# Changelog

All notable changes to this project will be documented in this file, per [the Keep a Changelog standard](http://keepachangelog.com/), and will adhere to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased] - TBD

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
[1.0.2]: https://github.com/10up/convert-to-blocks/compare/1.0.1...1.0.2
[1.0.1]: https://github.com/10up/convert-to-blocks/compare/cf8c873...1.0.1
[1.0.0]: https://github.com/10up/convert-to-blocks/tree/cf8c873ae4f88286723f6e996fbab4c1f8cf2940
