<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Neville
 */

get_header();

	/**
	 * Hooked:
	 * neville__page_wrap_start - 10
	 * neville__page_header     - 20
	 * neville__page_init       - 30
	 * neville__page_wrap_end   - 999
	 *
	 * @see ../template-parts/partials/__page_content.php
	 */
	do_action( 'neville__page' );

get_footer();
