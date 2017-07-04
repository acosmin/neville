<?php
/**
 * --------------------
 * Page template
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
add_action( 'neville__page', 'neville__page_wrap_start', 10 );
add_action( 'neville__page', 'neville__page_header',     20 );
add_action( 'neville__page', 'neville__page_init',       30 );
add_action( 'neville__page', 'neville__page_wrap_end',   999 );

add_action( 'neville__page_header', 'neville__page_header_start',    10 );
add_action( 'neville__page_header', 'neville__page_header_contents', 20 );
add_action( 'neville__page_header', 'neville__page_header_end',      999 );

add_action( 'neville__page_header_contents', 'neville__page_header_meta',  10 );
add_action( 'neville__page_header_contents', 'neville__page_header_title', 20 );

add_action( 'neville__page_header_meta', 'neville__page_header_meta_start',       10 );
add_action( 'neville__page_header_meta', 'neville__page_header_meta_breadcrumbs', 20 );
add_action( 'neville__page_header_meta', 'neville__single_header_meta_rss',       30 );
add_action( 'neville__page_header_meta', 'neville__page_header_meta_end',         999 );

add_action( 'neville__page_init', 'neville__page_primary', 10 );
add_action( 'neville__page_init', 'neville__page_sidebar', 20 );

add_action( 'neville__page_primary', 'neville__page_primary_start',     10 );
add_action( 'neville__page_primary', 'neville__page_primary_thumbnail', 20 );
add_action( 'neville__page_primary', 'neville__page_primary_main',      30 );
add_action( 'neville__page_primary', 'neville__page_primary_end',       999 );

add_action( 'neville__page_primary_main', 'neville__page_primary_main_start', 10 );
add_action( 'neville__page_primary_main', 'neville__page_primary_main_loop',  20 );
add_action( 'neville__page_primary_main', 'neville__page_primary_main_end',   999 );

add_action( 'neville__page_after_content', 'neville__page_primary_main_after', 10 );

add_action( 'neville__page_sidebar_display', 'neville__page_sidebar_init', 10 );

add_action( 'neville__page_sidebar_init', 'neville__page_sidebar_start',   10 );
add_action( 'neville__page_sidebar_init', 'neville__page_sidebar_dynamic', 20 );
add_action( 'neville__page_sidebar_init', 'neville__page_sidebar_end',     999 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Wrapper start
if( ! function_exists( 'neville__page_wrap_start' ) ) {
	function neville__page_wrap_start() {
		?>
		<section id="page-tmpl" class="wrap page-tmpl-1">
			<div class="container">
				<div class="row-display grid-2">
		<?php
	}
}

// Wrapper end
if( ! function_exists( 'neville__page_wrap_end' ) ) {
	function neville__page_wrap_end() {
		?>
				</div><!-- .row-display .grid-2 -->
			</div><!-- .container -->
		</section>
		<?php
	}
}

// Page init
if( ! function_exists( 'neville__page_init' ) ) {
	function neville__page_init() {
		/**
		 * Hooked:
		 * neville__page_primary - 10
		 * neville__page_sidebar - 20
		 */
		do_action( 'neville__page_init' );
	}
}

// Page header
if( ! function_exists( 'neville__page_header' ) ) {
	function neville__page_header() {
		/**
		 * Hooked:
		 * neville__page_header_start    - 10
		 * neville__page_header_contents - 20
		 * neville__page_header_end      - 999
		 */
		do_action( 'neville__page_header' );
	}
}

	// Page header - wrap start
	if( ! function_exists( 'neville__page_header_start' ) ) {
		function neville__page_header_start() {
			$side   = neville_tm( 'hide_sidebar_page', false );
			$type   = $side ? 'col-9x' : 'col-12x';
			$format = '<header id="page-header" class="%s page-header">';

			// Filter it
			$output = sprintf( $format, $type );
			$output = apply_filters( 'neville___page_header_start', $output, $format, $type, $side );

			// Display Output
			echo $output;
		}
	}

	// Page header - wrap end
	if( ! function_exists( 'neville__page_header_end' ) ) {
		function neville__page_header_end() {
			?></header><?php
		}
	}

	// Page header - contents
	if( ! function_exists( 'neville__page_header_contents' ) ) {
		function neville__page_header_contents() {
			/**
			 * Hooked
			 * neville__page_header_meta  - 10
			 * neville__page_header_title - 20
			 */
			do_action( 'neville__page_header_contents' );
		}
	}

		// Header secondary meta
		if( ! function_exists( 'neville__page_header_meta' ) ) {
			function neville__page_header_meta() {
				$show = apply_filters( 'neville__page_header_meta', true );

				// Hide
				if( ! $show ) return;

				/**
				 * Hooked:
				 * neville__page_header_meta_start       - 10
				 * neville__page_header_meta_breadcrumbs - 20
				 * neville__page_header_meta_end         - 999
				 */
				do_action( 'neville__page_header_meta' );
			}
		}

			// Header secondary meta start
			if( ! function_exists( 'neville__page_header_meta_start' ) ) {
				function neville__page_header_meta_start() {
					?><div class="entry-meta-secondary"><?php
				}
			}

			// Header secondary meta end
			if( ! function_exists( 'neville__page_header_meta_end' ) ) {
				function neville__page_header_meta_end() {
					?></div><?php
				}
			}

			// Header secondary meta breadcrumbs
			if( ! function_exists( 'neville__page_header_meta_breadcrumbs' ) ) {
				function neville__page_header_meta_breadcrumbs() {
					$location = 'page';
					$args     = apply_filters( 'neville___page_header_meta_breadcrumbs', [], $location );
					neville_breadcrumbs_trail( $args );
				}
			}

		// Page title
		if( ! function_exists( 'neville__page_header_title' ) ) {
			function neville__page_header_title() {
				neville_content_title( [
					'before' => '<h1 class="entry-title main-title">',
					'after'  => '</h1>'
				], 'page_large' );
			}
		}

