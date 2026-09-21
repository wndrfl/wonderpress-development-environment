<?php
/**
 * A view template for a theme-image.
 *
 * Variables provided by Wonderpress_Core\Partials\Image:
 * $src, $srcset, $sizes, $classes, $alt, $width, $height, $decoding, $attributes.
 *
 * @package Wonderpress Theme
 */

defined( 'ABSPATH' ) || exit;

$attrs               = ( ! empty( $attributes ) && is_array( $attributes ) ) ? $attributes : array();
$has_custom_loading  = array_key_exists( 'loading', $attrs );
$has_custom_decoding = array_key_exists( 'decoding', $attrs );
$is_picture          = ! empty( $srcset ) && is_array( $srcset );
$native_srcset       = ! empty( $srcset ) && is_string( $srcset );

if ( empty( $src ) && $is_picture ) {
	$src = end( $srcset );
}
?>
<?php if ( $is_picture ) : ?>
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
		<?php if ( ! $has_custom_decoding && ! empty( $decoding ) ) : ?>
		decoding="<?php echo esc_attr( $decoding ); ?>"
		<?php endif; ?>
		<?php if ( ! empty( $width ) ) : ?>
		width="<?php echo esc_attr( $width ); ?>"
		<?php endif; ?>
		<?php if ( ! empty( $height ) ) : ?>
		height="<?php echo esc_attr( $height ); ?>"
		<?php endif; ?>
		<?php if ( $native_srcset ) : ?>
		srcset="<?php echo esc_attr( $srcset ); ?>"
		<?php endif; ?>
		<?php if ( ! empty( $sizes ) && is_string( $sizes ) ) : ?>
		sizes="<?php echo esc_attr( $sizes ); ?>"
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
		/>
<?php if ( $is_picture ) : ?>
</picture>
<?php endif; ?>
