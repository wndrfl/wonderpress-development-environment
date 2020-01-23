# ✨Wonderpress

## Overview
WonderPress is a high-level development tool aimed at making the management of a WordPress development environment easier.

This isn't about theme development, its about WordPress environment management. If you want to make theme development easier, check out our boilerplate theme.

![](https://media.giphy.com/media/tVBPgQv3AO3AI/giphy.gif)


## Getting Started
Wonderpress comes with a super basic CLI to help you interact with the various developer tools it provides. The CLI will help you do everything from setting up the WordPress installation to "sniffing" your code against the WordPress Standards.

To access the Wonderpress CLI, navigate to the root of the project and enter the following in your terminal:

```
$ sh wonderpress
```
You will be prompted with:

```
*********************

✨WONDERPRESS MAIN MENU✨

*********************

What would you like to do?
[1] Setup WordPress
[2] Sniff Code
[3] Install a Plugin
[4] Reinstall Wonderpress
[5] Exit
```

### 1. Setup WordPress
This option will use the [WP CLI](https://wp-cli.org/) command-line interface to download, configure, and install the latest version of WordPress. If your machine does not currently have WP CLI installed, it will be installed in this process.

After WordPress is installed, this option will install code sniffing tools that can later be used to validate the quality of your code against the official [WordPress Coding Standards](https://github.com/WordPress/WordPress-Coding-Standards).

### 2. Sniff Code
This option will use `PHP_CodeSniffer` to validate your code against the [WordPress Coding Standards](https://github.com/WordPress/WordPress-Coding-Standards). The sniffing process looks for things like code format, syntax errors, and insecurities.

Optionally, this will also ask if you would like to automatically "fix" various issues that are found. You will be prompted to confirm before this occurs.

*Note: not all issues are able to be automatically fixed, but all issues will have associated file names and line numbers provided.*

### 3. Install a Plugin
WonderPress has various plugins that it works particularly well with. This option allows for the easy download and installation of these plugins. You will be prompted with options.

### 4. Reinstall WonderPress
Sometimes it is easy to get into a hole, and it helps to have a "reset" button. This option will **delete all files and reinstall WonderPress from scratch**. Yes, it's super danger. Be careful. ☠️