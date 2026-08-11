<?php
/**
 * The template for displaying a page.
 *
 * @package Wonderpress Theme
 */

// Set the <body> id
wonder_body_id( 'page' );

get_header();
?>

	<main id="main">

		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>

				<?php the_content(); ?>

				<?php edit_post_link(); ?>

			</article>

				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>

			<?php endwhile; ?>

		<?php else : ?>

			<p class="no-results"><?php esc_html_e( 'Sorry, nothing to display.', 'wonderpress' ); ?></p>

		<?php endif; ?>

	</main>

<?php get_footer(); ?>
