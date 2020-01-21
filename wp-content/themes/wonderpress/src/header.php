<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<title>
		<?php wp_title( '' ); ?>
		<?php
		if ( wp_title( '', false ) ) {
			echo ' : '; }
		?>
		<?php bloginfo( 'name' ); ?>
	</title>

	<link href="//www.google-analytics.com" rel="dns-prefetch">
	<link href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" rel="shortcut icon">
	<link href="<?php echo get_template_directory_uri(); ?>/images/touch.png" rel="apple-touch-icon-precomposed">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">

	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<?php wp_head(); ?>

	<!-- analytics -->
	<script>
	(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
	(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
	l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-XXXXXXXX-XX', 'auto');
	ga('send', 'pageview');
	</script>
</head>
<body <?php body_class(); ?>>

	<header id="theme-header" class="theme-header clear" role="banner">
		<div class="container">

			<div class="theme-header-logo">
				<a href="<?php echo home_url(); ?>"></a>
			</div>

			<nav class="theme-header-nav hidden-xs" role="navigation">
				<?php skellie_nav( 'header-menu' ); ?>
			</nav>

			<a href="#" id="theme-header-hamburger" class="theme-header-hamburger visible-xs-block">
				<span class="theme-header-hamburger-bar"></span>
				<span class="theme-header-hamburger-bar"></span>
				<span class="theme-header-hamburger-bar"></span>
			</a>
		</div>
	</header>
