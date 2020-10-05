# Convert to Blocks

>  Convert classic editor posts to blocks on the fly.

[![Support Level](https://img.shields.io/badge/support-active-green.svg)](#support-level) [![Release Version](https://img.shields.io/github/release/10up/gutenbridge.svg)](https://github.com/10up/gutenbridge/releases/latest) ![WordPress tested up to version](https://img.shields.io/badge/WordPress-v5.5%20tested-success.svg) [![GPLv2 License](https://img.shields.io/github/license/10up/gutenbridge.svg)](https://github.com/10up/gutenbridge/blob/develop/LICENSE.md)

## Overview

Convert to Blocks is a WordPress plugin that transforms classic editor content to [Gutenberg](https://wordpress.org/gutenberg/) blocks on the fly. After installing Gutenberg or upgrading to WordPress 5.0+, your content will be showing in "Classic Editor Blocks". While these blocks are completely functional and will display fine on the front of your website, they do not empower editors to fully make use of the Gutenberg experience.  In order to do so, your classic editor posts need to be converted to Gutenberg blocks. This plugin does that for you "on the fly". When an editor goes to edit a classic post, the content will be parsed into blocks. When the editor saves the post, the new structure will be saved into the database. This strategy reduces risk as you are only altering database values for content that needs to be changed.

## Requirements

* PHP 7.0+
* WordPress 5.4+

## Installation

1. Clone the repository into your `/plugins` directory.
2. Inside the repository directory, run `npm install` and then `npm build`.
3. Inside the repository directory, run `composer install`.

## Frequently Asked Questions

### How Do I Know It's Working?

Find a classic editor in the post, try to navigate away from the page. You will get an error saying your changes will be discarded. This is because Gutenbridge converted your content to blocks on the fly and those changes will be saved when you update the post.

### Will Gutenbridge Handle My Custom Blocks?

By default it will not.

## Support Level

**Active:** 10up is actively working on this, and we expect to continue work for the foreseeable future including keeping tested up to the most recent version of WordPress.  Bug reports, feature requests, questions, and pull requests are welcome.

## Changelog

A complete listing of all notable changes to Gutenbridge are documented in [CHANGELOG.md](https://github.com/10up/gutenbridge/blob/develop/CHANGELOG.md).

## Contributing

Please read [CODE_OF_CONDUCT.md](https://github.com/10up/gutenbridge/blob/develop/CODE_OF_CONDUCT.md) for details on our code of conduct, [CONTRIBUTING.md](https://github.com/10up/gutenbridge/blob/develop/CONTRIBUTING.md) for details on the process for submitting pull requests to us, and [CREDITS.md](https://github.com/10up/gutenbridge/blob/develop/CREDITS.md) for a listing of maintainers of, contributors to, and libraries used by Gutenbridge.

## Like what you see?

<p align="center">
<a href="http://10up.com/contact/"><img src="https://10up.com/uploads/2016/10/10up-Github-Banner.png" width="850"></a>
</p>
