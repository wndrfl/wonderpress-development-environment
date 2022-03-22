<?php
/**
 * A Link partial class.
 *
 * @package Wonderpress Theme
 */

namespace Wonderpress\Partials;

use Wonderpress_Core\Partials\Link as Core_Link;

/**
 * Link
 * Wonderpress\Partials\Image
 */
class Link extends Core_Link {

	/**
	 * A relative path to a partial template to use as the view for this partial.
	 *
	 * @var String|Boolean $_partial_template
	 */
	protected $_partial_template = 'partials/link.php';
}
