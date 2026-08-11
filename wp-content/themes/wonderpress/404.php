<?php
/**
 * The 404 template.
 *
 * @package Wonderpress Theme
 */

// Set the <body> id
wonder_body_id( '404' );

get_header();
?>

	<main id="main">

		<section class="error-404">

			<h1><?php esc_html_e( 'Page not found', 'wonderpress' ); ?></h1>

			<p>
				<?php esc_html_e( 'The page you are looking for does not exist. It may have been moved or removed. Try a search, or head back home.', 'wonderpress' ); ?>
			</p>

			<?php get_search_form(); ?>

			<p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return home', 'wonderpress' ); ?></a>
			</p>

		</section>

	</main>

<?php get_footer(); ?>
