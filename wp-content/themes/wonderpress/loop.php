<?php
/**
 * A reusable WordPress Loop
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

			<?php if ( has_post_thumbnail() ) : // Check if thumbnail exists. ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail( array( 120, 120 ) ); // Declare pixel size you need inside the array. ?>
			</a>
		<?php endif; ?>

		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h2>

		<span class="date">
			<time datetime="<?php the_time( 'Y-m-d' ); ?> <?php the_time( 'H:i' ); ?>">
				<?php the_date(); ?> <?php the_time(); ?>
			</time>
		</span>
		<span class="author"><?php esc_html_e( 'Published by', 'wonder' ); ?> <?php the_author_posts_link(); ?></span>
		<span class="comments">
		<?php
		if ( comments_open( get_the_ID() ) ) {
			comments_popup_link( __( 'Leave your thoughts', 'wonder' ), __( '1 Comment', 'wonder' ), __( '% Comments', 'wonder' ) );}
		?>
		</span>

		<?php the_excerpt(); ?>

		<?php edit_post_link(); ?>

	</article>

	<?php endwhile; ?>

<?php else : ?>

	<article>
		<h2>
			<?php esc_html_e( 'Sorry, nothing to display.', 'wonder' ); ?>
		</h2>
	</article>

<?php endif; ?>
