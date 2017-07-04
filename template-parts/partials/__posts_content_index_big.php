<?php
/**
 * --------------------------
 * Single post template - big
 *
 * @package Neville
 * --------------------------
 */

/**
 * Hook some template actions ;)
 *
 * You can find some of these functions in ../inc/entry/meta.php
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 */
add_action( 'neville__content_index_big', 'neville__content_index_big_start', 10 );
add_action( 'neville__content_index_big', 'neville__content_index_big_share', 20 );
add_action( 'neville__content_index_big', 'neville__content_index_big_thumb', 30 );
add_action( 'neville__content_index_big', 'neville__content_index_big_entry', 40 );
add_action( 'neville__content_index_big', 'neville__content_index_big_end',   999 );

add_action( 'neville__content_index_big_thumb', 'neville__content_index_big_thumb_start',   10 );
add_action( 'neville__content_index_big_thumb', 'neville__content_index_big_thumb_image',   20 );
add_action( 'neville__content_index_big_thumb', 'neville__content_index_big_thumb_overlay', 30 );
add_action( 'neville__content_index_big_thumb', 'neville__content_index_big_thumb_end',     999 );

add_action( 'neville__content_index_big_entry', 'neville__content_index_big_entry_start', 10 );
add_action( 'neville__content_index_big_entry', 'neville__content_index_big_entry_meta',  20 );
add_action( 'neville__content_index_big_entry', 'neville__content_index_big_entry_title', 30 );
add_action( 'neville__content_index_big_entry', 'neville__content_index_big_entry_excerpt', 30 );
add_action( 'neville__content_index_big_entry', 'neville__content_index_big_entry_end',   999 );

