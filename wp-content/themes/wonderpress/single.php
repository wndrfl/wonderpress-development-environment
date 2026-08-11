<?php
/**
 * The template for displaying a single post.
 *
 * @package Wonderpress Theme
 */

// Set the <body> id
wonder_body_id( 'single' );

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

					<span class="date">
						<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
							<?php echo esc_html( get_the_date() . ' ' . get_the_time() ); ?>
						</time>
					</span>

					<span class="author">
						<?php
						/* translators: %s: the author's posts link. */
						printf( esc_html__( 'Published by %s', 'wonderpress' ), get_the_author_posts_link() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_the_author_posts_link() returns built, escaped markup.
						?>
					</span>

					<?php if ( comments_open() || get_comments_number() ) : ?>
					<span class="comments">
						<?php comments_popup_link( esc_html__( 'Leave your thoughts', 'wonderpress' ), esc_html__( '1 Comment', 'wonderpress' ), esc_html__( '% Comments', 'wonderpress' ) ); ?>
					</span>
					<?php endif; ?>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail(); ?>
				<?php endif; ?>

				<?php the_content(); ?>

				<footer class="entry-meta">
					<?php
					$wonderpress_tag_list = get_the_tag_list( '', esc_html__( ', ', 'wonderpress' ) );
					if ( $wonderpress_tag_list ) :
						?>
					<p class="entry-tags">
						<?php
						/* translators: %s: comma-separated list of tag links. */
						printf( esc_html__( 'Tagged: %s', 'wonderpress' ), $wonderpress_tag_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_the_tag_list() returns built, escaped markup.
						?>
					</p>
					<?php endif; ?>

					<?php
					$wonderpress_category_list = get_the_category_list( esc_html__( ', ', 'wonderpress' ) );
					if ( $wonderpress_category_list ) :
						?>
					<p class="entry-categories">
						<?php
						/* translators: %s: comma-separated list of category links. */
						printf( esc_html__( 'Categorised in: %s', 'wonderpress' ), $wonderpress_category_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- get_the_category_list() returns built, escaped markup.
						?>
					</p>
					<?php endif; ?>

					<?php edit_post_link(); ?>
				</footer>

			</article>

				<?php
				the_post_navigation(
					array(
						'prev_text' => esc_html__( 'Previous: %title', 'wonderpress' ),
						'next_text' => esc_html__( 'Next: %title', 'wonderpress' ),
					)
				);
				?>

				<?php comments_template(); ?>

			<?php endwhile; ?>

		<?php else : ?>

			<p class="no-results"><?php esc_html_e( 'Sorry, nothing to display.', 'wonderpress' ); ?></p>

		<?php endif; ?>

	</main>

<?php get_footer(); ?>
