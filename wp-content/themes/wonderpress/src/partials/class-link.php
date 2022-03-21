<?php
/**
 * A Link partial class.
 *
 * @package Wonderpress Theme
 */

namespace Wonderpress\Partials;

use Wonderpress\Partials\Abstract_Partial;

/**
 * Link
 * Wonderpress\Partials\Image
 */
class Link extends Abstract_Partial {


	/**
	 * A definition of all available properties.
	 *
	 * @var Array $_properties
	 */
	protected static $_properties = array(
		'attributes' => array(
			'description' => 'An array of arbitrary attributes for the anchor element',
			'format' => 'array',
			'required' => false,
		),
		'classes' => array(
			'description' => 'The classes for the link element',
			'format' => 'string|array',
			'required' => false,
		),
		'content' => array(
			'description' => 'The content to display inside the anchor tag',
			'format' => 'string',
			'required' => true,
		),
		'open_in_new_tab' => array(
			'description' => 'Whether or not this link should open in a new tab when clicked',
			'format' => 'boolean',
			'default' => false,
			'required' => true,
		),
		'title' => array(
			'description' => 'A title to used to aid screenreaders in understanding this link',
			'format' => 'string',
			'default' => 'Defaults to $content (with HTML tags stripped)',
			'required' => false,
		),
		'url' => array(
			'description' => 'The anchor tag url attribute',
			'format' => 'string',
			'required' => true,
		),
	);

	/**
	 * Constructor
	 *
	 * @param Array $params An array of values to populate the partial snippet.
	 * @return void
	 */
	public function __construct( array $params = array() ) {
		// Check to see if a preferred size was passed.
		$classes = ( isset( $params['classes'] ) ) ? $params['classes'] : array();
		$this->classes = ( is_array( $classes ) ) ? implode( ' ', $classes ) : $classes;

		// Check for content
		$this->content = ( isset( $params['content'] ) ) ? $params['content'] : null;

		// Open in a new tab?
		$this->open_in_new_tab = ( isset( $params['open_in_new_tab'] ) ) ? $params['open_in_new_tab'] : false;

		// Check for a title.
		$this->title = ( isset( $params['title'] ) ) ? $params['title'] : null;
		if ( ! $this->title ) {
			$this->title = strip_tags( $this->content );
		}

		// Check for a url.
		$this->url = ( isset( $params['url'] ) ) ? $params['url'] : null;

		// Set arbitrary attributes for the element (such as data attributes).
		$this->attributes = ( isset( $params['attributes'] ) && is_array( $params['attributes'] ) ) ? $params['attributes'] : array();
	}

	/**
	 * Outputs an example code snippet for how to use this partial.
	 *
	 * @return String
	 */
	public static function example_snippet() {
		$snippet = <<<EOD
				<?php
				wonder_link(array(
					'content' => 'This is the link content',
					'open_in_new_tab' => false,
					'title' => 'This is the title of the link',
					'url' => 'https://wonderful.io/',
				), true);
				?>
				EOD;

		return $snippet;
	}


	/**
	 * An internal process to merge the property values and HTML bits into a
	 * usable HTML snippet.
	 *
	 * @return void
	 */
	public function render_into_template() {
		?>
		<a href="<?php echo esc_url( $this->url ); ?>"
		<?php
		if ( $this->classes ) {
			?>
			 class="<?php echo esc_attr( $this->classes ); ?>"<?php } ?>
		<?php
		if ( $this->title ) {
			?>
			 aria-label="<?php echo esc_attr( $this->title ); ?>"
			 title="<?php echo esc_attr( $this->title ); ?>"<?php } ?>
		<?php if ( $this->open_in_new_tab ) { ?>
			 target="_blank"
		<?php } ?>
		<?php foreach ( $this->attributes as $attribute => $value ) { ?>
			 <?php echo esc_html( $attribute ); ?>="<?php echo esc_attr( $value ); ?>"
		<?php } ?>
	   role="link"
		>
		<?php
		echo $this->content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
		</a>
		<?php
	}
}
