<?php
/**
 * The pagination template.
 *
 * the_posts_pagination() outputs a labelled <nav> landmark with numbered,
 * translated links and aria-current on the active page — and nothing at
 * all when there is only one page.
 *
 * @package Wonderpress Theme
 */

the_posts_pagination(
	array(
		'prev_text' => esc_html__( 'Newer posts', 'wonderpress' ),
		'next_text' => esc_html__( 'Older posts', 'wonderpress' ),
	)
);
