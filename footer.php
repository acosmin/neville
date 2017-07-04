<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Neville
 */

		/**
		 * Display footer template
		 *
		 * @see ../inc/helper-functions.php
		 */
		neville_get_tmpl_partials(
			'footers/footer-tmpl',
			'footer_tmpl'
		);

	/**
	 * Hooked:
	 * neville__global_end_wrap - 999
	 *
	 * @see ../template-parts/partials/__global.php
	 */
	do_action( 'neville__global_end' );

wp_footer();
?>

</body>
</html>
