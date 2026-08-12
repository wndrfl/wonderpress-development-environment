<?php
/**
 * Compatibility layer for the Wonderpress Core plugin.
 *
 * The theme is designed to run alongside the Wonderpress Core plugin, which
 * provides the wonder_* helper functions and the partial classes. Everything
 * in this file is a minimal fallback so the theme still boots — degraded but
 * working — when the plugin is missing or deactivated. Each fallback is
 * guarded with function_exists(); when the plugin is active (plugins load
 * before themes), the plugin's implementations win and none of these run.
 *
 * @package Wonderpress Theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Warn administrators when the Wonderpress Core plugin is not active.
 *
 * @return void
 */
function wonderpress_core_missing_notice() {
	if ( class_exists( 'Wonderpress_Core\Partials\Abstract_Partial' ) ) {
		return;
	}

	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html__( 'The Wonderpress Core plugin is not active. The Wonderpress theme is running in reduced-functionality mode: partials, custom navigation helpers and inline asset delivery are unavailable.', 'wonderpress' )
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

if ( ! function_exists( 'wonder_get_menu_array' ) ) {
	/**
	 * Get a WordPress Menu as an associative array.
	 *
	 * Fallback: without the plugin there is no array-based menu helper, so
	 * callers receive an empty array and should degrade gracefully. Prefer
	 * wonder_nav()/wp_nav_menu() in templates.
	 *
	 * @param String $location A theme location, or a menu id, slug or name.
	 * @return Array
	 */
	function wonder_get_menu_array( $location ) {
		unset( $location );
		return array();
	}
}

if ( ! function_exists( 'wonder_link' ) ) {
	/**
	 * Render a plain anchor tag.
	 *
	 * Fallback for the plugin's Link partial. Supports the same core
	 * parameters: url, content, classes, title, open_in_new_tab.
	 *
	 * @param Mixed[] $params An array of link parameters.
	 * @param Boolean $echo Whether to echo or return the link snippet.
	 * @return String
	 */
	function wonder_link( $params, $echo = true ) {
		$classes = isset( $params['classes'] ) ? $params['classes'] : '';
		$classes = is_array( $classes ) ? implode( ' ', $classes ) : $classes;

		$html = sprintf(
			'<a href="%s"%s%s%s>%s</a>',
			esc_url( isset( $params['url'] ) ? $params['url'] : '' ),
			$classes ? ' class="' . esc_attr( $classes ) . '"' : '',
			! empty( $params['title'] ) ? ' title="' . esc_attr( $params['title'] ) . '"' : '',
			! empty( $params['open_in_new_tab'] ) ? ' target="_blank" rel="noopener noreferrer"' : '',
			wp_kses_post( isset( $params['content'] ) ? $params['content'] : '' )
		);

		if ( $echo ) {
			echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped piecewise above.
		}

		return $html;
	}
}

if ( ! function_exists( 'wonder_image' ) ) {
	/**
	 * Render a plain image tag.
	 *
	 * Fallback for the plugin's Image partial. Supports the same core
	 * parameters: src, alt, classes, width, height.
	 *
	 * @param Mixed[] $params An array of image parameters.
	 * @param Boolean $echo Whether to echo or return the image snippet.
	 * @return String
	 */
	function wonder_image( $params, $echo = true ) {
		$classes = isset( $params['classes'] ) ? $params['classes'] : '';
		$classes = is_array( $classes ) ? implode( ' ', $classes ) : $classes;

		$html = sprintf(
			'<img src="%s" alt="%s"%s%s%s loading="lazy" />',
			esc_url( isset( $params['src'] ) ? $params['src'] : '' ),
			esc_attr( isset( $params['alt'] ) ? $params['alt'] : '' ),
			$classes ? ' class="' . esc_attr( $classes ) . '"' : '',
			! empty( $params['width'] ) ? ' width="' . esc_attr( $params['width'] ) . '"' : '',
			! empty( $params['height'] ) ? ' height="' . esc_attr( $params['height'] ) . '"' : ''
		);

		if ( $echo ) {
			echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped piecewise above.
		}

		return $html;
	}
}

if ( ! function_exists( 'wonder_prefer_inline_css' ) ) {
	/**
	 * Whether the site prefers inlined CSS over enqueued stylesheets.
	 *
	 * Fallback: always false without the plugin.
	 *
	 * @param Boolean $prefer Ignored by the fallback.
	 * @return Boolean
	 */
	function wonder_prefer_inline_css( $prefer = null ) {
		unset( $prefer );
		return false;
	}
}

if ( ! function_exists( 'wonder_prefer_inline_js' ) ) {
	/**
	 * Whether the site prefers inlined JS over enqueued scripts.
	 *
	 * Fallback: always false without the plugin.
	 *
	 * @param Boolean $prefer Ignored by the fallback.
	 * @return Boolean
	 */
	function wonder_prefer_inline_js( $prefer = null ) {
		unset( $prefer );
		return false;
	}
}
