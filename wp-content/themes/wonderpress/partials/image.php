<?php
/**
 * A view template for a theme-image.
 *
 * Variables provided by Wonderpress_Core\Partials\Image:
 * $src, $srcset, $classes, $alt, $width, $height, $attributes.
 *
 * @package Wonderpress Theme
 */

defined( 'ABSPATH' ) || exit;

$has_srcset = ! empty( $srcset ) && is_array( $srcset );

// When only a srcset was supplied, fall back to its smallest candidate so
// browsers that ignore <picture> do not download the largest asset.
if ( empty( $src ) && $has_srcset ) {
	$src = end( $srcset );
}

$has_custom_loading = ! empty( $attributes ) && is_array( $attributes ) && array_key_exists( 'loading', $attributes );
?>
<?php if ( $has_srcset ) : ?>
<picture>
	<?php foreach ( $srcset as $min => $srcset_src ) : ?>
	<source media="(min-width:<?php echo esc_attr( $min ); ?>px)" srcset="<?php echo esc_url( $srcset_src ); ?>">
	<?php endforeach; ?>
<?php endif; ?>
	<img src="<?php echo esc_url( $src ); ?>"
		<?php if ( ! empty( $classes ) ) : ?>
		class="<?php echo esc_attr( is_array( $classes ) ? implode( ' ', $classes ) : $classes ); ?>"
		<?php endif; ?>
		alt="<?php echo esc_attr( isset( $alt ) ? $alt : '' ); ?>"
		<?php if ( ! $has_custom_loading ) : ?>
		loading="lazy"
		<?php endif; ?>
		<?php if ( ! empty( $width ) ) : ?>
		width="<?php echo esc_attr( $width ); ?>"
		<?php endif; ?>
		<?php if ( ! empty( $height ) ) : ?>
		height="<?php echo esc_attr( $height ); ?>"
		<?php endif; ?>
		<?php
		if ( ! empty( $attributes ) && is_array( $attributes ) ) {
			foreach ( $attributes as $attribute => $value ) {
				// Attribute names come from developer input, not user input,
				// but reject anything that is not a plain attribute name.
				$attribute = strtolower( (string) $attribute );
				if ( ! preg_match( '/^[a-z][a-z0-9\-]*$/', $attribute ) || 0 === strpos( $attribute, 'on' ) ) {
					continue;
				}
				?>
				<?php echo esc_html( $attribute ); ?>="<?php echo esc_attr( $value ); ?>"
				<?php
			}
		}
		?>
		/>
<?php if ( $has_srcset ) : ?>
</picture>
<?php endif; ?>
