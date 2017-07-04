<?php
/**
 * ----------------------------
 * Content single post template
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
add_action( 'neville__content_single', 'neville__content_single_start', 10 );
add_action( 'neville__content_single', 'neville__content_single_meta',  20 );
add_action( 'neville__content_single', 'neville__content_single_share', 30 );
add_action( 'neville__content_single', 'neville__content_single_entry', 40 );
add_action( 'neville__content_single', 'neville__content_single_end',   999 );

add_action( 'neville__content_single_meta', 'neville__content_single_meta_start',    10 );
add_action( 'neville__content_single_meta', 'neville__content_single_meta_category', 20 );
add_action( 'neville__content_single_meta', 'neville__content_single_meta_r_start',  30 );
add_action( 'neville__content_single_meta', 'neville__content_single_meta_date',     40 );
add_action( 'neville__content_single_meta', 'neville__content_single_meta_author',   50 );
add_action( 'neville__content_single_meta', 'neville__content_single_meta_com',      60 );
add_action( 'neville__content_single_meta', 'neville__content_single_meta_r_end',    70 );
add_action( 'neville__content_single_meta', 'neville__content_single_meta_end',      999 );

add_action( 'neville__content_single_share', 'neville__content_single_share_start', 10 );
add_action( 'neville__content_single_share', 'neville__content_single_share_init',  20 );
add_action( 'neville__content_single_share', 'neville__content_single_share_end',   980 );
add_action( 'neville__content_single_share', 'neville__content_single_share_js',    999 );

add_action( 'neville__content_single_entry', 'neville__content_single_entry_start',   10 );
add_action( 'neville__content_single_entry', 'neville__content_single_entry_excerpt', 20 );
add_action( 'neville__content_single_entry', 'neville__content_single_entry_content', 30 );
add_action( 'neville__content_single_entry', 'neville__content_single_entry_nav',     40 );
add_action( 'neville__content_single_entry', 'neville__content_single_entry_end',     999 );

add_action( 'neville__content_single_entry_content', 'neville__content_single_entry_meta', 10 );

add_action( 'neville__content_single_entry_meta', 'neville__content_single_entry_meta_tags', 10 );
add_action( 'neville__content_single_entry_meta', 'neville__content_single_entry_meta_cats', 20 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Content single start
if( ! function_exists( 'neville__content_single_start' ) ) {
	function neville__content_single_start() {
		$classes = apply_filters( 'neville___content_single_start_classes', [] );
		?><article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>><?php
	}
}

// Content single end
if( ! function_exists( 'neville__content_single_end' ) ) {
	function neville__content_single_end() {
		?></article><!-- #post-<?php the_ID(); ?> --><?php
	}
}

	// Content single meta
	if( ! function_exists( 'neville__content_single_meta' ) ) {
		function neville__content_single_meta() {
			/**
			 * Hooked:
			 * neville__content_single_meta_start    - 10
			 * neville__content_single_meta_category - 20
			 * neville__content_single_meta_r_start  - 30
			 * neville__content_single_meta_date     - 40
			 * neville__content_single_meta_author   - 50
			 * neville__content_single_meta_com      - 60
			 * neville__content_single_meta_r_end    - 70
			 * neville__content_single_meta_end      - 999
			 */
			do_action( 'neville__content_single_meta' );
		}
	}

		// Content single meta start
		if( ! function_exists( 'neville__content_single_meta_start' ) ) {
			function neville__content_single_meta_start() {
				?><header class="entry-meta"><?php
			}
		}

		// Content single meta end
		if( ! function_exists( 'neville__content_single_meta_end' ) ) {
			function neville__content_single_meta_end() {
				?></header><?php
			}
		}

		// Content single meta category
		if( ! function_exists( 'neville__content_single_meta_category' ) ) {
			function neville__content_single_meta_category() {
				$args = apply_filters( 'neville___content_single_meta_category', [] );
				neville_em_single_cat( $args, true );
			}
		}

		// Content single meta right start
		if( ! function_exists( 'neville__content_single_meta_r_start' ) ) {
			function neville__content_single_meta_r_start() {
				?><div class="single-meta"><?php
			}
		}

		// Content single meta right end
		if( ! function_exists( 'neville__content_single_meta_r_end' ) ) {
			function neville__content_single_meta_r_end() {
				?></div><?php
			}
		}

		// Content single meta date
		if( ! function_exists( 'neville__content_single_meta_date' ) ) {
			function neville__content_single_meta_date() {
				echo neville_em_time();
			}
		}

		// Content single meta author
		if( ! function_exists( 'neville__content_single_meta_author' ) ) {
			function neville__content_single_meta_author() {
				echo neville_em_author();
			}
		}

		// Content single meta comments
		if( ! function_exists( 'neville__content_single_meta_com' ) ) {
			function neville__content_single_meta_com() {
				echo neville_em_comments();
			}
		}

	// Content single share
	if( ! function_exists( 'neville__content_single_share' ) ) {
		function neville__content_single_share() {
			$show = neville_tm( 'side_share', false );

			// Check for right conditions to show this
			if( ! $show || ! neville_check_ss_display() ) return;

			/**
			 * Hooked:
			 * neville__content_single_share_start - 10
			 * neville__content_single_share_init  - 20
			 * neville__content_single_share_end   - 980
			 * neville__content_single_share_js    - 999
			 */
			do_action( 'neville__content_single_share' );
		}
	}

		// Content single share start
		if( ! function_exists( 'neville__content_single_share_start' ) ) {
			function neville__content_single_share_start() {
				$sticky = neville_tm( 'ss_sticky', false ) ? '<div class="sticky-sidebar-ac">' : '';
				$format = '<div id="sticky-share" class="entry-share">%s';

				$output = sprintf( $format, $sticky );
				$output = apply_filters( 'neville___content_single_share_start', $output, $sticky, $format );

				echo $output;
			}
		}

		// Content single share end
		if( ! function_exists( 'neville__content_single_share_end' ) ) {
			function neville__content_single_share_end() {
				$sticky = neville_tm( 'ss_sticky', false ) ? '</div><!-- sticky wrap -->' : '';
				$format = '%s</div><!-- .entry-share -->';

				$output = sprintf( $format, $sticky );
				$output = apply_filters( 'neville___content_single_share_end', $output, $sticky, $format );

				echo $output;
			}
		}

		// Content single share init
		if( ! function_exists( 'neville__content_single_share_init' ) ) {
			function neville__content_single_share_init() {
				echo apply_filters( 'neville___sharing_display', '' );
			}
		}

		// Content single share js
		if( ! function_exists( 'neville__content_single_share_js' ) ) {
			function neville__content_single_share_js() {
				// Don't show if disabled sticky
				if( ! neville_tm( 'ss_sticky', false ) ) return;

				// Options
				$o = apply_filters( 'neville___content_single_share_js', [
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

	// Content single entry
	if( ! function_exists( 'neville__content_single_entry' ) ) {
		function neville__content_single_entry() {
			/**
			 * Hooked:
			 * neville__content_single_entry_start   - 10
			 * neville__content_single_entry_excerpt - 20
			 * neville__content_single_entry_content - 30
			 * neville__content_single_entry_nav     - 40
			 * neville__content_single_entry_end     - 999
			 */
			do_action( 'neville__content_single_entry' );
		}
	}

		// Content single entry start
		if( ! function_exists( 'neville__content_single_entry_start' ) ) {
			function neville__content_single_entry_start() {
				?><div class="entry-content"><?php
			}
		}

		// Content single entry end
		if( ! function_exists( 'neville__content_single_entry_end' ) ) {
			function neville__content_single_entry_end() {
				?></div><!-- .entry-content --><?php
			}
		}

		// Content single entry excerpt
		if( ! function_exists( 'neville__content_single_entry_excerpt' ) ) {
			function neville__content_single_entry_excerpt() {
				global $wp_query;

				if(
					! has_excerpt() ||
					( ! empty( $wp_query->query[ 'page' ] ) && $wp_query->query[ 'page' ] > 1 ) ||
					is_attachment()
				) return;

				?>
				<div class="entry-excerpt-single">
					<?php the_excerpt(); ?>
				</div>
				<?php
			}
		}

		// Content single entry content
		if( ! function_exists( 'neville__content_single_entry_content' ) ) {
			function neville__content_single_entry_content() {
				the_content();

				/**
				 * Hooked:
				 * neville__content_single_entry_meta_tags - 10
				 * neville__content_single_entry_meta_cats - 20
				 */
				do_action( 'neville__content_single_entry_meta' );
			}
		}

			// Content single entry meta tags
			if( ! function_exists( 'neville__content_single_entry_meta_tags' ) ) {
				function neville__content_single_entry_meta_tags() {
					neville_entry_tags_list( [ 'location' => 'single' ] );
				}
			}

			// Content single entry meta categories
			if( ! function_exists( 'neville__content_single_entry_meta_cats' ) ) {
				function neville__content_single_entry_meta_cats() {
					neville_entry_categories_list( [ 'location' => 'single' ] );
				}
			}

		// Content single entry nav
		if( ! function_exists( 'neville__content_single_entry_nav' ) ) {
			function neville__content_single_entry_nav() {
				$args = apply_filters( 'neville___content_single_entry_nav', [
					'before' => '<nav class="navigation pagination nav-page"><div class="nav-links"><span class="page-numbers">' . esc_html__( 'Pages:', 'neville' ) . '</span>',
					'after'  => '</div></nav>',
					'link_before' => '<span class="page-numbers">',
					'link_after'  => '</span>'
				] );

				// Output
				wp_link_pages( $args );
			}
		}
