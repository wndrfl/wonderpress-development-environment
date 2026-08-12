<?php
/**
 * A Link partial class.
 *
 * @package Wonderpress Theme
 */

namespace Wonderpress\Partials;

use Wonderpress_Core\Partials\Link as Core_Link;

defined( 'ABSPATH' ) || exit;

// The base class ships with the Wonderpress Core plugin; without it there
// is nothing to extend. Callers should use wonder_link(), which falls back
// to a plain <a> tag when the plugin is missing (see inc/compat.php).
if ( ! class_exists( 'Wonderpress_Core\Partials\Link' ) ) {
	return;
}

/**
 * Link
 * Wonderpress\Partials\Link
 */
class Link extends Core_Link {

	/**
	 * A relative path to a partial template to use as the view for this partial.
	 *
	 * @var String|Boolean $_partial_template
	 */
	protected $_partial_template = 'partials/link.php';
}
