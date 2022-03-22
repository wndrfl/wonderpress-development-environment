<?php
/**
 * Various functions and configurations to run upon page load.
 *
 * @package Wonderpress Theme
 */

/**
 * Set image sizes for the WordPress CMS
 */
if ( function_exists( 'add_theme_support' ) ) {
	add_image_size( 'banner', 2048, '', true );
	add_image_size( 'large', 1024, '', true );
	add_image_size( 'medium', 768, '', true );
	add_image_size( 'small', 375, '', true );
	add_image_size( 'micro', 120, '', true );
}

if ( ! is_admin() ) {
	/**
	 * Remove Gutenburg CSS
	 **/
	function wonder_remove_wp_block_library_css() {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
	}
	add_action( 'wp_enqueue_scripts', 'wonder_remove_wp_block_library_css', 100 );
}

/**
 * Enqueue any javascript files to be used in this theme.
 * These scripts will be added to the header or footer.
 */
function wonder_enqueue_scripts() {
	if ( 'wp-login.php' !== $GLOBALS['pagenow'] && ! is_admin() ) {

		// Remove the built-in WordPress copy of jQuery
		wp_deregister_script( 'jquery' );

		if ( wonder_body_id() ) {

			// Replace with our own copy of jquery (and our custom scripts)
			$path = '/js/' . wonder_body_id() . '.js';
			if ( file_exists( get_template_directory() . $path ) ) {

				$version = filemtime( get_template_directory() . $path );
				wp_register_script( 'global', get_template_directory_uri() . $path, array(), $version, true );
				wp_enqueue_script( 'global' );

				wp_localize_script(
					'global',
					'global_vars',
					array(
						'ajax_nonce' => wp_create_nonce( 'ajax-nonce' ),
						'ajax_url' => admin_url( 'admin-ajax.php' ),
					)
				);

				// This is hear to trigger any js scripts with a dependency on jQuery
				wp_register_script( 'jquery', false, array( 'global' ), '1.0.0', true );
			}
		}
	}
}

add_action( 'wp_enqueue_scripts', 'wonder_enqueue_scripts' );


/**
 * Enqueue any stylesheets to be used in this theme.
 */
function wonder_enqueue_styles() {

	// remove dashicons
	wp_deregister_style( 'dashicons' );

	if ( wonder_body_id() ) {
		$path = '/css/' . wonder_body_id() . '.css';

		if ( file_exists( get_template_directory() . $path ) ) {
			$version = filemtime( get_template_directory() . $path );
			wp_register_style( 'theme', get_template_directory_uri() . $path, array(), $version, 'all' );
			wp_enqueue_style( 'theme' );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'wonder_enqueue_styles' );

/**
 * Register nav menus
 */
function wonder_register_menu() {
	register_nav_menus(
		array(
			'header-menu'  => 'Header Menu',
			'sidebar-menu' => 'Sidebar Menu',
			'footer-menu'  => 'Footer Menu',
		)
	);
}

add_action( 'init', 'wonder_register_menu' );
