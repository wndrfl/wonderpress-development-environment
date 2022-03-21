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

<main role="main">

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if ( has_post_thumbnail() ) : // Check if Thumbnail exists. ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(); // Fullsize image for the single post. ?>
				</a>
			<?php endif; ?>

			<h1>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h1>

			<span class="date">
				<time datetime="<?php the_time( 'Y-m-d' ); ?> <?php the_time( 'H:i' ); ?>">
					<?php the_date(); ?> <?php the_time(); ?>
				</time>
			</span>

			<span class="author">
				<?php esc_html_e( 'Published by', 'wonder' ); ?> <?php the_author_posts_link(); ?>
			</span>

			<span class="comments">
				<?php
				if ( comments_open( get_the_ID() ) ) {
					comments_popup_link( __( 'Leave your thoughts', 'wonder' ), __( '1 Comment', 'wonder' ), __( '% Comments', 'wonder' ) );}
				?>
			</span>

			<?php the_content(); ?>

			<?php the_tags( __( 'Tags: ', 'wonder' ), ', ', '<br>' ); ?>

			<p>
				<?php
				esc_html_e( 'Categorised in: ', 'wonder' );
				the_category( ', ' );
				?>
			</p>

			<p>
				<?php
				esc_html_e( 'This post was written by ', 'wonder' );
				the_author();
				?>
			</p>

			<?php edit_post_link(); ?>

			<?php comments_template(); ?>

		</article>

		<?php endwhile; ?>

	<?php else : ?>

		<article>

			<h1><?php esc_html_e( 'Sorry, nothing to display.', 'wonder' ); ?></h1>

		</article>

	<?php endif; ?>

</main>

<?php get_footer(); ?>
