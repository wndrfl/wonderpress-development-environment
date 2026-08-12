<?php
/**
 * The archive template.
 *
 * Serves every archive type — category, tag, author, date, taxonomy and
 * post type — via the_archive_title()/the_archive_description(), which
 * label each type correctly and translatably.
 *
 * @package Wonderpress Theme
 */

// Set the <body> id, preserving the per-archive-type Static Kit bundles.
$wonderpress_archive_body_id = 'archive';
if ( is_category() ) {
	$wonderpress_archive_body_id = 'category';
} elseif ( is_tag() ) {
	$wonderpress_archive_body_id = 'tag';
} elseif ( is_author() ) {
	$wonderpress_archive_body_id = 'author';
}
wonder_body_id( $wonderpress_archive_body_id );

get_header();
?>

	<main id="main">

		<header class="page-header">
			<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>

			<?php if ( is_author() ) : ?>
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 96 ); ?>
			<?php endif; ?>

			<?php // On author archives the description is the author's bio. ?>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
		</header>

		<?php get_template_part( 'loop' ); ?>

		<?php get_template_part( 'pagination' ); ?>

	</main>

<?php get_footer(); ?>