add_action( 'neville__content_index_big_entry_meta', 'neville__content_index_big_em_start',  10 );
add_action( 'neville__content_index_big_entry_meta', 'neville__content_index_big_em_cat',    20 );
add_action( 'neville__content_index_big_entry_meta', 'neville__content_index_big_em_author', 30 );
add_action( 'neville__content_index_big_entry_meta', 'neville__content_index_big_em_date',   40 );
add_action( 'neville__content_index_big_entry_meta', 'neville__content_index_big_em_sticky', 50 );
add_action( 'neville__content_index_big_entry_meta', 'neville__content_index_big_em_share',  60 );
add_action( 'neville__content_index_big_entry_meta', 'neville__content_index_big_em_com',    70 );
add_action( 'neville__content_index_big_entry_meta', 'neville__content_index_big_em_end',    999 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Content start
if( ! function_exists( 'neville__content_index_big_start' ) ) {
	function neville__content_index_big_start() {
		$classes = apply_filters( 'neville___content_index_big_start_class', [ 'full-size' ] );
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
		<?php
	}
}

// Content end
if( ! function_exists( 'neville__content_index_big_end' ) ) {
	function neville__content_index_big_end() {
		?>
		</article><!-- #post-<?php the_ID(); ?> -->
		<?php
	}
}

// Content share
if( ! function_exists( 'neville__content_index_big_share' ) ) {
	function neville__content_index_big_share() {
		neville_share_display( true );
	}
}

// Content thumbnail
if( ! function_exists( 'neville__content_index_big_thumb' ) ) {
	function neville__content_index_big_thumb() {
		$hide = apply_filters( 'neville___content_index_thumb_hide', false );

		// Do nothing if it doesn't have a post thumbnail
		if( ! has_post_thumbnail() || $hide ) return;

		/**
		 * Hooked:
		 * neville__content_index_big_thumb_start   - 10
		 * neville__content_index_big_thumb_image   - 20
		 * neville__content_index_big_thumb_overlay - 30
		 * neville__content_index_big_thumb_end     - 999
		 */
		do_action( 'neville__content_index_big_thumb' );
	}
}

	// Content thumbnail start
	if( ! function_exists( 'neville__content_index_big_thumb_start' ) ) {
		function neville__content_index_big_thumb_start() {
			?><figure class="img-has-overlay post-thumbnail"><?php
		}
	}

	// Content thumbnail end
	if( ! function_exists( 'neville__content_index_big_thumb_end' ) ) {
		function neville__content_index_big_thumb_end() {
			?></figure><!-- #post-<?php the_ID(); ?> --><?php
		}
	}

	// Content thumbnail image
	if( ! function_exists( 'neville__content_index_big_thumb_image' ) ) {
		function neville__content_index_big_thumb_image() {
			$size = apply_filters( 'neville___content_index_big_thumb_image_size', 'neville-full-4x' );

			// Output thumbnail
			the_post_thumbnail( $size );
		}
	}

	// Content thumbnail overlay
	if( ! function_exists( 'neville__content_index_big_thumb_overlay' ) ) {
		function neville__content_index_big_thumb_overlay() {
			// Some options
			$o = [
				'gradient' => false,
				'link'     => true,
			];

			// Output based on options
			$gradient = $o[ 'gradient' ] ? '' : 'no-gradient';
			$link     = $o[ 'link' ] ? sprintf( '<a href="%1$s" title="%2$s" class="img-link-to" rel="nofollow"></a>', esc_url( get_the_permalink() ), the_title_attribute( 'echo=0' ) ) : '';

			// Final output
			$format = '
			<figcaption class="img-overlay empty-caption %1$s">
				%2$s
			</figcaption>';

			// Filter
			$format = apply_filters( 'neville___content_index_big_thumb_overlay', $format, $o, $gradient, $link );

			// Display
			printf( $format, $gradient, $link );
		}
	}

// Content entry
if( ! function_exists( 'neville__content_index_big_entry' ) ) {
	function neville__content_index_big_entry() {
		/**
		 * Hooked:
		 * neville__content_index_big_entry_start   - 10
		 * neville__content_index_big_entry_meta    - 20
		 * neville__content_index_big_entry_title   - 30
		 * neville__content_index_big_entry_excerpt - 999
		 */
		do_action( 'neville__content_index_big_entry' );
	}
}

	// Content entry start
	if( ! function_exists( 'neville__content_index_big_entry_start' ) ) {
		function neville__content_index_big_entry_start() {
			?><div class="entry-content"><?php
		}
	}

	// Content entry end
	if( ! function_exists( 'neville__content_index_big_entry_end' ) ) {
		function neville__content_index_big_entry_end() {
			?></div><?php
		}
	}

	// Content entry meta
	if( ! function_exists( 'neville__content_index_big_entry_meta' ) ) {
		function neville__content_index_big_entry_meta() {
			/**
			 * TO DO
			 * maybe add theme mods
			 */
			// Show/hide
			$show = apply_filters( 'neville___content_index_big_entry_meta', [
				'meta'   => true, // Add a main meta disabler theme mod
				'cat'    => true,
				'author' => true,
				'date'   => true,
				'share'  => true,
				'com'    => true,
			] );

			if( ! $show[ 'meta' ] ) return;

			/**
			 * Hooked:
			 * neville__content_index_big_em_start  - 10
			 * neville__content_index_big_em_cat    - 20
			 * neville__content_index_big_em_author - 30
			 * neville__content_index_big_em_date   - 40
			 * neville__content_index_big_em_sticky - 50
			 * neville__content_index_big_em_share  - 60
			 * neville__content_index_big_em_com    - 70
			 * neville__content_index_big_em_end    - 999
			 */
			do_action( 'neville__content_index_big_entry_meta', $show );
		}
	}

		// Content entry meta start
		if( ! function_exists( 'neville__content_index_big_em_start' ) ) {
			function neville__content_index_big_em_start() {
				?><div class="entry-meta"><?php
			}
		}

		// Content entry meta end
		if( ! function_exists( 'neville__content_index_big_em_end' ) ) {
			function neville__content_index_big_em_end() {
				?></div><?php
			}
		}

		// Content entry meta category
		if( ! function_exists( 'neville__content_index_big_em_cat' ) ) {
			function neville__content_index_big_em_cat( $show ) {
				if( ! $show[ 'cat' ] ) return;
				neville_em_single_cat( [], true );
			}
		}

		// Content entry meta author
		if( ! function_exists( 'neville__content_index_big_em_author' ) ) {
			function neville__content_index_big_em_author( $show ) {
				if( ! $show[ 'author' ] ) return;
				echo neville_em_author();
			}
		}

		// Content entry meta date
		if( ! function_exists( 'neville__content_index_big_em_date' ) ) {
			function neville__content_index_big_em_date( $show ) {
				if( ! $show[ 'date' ] ) return;
				echo neville_em_time();
			}
		}

		// Content entry meta sticky
		if( ! function_exists( 'neville__content_index_big_em_sticky' ) ) {
			function neville__content_index_big_em_sticky() {
				echo neville_em_sticky_tag();
			}
		}

		// Content entry meta share
		if( ! function_exists( 'neville__content_index_big_em_share' ) ) {
			function neville__content_index_big_em_share( $show ) {
				if( ! $show[ 'share' ] ) return;
				$output = neville_em_share();
				$output = str_replace( '<a', '<a class="share-article jp-share-init"', $output );

				echo $output;
			}
		}

		// Content entry meta comments
		if( ! function_exists( 'neville__content_index_big_em_com' ) ) {
			function neville__content_index_big_em_com( $show ) {
				if( ! $show[ 'com' ] ) return;
				echo neville_em_comments();
			}
		}

	// Content entry title
	if( ! function_exists( 'neville__content_index_big_entry_title' ) ) {
		function neville__content_index_big_entry_title() {
			$args = [
				'before' => '<h3 class="entry-title t-2x"><a title="' . the_title_attribute( 'echo=0' ) . '" href="' . esc_url( get_permalink() ) . '" rel="bookmark">',
				'after'  => '</a></h3>'
			];
			neville_content_title( $args, 'index_big' );
		}
	}

	// Content entry excerpt
	if( ! function_exists( 'neville__content_index_big_entry_excerpt' ) ) {
		function neville__content_index_big_entry_excerpt() {
			// Variables
			$ending   = '<a href="%1$s" class="entry-continue" title="%2$s">%3$s</a></p>';
			$continue = sprintf( __( 'Continue reading: %s', 'neville' ), the_title_attribute( 'echo=0' ) );
			$text     = __( 'Continue Reading &#8594;', 'neville' );
			$output   = sprintf( $ending, esc_url( get_the_permalink() ), $continue, esc_html( $text ) );

			// Arguments
			$args = apply_filters( 'neville___content_index_big_entry_excerpt', [
				'after' => $output,
				'num'   => 30
			], $output, $ending, $continue, $text );

			// Display
			neville_excerpt( $args );
		}
	}
