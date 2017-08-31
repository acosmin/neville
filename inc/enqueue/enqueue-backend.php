<?php
/**
 * --------------------------------------------
 * Enqueue scripts and styles for the backend.
 *
 * @package Neville
 * --------------------------------------------
 */

if ( ! function_exists( 'neville_scripts_admin' ) ) {
	/**
	 * Enqueue admin styles and scripts
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function neville_scripts_admin( $hook ) {
		if ( 'widgets.php' !== $hook ) return;

		// Styles
		wp_enqueue_style(
			'neville-style-admin',
			get_template_directory_uri() . '/assets/css/admin/neville-admin.css',
			[], NEVILLE_VERSION, 'all'
		);

		// Scripts
		wp_enqueue_script(
			'neville-scripts-admin',
			get_template_directory_uri() . '/assets/js/admin/neville-admin.js',
			[ 'jquery' ], NEVILLE_VERSION, true
		);
	}
}
add_action( 'admin_enqueue_scripts', 'neville_scripts_admin' );
