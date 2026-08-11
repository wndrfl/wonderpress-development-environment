<?php
/**
 * Front-end asset delivery.
 *
 * The theme follows the Static Kit convention: each top-level template
 * declares a body id (see wonder_body_id()), and its compiled CSS/JS bundle
 * lives at static/dist/{css,js}/{body_id}.{css,js}. When a template has no
 * bundle of its own, a shared global.{css,js} bundle is used instead.
 *
 * @package Wonderpress Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Resolve the current template's asset bundle path, relative to the theme.
 *
 * Falls back to the shared "global" bundle when the template-specific
 * bundle has not been built.
 *
 * @param String $type Either 'css' or 'js'.
 * @return String|null The relative path, or null when no bundle exists.
 */
function wonderpress_asset_path( $type ) {
	$candidates = array(
		sprintf( '/static/dist/%1$s/%2$s.%1$s', $type, wonder_body_id() ),
		sprintf( '/static/dist/%1$s/global.%1$s', $type ),
	);

	foreach ( $candidates as $candidate ) {
		if ( file_exists( get_template_directory() . $candidate ) ) {
			return $candidate;
		}
	}

	return null;
}

/**
 * Enqueue the template's stylesheet, inline or as a linked asset.
 *
 * @return void
 */
function wonderpress_enqueue_styles() {

	// The theme stylesheet carries the accessibility baseline (skip link,
	// .screen-reader-text) that core-generated markup relies on.
	wp_enqueue_style(
		'wonderpress-style',
		get_stylesheet_uri(),
		array(),
		(string) filemtime( get_stylesheet_directory() . '/style.css' )
	);

	$path = wonderpress_asset_path( 'css' );
	if ( ! $path ) {
		return;
	}

	$absolute = get_template_directory() . $path;

	if ( wonder_prefer_inline_css() ) {
		// Register an empty handle to attach the inline CSS to. The file is
		// read, never include()d, so it is not executed as PHP.
		wp_register_style( 'wonderpress-inline', false, array(), (string) filemtime( $absolute ) );
		wp_enqueue_style( 'wonderpress-inline' );
		wp_add_inline_style( 'wonderpress-inline', (string) file_get_contents( $absolute ) ); // phpcs:ignore WordPressVIPMinimum.Performance.FetchingRemoteData.FileGetContentsUnknown -- Local theme file.
		return;
	}

	wp_enqueue_style(
		'wonderpress-' . wonder_body_id(),
		get_template_directory_uri() . $path,
		array(),
		(string) filemtime( $absolute )
	);
}
add_action( 'wp_enqueue_scripts', 'wonderpress_enqueue_styles' );

/**
 * Enqueue the template's script bundle, inline or as a linked asset.
 *
 * @return void
 */
function wonderpress_enqueue_scripts() {
	$path = wonderpress_asset_path( 'js' );

	if ( $path && ! wonder_prefer_inline_js() ) {
		$absolute = get_template_directory() . $path;
		$handle   = 'wonderpress-' . wonder_body_id();

		wp_enqueue_script(
			$handle,
			get_template_directory_uri() . $path,
			array(),
			(string) filemtime( $absolute ),
			true
		);

		wp_localize_script(
			$handle,
			'wonderpressGlobals',
			array(
				'ajax_nonce' => wp_create_nonce( 'ajax-nonce' ),
				'ajax_url'   => admin_url( 'admin-ajax.php' ),
			)
		);
	}

	// Support threaded comment replies without a page reload.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wonderpress_enqueue_scripts' );

/**
 * Print the template's script bundle inline in the footer, if configured.
 *
 * @return void
 */
function wonderpress_inline_js() {
	if ( ! wonder_prefer_inline_js() ) {
		return;
	}

	$path = wonderpress_asset_path( 'js' );
	if ( ! $path ) {
		return;
	}

	// The file is read, never include()d, so it is not executed as PHP.
	$js = (string) file_get_contents( get_template_directory() . $path ); // phpcs:ignore WordPressVIPMinimum.Performance.FetchingRemoteData.FileGetContentsUnknown -- Local theme file.

	printf( '<script>%s</script>', $js ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Raw built asset; escaping would corrupt it.
}
add_action( 'wp_footer', 'wonderpress_inline_js' );

/**
 * Optionally dequeue the core block-library CSS.
 *
 * Off by default so content authored with core blocks renders styled. A
 * project that owns 100% of its CSS through Static Kit can opt in via the
 * filter, or by defining WONDERPRESS_DEQUEUE_BLOCK_CSS as true.
 *
 * @return void
 */
function wonderpress_maybe_dequeue_block_css() {
	$default = defined( 'WONDERPRESS_DEQUEUE_BLOCK_CSS' ) && WONDERPRESS_DEQUEUE_BLOCK_CSS;

	if ( ! apply_filters( 'wonderpress_dequeue_block_css', $default ) ) {
		return;
	}

	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_enqueue_scripts', 'wonderpress_maybe_dequeue_block_css', 100 );
