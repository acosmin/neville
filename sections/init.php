<?php
/**
 * --------------------
 * Initializes all sections and templates needed to create an awesome home page.
 *
 * @package Neville
 * --------------------
 */

/**
 * Register all the section widgets
 */
add_action( 'widgets_init', 'neville_sections_init', 30 );

if( ! function_exists( 'neville_sections' ) ) {
	/**
	 * Returns an array of all the sections
	 *
	 * @since  1.0.0
	 * @return array All the sections to include
	 */
	function neville_sections() {
		return apply_filters( 'neville___sections', [
			'slider',
			'category',
			'blog',
			'line'
		] );
	}
}

if( ! function_exists( 'neville_sections_tmpl_excluded' ) ) {
	/**
	 * Returns an array with section that need to be excluded
	 * from loading a template
	 *
	 * @since  1.0.0
	 * @return array Excluded sections
	 */
	function neville_sections_tmpl_excluded() {
		return apply_filters( 'neville___sections_tmpl_excluded', [] );
	}
}

if( ! function_exists( 'neville_sections_init' ) ) {
	/**
	 * Initialize all sections
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function neville_sections_init() {
		/* Get all sections */
		$sections = neville_sections();

		/* Excluded sections */
		$excluded = neville_sections_tmpl_excluded();

		/* And go through them and include them */
		foreach ( $sections as $name ) {
			$name   = sanitize_key( $name );
			$folder = trailingslashit( $name );
			require_once( NEVILLE_SECTIONS . $folder . $name . '.php' );

			/* Load templates */
			if( ! in_array( $name, $excluded, true ) ) {
				require_once( NEVILLE_SECTIONS . $folder . $name . '-tmpl.php' );
			}
		}
	}
}
