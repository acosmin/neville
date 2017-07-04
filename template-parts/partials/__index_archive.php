<?php
/**
 * ------------------------
 * Blog/Index/Archive view.
 *
 * @package Neville
 * ------------------------
 */

/**
 * Hook some template actions ;)
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 */
add_filter( 'get_the_archive_title', 'neville___archive_title' );

add_action( 'neville__blog', 'neville__blog_header',       5  );
add_action( 'neville__blog', 'neville__blog_wrap_start',   10 );
add_action( 'neville__blog', 'neville__content_area_init', 20 );
add_action( 'neville__blog', 'neville__blog_wrap_end',     999 );

add_action( 'neville__blog_header', 'neville__blog_header_start',       10 );
add_action( 'neville__blog_header', 'neville__blog_header_title',       20 );
add_action( 'neville__blog_header', 'neville__blog_header_description', 30 );
add_action( 'neville__blog_header', 'neville__blog_header_breadcrumbs', 40 );
add_action( 'neville__blog_header', 'neville__blog_header_end',         999 );

add_action( 'neville__content_area_init', 'neville__content_area_start',  10 );
add_action( 'neville__content_area_init', 'neville__content_area_header', 20 );
add_action( 'neville__content_area_init', 'neville__content_area_main',   30 );
add_action( 'neville__content_area_init', 'neville__content_area_end',    40 );
add_action( 'neville__content_area_init', 'neville__sidebar_index',       50 );

add_action( 'neville__sidebar_index', 'neville__sidebar_index_display', 10 );

add_action( 'neville__sidebar_index_display', 'neville__sidebar_index_display_start', 10 );
add_action( 'neville__sidebar_index_display', 'neville__sidebar_index_display_side',  20 );
add_action( 'neville__sidebar_index_display', 'neville__sidebar_index_display_end',   999 );

add_action( 'neville__ca_main', 'neville__ca_main_start', 10 );
add_action( 'neville__ca_main', 'neville__ca_main_loop',  20 );
add_action( 'neville__ca_main', 'neville__ca_main_end',   30 );

