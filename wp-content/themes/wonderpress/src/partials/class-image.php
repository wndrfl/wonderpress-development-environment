<?php
/**
 * An Image partial class.
 *
 * @package Wonderpress Theme
 */

namespace Wonderpress\Partials;

use Wonderpress_Core\Partials\Image as Core_Image;

defined( 'ABSPATH' ) || exit;

// The base class ships with the Wonderpress Core plugin; without it there
// is nothing to extend. Callers should use wonder_image(), which falls back
// to a plain <img> tag when the plugin is missing (see inc/compat.php).
if ( ! class_exists( 'Wonderpress_Core\Partials\Image' ) ) {
	return;
}

/**
 * Image
 * Wonderpress\Partials\Image
 */
class Image extends Core_Image {

	/**
	 * A relative path to a partial template to use as the view for this partial.
	 *
	 * @var String|Boolean $_partial_template
	 */
	protected $_partial_template = 'partials/image.php';
}
