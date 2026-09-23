<?php
/**
 * The theme's own stylesheet.
 *
 * Everything else about asset delivery — the Static Kit bundle convention,
 * inline CSS/JS, the optional block-library dequeue — lives in
 * wndrfl/wonderpress-core, because it is the contract with the build tool
 * rather than a decision this theme makes. See that package's inc/assets.php,
 * and filter `wonderpress_asset_candidates` to change the bundle layout.
 *
 * style.css stays here on purpose: it is this theme's file and it carries
 * skip-link :focus styles.
 *
 * @package Wonderpress Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue the theme stylesheet.
 *
 * @return void
 */
function wonderpress_enqueue_theme_stylesheet() {
	wp_enqueue_style(
		'wonderpress-style',
		get_stylesheet_uri(),
		array(),
		(string) filemtime( get_stylesheet_directory() . '/style.css' )
	);
}

/*
 * Priority 5, ahead of the package's bundle enqueue at the default 10.
 * style.css is a baseline the compiled bundle is meant to override, so it has
 * to come first in the cascade. When both lived in one function this was
 * simply statement order; across two files it has to be said out loud.
 */
add_action( 'wp_enqueue_scripts', 'wonderpress_enqueue_theme_stylesheet', 5 );
