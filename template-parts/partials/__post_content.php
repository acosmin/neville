<?php
/**
 * --------------------
 * Single post template
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
add_action( 'neville__single', 'neville__single_wrap_start', 10 );
add_action( 'neville__single', 'neville__single_header',     20 );
add_action( 'neville__single', 'neville__single_init',       30 );
add_action( 'neville__single', 'neville__single_wrap_end',   999 );

add_action( 'neville__single_header', 'neville__single_header_start',    10 );
add_action( 'neville__single_header', 'neville__single_header_contents', 20 );
add_action( 'neville__single_header', 'neville__single_header_end',      999 );

add_action( 'neville__single_header_contents', 'neville__single_header_meta',  10 );
add_action( 'neville__single_header_contents', 'neville__single_header_title', 20 );

add_action( 'neville__single_header_meta', 'neville__single_header_meta_start',       10 );
add_action( 'neville__single_header_meta', 'neville__single_header_meta_breadcrumbs', 20 );
add_action( 'neville__single_header_meta', 'neville__single_header_meta_rss',         30 );
add_action( 'neville__single_header_meta', 'neville__single_header_meta_end',         999 );

add_action( 'neville__single_init', 'neville__single_primary', 10 );
add_action( 'neville__single_init', 'neville__single_sidebar', 20 );

add_action( 'neville__single_primary', 'neville__single_primary_start',     10 );
add_action( 'neville__single_primary', 'neville__single_primary_thumbnail', 20 );
add_action( 'neville__single_primary', 'neville__single_primary_main',      30 );
add_action( 'neville__single_primary', 'neville__single_primary_end',       999 );

add_action( 'neville__single_primary_main', 'neville__single_primary_main_start', 10 );
add_action( 'neville__single_primary_main', 'neville__single_primary_main_loop',  20 );
add_action( 'neville__single_primary_main', 'neville__single_primary_main_end',   999 );

add_action( 'neville__single_after_content', 'neville__single_primary_main_after_start', 10 );
add_action( 'neville__single_after_content', 'neville__single_primary_main_after',       20 );
add_action( 'neville__single_after_content', 'neville__single_primary_main_after_end',   999 );

add_action( 'neville__single_sidebar_display', 'neville__single_sidebar_init', 10 );

add_action( 'neville__single_sidebar_init', 'neville__single_sidebar_start',   10 );
add_action( 'neville__single_sidebar_init', 'neville__single_sidebar_dynamic', 20 );
add_action( 'neville__single_sidebar_init', 'neville__single_sidebar_end',     999 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Wrapper start
if( ! function_exists( 'neville__single_wrap_start' ) ) {
	function neville__single_wrap_start() {
		?>
		<section id="single-post-1" class="wrap single-tmpl-1">
			<div class="container">
				<div class="row-display grid-2">
		<?php
	}
}

// Wrapper end
if( ! function_exists( 'neville__single_wrap_end' ) ) {
	function neville__single_wrap_end() {
		?>
				</div><!-- .row-display .grid-2 -->
			</div><!-- .container -->
		</section>
		<?php
	}
}

// Single init
if( ! function_exists( 'neville__single_init' ) ) {
	function neville__single_init() {
		/**
		 * Hooked:
		 * neville__single_primary - 10
		 * neville__single_sidebar - 20
		 */
		do_action( 'neville__single_init' );
	}
}