add_filter( 'navigation_markup_template', 'neville___ca_main_loop_nav_goto', 15, 2 );
add_action( 'neville_ca_main_loop_after', 'neville__ca_main_loop_nav',    10 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Header
if( ! function_exists( 'neville__blog_header' ) ) {
	function neville__blog_header() {
		// Show only if
		if( is_archive() || is_search() ) :

			/**
			 * Hooked:
			 * neville__blog_header_start - 10
			 * neville__blog_header_title - 20
			 * neville__blog_header_end   - 999
			 */
			do_action( 'neville__blog_header' );

		endif;
	}
}

	// Header start
	if( ! function_exists( 'neville__blog_header_start' ) ) {
		function neville__blog_header_start() {
			?>
			<header class="wrap blog-header">
				<?php neville__blog_header_overlay(); ?>
				<div class="container">
					<div class="row-display grid-2">
						<div class="col-12x">
			<?php
		}
	}

	// Header overlay
	if( ! function_exists( 'neville__blog_header_overlay' ) ) {
		function neville__blog_header_overlay() {
			$o = apply_filters( 'neville___blog_header_overlay', [
				'overlay' => '<div class="bh-overlay"></div>',
				'shadow'  => '<div class="bho-shadow"></div>'
			] );

			printf( '%1$s%2$s', $o[ 'overlay' ], $o[ 'shadow' ] );
		}
	}

	// Header end
	if( ! function_exists( 'neville__blog_header_end' ) ) {
		function neville__blog_header_end() {
			/**
			 * TO DO
			 * disable black-wrap if breadcrumbs is disabled
			 */
			?>
						</div>
					</div>
				</div>
				<div class="black-wrap"></div>
			</header>
			<?php
		}
	}

	// Header title
	if( ! function_exists( 'neville__blog_header_title' ) ) {
		function neville__blog_header_title() {
			$o = apply_filters( 'neville___blog_header_title', [
				'archive' => [
					'before'   => '<h1 class="section-title">',
					'after'    => '</h1>'
				],
				'search'  => [
					'before'   => '<h1 class="section-title">',
					'after'    => '</h1>',
					'results'  => sprintf( esc_html__( 'Searched for: %s', 'neville' ), '<i>' . get_search_query() . '</i>' ),
					'format'   => '%1$s%2$s%3$s'
				]
			] );

			// Archive title
			if( is_archive() ) {
				the_archive_title( $o[ 'archive' ][ 'before' ], $o[ 'archive' ][ 'after'] );
			}
			// Search results
			elseif( is_search() ) {
				$s = $o[ 'search' ];
				printf( $s[ 'format' ], $s[ 'before'], $s[ 'results' ], $s[ 'after'] );
			}
		}
	}

	// Header description
	if( ! function_exists( 'neville__blog_header_description' ) ) {
		function neville__blog_header_description() {
			$o = apply_filters( 'neville___blog_header_description', [
				'location' => 'archive',
				'title'    => strip_tags( get_the_archive_description() ),
				'wrap'     => '<p class="section-description">%s</p>'
			] );
			printf( $o[ 'wrap' ], $o[ 'title' ] );
		}
	}

	// Header breadcrumbs
	if( ! function_exists( 'neville__blog_header_breadcrumbs' ) ) {
		function neville__blog_header_breadcrumbs() {
			$o = apply_filters( 'neville___blog_header_breadcrumbs', [
				'location' => 'archive',
				'args'     => [ 'echo' => false ],
				'wrap'     => '<div class="header-bread">%s</div>'
			] );
			printf( $o[ 'wrap' ], neville_breadcrumbs_trail( $o[ 'args' ] ) );
		}
	}

// Archive title
if( ! function_exists( 'neville___archive_title' ) ) {
	function neville___archive_title( $title ) {
		if ( is_category() ) {
			// Category
			$title = single_cat_title( '', false );
		}

		// Return new title
		return $title;
	}
}

// Wrapper start
if( ! function_exists( 'neville__blog_wrap_start' ) ) {
	function neville__blog_wrap_start() {
		?>
		<section id="sec-blog-1" class="wrap section-blog">
			<div class="container">
				<div class="row-display grid-2">
		<?php
	}
}

// Wrapper end
if( ! function_exists( 'neville__blog_wrap_end' ) ) {
	function neville__blog_wrap_end() {
		?>
				</div><!-- .row-display -->
			</div><!-- .container -->
		</section><!-- #sec-blog-1 -->
		<?php
	}
}

// Content area init
if( ! function_exists( 'neville__content_area_init' ) ) {
	function neville__content_area_init() {
		/**
		 * Hooked:
		 * neville__content_area_start  - 10
		 * neville__content_area_header - 20
		 * neville__content_area_main   - 30
		 * neville__content_area_end    - 40
		 * neville__sidebar_index       - 50
		 */
		do_action( 'neville__content_area_init' );
	}
}

// Content area start
if( ! function_exists( 'neville__content_area_start' ) ) {
	function neville__content_area_start() {
		?>
		<div id="primary" class="col-8x content-area">
		<?php
	}
}

// Content area start
if( ! function_exists( 'neville__content_area_end' ) ) {
	function neville__content_area_end() {
		?>
		</div><!-- #primary -->
		<?php
	}
}

// Content area header
if( ! function_exists( 'neville__content_area_header' ) ) {
	function neville__content_area_header() {
		// Vars
		$show      = neville_tm( 'index_show_header', true );
		$title     = neville_tm( 'index_title', __( 'Latest Articles', 'neville' ) );
		$subscribe = neville_tm( 'index_show_subscr', true );

		// Show only on a few pages
		if( $show && ( is_page_template( 'template-frontpage.php' ) || is_home() ) && ! is_paged() ) {
		?>
			<header class="section-header sh1x with-margin">
				<h2 class="section-title st1x"><?php echo esc_html( $title ); ?></h2>
				<?php if( $subscribe ) : ?>
				<ul class="small-nav section-subcats">
					<li><a class="sb-subscr rss-btn" href="<?php bloginfo('rss2_url'); ?>"><i class="nicon nicon-feed"></i> <?php esc_html_e( 'RSS Subscribe', 'neville' ); ?></a></li>
				</ul>
				<?php endif; ?>
			</header>
		<?php
		} //if clause
	}
}

// Content area main
if( ! function_exists( 'neville__content_area_main' ) ) {
	function neville__content_area_main() {
		/**
		 * Hooked:
		 * neville__ca_main_start - 10
		 * neville__ca_main_loop  - 20
		 * neville__ca_main_end   - 30
		 */
		do_action( 'neville__ca_main' );
	}
}

		// Content area main - start
		if( ! function_exists( 'neville__ca_main_start' ) ) {
			function neville__ca_main_start() {
				?>
				<main id="main" class="site-main" role="main">
				<?php
			}
		}

		// Content area main - end
		if( ! function_exists( 'neville__ca_main_end' ) ) {
			function neville__ca_main_end() {
				?>
				</main><!-- #main -->
				<?php
			}
		}

		// Content area main - posts loop
		if( ! function_exists( 'neville__ca_main_loop' ) ) {
			function neville__ca_main_loop() {
				// Variables
				$types = apply_filters( 'neville___ca_main_loop_types', [
					'type'   => 'simple',
					'count'  => (int)  neville_tm( 'posts_start', 1 ),
					'mixed'  => (bool) neville_tm( 'posts_mixed', true ),
					'when'   => (int)  neville_tm( 'posts_when',  3 ),
					'big'    => 'template-parts/content-big',
					'normal' => 'template-parts/content'
				] );
				$type   = $types[ 'type' ];
				$count  = $types[ 'count' ];

				/**
				 * Loop posts based on location
				 */
				if( ! is_page_template( 'template-frontpage.php' ) ) {

					/**
					 * Loop which works on any other page than one
					 * with `template-frontpage.php` set
					 */

					// Loop
					if( have_posts() ) :
						while( have_posts() ) :
							the_post();

							/**
							 * Switch between index post templates
							 *
							 * @see ../template-parts/partials/loop-types.php
							 */
							do_action( "neville__posts_loop_{$type}", $types, $count );

							// Add 1
							$count++;
						endwhile;

						/**
						 * Hooked:
						 * neville__ca_main_loop_nav - 10
						 */
						do_action( 'neville_ca_main_loop_after' );

					else :
						// No posts found
						get_template_part( 'template-parts/content', 'none' );
					endif;

				} else {

					/**
					 * Works only on `template-frontpage.php`. This is used mainly in
					 * the `Blog` section widget.
					 *
					 * Hacky way of making the pagination work, but after we're done with
					 * it, we'll reset it to what it was before.
					 */

					// Query arguments
					$args = apply_filters( 'neville___blog_query_args', [
						'posts_per_page' => absint( get_option( 'posts_per_page' ) ),
						'paged'          => get_query_var( 'page' ) ? get_query_var( 'page' ) : 1
					] );

					// Set-up query
					$query = new WP_Query( $args );

					// Query posts
					if( $query->have_posts() ) :
						while ( $query->have_posts() ) :
							$query->the_post();

							/**
							 * Switch between index post templates
							 *
							 * @see ../template-parts/partials/loop-types.php
							 */
							do_action( "neville__posts_loop_{$type}", $types, $count );

							// Add 1
							$count++;
						endwhile;

						/**
						 * Hooked:
						 * neville__ca_main_loop_nav - 10
						 */
						do_action( 'neville_ca_main_loop_after' );

						// Reset
						wp_reset_postdata();
					else:
						// No posts found
						get_template_part( 'template-parts/content', 'none' );
					endif;
				}
			}
		}

		// Add a `Go to page` to our navigation
		if( ! function_exists( 'neville___ca_main_loop_nav_goto' ) ) {
			function neville___ca_main_loop_nav_goto( $template, $class ) {
				// Show or hide
				$show = apply_filters( 'neville___ca_main_loop_nav_goto_show', true );

				if( ! $show || is_singular() ) return $template;

				// Else replace
				$string   = '</h2><span class="go-to-page">' . esc_html__( 'Go to page: ', 'neville' ) . '</span>';
				$template = str_replace( '</h2>', $string, $template );

				return $template;
			}
		}

		// Content area main - posts loop navigation
		if( ! function_exists( 'neville__ca_main_loop_nav' ) ) {
			function neville__ca_main_loop_nav() {
				$format = '
				<nav class="navigation pagination sec-pagination" role="navigation">
					<div class="nav-links row-display grid-1">
						<a class="page-numbers" href="%1$s">%2$s</a>
					</div>
				</nav>
				';

				$o = apply_filters( 'neville___ca_main_loop_nav_section', [
					'show'   => neville_tm( 'more_articles_show', true ),
					'format' => $format,
					'url'    => neville_tm( 'more_articles_url' ),
					'button' => neville_tm( 'more_articles_button', __( 'View more articles', 'neville' ) )
				] );

				if( is_page_template( 'template-frontpage.php' ) ) {
					if( ! $o[ 'show' ] ) return;

					printf( $o[ 'format' ], esc_url( $o[ 'url' ] ), esc_html( $o[ 'button' ] ) );
				} else {
					the_posts_pagination( array(
						'prev_text' => _x( '&#8592;', 'Posts pagination - previous text', 'neville' ),
						'next_text' => _x( '&#8594;', 'Posts pagination - next text', 'neville' ),
					) );
				}
			}
		}

// Sidebar 1
if( ! function_exists( 'neville__sidebar_index' ) ) {
	function neville__sidebar_index() {
		get_sidebar( apply_filters( 'neville_sidebar___index', '' ) );
	}
}

	// Sidebar display
	if( ! function_exists( 'neville__sidebar_index_display' ) ) {
		function neville__sidebar_index_display() {
			/**
			 * Hooked:
			 * neville__sidebar_index_display_start - 10
			 * neville__sidebar_index_display_side  - 20
			 * neville__sidebar_index_display_end   - 999
			 */
			do_action( 'neville__sidebar_index_display' );
		}
	}

		// Sidebar display start
		if( ! function_exists( 'neville__sidebar_index_display_start' ) ) {
			function neville__sidebar_index_display_start() {
				?>
				<div class="col-4x sidebar-wrap">
					<aside id="sidebar-index" class="sidebar" role="complementary">
				<?php
			}
		}

		// Sidebar display end
		if( ! function_exists( 'neville__sidebar_index_display_end' ) ) {
			function neville__sidebar_index_display_end() {
				?>
					</aside><!-- #sidebar-index -->
				</div><!-- sidebar columnd wrap -->
				<?php
			}
		}

		// Sidebar display side
		if( ! function_exists( 'neville__sidebar_index_display_side' ) ) {
			function neville__sidebar_index_display_side() {
				$sidebar = apply_filters( 'neville___sidebar_index_display', [
					'sidebar-1',
					__( 'Home Sidebar', 'neville' )
				] );

				if ( is_active_sidebar( $sidebar[ 0 ] ) ) {
					dynamic_sidebar( $sidebar[ 0 ] );
				} else {
					if( current_user_can( 'edit_theme_options' ) ) {
						printf(
							'<div class="widget"><div class="widget-content"><center>' . __( 'Add some widgets in this sidebar, "%s". Only admins can view this message.', 'neville' ) . '</center></div></div>',
							'<strong>' . $sidebar[ 1 ] . '</strong>'
						);
					}
				}
			}
		}
