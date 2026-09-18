<?php
/**
 * Minimal fallbacks for when wndrfl/wonderpress-core is not installed.
 *
 * The theme declares that package as a Composer dependency, so the usual cause
 * of it being absent is that `composer install` has not run. That is a setup
 * error, not a supported mode — this file exists so the site says so clearly
 * instead of fataling, not so it can run indefinitely without the package.
 *
 * It is deliberately small. It used to carry full fallback implementations of
 * wonder_link(), wonder_image(), wonder_nav() and friends: a second copy of
 * behaviour that also lives in the package, free to drift from it, and covered
 * by no test. What remains is only the handful of helpers this theme's
 * templates call directly, in their simplest honest form.
 *
 * Each fallback is guarded with function_exists(). When the package is present
 * — loaded by functions.php through vendor/autoload.php, or by an older site's
 * mu-plugin — its implementations win and none of these run.
 *
 * @package Wonderpress Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Warn administrators when the theme's dependencies are not installed.
 *
 * @return void
 */
function wonderpress_core_missing_notice() {
	if ( class_exists( 'Wonderpress_Core\Partials\Abstract_Partial' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html__( "The Wonderpress theme's dependencies are not installed, so it is running in reduced-functionality mode: partials, blocks, compiled CSS and JS, and custom navigation helpers are unavailable. Run `composer install` in the theme directory.", 'wonderpress' )
	);
}
add_action( 'admin_notices', 'wonderpress_core_missing_notice' );

if ( ! function_exists( 'wonder_body_id' ) ) {
	/**
	 * Stash a static record of the intended body id.
	 *
	 * Each top-level template declares its id before get_header() runs, and
	 * the asset pipeline uses the same id to find the template's CSS/JS
	 * bundle in static/dist.
	 *
	 * @param String $body_id The ID of the body tag.
	 * @return Boolean|String True when setting; the current id when getting.
	 */
	function wonder_body_id( $body_id = null ) {
		static $_body_id;

		if ( ! is_null( $body_id ) ) {
			$_body_id = $body_id;
			return true;
		}

		return ( $_body_id ? $_body_id : 'body' );
	}
}

if ( ! function_exists( 'wonder_include_template_file' ) ) {
	/**
	 * Render or return the contents of a template file.
	 *
	 * @param String  $_filename The path to the file, relative to the theme.
	 * @param Mixed[] $_params An array of variables to pass to the template.
	 * @param Boolean $_return Whether to return the contents (instead of echoing them).
	 * @return void|String
	 */
	function wonder_include_template_file( $_filename, $_params = array(), $_return = false ) {

		$_template = locate_template( $_filename );
		if ( ! $_template ) {
			return $_return ? '' : null;
		}

		if ( $_return ) {
			ob_start();
		}

		foreach ( $_params as $k => $v ) {
			$$k = $v;
		}
		include $_template;

		if ( $_return ) {
			return ob_get_clean();
		}
	}
}

if ( ! function_exists( 'wonder_nav' ) ) {
	/**
	 * Output a navigation menu for a registered theme location.
	 *
	 * @param String $location The navigation location to render.
	 * @return void
	 */
	function wonder_nav( $location = 'header-menu' ) {
		wp_nav_menu(
			array(
				'theme_location' => $location,
				'container'      => '',
				'menu_class'     => 'menu',
				'fallback_cb'    => 'wp_page_menu',
				'items_wrap'     => '<ul>%3$s</ul>',
			)
		);
	}
}
