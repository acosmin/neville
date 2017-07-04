<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
