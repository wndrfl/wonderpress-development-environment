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
	<title><?php wp_title(); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<link href="//www.google-analytics.com" rel="dns-prefetch">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">

	<?php
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );}
	?>

	<?php wp_head(); ?>
</head>

<body id="<?php echo esc_attr( wonder_body_id() ); ?>" <?php body_class(); ?>>

	<?php wonder_include_template_file( 'partials/theme-header.php', array() ); ?>
