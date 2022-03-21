<?php
/**
 * An Image partial class.
 *
 * @package Wonderpress Theme
 */

namespace Wonderpress\Partials;

use Wonderpress\Partials\Abstract_Partial;

/**
 * Image
 * Wonderpress\Partials\Image
 */
class Image extends Abstract_Partial {

	/**
	 * Whether this partial accepts an ACF parameter for easy hydration.
	 *
	 * @var Boolean $_acf_compatible
	 */
	protected $_acf_compatible = true;

	/**
	 * A relative path to a partial template to use as the view for this partial.
	 *
	 * @var String|Boolean $_partial_template
	 */
	protected $_partial_template = 'partials/theme-image.php';

	/**
	 * A definition of all available properties.
	 *
	 * @var Array $_properties
	 */
	protected static $_properties = array(
		'acf' => array(
			'description' => 'The ACF array for this partial.',
			'format' => 'array',
			'required' => false,
		),
		'attributes' => array(
			'description' => 'An array of arbitrary attributes for the DOM element',
			'format' => 'array',
			'required' => false,
		),
		'classes' => array(
			'description' => 'The classes for the image element',
			'default' => 'theme-image',
			'format' => 'string|array',
			'required' => false,
		),
		'alt' => array(
			'description' => 'Alternative text for the image',
			'format' => 'string',
			'required' => false,
		),
		'height' => array(
			'description' => 'The height of the image (used for attributes only).',
			'format' => 'string',
			'required' => false,
		),
		'size' => array(
			'description' => 'The default WP Image size',
			'default' => 'large',
			'format' => 'string',
			'required' => false,
		),
		'src' => array(
			'description' => 'The image src attribute',
			'format' => 'string',
			'required' => true,
		),
		'srcset' => array(
			'description' => 'A srcset for a <picture> element',
			'format' => 'array',
			'required' => false,
		),
		'width' => array(
			'description' => 'The width of the image (used for attributes only).',
			'format' => 'string',
			'required' => false,
		),
	);

	/**
	 * Outputs an example code snippet for how to use this partial.
	 *
	 * @return String
	 */
	public static function example_snippet() {
		$snippet = <<<EOD
		<?php
		wonder_image(array(
			'alt' => 'This is an example image',
			'src' => 'https://via.placeholder.com/150',
		), true);
		?>
		EOD;

		return $snippet;
	}

	/**
	 * A method to manipulate $_attrs before attempting to display.
	 *
	 * @return Boolean
	 */
	public function prepare_properties_for_display() {

		// If ACF is provided, we do some more special assignments
		if ( isset( $this->_attrs['acf'] ) && is_array( $this->_attrs['acf'] ) ) {

			switch ( $this->size ) {
				case 'medium':
					$this->src = isset( $this->_attrs['acf']['sizes']['medium'] ) ? $this->_attrs['acf']['sizes']['medium'] : null;
					break;
				case 'small':
					$this->src = isset( $this->_attrs['acf']['sizes']['small'] ) ? $this->_attrs['acf']['sizes']['small'] : null;
					break;
				case 'large':
				default:
					$this->src = isset( $this->_attrs['acf']['sizes']['large'] ) ? $this->_attrs['acf']['sizes']['large'] : null;
					break;
			}

			$this->srcset = array(
				'1024' => isset( $this->_attrs['acf']['sizes']['banner'] ) ? $this->_attrs['acf']['sizes']['banner'] : $this->src,
				'768' => isset( $this->_attrs['acf']['sizes']['large'] ) ? $this->_attrs['acf']['sizes']['large'] : $this->src,
				'120' => isset( $this->_attrs['acf']['sizes']['medium'] ) ? $this->_attrs['acf']['sizes']['medium'] : $this->src,
				'0' => isset( $this->_attrs['acf']['sizes']['small'] ) ? $this->_attrs['acf']['sizes']['small'] : $this->src,
			);

			$this->width = isset( $this->_attrs['acf']['width'] ) ? (string) $this->_attrs['acf']['width'] : null;
			$this->height = isset( $this->_attrs['acf']['height'] ) ? (string) $this->_attrs['acf']['height'] : null;
		}

		// If no alt was passed, let's do a best attempt
		if ( ! $this->alt || empty( $this->alt ) ) {
			$this->alt = $this->src;
		}

		return true;
	}
}
