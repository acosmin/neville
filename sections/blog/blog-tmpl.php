<?php
/**
 * ------------------------------
 * Blog section template partials
 *
 * @package Neville
 * ------------------------------
 */

/**
 * Hook some template actions ;)
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 */
add_action( 'neville__section_blog', 'neville__sec_tmpl_blog_start', 10 );
add_action( 'neville__section_blog', 'neville__content_area_init',   20 );
add_action( 'neville__section_blog', 'neville__sec_tmpl_blog_end',   999 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Blog wrap start
if( ! function_exists( 'neville__sec_tmpl_blog_start' ) ) {
	function neville__sec_tmpl_blog_start( $o ) {
		?>
		<div class="container">
			<div class="row-display grid-2">
		<?php
	}
}

// Blog wrap end
if( ! function_exists( 'neville__sec_tmpl_blog_end' ) ) {
	function neville__sec_tmpl_blog_end( $o ) {
		?>
			</div>
		</div><!-- .container -->
		<?php
	}
}
