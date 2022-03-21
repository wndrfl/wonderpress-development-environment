<?php
/**
 * An interface for Wonderpress partials.
 *
 * @package Wonderpress Theme
 */

namespace Wonderpress\Partials;

/**
 * Partial_Interface
 * Wonderpress\Partials\Partial_Interface
 */
interface Partial_Interface {


	/**
	 * Outputs formatted example code for this partial.
	 *
	 * @return String
	 */
	public static function example();

	/**
	 * Outputs an example code snippet for how to use this partial.
	 *
	 * @return String
	 */
	public static function example_snippet();

	/**
	 * Outputs an explanation of each property available for this partial.
	 *
	 * @return String
	 */
	public static function explain();

	/**
	 * Determines whether this instatiation is currently valid for output.
	 *
	 * @return Boolean
	 */
	public function is_valid();

	/**
	 * Build and render the HTML for this partial.
	 *
	 * @param Boolean $echo Whether or not to echo the HTML or simply return it.
	 * @return String|Boolean
	 */
	public function render( $echo = true);

	/**
	 * An internal process to merge the property values and HTML bits into a
	 * usable HTML snippet.
	 *
	 * @return void
	 */
	public function render_into_template();
}
