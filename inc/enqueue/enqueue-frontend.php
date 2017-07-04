<?php
/**
 * --------------------------------------------
 * Enqueue scripts and styles for the frontend.
 *
 * @package Neville
 * --------------------------------------------
 */

if ( ! function_exists( 'neville_scripts' ) ) {
	/**
	 * Enqueue frontend styles and scripts
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function neville_scripts() {
		// Google fonts
		wp_enqueue_style(
			'neville-fonts',
			neville_fonts(),
			array(),
			null
		);

		// Theme style.css
		wp_enqueue_style(
			'neville-style',
			get_stylesheet_uri(),
			array(),
			NEVILLE_VERSION
		);

		// Masonry
		wp_enqueue_script( 'jquery-masonry' );

		// Scripts
		wp_enqueue_script(
			'neville-scripts',
			get_template_directory_uri() . '/assets/js/scripts.js',
			array( 'jquery' ),
			NEVILLE_VERSION,
			true
		);

		// Add some localized variables
		wp_localize_script(
			'neville-scripts',
			'neville_front_vars',
			apply_filters( 'neville___front_vars', [
				'searchx' => esc_html_x( 'X', 'Search overlay - close button text', 'neville' ),
				'search'  => esc_html_x( 'Type your search keywords here&hellip;', 'Search overlay - placeholder', 'neville' ),
			])
		);

		// Owl Carousel 2
		wp_enqueue_script(
			'neville-owl-carousel',
			get_template_directory_uri() . '/assets/js/owl.carousel.min.js',
			array( 'jquery' ),
			'2.1.0',
			true
		);

		// Sticky Sidebar
		wp_enqueue_script(
			'neville-sticky-sidebar',
			get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.js',
			array( 'jquery' ),
			'1.5.0',
			true
		);

		// Comments reply functionality
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'neville_scripts' );

if ( ! function_exists( 'neville_fonts' ) ) {
	/**
	 * Fonts URL
	 *
	 * @since  1.0.0
	 * @return string Encoded Google fonts URL
	 */
	function neville_fonts() {
		$fonts_url = '';
		$fonts     = array();

		/**
		 * Use this filter to change subsets for fonts.
		 * @var string
		 */
		$subsets = apply_filters( 'neville_fonts___subsets', $subsets = 'latin,latin-ext' );

		$fonts[] = 'Libre Franklin:400,500,600';
		$fonts[] = 'Playfair Display:400italic,700,900,900italic';
		$fonts[] = 'PT Serif:400,400italic,700,700italic';

		/**
		 * Use this filter to add or remove fonts.
		 * @var array
		 */
		$fonts = apply_filters( 'neville_fonts___family', $fonts );

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
}

if( ! function_exists( 'neville_headers_bg' ) ) {
	/**
	 * Adds a custom header based on conditions
	 *
	 * @since  1.0.0
	 * @return string Inline CSS styles
	 */
	function neville_headers_bg() {
		// Core custom header first
		$header_img = get_header_image();

		// Inline style format
		$format     = '.blog-header {
			background: url("%s") no-repeat center center;
			background-size: cover;
		}';

		// Some default values
		$custom_header = $category_img = '';

		// Check if we have a Custom header
		if( ! empty( $header_img ) ) {
			$custom_header = sprintf( $format, $header_img );
		}

		// If we are in a category archive and categories images is active
		// show this instead
		if( neville_check_categories_imgs() ) {
			$category_img  = z_taxonomy_image_url();
			$category_img  = ! empty( $category_img ) ? $category_img : $header_img;
			$custom_header = sprintf( $format, $category_img );
		}

		// Filter
		$custom_header = apply_filters( 'neville___headers_bg_custom', $custom_header, $format, $header_img, $category_img );

		// Do nothing if none are set
		if( ( empty( $header_img ) && empty( $category_img ) ) || ! is_archive() ) return;

		// Output
		wp_add_inline_style( 'neville-style', neville_sanitize_css( $custom_header ) );
	}
}
add_action( 'wp_enqueue_scripts', 'neville_headers_bg' );
