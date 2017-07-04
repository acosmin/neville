<?php
/**
 * Template name: Front Page
 *
 * The template for displaying all single posts.
 *
 * @package Neville
 */

get_header(); ?>

	<?php
	/**
	 * Hooked:
	 * neville__tmpl_front_page_before - 10
	 * neville__tmpl_front_page_init   - 20
	 * neville__tmpl_front_page_after  - 999
	 */
	do_action( 'neville_tmpl_front_page' );
	?>

<?php
get_footer();
