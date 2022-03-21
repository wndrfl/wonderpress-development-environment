<?php
/**
 * The template for displaying a page
 *
 * @package Wonderpress Theme
 */

// Set the <body> id
wonder_body_id( 'page' );

get_header();
?>

	<main role="main">

		<h1><?php the_title(); ?></h1>

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<?php comments_template( '', true ); ?>

				<?php edit_post_link(); ?>

			</article>

			<?php endwhile; ?>

		<?php else : ?>

			<article>

				<h2><?php esc_html_e( 'Sorry, nothing to display.', 'wonder' ); ?></h2>

			</article>

		<?php endif; ?>

	</main>

<?php get_footer(); ?>
