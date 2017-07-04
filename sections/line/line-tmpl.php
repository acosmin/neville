<?php

/**
 * ------------------------------
 * Line section template partials
 *
 * @package Neville
 * ------------------------------
 */

/**
 * Hook some template actions ;)
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 */
add_action( 'neville__section_line', 'neville__sec_tmpl_line', 10 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Line template
if( ! function_exists( 'neville__sec_tmpl_line' ) ) {
	function neville__sec_tmpl_line( $o ) {
		?><span><span></span><span></span><span></span></span><?php
	}
}
