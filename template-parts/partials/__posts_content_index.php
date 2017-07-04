<?php
/**
 * --------------------
 * Index posts template
 *
 * @package Neville
 * --------------------
 */

/**
 * Hook some template actions ;)
 *
 * You can find some of these functions in ../inc/entry/meta.php
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 */
add_action( 'neville__content_index', 'neville__content_index_start', 10 );
add_action( 'neville__content_index', 'neville__content_index_share', 20 );
add_action( 'neville__content_index', 'neville__content_index_thumb', 30 );
add_action( 'neville__content_index', 'neville__content_index_entry', 40 );
add_action( 'neville__content_index', 'neville__content_index_end',   999 );

add_action( 'neville__content_index_thumb', 'neville__content_index_thumb_start',   10 );
add_action( 'neville__content_index_thumb', 'neville__content_index_thumb_image',   20 );
add_action( 'neville__content_index_thumb', 'neville__content_index_thumb_overlay', 30 );
add_action( 'neville__content_index_thumb', 'neville__content_index_thumb_end',     999 );

add_action( 'neville__content_index_entry', 'neville__content_index_entry_start',   10 );
add_action( 'neville__content_index_entry', 'neville__content_index_entry_meta1',   20 );
add_action( 'neville__content_index_entry', 'neville__content_index_entry_title',   30 );
add_action( 'neville__content_index_entry', 'neville__content_index_entry_excerpt', 40 );
add_action( 'neville__content_index_entry', 'neville__content_index_entry_meta2',   50 );
add_action( 'neville__content_index_entry', 'neville__content_index_entry_end',     999 );

add_action( 'neville__content_index_entry_meta1', 'neville__content_index_entry_meta1_start', 10 );
add_action( 'neville__content_index_entry_meta1', 'neville__content_index_entry_meta1_cat',   20 );
add_action( 'neville__content_index_entry_meta1', 'neville__content_index_entry_meta1_end',   999 );

