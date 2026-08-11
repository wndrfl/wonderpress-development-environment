<?php
/**
 * A view template for a theme-header.
 *
 * @package Wonderpress Theme
 */

?>
<header id="theme-header" class="theme-header">

	<div class="theme-header__logo">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<a class="theme-header__logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name', 'display' ) ); ?></a>
		<?php endif; ?>
	</div>

	<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
	<nav class="theme-header__nav" aria-label="<?php esc_attr_e( 'Primary', 'wonderpress' ); ?>">
		<?php
		// wp_nav_menu() supplies current-menu-item classes and
		// aria-current="page" on the active item.
		wp_nav_menu(
			array(
				'theme_location' => 'header-menu',
				'container'      => '',
				'menu_class'     => 'theme-header__nav-list',
				'fallback_cb'    => false,
			)
		);
		?>
	</nav>
	<?php endif; ?>
</header>
