<?php
/**
 * Theme bootstrap: class autoloading and module loading.
 *
 * @package Wonderpress Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Auto-load theme classes from the `src` directory.
 *
 * Classes in the `Wonderpress\` namespace are expected to live in `src`,
 * named according to the WordPress Coding Standards for PHP classes
 * (`class-the-class-name.php`), which differs from PSR-4: the namespace path
 * is lowercased and the file name gains a `class-` prefix with hyphens
 * instead of underscores.
 *
 * See: https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/#only-one-object-structure-class-interface-trait-should-be-declared-per-file
 */
spl_autoload_register(
	function ( $class_name ) {

		// Only handle the theme's own namespace. An exact prefix match is
		// required so this does not claim Wonderpress_Core\* classes.
		if ( 0 !== strpos( $class_name, 'Wonderpress\\' ) ) {
			return;
		}

		// Map the namespace path to a lowercased directory path.
		$class_file = str_replace( 'Wonderpress\\', '', $class_name ) . '.php';
		$class_file = str_replace( '\\', DIRECTORY_SEPARATOR, $class_file );
		$class_file = strtolower( $class_file );

		// Convert the trailing file name into the WordPress-friendly
		// naming convention of "class-the-class-name.php".
		$class_file_parts = explode( DIRECTORY_SEPARATOR, $class_file );
		$file_name        = 'class-' . str_replace( '_', '-', array_pop( $class_file_parts ) );
		array_push( $class_file_parts, $file_name );
		$class_file = implode( DIRECTORY_SEPARATOR, $class_file_parts );

		// get_theme_file_path() checks the child theme first, so a child
		// theme may override any class by shipping the same file path.
		$class_path = get_theme_file_path( 'src' . DIRECTORY_SEPARATOR . $class_file );

		// An autoloader must fall through quietly when it cannot resolve
		// a class, so another registered autoloader can take over.
		if ( file_exists( $class_path ) ) {
			require_once $class_path;
		}
	}
);

/*
 * Load the theme modules in an explicit, deterministic order.
 * compat.php must load first: it provides fallbacks for the Wonderpress
 * Core plugin functions that the other modules and templates rely on.
 */
require_once get_theme_file_path( 'inc/compat.php' );
require_once get_theme_file_path( 'inc/setup.php' );
require_once get_theme_file_path( 'inc/assets.php' );
