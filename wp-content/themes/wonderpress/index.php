<?php
/**
 * The index template: the blog posts index, and the final fallback for any
 * request no more specific template matches.
 *
 * @package Wonderpress Theme
 */

// Set the <body> id
wonder_body_id( 'index' );

get_header();
?>

	<main id="main">

		<header class="page-header">
			<h1 class="page-title">
				<?php
				if ( is_home() && ! is_front_page() ) {
					// The "Posts page" chosen under Settings → Reading.
					single_post_title();
				} else {
					esc_html_e( 'Latest Posts', 'wonderpress' );
				}
				?>
			</h1>
		</header>

		<?php get_template_part( 'loop' ); ?>

		<?php get_template_part( 'pagination' ); ?>

	</main>

<?php get_footer(); ?>
