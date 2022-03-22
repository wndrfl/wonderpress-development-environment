<?php
/**
 * A view template for an image.
 *
 * @package Wonderpress Theme
 */

// If there are multiple sources, use the <picture> element.
if ( $srcset ) {
	$src = reset( $srcset );
	?>
<picture>
	<?php foreach ( $srcset as $min => $srcset_src ) { ?>
	<source media="(min-width:<?php echo esc_attr( $min ); ?>px)" srcset="<?php echo esc_url( $srcset_src ); ?>">
	<?php } ?>
<?php } ?>
	<img src="<?php echo esc_url( $src ); ?>"
		<?php if ( isset( $classes ) ) { ?>
		 class="<?php echo esc_attr( $classes ); ?>"
		<?php } ?>
		<?php if ( isset( $alt ) ) { ?>
		 alt="<?php echo esc_attr( $alt ); ?>"
		<?php } ?>
		 loading="lazy"
		<?php if ( isset( $width ) ) { ?>
		 width="<?php echo esc_attr( $width ); ?>"
		<?php } ?>
		<?php if ( isset( $height ) ) { ?>
		 height="<?php echo esc_attr( $height ); ?>"
		<?php } ?>
		<?php
		if ( isset( $attributes ) && is_array( $attributes ) ) {
			foreach ( $attributes as $attribute => $value ) {
				?>
				<?php echo esc_html( $attribute ); ?>="<?php echo esc_attr( $value ); ?>"
				<?php
			}
		}
		?>
		/>
<?php if ( $srcset ) { ?>
</picture>
	<?php
}
