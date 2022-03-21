# ✨ Wonderpress Theme

[![wonderpress-coding-standards Status](https://github.com/wndrfl/wonderpress-theme/workflows/wonderpress-coding-standards/badge.svg)](https://github.com/wndrfl/wonderpress-theme/actions)

Wonderpress Theme is the official Wonderful boilerplate theme for WordPress. The goal is to provide coverage for the basics of a WordPress theme, without imposing opinion on styles or structure.

This theme leans heavily on Wonderful's [Static Kit](https://github.com/wndrfl/static-kit) development environment.

## Installation

1. Download the theme into your Wordpress installation
1. Run `$ npm install`
1. Static Kit will automatically be installed and prepared in the theme directory
1. Run `$ gulp`

## Linting

Wonderpress Theme includes tools to lint your code against the [WordPress Coding Standards](https://github.com/WordPress/WordPress-Coding-Standards).

To lint your code:

1. Install all dependencies with `$ composer install`
1. Run the linter with `$ composer run lint`

To automatically fix errors found during lint:

`$ composer run lint-fix`

