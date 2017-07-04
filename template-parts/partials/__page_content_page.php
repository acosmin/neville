<?php
/**
 * ----------------------------
 * Content page template
 *
 * @package Neville
 * ----------------------------
 */

/**
 * Hook some template actions ;)
 *
 * You can find some of these functions in ../inc/entry/meta.php
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 */
add_action( 'neville__content_page', 'neville__content_page_start', 10 );
add_action( 'neville__content_page', 'neville__content_page_meta',  20 );
add_action( 'neville__content_page', 'neville__content_page_share', 30 );
add_action( 'neville__content_page', 'neville__content_page_entry', 40 );
add_action( 'neville__content_page', 'neville__content_page_end',   999 );

add_action( 'neville__content_page_meta', 'neville__content_page_meta_start',    10 );
add_action( 'neville__content_page_meta', 'neville__content_page_meta_date',     20 );
add_action( 'neville__content_page_meta', 'neville__content_page_meta_r_start',  30 );
add_action( 'neville__content_page_meta', 'neville__content_page_meta_author',   40 );
add_action( 'neville__content_page_meta', 'neville__content_page_meta_com',      50 );
add_action( 'neville__content_page_meta', 'neville__content_page_meta_r_end',    60 );
add_action( 'neville__content_page_meta', 'neville__content_page_meta_end',      999 );

add_action( 'neville__content_page_share', 'neville__content_page_share_start', 10 );
add_action( 'neville__content_page_share', 'neville__content_page_share_init',  20 );
add_action( 'neville__content_page_share', 'neville__content_page_share_end',   980 );
add_action( 'neville__content_page_share', 'neville__content_page_share_js',    999 );

