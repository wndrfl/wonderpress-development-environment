<?php
/**
 * A view template for a theme-link.
 *
 * Variables provided by Wonderpress_Core\Partials\Link:
 * $url, $content, $classes, $title, $open_in_new_tab, $attributes.
 *
 * @package Wonderpress Theme
 */

defined( 'ABSPATH' ) || exit;

$attrs = ( ! empty( $attributes ) && is_array( $attributes ) ) ? $attributes : array();
?>
<a href="<?php echo esc_url( $url ); ?>"
	<?php if ( ! empty( $classes ) ) : ?>
	class="<?php echo esc_attr( is_array( $classes ) ? implode( ' ', $classes ) : $classes ); ?>"
	<?php endif; ?>
	<?php if ( ! empty( $title ) ) : ?>
	title="<?php echo esc_attr( $title ); ?>"
	<?php endif; ?>
	<?php
	foreach ( $attrs as $attribute => $value ) {
		$attribute = strtolower( (string) $attribute );
		if ( ! preg_match( '/^[a-z][a-z0-9\-]*$/', $attribute ) || 0 === strpos( $attribute, 'on' ) ) {
			continue;
		}
		?>
		<?php echo esc_html( $attribute ); ?>="<?php echo esc_attr( $value ); ?>"
		<?php
	}
	?>
>
	<?php
	// Content may deliberately carry markup (icons, spans). Escaping is the
	// caller's responsibility; Abstract_Partial::render() additionally passes
	// the rendered snippet through wp_kses().
	echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
</a>