// Single header
if( ! function_exists( 'neville__single_header' ) ) {
	function neville__single_header() {
		/**
		 * Hooked:
		 * neville__single_header_start    - 10
		 * neville__single_header_contents - 20
		 * neville__single_header_end      - 999
		 */
		do_action( 'neville__single_header' );
	}
}

	// Single header - wrap start
	if( ! function_exists( 'neville__single_header_start' ) ) {
		function neville__single_header_start() {
			$side    = neville_tm( 'hide_sidebar_post', false );
			$type    = $side ? 'col-9x' : 'col-12x';
			$format  = '<header id="post-header" class="%s post-header">';

			// Filter it
			$output = sprintf( $format, $type );
			$output = apply_filters( 'neville___single_header_start', $output, $format, $type, $side );

			// Display Output
			echo $output;
		}
	}

	// Single header - wrap end
	if( ! function_exists( 'neville__single_header_end' ) ) {
		function neville__single_header_end() {
			?></header><?php
		}
	}

	// Single header - contents
	if( ! function_exists( 'neville__single_header_contents' ) ) {
		function neville__single_header_contents() {
			/**
			 * Hooked
			 * neville__single_header_meta  - 10
			 * neville__single_header_title - 20
			 */
			do_action( 'neville__single_header_contents' );
		}
	}

		// Header secondary meta
		if( ! function_exists( 'neville__single_header_meta' ) ) {
			function neville__single_header_meta() {
				$show = apply_filters( 'neville__single_header_meta', true );

				// Hide
				if( ! $show ) return;

				/**
				 * Hooked:
				 * neville__single_header_meta_start       - 10
				 * neville__single_header_meta_breadcrumbs - 20
				 * neville__single_header_meta_end         - 999
				 */
				do_action( 'neville__single_header_meta' );
			}
		}

			// Header secondary meta start
			if( ! function_exists( 'neville__single_header_meta_start' ) ) {
				function neville__single_header_meta_start() {
					?><div class="entry-meta-secondary"><?php
				}
			}

			// Header secondary meta end
			if( ! function_exists( 'neville__single_header_meta_end' ) ) {
				function neville__single_header_meta_end() {
					?></div><?php
				}
			}

			// Header secondary meta breadcrumbs
			if( ! function_exists( 'neville__single_header_meta_breadcrumbs' ) ) {
				function neville__single_header_meta_breadcrumbs() {
					$location = 'single';
					$args     = apply_filters( 'neville___single_header_meta_breadcrumbs', [], $location );
					neville_breadcrumbs_trail( $args );
				}
			}

			// Header secondary meta rss
			if( ! function_exists( 'neville__single_header_meta_rss' ) ) {
				function neville__single_header_meta_rss() {
					?><a class="rss-btn" href="<?php bloginfo('rss2_url'); ?>"><i class="nicon nicon-feed"></i> <?php esc_html_e( 'RSS Subscribe', 'neville' ); ?></a><?php
				}
			}

		// Single title
		if( ! function_exists( 'neville__single_header_title' ) ) {
			function neville__single_header_title() {
				neville_content_title( [
					'before' => '<h1 class="entry-title main-title">',
					'after'  => '</h1>'
				], 'single_large' );
			}
		}

// Single primary
if( ! function_exists( 'neville__single_primary' ) ) {
	function neville__single_primary() {
		/**
		 * Hooked:
		 * neville__single_primary_start     - 10
		 * neville__single_primary_thumbnail - 20
		 * neville__single_primary_main      - 30
		 * neville__single_primary_end       - 999
		 */
		do_action( 'neville__single_primary' );
	}
}

	// Single primary - wrap start
	if( ! function_exists( 'neville__single_primary_start' ) ) {
		function neville__single_primary_start() {
			$side   = neville_tm( 'hide_sidebar_post', false );
			$type   = $side ? 'col-9x' : 'col-8x';
			$format = '<div id="primary" class="%s content-area">';

			// Filter it
			$output = sprintf( $format, $type );
			$output = apply_filters( 'neville___single_primary_start', $output, $format, $type, $side );

			// Display Output
			echo $output;
		}
	}

	// Single primary - wrap end
	if( ! function_exists( 'neville__single_primary_end' ) ) {
		function neville__single_primary_end() {
			?></div><!-- #primary --><?php
		}
	}

	// Single primary - thumbnail
	if( ! function_exists( 'neville__single_primary_thumbnail' ) ) {
		function neville__single_primary_thumbnail() {
			$args = apply_filters( 'neville__single_primary_thumbnail___args', array(
				'overlay'  => false,
				'link'     => false,
				'w_before' => '<figure class="entry-thumbnail">',
				'w_after'  => '</figure>',
				'size'     => 'neville-full-4x'
			) );
			neville_content_thumbnail( $args );
		}
	}

	// Main area
	if( ! function_exists( 'neville__single_primary_main' ) ) {
		function neville__single_primary_main() {
			/**
			 * Hooked:
			 * neville__single_primary_main_start - 10
			 * neville__single_primary_main_loop  - 20
			 * neville__single_primary_main_end   - 999
			 */
			do_action( 'neville__single_primary_main' );
		}
	}

		// Main start
		if( ! function_exists( 'neville__single_primary_main_start' ) ) {
			function neville__single_primary_main_start() {
				?><main id="single-main" class="site-single" role="main"><?php
			}
		}

		// Main end
		if( ! function_exists( 'neville__single_primary_main_end' ) ) {
			function neville__single_primary_main_end() {
				?></main><!-- #single-main --><?php
			}
		}

		// Main loop
		if( ! function_exists( 'neville__single_primary_main_loop' ) ) {
			function neville__single_primary_main_loop() {
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'single' );

					/**
					 * Hooked:
					 * neville__single_primary_main_after_start - 10
					 * neville__single_primary_main_after       - 20
					 * neville__single_primary_main_after_end   - 999
					 */
					do_action( 'neville__single_after_content' );

				endwhile; // End of the loop.
			}
		}

		// Single after start
		if( ! function_exists( 'neville__single_primary_main_after_start' ) ) {
			function neville__single_primary_main_after_start() {
				?><div id="single-sortable" class="single-sortable"><?php
			}
		}

		// Single after end
		if( ! function_exists( 'neville__single_primary_main_after_end' ) ) {
			function neville__single_primary_main_after_end() {
				?></div><?php
			}
		}

		// Single after
		if( ! function_exists( 'neville__single_primary_main_after' ) ) {
			function neville__single_primary_main_after() {
				$theme_mod = 'single_sortable';
				$items     = neville_cc_sortable_post_boxes();
				$defaults  = neville_cc_sortable_defaults( $items, $theme_mod );
				$mod       = neville_tm( $theme_mod, $defaults );

				if( ! $mod ) return;

				$mod = explode( ',', $mod );
				$new = neville_sortable_items_to_array( $mod, $items );
				neville_sortable_items_ouput( $items, $new, $mod );
			}
		}

