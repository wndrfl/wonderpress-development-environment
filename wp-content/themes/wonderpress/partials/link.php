<?php
/**
 * A view template for a link.
 *
 * @package Wonderpress Theme
 */

?>
<a href="<?php echo esc_url( $url ); ?>"
<?php
if ( $classes ) {
	?>
	 class="<?php echo esc_attr( $classes ); ?>"<?php } ?>
<?php
if ( $title ) {
	?>
	 aria-label="<?php echo esc_attr( $title ); ?>" <?php } ?>
<?php
if ( $title ) {
	?>
	 title="<?php echo esc_attr( $title ); ?>" <?php } ?>
<?php if ( $open_in_new_tab ) { ?>
	 target="_blank" <?php } ?>
<?php
if ( $attributes ) {
	foreach ( $attributes as $attribute => $value ) {
		?>
		<?php echo esc_html( $attribute ); ?>="<?php echo esc_attr( $value ); ?>"
		<?php
	}
}
?>
role="link"
>
	<?php
	echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
</a>
