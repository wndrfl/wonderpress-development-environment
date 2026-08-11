<?php
/**
 * A reusable WordPress Loop.
 *
 * @package Wonderpress Theme
 */

?>

<?php
if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( has_post_thumbnail() ) : ?>
			<?php // The heading below links to the same place, so hide this duplicate link from assistive technology. ?>
		<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
			<?php the_post_thumbnail( 'wonderpress-micro' ); ?>
		</a>
		<?php endif; ?>

		<header class="entry-header">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>

			<span class="date">
				<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
					<?php echo esc_html( get_the_date() ); ?>
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

		<?php the_excerpt(); ?>

		<?php edit_post_link(); ?>

	</article>

	<?php endwhile; ?>

<?php else : ?>

	<p class="no-results"><?php esc_html_e( 'Sorry, nothing to display.', 'wonderpress' ); ?></p>

<?php endif; ?>
