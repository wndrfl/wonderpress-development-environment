<?php
/**
 * The template for displaying a footer.
 *
 * @package Wonderpress Theme
 */

?>
		<footer class="theme-footer">
			<div class="container">
				<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
				<nav class="theme-footer-nav" aria-label="<?php esc_attr_e( 'Footer', 'wonderpress' ); ?>">
					<?php wonder_nav( 'footer-menu' ); ?>
				</nav>
				<?php endif; ?>
			</div>
		</footer>

		<?php wp_footer(); ?>
	</body>
</html>