add_action( 'neville__content_index_entry_meta2', 'neville__content_index_entry_meta2_start',  10 );
add_action( 'neville__content_index_entry_meta2', 'neville__content_index_entry_meta2_author', 20 );
add_action( 'neville__content_index_entry_meta2', 'neville__content_index_entry_meta2_com',    30 );
add_action( 'neville__content_index_entry_meta2', 'neville__content_index_entry_meta2_date',   40 );
add_action( 'neville__content_index_entry_meta2', 'neville__content_index_entry_meta2_sticky', 50 );
add_action( 'neville__content_index_entry_meta2', 'neville__content_index_entry_meta2_share',  60 );
add_action( 'neville__content_index_entry_meta2', 'neville__content_index_entry_meta2_end',    999 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Entry start
if( ! function_exists( 'neville__content_index_start' ) ) {
	function neville__content_index_start() {
		$classes = apply_filters( 'neville___content_index_start_classes', [] );
		?><article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>><?php
	}
}

// Entry end
if( ! function_exists( 'neville__content_index_end' ) ) {
	function neville__content_index_end() {
		?></article><!-- #post-<?php the_ID(); ?> --><?php
	}
}

// Entry share
if( ! function_exists( 'neville__content_index_share' ) ) {
	function neville__content_index_share() {
		neville_share_display( true );
	}
}

// Entry thumb
if( ! function_exists( 'neville__content_index_thumb' ) ) {
	function neville__content_index_thumb() {
		$hide = apply_filters( 'neville___content_index_thumb_hide', false );

		// Don't show if no thumbnail
		if( ! has_post_thumbnail() || $hide ) return;

		/**
		 * Hooked
		 * neville__content_index_thumb_start   - 10
		 * neville__content_index_thumb_image   - 20
		 * neville__content_index_thumb_overlay - 30
		 * neville__content_index_thumb_end     - 999
		 */
		do_action( 'neville__content_index_thumb' );
	}
}

	// Entry thumbnail start
	if( ! function_exists( 'neville__content_index_thumb_start' ) ) {
		function neville__content_index_thumb_start() {
			?><figure class="img-has-overlay post-thumbnail"><?php
		}
	}

	// Entry thumbnail end
	if( ! function_exists( 'neville__content_index_thumb_end' ) ) {
		function neville__content_index_thumb_end() {
			?></figure><?php
		}
	}

	// Entry thumbnail image
	if( ! function_exists( 'neville__content_index_thumb_image' ) ) {
		function neville__content_index_thumb_image() {
			$size = apply_filters( 'neville___content_index_thumb_image', 'post-thumbnail' );
			the_post_thumbnail( $size );
		}
	}

	// Entry thumbnail overlay
	if( ! function_exists( 'neville__content_index_thumb_overlay' ) ) {
		function neville__content_index_thumb_overlay() {
			// Templates
			$classes     = 'img-overlay empty-caption no-gradient';
			$link        = '<a href="%1$s" title="%2$s" class="img-link-to" rel="nofollow"></a>';
			$link_output = sprintf( $link, esc_url( get_the_permalink() ), the_title_attribute( 'echo=0') );
			$overlay     = '<figcaption class="%1$s">%2$s</figcaption>';
			$output      = sprintf( $overlay, esc_attr( $classes ), $link_output );

			// Filter
			$output = apply_filters( 'neville___content_index_thumb_overlay', $output, $overlay, $link_output, $link, $classes );

			// Display
			echo $output;
		}
	}

// Entry content
if( ! function_exists( 'neville__content_index_entry' ) ) {
	function neville__content_index_entry() {
		/**
		 * Hooked
		 * neville__content_index_entry_start   - 10
		 * neville__content_index_entry_meta1   - 20
		 * neville__content_index_entry_title   - 30
		 * neville__content_index_entry_excerpt - 40
		 * neville__content_index_entry_meta2   - 50
		 * neville__content_index_entry_end     - 999
		 */
		do_action( 'neville__content_index_entry' );
	}
}

	// Entry content start
	if( ! function_exists( 'neville__content_index_entry_start' ) ) {
		function neville__content_index_entry_start() {
			?><div class="entry-content"><?php
		}
	}

	// Entry content end
	if( ! function_exists( 'neville__content_index_entry_end' ) ) {
		function neville__content_index_entry_end() {
			?></div><?php
		}
	}

	// Entry content meta 1
	if( ! function_exists( 'neville__content_index_entry_meta1' ) ) {
		function neville__content_index_entry_meta1() {
			/**
			 * Hooked:
			 * neville__content_index_entry_meta1_start - 10
			 * neville__content_index_entry_meta1_cat   - 20
			 * neville__content_index_entry_meta1_end   - 999
			 */
			do_action( 'neville__content_index_entry_meta1' );
		}
	}

		// Entry content meta 1 start
		if( ! function_exists( 'neville__content_index_entry_meta1_start' ) ) {
			function neville__content_index_entry_meta1_start() {
				?><div class="entry-meta"><?php
			}
		}

		// Entry content meta 1 end
		if( ! function_exists( 'neville__content_index_entry_meta1_end' ) ) {
			function neville__content_index_entry_meta1_end() {
				?></div><?php
			}
		}

		// Entry content meta 1 category
		if( ! function_exists( 'neville__content_index_entry_meta1_cat' ) ) {
			function neville__content_index_entry_meta1_cat() {
				$args = apply_filters( 'neville___content_index_entry_meta1_cat', [] );
				neville_em_single_cat( $args, true );
			}
		}

	// Entry content title
	if( ! function_exists( 'neville__content_index_entry_title' ) ) {
		function neville__content_index_entry_title() {
			neville_content_title( [], 'content_index' );
		}
	}

	// Entry content excerpt
	if( ! function_exists( 'neville__content_index_entry_excerpt' ) ) {
		function neville__content_index_entry_excerpt() {
			$args = apply_filters( 'neville___content_index_entry_title', [] );
			neville_excerpt( $args );
		}
	}

	// Entry content meta 2
	if( ! function_exists( 'neville__content_index_entry_meta2' ) ) {
		function neville__content_index_entry_meta2() {
			/**
			 * Hooked:
			 * neville__content_index_entry_meta2_start  - 10
			 * neville__content_index_entry_meta2_author - 20
			 * neville__content_index_entry_meta2_com    - 30
			 * neville__content_index_entry_meta2_date   - 40
			 * neville__content_index_entry_meta2_sticky - 50
			 * neville__content_index_entry_meta2_share  - 60
			 * neville__content_index_entry_meta2_end    - 999
			 */
			do_action( 'neville__content_index_entry_meta2' );
		}
	}

		// Entry content meta 2 start
		if( ! function_exists( 'neville__content_index_entry_meta2_start' ) ) {
			function neville__content_index_entry_meta2_start() {
				?><footer class="entry-meta"><?php
			}
		}

		// Entry content meta 2 end
		if( ! function_exists( 'neville__content_index_entry_meta2_end' ) ) {
			function neville__content_index_entry_meta2_end() {
				?></footer><?php
			}
		}

		// Entry content meta 2 author
		if( ! function_exists( 'neville__content_index_entry_meta2_author' ) ) {
			function neville__content_index_entry_meta2_author() {
				echo neville_em_author();
			}
		}

		// Entry content meta 2 comments
		if( ! function_exists( 'neville__content_index_entry_meta2_com' ) ) {
			function neville__content_index_entry_meta2_com() {
				echo neville_em_comments();
			}
		}

		// Entry content meta 2 date
		if( ! function_exists( 'neville__content_index_entry_meta2_date' ) ) {
			function neville__content_index_entry_meta2_date() {
				echo neville_em_time();
			}
		}

		// Entry content meta 2 sticky
		if( ! function_exists( 'neville__content_index_entry_meta2_sticky' ) ) {
			function neville__content_index_entry_meta2_sticky() {
				echo neville_em_sticky_tag();
			}
		}

		// Entry content meta 2 share
		if( ! function_exists( 'neville__content_index_entry_meta2_share' ) ) {
			function neville__content_index_entry_meta2_share() {
				$text = apply_filters( 'neville___content_index_entry_meta2_share', '' );
				echo neville_em_share( $text );
			}
		}
