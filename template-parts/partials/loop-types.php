<?php
/**
 * ----------------------------------------------------------------------
 * Loop types
 *
 * Each function should be in the form of `neville_posts_loop_{$type}`
 *
 * Change can change the type in the `$types` array, using the
 * `neville___ca_main_loop_types` filter
 *
 * @package Neville
 * ----------------------------------------------------------------------
 */
if( ! function_exists( 'neville_posts_loop_simple' ) ) {
	/**
	 * Displays a simple post, used in the loop. When the `$when`
	 * value is reached it will show another style of the post.
	 *
	 * @since  1.0.0
	 * @param  array $types An array with all the needed settings
	 * @param  int   $count Current post's position in the loop order
	 * @return void         A template part based on `$big` or `$normal`
	 */
	function neville_posts_loop_simple( $types, $count ) {
		// `$types` values
		$mixed  = $types[ 'mixed' ];
		$when   = $types[ 'when' ];
		$big    = $types[ 'big' ];
		$nomral = $types[ 'normal' ];

		// Post tmpl for loop
		if ( $mixed && ( $count % $when === 0 ) ) {
			// x2 tmpl
			get_template_part( $big, get_post_format() );
		} else {
			// x1 tmpl
			get_template_part( $nomral, get_post_format() );
		}
	}
}
add_action( 'neville__posts_loop_simple', 'neville_posts_loop_simple', 10, 2 );
