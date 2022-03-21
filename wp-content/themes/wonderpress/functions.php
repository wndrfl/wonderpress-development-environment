<?php
/**
 * Global functions.
 *
 * @package Wonderpress Theme
 */

/*
 * This auto-loads a class or trait just when you need it.
 *
 * This function expects the class to be stored in the `src` directory
 * and named according to the official WordPress Coding Standards for PHP classes.
 *
 * See: https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/#only-one-object-structure-class-interface-trait-should-be-declared-per-file
 */
spl_autoload_register(
	function ( $class_name ) {
		if ( false !== strpos( $class_name, 'Wonderpress' ) ) {

			// Clean up the class name to reflect that of a normal PSR-4 standard
			$classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
			$class_file  = str_replace( 'Wonderpress\\', '', $class_name ) . '.php';
			$class_file  = str_replace( '\\', DIRECTORY_SEPARATOR, $class_file );
			$class_file = strtolower( $class_file );

			// FOOLED YOU. The WordPress Coding Standard doesn't support true PSR-4
			// naming standards for classes. So we have to adjust the naming a little
			// further in order to find the correct file.
			// Now turn the file name into the WordPress-friendly naming convention
			// of "class-the-class-name.php"
			$class_file_parts = explode( DIRECTORY_SEPARATOR, $class_file );
			$file_name = 'class-' . str_replace( '_', '-', array_pop( $class_file_parts ) );
			array_push( $class_file_parts, $file_name );
			$class_file = implode( DIRECTORY_SEPARATOR, $class_file_parts );

			require_once $classes_dir . $class_file;
		}
	}
);

/**
 * Require all files in a directory.
 *
 * @param String $path The path to the directory (with trailing slash).
 */
function require_all( $path ) {
	foreach ( glob( $path . '*.php' ) as $filename ) {
		require_once $filename;
	}
}

/**
 * Import PHP files from ./lib/ directory
 */
require_all( dirname( __FILE__ ) . '/inc/' );


/**
 * Theme Support
 */

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
}


/**
 * Remove Various Actions
 */

remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