add_action( 'neville__content_page_entry', 'neville__content_page_entry_start',   10 );
add_action( 'neville__content_page_entry', 'neville__content_page_entry_excerpt', 20 );
add_action( 'neville__content_page_entry', 'neville__content_page_entry_content', 30 );
add_action( 'neville__content_page_entry', 'neville__content_page_entry_nav',     40 );
add_action( 'neville__content_page_entry', 'neville__content_page_entry_end',     999 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Content page start
if( ! function_exists( 'neville__content_page_start' ) ) {
	function neville__content_page_start() {
		$classes = apply_filters( 'neville___content_page_start_classes', [] );
		?><article id="page-<?php the_ID(); ?>" <?php post_class( $classes ); ?>><?php
	}
}

// Content page end
if( ! function_exists( 'neville__content_page_end' ) ) {
	function neville__content_page_end() {
		?></article><!-- #page-<?php the_ID(); ?> --><?php
	}
}

	// Content page meta
	if( ! function_exists( 'neville__content_page_meta' ) ) {
		function neville__content_page_meta() {
			/**
			 * Hooked:
			 * neville__content_page_meta_start    - 10
			 * neville__content_page_meta_date     - 20
			 * neville__content_page_meta_r_start  - 30
			 * neville__content_page_meta_author   - 40
			 * neville__content_page_meta_com      - 50
			 * neville__content_page_meta_r_end    - 60
			 * neville__content_page_meta_end      - 999
			 */
			do_action( 'neville__content_page_meta' );
		}
	}

		// Content page meta start
		if( ! function_exists( 'neville__content_page_meta_start' ) ) {
			function neville__content_page_meta_start() {
				?><header class="entry-meta"><?php
			}
		}

		// Content page meta end
		if( ! function_exists( 'neville__content_page_meta_end' ) ) {
			function neville__content_page_meta_end() {
				?></header><?php
			}
		}

		// Content page meta date
		if( ! function_exists( 'neville__content_page_meta_date' ) ) {
			function neville__content_page_meta_date() {
				echo neville_em_time();
			}
		}

			// Content page meta right start
			if( ! function_exists( 'neville__content_page_meta_r_start' ) ) {
				function neville__content_page_meta_r_start() {
					?><div class="page-meta"><?php
				}
			}

			// Content page meta right end
			if( ! function_exists( 'neville__content_page_meta_r_end' ) ) {
				function neville__content_page_meta_r_end() {
					?></div><?php
				}
			}

			// Content page meta author
			if( ! function_exists( 'neville__content_page_meta_author' ) ) {
				function neville__content_page_meta_author() {
					echo neville_em_author();
				}
			}

			// Content page meta comments
			if( ! function_exists( 'neville__content_page_meta_com' ) ) {
				function neville__content_page_meta_com() {
					echo neville_em_comments();
				}
			}

	// Content page share
	if( ! function_exists( 'neville__content_page_share' ) ) {
		function neville__content_page_share() {
			$show = neville_tm( 'side_share_page', false );
			$args = [ 'show' => 'page' ];

			// Check for right conditions to show this
			if( ! $show || ! neville_check_ss_display( $args ) ) return;

			/**
			 * Hooked:
			 * neville__content_page_share_start - 10
			 * neville__content_page_share_init  - 20
			 * neville__content_page_share_end   - 980
			 * neville__content_page_share_js    - 999
			 */
			do_action( 'neville__content_page_share' );
		}
	}

		// Content page share start
		if( ! function_exists( 'neville__content_page_share_start' ) ) {
			function neville__content_page_share_start() {
				$sticky = neville_tm( 'ss_sticky_page', false ) ? '<div class="sticky-sidebar-ac">' : '';
				$format = '<div id="sticky-share" class="entry-share">%s';

				$output = sprintf( $format, $sticky );
				$output = apply_filters( 'neville___content_page_share_start', $output, $sticky, $format );

				echo $output;
			}
		}

		// Content page share end
		if( ! function_exists( 'neville__content_page_share_end' ) ) {
			function neville__content_page_share_end() {
				$sticky = neville_tm( 'ss_sticky_page', false ) ? '</div><!-- sticky wrap -->' : '';
				$format = '%s</div><!-- .entry-share -->';

				$output = sprintf( $format, $sticky );
				$output = apply_filters( 'neville___content_page_share_end', $output, $sticky, $format );

				echo $output;
			}
		}

		// Content page share init
		if( ! function_exists( 'neville__content_page_share_init' ) ) {
			function neville__content_page_share_init() {
				echo apply_filters( 'neville___sharing_display', '' );
			}
		}

		// Content page share js
		if( ! function_exists( 'neville__content_page_share_js' ) ) {
			function neville__content_page_share_js() {
				// Don't show if disabled sticky
				if( ! neville_tm( 'ss_sticky_page', false ) ) return;

				// Options
				$o = apply_filters( 'neville___content_page_share_js', [
					'id'        => '#sticky-share',
					'container' => '.entry-content',
					'margin'    => 30,
				] );

				?>
				<script>
				(function( $ ) {
					$( document  ).ready( function( $ ) {
						var nevilleStickyShare = $( '<?php echo esc_attr( $o[ 'id' ] ); ?>' );
						nevilleStickyShare.imagesLoaded( function() {
							nevilleStickyShare.stickysidebars({
								// Settings
								containerSelector   : '<?php echo esc_attr( $o[ 'container' ] ); ?>',
								additionalMarginTop : <?php echo absint( $o[ 'margin' ] ); ?>
							});
						});
					});
				})( jQuery );
				</script>
				<?php
			}
		}

// Content page entry
if( ! function_exists( 'neville__content_page_entry' ) ) {
	function neville__content_page_entry() {
		/**
		 * Hooked:
		 * neville__content_page_entry_start   - 10
		 * neville__content_page_entry_excerpt - 20
		 * neville__content_page_entry_content - 30
		 * neville__content_page_entry_nav     - 40
		 * neville__content_page_entry_end     - 999
		 */
		do_action( 'neville__content_page_entry' );
	}
}

	// Content page entry start
	if( ! function_exists( 'neville__content_page_entry_start' ) ) {
		function neville__content_page_entry_start() {
			?><div class="entry-content"><?php
		}
	}

	// Content page entry end
	if( ! function_exists( 'neville__content_page_entry_end' ) ) {
		function neville__content_page_entry_end() {
			?></div><!-- .entry-content --><?php
		}
	}

	// Content page entry excerpt
	if( ! function_exists( 'neville__content_page_entry_excerpt' ) ) {
		function neville__content_page_entry_excerpt() {
			global $wp_query;
			// TO DO theme mod to disable this
			// Do nothing if we don't have an excerpt
			if( ! has_excerpt() || $wp_query->query[ 'page' ] > 1 ) return;

			?>
			<div class="entry-excerpt-page">
				<?php the_excerpt(); ?>
			</div>
			<?php
		}
	}

	// Content page entry content
	if( ! function_exists( 'neville__content_page_entry_content' ) ) {
		function neville__content_page_entry_content() {
			the_content();
		}
	}

	// Content page entry nav
	if( ! function_exists( 'neville__content_page_entry_nav' ) ) {
		function neville__content_page_entry_nav() {
			$args = apply_filters( 'neville___content_page_entry_nav', [
				'before' => '<nav class="navigation pagination nav-page"><div class="nav-links"><span class="page-numbers">' . esc_html__( 'Pages:', 'neville' ) . '</span>',
				'after'  => '</div></nav>',
				'link_before' => '<span class="page-numbers">',
				'link_after'  => '</span>'
			] );

			// Output
			wp_link_pages( $args );
		}
	}