// Page primary
if( ! function_exists( 'neville__page_primary' ) ) {
	function neville__page_primary() {
		/**
		 * Hooked:
		 * neville__page_primary_start     - 10
		 * neville__page_primary_thumbnail - 20
		 * neville__page_primary_main      - 30
		 * neville__page_primary_end       - 999
		 */
		do_action( 'neville__page_primary' );
	}
}

	// Page primary - wrap start
	if( ! function_exists( 'neville__page_primary_start' ) ) {
		function neville__page_primary_start() {
			$side   = neville_tm( 'hide_sidebar_page', false );
			$type   = $side ? 'col-9x' : 'col-8x';
			$format = '<div id="primary" class="%s content-area">';

			// Filter it
			$output = sprintf( $format, $type );
			$output = apply_filters( 'neville___page_primary_start', $output, $format, $type, $side );

			// Display Output
			echo $output;
		}
	}

	// Page primary - wrap end
	if( ! function_exists( 'neville__page_primary_end' ) ) {
		function neville__page_primary_end() {
			?></div><!-- #primary --><?php
		}
	}

	// Page primary - thumbnail
	if( ! function_exists( 'neville__page_primary_thumbnail' ) ) {
		function neville__page_primary_thumbnail() {
			$args = apply_filters( 'neville__page_primary_thumbnail___args', array(
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
	if( ! function_exists( 'neville__page_primary_main' ) ) {
		function neville__page_primary_main() {
			/**
			 * Hooked:
			 * neville__page_primary_main_start - 10
			 * neville__page_primary_main_loop  - 20
			 * neville__page_primary_main_end   - 999
			 */
			do_action( 'neville__page_primary_main' );
		}
	}

		// Main start
		if( ! function_exists( 'neville__page_primary_main_start' ) ) {
			function neville__page_primary_main_start() {
				?><main id="page-main" class="site-page" role="main"><?php
			}
		}

		// Main end
		if( ! function_exists( 'neville__page_primary_main_end' ) ) {
			function neville__page_primary_main_end() {
				?></main><!-- #page-main --><?php
			}
		}

			// Main loop
			if( ! function_exists( 'neville__page_primary_main_loop' ) ) {
				function neville__page_primary_main_loop() {
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', 'page' );

						/**
						 * Hooked:
						 * neville__page_primary_main_after - 10
						 */
						do_action( 'neville__page_after_content' );

					endwhile; // End of the loop.
				}
			}

			if( ! function_exists( 'neville__page_primary_main_after' ) ) {
				function neville__page_primary_main_after() {
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				}
			}

	// Sidebar
	if( ! function_exists( 'neville__page_sidebar' ) ) {
		function neville__page_sidebar() {
			// Hide sidebar
			$hide = neville_tm( 'hide_sidebar_page', false );

			if( $hide ) return;

			get_sidebar( apply_filters( 'neville_sidebar___page', 'page' ) );
		}
	}

		// Sidebar init
		if( ! function_exists( 'neville__page_sidebar_init' ) ) {
			function neville__page_sidebar_init() {
				$sidebar = apply_filters( 'neville___page_sidebar_id', [
					'id'      => 'sidebar-3',
					'wrap'    => 'col-4x sidebar-wrap',
					'sidebar' => 'sidebar',
					'title'   => __( 'Pages Sidebar', 'neville' )
				] );

				/**
				 * Hooked:
				 * neville__page_sidebar_start   - 10
				 * neville__page_sidebar_dynamic - 20
				 * neville__page_sidebar_end     - 999
				 */
				do_action( 'neville__page_sidebar_init', $sidebar );
			}
		}

			// Sidebar start
			if( ! function_exists( 'neville__page_sidebar_start' ) ) {
				function neville__page_sidebar_start( $s ) {
					?>
					<div class="<?php echo esc_attr( $s[ 'wrap' ] ); ?>">
						<aside id="<?php echo esc_attr( $s[ 'id' ] ); ?>" class="<?php echo esc_attr( $s[ 'sidebar' ] ); ?>" role="complementary">
					<?php
				}
			}

			// Sidebar end
			if( ! function_exists( 'neville__page_sidebar_end' ) ) {
				function neville__page_sidebar_end( $s ) {
					?>
						</aside><!-- #<?php echo esc_html( $s[ 'id' ] ); ?> -->
					</div><!-- <?php echo esc_html( $s[ 'wrap' ] ); ?> -->
					<?php
				}
			}

			// Dynamic sidebar
			if( ! function_exists( 'neville__page_sidebar_dynamic' ) ) {
				function neville__page_sidebar_dynamic( $s ) {
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
