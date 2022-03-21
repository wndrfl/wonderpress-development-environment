<?php
/**
 * The template for displaying a footer.
 *
 * @package Wonderpress Theme
 */

?>
		<footer class="theme-footer" role="contentinfo">
			<div class="container">
				<nav class="theme-footer-nav">
					<?php wonder_nav( 'footer-menu' ); ?>
				</nav>
			</div>
		</footer>

		<?php wp_footer(); ?>

		<div id="theme-mobile-nav" class="theme-mobile-nav visible-xs-block">
			<?php wonder_nav( 'header-menu' ); ?>
		</div>
	</body>
</html>