// Sidebar
if( ! function_exists( 'neville__single_sidebar' ) ) {
	function neville__single_sidebar() {
		// Hide sidebar
		$hide = neville_tm( 'hide_sidebar_post', false );

		if( $hide ) return;

		// Show sidebar
		get_sidebar( apply_filters( 'neville_sidebar___single', 'single' ) );
	}
}

	// Sidebar init
	if( ! function_exists( 'neville__single_sidebar_init' ) ) {
		function neville__single_sidebar_init() {
			$sidebar = apply_filters( 'neville___single_sidebar_id', [
				'id'      => 'sidebar-2',
				'wrap'    => 'col-4x sidebar-wrap',
				'sidebar' => 'sidebar',
				'title'   => __( 'Posts Sidebar', 'neville' )
			] );

			/**
			 * Hooked:
			 * neville__single_sidebar_start   - 10
			 * neville__single_sidebar_dynamic - 20
			 * neville__single_sidebar_end     - 999
			 */
			do_action( 'neville__single_sidebar_init', $sidebar );
		}
	}

		// Sidebar start
		if( ! function_exists( 'neville__single_sidebar_start' ) ) {
			function neville__single_sidebar_start( $s ) {
				?>
				<div class="<?php echo esc_attr( $s[ 'wrap' ] ); ?>">
					<aside id="<?php echo esc_attr( $s[ 'id' ] ); ?>" class="<?php echo esc_attr( $s[ 'sidebar' ] ); ?>" role="complementary">
				<?php
			}
		}

		// Sidebar end
		if( ! function_exists( 'neville__single_sidebar_end' ) ) {
			function neville__single_sidebar_end( $s ) {
				?>
					</aside><!-- #<?php echo esc_html( $s[ 'id' ] ); ?> -->
				</div><!-- <?php echo esc_html( $s[ 'wrap' ] ); ?> -->
				<?php
			}
		}

		// Dynamic sidebar
		if( ! function_exists( 'neville__single_sidebar_dynamic' ) ) {
			function neville__single_sidebar_dynamic( $s ) {
				if ( is_active_sidebar( $s[ 'id' ] ) ) {
					dynamic_sidebar( $s[ 'id' ] );
				} else {
					if( current_user_can( 'edit_theme_options' ) ) {
						printf(
							'<div class="widget"><div class="widget-content"><center>' . __( 'Add some widgets in this sidebar, "%s". Only admins can view this message.', 'neville' ) . '</center></div></div>',
							'<strong>' . esc_html( $s[ 'title' ] ) . '</strong>'
						);
					}
				}
			}
		}
