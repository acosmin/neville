<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Neville
 */

get_header();

	/**
	 * Hooked:
	 * neville__blog_header       - 5
	 * neville__blog_wrap_start   - 10
	 * neville__content_area_init - 20
	 * neville__blog_wrap_end     - 999
	 *
	 * @see ../template-parts/partials/__index_archive.php
	 */
	do_action( 'neville__blog' );

get_footer();
