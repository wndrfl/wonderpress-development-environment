<?php
/**
 * The template for displaying an author's postss
 *
 * @package Wonderpress Theme
 */

// Set the <body> id
wonder_body_id( 'author' );

get_header();
?>

	<main role="main">
		<?php
		if ( have_posts() ) :
			the_post();
			?>

			<h1>
			<?php
			esc_html_e( 'Author Archives for ', 'wonder' );
			echo get_the_author();
			?>
			</h1>

			<?php if ( get_the_author_meta( 'description' ) ) : ?>

				<?php echo get_avatar( get_the_author_meta( 'useresc_html_email' ) ); ?>

			<h2>
				<?php
				esc_html_e( 'About ', 'wonder' );
				echo get_the_author();
				?>
			</h2>

		<?php endif; ?>

			<?php
			rewind_posts();
			while ( have_posts() ) :
				the_post();
				?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( has_post_thumbnail() ) : // Check if Thumbnail exists. ?>
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
				<span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'wonder' ), __( '1 Comment', 'wonder' ), __( '% Comments', 'wonder' ) ); ?></span>

				<?php the_excerpt(); ?>

				<br />

				<?php edit_post_link(); ?>

			</article>

			<?php endwhile; ?>

		<?php else : ?>

			<article>

				<h2><?php esc_html_e( 'Sorry, nothing to display.', 'wonder' ); ?></h2>

			</article>

		<?php endif; ?>

		<?php get_template_part( 'pagination' ); ?>
	</main>

<?php get_footer(); ?>
