<?php
/**
 * -----------------------------------
 * Functions needed to sanitize values
 *
 * @package Neville
 * -----------------------------------
 */

if( ! function_exists( 'neville_sanitize_select' ) ) {
	/**
	 * Sanitize a selectbox in our outside the Customizer
	 *
	 * @since  1.0.0
	 * @param  string  $input      Inputed value
	 * @param  object  $setting    WP_Customize setting
	 * @param  string  $default    Default value
	 * @param  boolean $customizer If this function is intended to be used in the Customizer
	 * @return mixed               Depending on the choices
	 */
	function neville_sanitize_select( $input, $setting, $default = '', $customizer = true ) {
		global $wp_customize;

		if( $customizer ) {
			if( ! is_object( $wp_customize ) ) return;

			$control = $wp_customize->get_control( $setting->id );

			return array_key_exists( $input, $control->choices ) ? $input : $setting->default;
		} else {
			$choices = (array) $setting;

			return in_array( $input, $choices, true ) ? $input : $default;
		}
	}
}

if( ! function_exists( 'neville_sanitize_rgb' ) ) {
	/**
	 * Sanitize RGB color
	 *
	 * @since  1.0.0
	 * @param  string $color Hexadecimal color
	 * @return string        Sanitized color
	 */
	function neville_sanitize_rgb( $color ) {
		if ( '' === $color ) return '';

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) return $color;
	}
}

if( ! function_exists( 'neville_sanitize_checkbox' ) ) {
	/**
	 * Sanitize checkbox input
	 *
	 * @since  1.0.0
	 * @param  boolean $input Current value
	 * @return boolean        Sanitized value
	 */
	function neville_sanitize_checkbox( $input ) {
		return $input === true ? true : false;
	}
}

if( ! function_exists( 'neville_sanitize_rgba' ) ) {
	/**
	 * Sanitize RGBA color input
	 *
	 * @since  1.0.0
	 * @param  string $color Current RGBA color
	 * @return string        Sanitized value
	 */
	function neville_sanitize_rgba( $color ) {
		if ( empty( $color ) || is_array( $color ) ) return 'rgba(0,0,0,0)';

		if ( false === strpos( $color, 'rgba' ) ) {
			return neville_sanitize_hex( $color );
		} else {
			$color = str_replace( ' ', '', $color );
			sscanf( $color, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
			return 'rgba('.$red.','.$green.','.$blue.','.$alpha.')';
		}
	}
}

if( ! function_exists( 'neville_sanitize_css' ) ) {
	/**
	 * Sanitize CSS
	 *
	 * @since  1.0.0
	 * @param  string  $custom_css A bunch of CSS
	 * @param  boolean $format     Minified or as it is
	 * @return string              Sanitized CSS
	 */
	function neville_sanitize_css( $custom_css, $format = TRUE ) {
		if ( '' === $custom_css ) return '';

		return $format ? preg_replace('/\s\s+/', ' ', wp_strip_all_tags( $custom_css ) ) : esc_html( $custom_css );
	}
}

if( ! function_exists( 'neville_sanitize_cc_sortable' ) ) {
	/**
	 * Sanitize sortable options
	 *
	 * @since  1.0.1
	 * @param  string $input   Current input value
	 * @param  object $setting The current setting object
	 * @return string          Sanitized value
	 */
	function neville_sanitize_cc_sortable( $input, $setting ){
		$output  = [];
		$choices = $setting->manager->get_control( $setting->id )->choices;

		$items = explode( ',', $input );

		if( ! $items ) {
			return null;
		}

		foreach( $items as $item ) {
			$item = explode( ':', $item );

			if( isset( $item[ 0 ] ) && isset( $item[ 1 ] ) ) {
				if( array_key_exists( $item[ 0 ], $choices ) ) {
					$status = $item[ 1 ] ? '1' : '0';
					$output[] = trim( $item[ 0 ] . ':' . $status );
				}
			}
		}

		return trim( esc_attr( implode( ',', $output ) ) );
	}
}
