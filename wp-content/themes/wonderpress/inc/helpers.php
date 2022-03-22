<?php
/**
 * Various helper methods to make development easier.
 *
 * @package Wonderpress Theme
 */

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
