<?php
/**
 * Theme setup: supports, image sizes, navigation menus and text domain.
 *
 * @package Wonderpress Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme supports, menus and image sizes.
 *
 * Runs on after_setup_theme so child themes can adjust or remove any of it.
 *
 * @return void
 */
function wonderpress_setup() {

	// Make the theme translatable. Translations live in /languages.
	load_theme_textdomain( 'wonderpress', get_template_directory() . '/languages' );

	// Let WordPress manage the document <title>.
	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );

	// Output modern HTML5 markup for core-generated fragments.
	add_theme_support(
		'html5',
		array(
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Scale embedded media to the container width.
	add_theme_support( 'responsive-embeds' );

	// Allow wide and full alignments in the block editor.
	add_theme_support( 'align-wide' );

	// Let sites upload a logo instead of editing the header template.
	add_theme_support( 'custom-logo' );

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

/**
 * Remove the emoji detection script and styles WordPress prints by default.
 *
 * @return void
 */
function wonderpress_disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'wonderpress_disable_emojis' );
