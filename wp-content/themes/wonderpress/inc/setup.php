<?php
/**
 * Theme setup: text domain, navigation menus and image sizes.
 *
 * The generic supports — title-tag, html5, responsive-embeds, align-wide and
 * the rest — come from wndrfl/wonderpress-core, which registers them on the
 * same hook. They were identical in every project. Filter
 * `wonderpress_theme_supports` to decline or change any of them.
 *
 * What stays here is what a project actually decides: which menu locations
 * exist, what image sizes to generate, and this theme's text domain.
 *
 * @package Wonderpress Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register the theme's text domain, menus and image sizes.
 *
 * Runs on after_setup_theme so child themes can adjust or remove any of it.
 *
 * @return void
 */
function wonderpress_setup() {

	// Make the theme translatable. Translations live in /languages.
	load_theme_textdomain( 'wonderpress', get_template_directory() . '/languages' );

	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu', 'wonderpress' ),
			'footer-menu' => __( 'Footer Menu', 'wonderpress' ),
		)
	);

	/*
	 * Additional image sizes, prefixed so they never override the
	 * option-driven core sizes (thumbnail, medium, large). Height 0 keeps
	 * the aspect ratio unconstrained.
	 */
	add_image_size( 'wonderpress-banner', 2048, 0 );
	add_image_size( 'wonderpress-small', 375, 0 );
	add_image_size( 'wonderpress-micro', 120, 0 );
}
add_action( 'after_setup_theme', 'wonderpress_setup' );
