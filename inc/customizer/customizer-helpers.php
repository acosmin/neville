<?php
/**
 * ---------------------------
 * Customizer helper functions
 *
 * @package Neville
 * ---------------------------
 */

if( ! function_exists( 'neville_tm' ) ) {
	/**
	 * Wrapper for get_theme_mod with a filter applied on the default value.
	 *
	 * @see    https://developer.wordpress.org/reference/functions/get_theme_mod/
	 * @since  1.0.0
	 * @param  string  $theme_mod Theme modification name.
	 * @param  boolean $default   The default value. If not set, returns false.
	 * @return mixed              Returns theme modification value.
	 */
	function neville_tm( $theme_mod, $default = false ) {
		$def = $default ? apply_filters( 'neville___' . $theme_mod . '_default', $default ) : $default;
		$mod = get_theme_mod( $theme_mod, $def );
		return $mod;
	}
}

if( ! function_exists( 'neville_gcs' ) ) {
	/**
	 * Generate custom CSS
	 *
	 * @since  1.0.0
	 * @param  string $selector CSS selector name or id
	 * @param  string $style    CSS style, `color` fpr example
	 * @param  string $mod_name Theme mod
	 * @param  string $prefix   Before the theme mod output
	 * @param  string $suffix   After the theme mod output
	 * @param  string $type2mod Secondary theme mod
	 * @return string           Generated CSS style
	 */
	function neville_gcs( $selector, $style, $mod_name, $prefix = '', $suffix = '', $type2mod = '' ) {
		$return = '';

		if( $type2mod !== '' ) {
			$mod = $type2mod;
		} else {
			$mod = get_theme_mod( $mod_name );
		}

		if ( ! empty( $mod ) ) {

			$return = sprintf( '%1$s{%2$s:%3$s;}',
				$selector,
				$style,
				$prefix . $mod . $suffix
			);

			return $return;

		}
	}
}

if( ! function_exists( 'neville_ccd' ) ) {
	/**
	 * Check customizer default value
	 *
	 * @since  1.0.0
	 * @param  string  $mod_name Theme mod name
	 * @param  string  $default  Default value to check for
	 * @return boolean           Return true if it's not the default value
	 */
	function neville_ccd( $mod_name, $default ) {
		$mod = get_theme_mod( $mod_name );

		if ( $mod != $default || $mod == '' )	{
			return true;
		}
	}
}

if ( ! function_exists( 'neville_customizer_partial_name' ) ) {
	/**
	 * Render the site title for the selective refresh partial
	 *
	 * @return string Blog name
	 */
	function neville_customizer_partial_name() {
		neville_logo( [ 'format' => '%4$s' ] );
	}
}

if ( ! function_exists( 'neville_customizer_partial_logo' ) ) {
	/**
	 * Render the logo for the selective refresh partial
	 *
	 * @return string Custom logo output
	 */
	function neville_customizer_partial_logo() {
		neville_logo( [], 'header' );
	}
}

if ( ! function_exists( 'neville_customizer_partial_light_logo' ) ) {
	/**
	 * Render the light logo for the selective refresh partial
	 *
	 * @return string Light logo output
	 */
	function neville_customizer_partial_light_logo() {
		neville_logo( [], 'light' );
	}
}

/**
 * Options used with the Sortable Items control
 */

if( ! function_exists( 'neville_cc_sortable_post_boxes' ) ) {
	/**
	 * Post boxes order
	 *
	 * @since  1.0.0
	 * @return array Options for the post boxes sortable option
	 */
	function neville_cc_sortable_post_boxes() {

		$boxes = [];

		// About the author
		$boxes['author'] = [
			'id'       => 'author',
			'label'    => esc_html_x( 'About the author', 'Customizer sortable options', 'neville' ),
			'callback' => 'neville_about_the_author'
		];

		// Next & previous posts links
		$boxes['nextprev'] = [
			'id'       => 'nextprev',
			'label'    => esc_html_x( 'Next &amp; prev article', 'Customizer sortable options', 'neville' ),
			'callback' => 'neville_post_nav'
		];

		// Related posts
		$boxes['related'] = [
			'id'       => 'related',
			'label'    => esc_html_x( 'Related posts', 'Customizer sortable options', 'neville' ),
			'callback' => 'neville_related_posts',
			'args'     => []
		];

		// Comments
		$boxes['comments'] = [
			'id'       => 'comments',
			'label'    => esc_html_x( 'Comments', 'Customizer sortable options', 'neville' ),
			'callback' => 'neville_post_comments'
		];

		return apply_filters( 'neville_cc_sortable___post_boxes', $boxes );
	}
}

if( ! function_exists( 'neville_cc_sortable_defaults' ) ) {
	/**
	 * Creates a string of default items for a sortable control
	 *
	 * @since  1.0.0
	 * @param  array  $items Default items
	 * @return string
	 */
	function neville_cc_sortable_defaults( $items = [], $mod ){
		$default = [];
		foreach( $items as $item ) {
			$default[] = $item[ 'id' ] . ':1';
		}
		return apply_filters( 'neville_cc_sortable_defaults___' . $mod, implode( ',', $default ) );
	}
}
