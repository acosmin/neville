<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Neville
 */

get_header();

	/**
	 * Hooked:
	 * neville__single_wrap_start - 10
	 * neville__single_header     - 20
	 * neville__single_init       - 30
	 * neville__single_wrap_end   - 999
	 *
	 * @see ../template-parts/partials/__post_content.php
	 */
	do_action( 'neville__single' );

get_footer();
