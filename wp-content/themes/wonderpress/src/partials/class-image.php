<?php
/**
 * An Image partial class.
 *
 * @package Wonderpress Theme
 */

namespace Wonderpress\Partials;

use Wonderpress_Core\Partials\Image as Core_Image;

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
