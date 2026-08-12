<?php
/**
 * The search results template.
 *
 * @package Wonderpress Theme
 */

// Set the <body> id
wonder_body_id( 'search' );

get_header();
?>

	<main id="main">

		<header class="page-header">
			<h1 class="page-title">
				<?php
				/* translators: %s: the search query. */
				printf( esc_html__( 'Search results for: %s', 'wonderpress' ), '<span class="search-query">' . esc_html( get_search_query( false ) ) . '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped piecewise above.
				?>
			</h1>

			<?php get_search_form(); ?>
		</header>

		<?php get_template_part( 'loop' ); ?>

		<?php get_template_part( 'pagination' ); ?>

	</main>

<?php get_footer(); ?>
