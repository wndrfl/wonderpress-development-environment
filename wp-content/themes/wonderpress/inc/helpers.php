<?php
/**
 * Various helper methods to make development easier.
 *
 * @package Wonderpress Theme
 */

use Wonderpress\Partials\Image;
use Wonderpress\Partials\Link;

if ( ! function_exists( 'wonder_body_id' ) ) {
	/**
	 * Stash a static record of the intended body id
	 *
	 * @param String $body_id The ID of the body tag.
	 * @return Boolean|String
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

if ( ! function_exists( 'wonder_get_menu_array' ) ) {
	/**
	 * Get a WordPress Menu as an associative array.
	 *
	 * @param String $location The name of the menu location.
	 * @return Array|Boolean
	 */
	function wonder_get_menu_array( $location ) {

		// https://developer.wordpress.org/reference/functions/wp_get_nav_menu_items/
		$menu_items = wp_get_nav_menu_items( 'header-menu', array() );

		if ( ! $menu_items ) {
			return array();
		}

		$menu = array();

		// Get the parent items
		foreach ( $menu_items as $menu_item ) {
			if ( empty( $menu_item->menu_item_parent ) ) {
				$menu[ $menu_item->ID ] = (array) $menu_item;
				$menu[ $menu_item->ID ]['children'] = array();
			}
		}

		// Get all subs
		// Right now this only checks 1 level deep
		foreach ( $menu_items as $menu_item ) {
			if ( $menu_item->menu_item_parent ) {

				$parent_menu_item = false;

				if ( isset( $menu[ $menu_item->menu_item_parent ] ) ) {
					$parent_menu_item = &$menu[ $menu_item->menu_item_parent ];
				}

				// TODO: Check submenus for matches

				if ( isset( $parent_menu_item ) && $parent_menu_item ) {
					$parent_menu_item['children'][ $menu_item->ID ] = (array) $menu_item;
					$parent_menu_item['children'][ $menu_item->ID ]['children'] = array();
					unset( $parent_menu_item );
				}
			}
		}

		return $menu;
	}
}

if ( ! function_exists( 'wonder_image' ) ) {
	/**
	 * Easily render an image tag.
	 *
	 * @param Mixed[] $params An array of variables to pass to the template.
	 * @param Boolean $echo Whether to echo or return the image snippet.
	 * @return String
	 */
	function wonder_image( $params, $echo = true ) {
		$image = new Image( $params );
		$html = $image->render( $echo );
		return $html;
	}
}

if ( ! function_exists( 'wonder_include_template_file' ) ) {
	/**
	 * Render or return the contents of a template file.
	 *
	 * @param String  $_filename The path to the file.
	 * @param Mixed[] $_params An array of variables to pass to the template.
	 * @param Boolean $_return Whether to return the contents (instead of echoing them).
	 * @return void|String
	 */
	function wonder_include_template_file( $_filename, $_params = array(), $_return = false ) {
		if ( $_return ) {
			$html = '';
			ob_start();
		}

		foreach ( $_params as $k => $v ) {
			$$k = $v;
		}
		include( locate_template( $_filename ) );

		if ( $_return ) {
			$html = ob_get_contents();
			ob_end_clean();
			return $html;
		}
	}
}

if ( ! function_exists( 'wonder_link' ) ) {
	/**
	 * Easily render an anchor tag.
	 *
	 * @param Mixed[] $params An array of variables to pass to the template.
	 * @param Boolean $echo Whether to echo or return the image snippet.
	 * @return String
	 */
	function wonder_link( $params, $echo = true ) {
		$link = new Link( $params );
		$html = $link->render( $echo );
		return $html;
	}
}


if ( ! function_exists( 'wonder_nav' ) ) {
	/**
	 * Uses wp_nav_menu() to generate a new menu.
	 *
	 * @param String $location The name the navigation location to hook into.
	 * @return void
	 */
	function wonder_nav( $location = 'header-menu' ) {
		wp_nav_menu(
			array(
				'theme_location'  => $location,
				'menu'            => '',
				'container'       => '',
				'container_class' => 'menu-container',
				'container_id'    => '',
				'menu_class'      => 'menu',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul>%3$s</ul>',
				'depth'           => 0,
				'walker'          => '',
			)
		);
	}
}

if ( ! function_exists( 'wonder_rte_filter' ) ) {
	/**
	 * Add a class to p tags from the wysiwyg.
	 *
	 * @param String $content The content to filter.
	 */
	function wonder_rte_filter( $content ) {
		$content = apply_filters( 'the_content', $content );

		$replaceable = array(
			'a',
			'blockquote',
			'figcaption',
			'figure',
			'h1',
			'h2',
			'h3',
			'h4',
			'h5',
			'h6',
			'hr',
			'img',
			'li',
			'p',
			'strong',
			'table',
			'ul',
		);

		$dom = new DOMDocument();
		libxml_use_internal_errors( true );
		$dom->loadHTML( mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' ) );
		libxml_clear_errors();

		foreach ( $replaceable as $tag ) {
			foreach ( $dom->getElementsByTagName( $tag ) as $node ) {
				$existing = $node->getAttribute( 'class' );
				$existing_parts = explode( ' ', $existing );
				$existing_parts[] = 'theme-rte__' . $tag;
				$node->setAttribute( 'class', implode( ' ', $existing_parts ) );
			}
		}

		$content = $dom->saveHTML();

		return '<div class="theme-rte">' . $content . '</div>';
	}
}
