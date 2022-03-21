<?php
/**
 * The archive page template.
 *
 * @package Wonderpress Theme
 */

// Set the <body> id
wonder_body_id( 'archive' );

get_header();
?>

	<main role="main">

		<section>

			<h1>
				<?php esc_html_e( 'Archives', 'bt' ); ?>
			</h1>

			<?php get_template_part( 'loop' ); ?>

			<?php get_template_part( 'pagination' ); ?>

		</section>

	</main>

<?php get_footer(); ?>
