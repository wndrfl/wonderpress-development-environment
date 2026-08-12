<?php
/**
 * The template for displaying a header.
 *
 * @package Wonderpress Theme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if ( is_singular() && pings_open() ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php endif; ?>
	<script>document.documentElement.classList.replace( 'no-js', 'js' );</script>
	<?php wp_head(); ?>
</head>

<body id="<?php echo esc_attr( wonder_body_id() ); ?>" <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'wonderpress' ); ?></a>

	<?php wonder_include_template_file( 'partials/theme-header.php', array() ); ?>
