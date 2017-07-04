<?php
/**
 * -----------------------
 * Footer default template
 *
 * @package Neville
 * -----------------------
 */

/**
 * Hook some template actions ;)
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 */
add_action( 'neville__footer_default', 'neville__footer_default_sidebars', 10 );
add_action( 'neville__footer_default', 'neville__footer_default_main',     20 );

add_action( 'neville__footer_default_sidebars', 'neville__footer_default_sidebars_start',   10 );
add_action( 'neville__footer_default_sidebars', 'neville__footer_default_sidebars_display', 20 );
add_action( 'neville__footer_default_sidebars', 'neville__footer_default_sidebars_end',     999 );

add_action( 'neville__footer_default_sidebars_display', 'neville__footer_default_sidebars_1', 10 );
add_action( 'neville__footer_default_sidebars_display', 'neville__footer_default_sidebars_2', 20 );
add_action( 'neville__footer_default_sidebars_display', 'neville__footer_default_sidebars_3', 30 );

add_action( 'neville__footer_default_main', 'neville__footer_default_main_start',   10 );
add_action( 'neville__footer_default_main', 'neville__footer_default_main_content', 20 );
add_action( 'neville__footer_default_main', 'neville__footer_default_main_end',     999 );

add_action( 'neville__footer_default_main_content', 'neville__footer_default_main_nav',       10 );
add_action( 'neville__footer_default_main_content', 'neville__footer_default_main_credits',   20 );
add_action( 'neville__footer_default_main_content', 'neville__footer_default_main_backtotop', 999 );

add_action( 'neville__footer_default_main_nav', 'neville__footer_default_main_nav_start', 10 );
add_action( 'neville__footer_default_main_nav', 'neville__footer_default_main_nav_cols',  20 );
add_action( 'neville__footer_default_main_nav', 'neville__footer_default_main_nav_end',   999 );

add_action( 'neville__footer_default_main_nav_cols', 'neville__footer_default_main_nav_cols_menu',   10 );
add_action( 'neville__footer_default_main_nav_cols', 'neville__footer_default_main_nav_cols_social', 20 );

add_action( 'neville__footer_default_main_credits', 'neville__footer_default_main_credits_start',     10 );
add_action( 'neville__footer_default_main_credits', 'neville__footer_default_main_credits_copyright', 20 );
add_action( 'neville__footer_default_main_credits', 'neville__footer_default_main_credits_logo',      30 );
add_action( 'neville__footer_default_main_credits', 'neville__footer_default_main_credits_acosmin',   40 );
add_action( 'neville__footer_default_main_credits', 'neville__footer_default_main_credits_end',       999 );

add_action( 'neville__footer_default_main_backtotop', 'neville__footer_default_main_backtotop_start',  10 );
add_action( 'neville__footer_default_main_backtotop', 'neville__footer_default_main_backtotop_button', 20 );
add_action( 'neville__footer_default_main_backtotop', 'neville__footer_default_main_backtotop_end',    999 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Sidebars part
if( ! function_exists( 'neville__footer_default_sidebars' ) ) {
	function neville__footer_default_sidebars() {
		// Do nothing if sidebars are empty
		if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) ) return;

		/**
		 * Hooked:
		 * neville__footer_default_sidebars_start   - 10
		 * neville__footer_default_sidebars_display - 20
		 * neville__footer_default_sidebars_end     - 999
		 */
		do_action( 'neville__footer_default_sidebars' );
	}
}

	// Sidebars wrap start
	if( ! function_exists( 'neville__footer_default_sidebars_start' ) ) {
		function neville__footer_default_sidebars_start() {
			?>
			<section id="sec-footer-sidebars" class="wrap section-footer-sidebars mg0">
				<div class="container">
					<div class="row-display grid-2">
			<?php
		}
	}

	// Sidebars wrap end
	if( ! function_exists( 'neville__footer_default_sidebars_end' ) ) {
		function neville__footer_default_sidebars_end() {
			?>
					</div><!-- .row-display -->
				</div><!-- .container -->
			</section><!-- #sec-footer-sidebars -->
			<?php
		}
	}

	// Sidebars display
	if( ! function_exists( 'neville__footer_default_sidebars_display' ) ) {
		function neville__footer_default_sidebars_display() {
			/**
			 * Hooked:
			 * neville__footer_default_sidebars_1 - 10
			 * neville__footer_default_sidebars_2 - 20
			 * neville__footer_default_sidebars_3 - 30
			 */
			do_action( 'neville__footer_default_sidebars_display' );
		}
	}

		// Sidebar 1
		if( ! function_exists( 'neville__footer_default_sidebars_1' ) ) {
			function neville__footer_default_sidebars_1() {
				?>
				<div class="col-4x footer-sidebar">
					<aside id="footer-sidebar-1" class="sidebar" role="complementary">
						<?php dynamic_sidebar( 'footer-1' ); ?>
					</aside><!-- #sec-blog-1-sidebar -->
				</div>
				<?php
			}
		}

		// Sidebar 2
		if( ! function_exists( 'neville__footer_default_sidebars_2' ) ) {
			function neville__footer_default_sidebars_2() {
				?>
				<div class="col-4x footer-sidebar">
					<aside id="footer-sidebar-2" class="sidebar" role="complementary">
						<?php dynamic_sidebar( 'footer-2' ); ?>
					</aside><!-- #sec-blog-1-sidebar -->
				</div>
				<?php
			}
		}

		// Sidebar 3
		if( ! function_exists( 'neville__footer_default_sidebars_3' ) ) {
			function neville__footer_default_sidebars_3() {
				?>
				<div class="col-4x footer-sidebar">
					<aside id="footer-sidebar-3" class="sidebar" role="complementary">
						<?php dynamic_sidebar( 'footer-3' ); ?>
					</aside><!-- #sec-blog-1-sidebar -->
				</div>
				<?php
			}
		}

// Main part
if( ! function_exists( 'neville__footer_default_main' ) ) {
	function neville__footer_default_main() {
		/**
		 * Hooked:
		 * neville__footer_default_main_start   - 10
		 * neville__footer_default_main_content - 20
		 * neville__footer_default_main_end     - 999
		 */
		do_action( 'neville__footer_default_main' );
	}
}

	// Main start
	if( ! function_exists( 'neville__footer_default_main_start' ) ) {
		function neville__footer_default_main_start() {
			?>
			<footer id="mastfooter" class="site-footer">
			<?php
		}
	}

	// Main end
	if( ! function_exists( 'neville__footer_default_main_end' ) ) {
		function neville__footer_default_main_end() {
			?>
			<footer id="mastfooter" class="site-footer">
			<?php
		}
	}

	// Main content
	if( ! function_exists( 'neville__footer_default_main_content' ) ) {
		function neville__footer_default_main_content() {
			/**
			 * Hooked:
			 * neville__footer_default_main_nav       - 10
			 * neville__footer_default_main_credits   - 20
			 * neville__footer_default_main_backtotop - 999
			 */
			do_action( 'neville__footer_default_main_content' );
		}
	}

		// Main nav
		if( ! function_exists( 'neville__footer_default_main_nav' ) ) {
			function neville__footer_default_main_nav() {
				/**
				 * Hooked:
				 * neville__footer_default_main_nav_start - 10
				 * neville__footer_default_main_nav_cols  - 20
				 * neville__footer_default_main_nav_end   - 999
				 */
				do_action( 'neville__footer_default_main_nav' );
			}
		}

			// Main nav start
			if( ! function_exists( 'neville__footer_default_main_nav_start' ) ) {
				function neville__footer_default_main_nav_start() {
					?>
					<div class="wrap footer-navs">
						<div class="container">
							<div class="row-display grid-2">
					<?php
				}
			}

			// Main nav end
			if( ! function_exists( 'neville__footer_default_main_nav_end' ) ) {
				function neville__footer_default_main_nav_end() {
					?>
							</div><!-- .row-display.grid-2 -->
						</div><!-- .container -->
					</div><!-- .footer-navs -->
					<?php
				}
			}

			// Main nav cols
			if( ! function_exists( 'neville__footer_default_main_nav_cols' ) ) {
				function neville__footer_default_main_nav_cols() {
					/**
					 * Hooked:
					 * neville__footer_default_main_nav_cols_menu   - 10
					 * neville__footer_default_main_nav_cols_social - 20
					 */
					do_action( 'neville__footer_default_main_nav_cols' );
				}
			}

				// Main nav menu
				if( ! function_exists( 'neville__footer_default_main_nav_cols_menu' ) ) {
					function neville__footer_default_main_nav_cols_menu() {
						$tmpl = 'default';
						?>
						<div class="col-6x">
							<nav id="footer-nav" class="secondary-nav" role="navigation">
								<?php
							 	$footer_menu_args = apply_filters( 'neville_footer_menu___args', array(
									'theme_location' => 'footer',
									'container'      => 'ul',
									'menu_id'        => 'footer-menu',
									'menu_class'     => 'small-nav',
									'fallback_cb'    => '__return_false',
									'depth'          => 1
								), $tmpl );
								wp_nav_menu( $footer_menu_args );
								?>
							</nav>
						</div>
						<?php
					}
				}

				// Main nav social
				if( ! function_exists( 'neville__footer_default_main_nav_cols_social' ) ) {
					function neville__footer_default_main_nav_cols_social() {
						$tmpl = 'default';
						?>
						<div class="col-6x">
							<nav id="footer-social-nav" class="social-nav-footer" role="navigation">
								<?php
							 	$footer_menu_args = apply_filters( 'neville_footer_social_menu___args', array(
									'theme_location' => 'footer-social',
									'container'      => 'ul',
									'menu_id'        => 'footer-social-menu',
									'menu_class'     => 'social-menu-round',
									'fallback_cb'    => '__return_false',
									'depth'          => 1
								), $tmpl );
								wp_nav_menu( $footer_menu_args );
								?>
							</nav>
						</div>
						<?php
					}
				}

		// Main credits
		if( ! function_exists( 'neville__footer_default_main_credits' ) ) {
			function neville__footer_default_main_credits() {
				/**
				 * Hooked:
				 * neville__footer_default_main_credits_start     - 10
				 * neville__footer_default_main_credits_copyright - 20
				 * neville__footer_default_main_credits_logo      - 30
				 * neville__footer_default_main_credits_acosmin   - 40
				 * neville__footer_default_main_credits_end       - 999
				 */
				do_action( 'neville__footer_default_main_credits' );
			}
		}

			// Main credits start
			if( ! function_exists( 'neville__footer_default_main_credits_start' ) ) {
				function neville__footer_default_main_credits_start() {
					?>
					<div id="colophon" class="wrap footer-credits" role="contentinfo">
						<div class="container">
							<div class="row-display grid-2">
					<?php
				}
			}

			// Main credits end
			if( ! function_exists( 'neville__footer_default_main_credits_end' ) ) {
				function neville__footer_default_main_credits_end() {
					?>
							</div><!-- .row-display.grid-1 -->
						</div><!-- .container -->
					</div><!-- .footer-credits -->
					<?php
				}
			}

			// Main credits copyright
			if( ! function_exists( 'neville__footer_default_main_credits_copyright' ) ) {
				function neville__footer_default_main_credits_copyright() {
					$msg = neville_tm( 'copyright_info', neville_copyright_info() );
					?>
					<div class="col-4x fc-left">
						<p class="ft-copyright-info"><?php echo wp_kses_post( $msg ); ?></p>
					</div>
					<?php
				}
			}

			// Main credits logo
			if( ! function_exists( 'neville__footer_default_main_credits_logo' ) ) {
				function neville__footer_default_main_credits_logo() {
					// Some options
					$o = apply_filters( 'neville___footer_default_main_credits_logo', [
						'before'   => '<div class="col-4x footer-logo light-logo"><div class="site-branding">',
						'after'    => '</div></div>',
						'location' => 'light'
					] );

					// Output logo
					echo $o[ 'before' ] . neville_logo( [ 'echo' => false ], $o[ 'location' ] ) . $o[ 'after' ];
				}
			}

			// Main credits theme author
			if( ! function_exists( 'neville__footer_default_main_credits_acosmin' ) ) {
				function neville__footer_default_main_credits_acosmin() {
					$disable = apply_filters( 'neville___disable_credits', false );

					/* Hide credits if the user wants it, use the filter */
					if( $disable ) return;

					/* Output */
					$format  = '<div class="col-4x fc-right"><p>%s</p></div>';
					$credits = sprintf(
						esc_html_x( '%s by Acosmin', 'theme author credits line', 'neville' ),
						'<a href="http://www.acosmin.com/theme/neville/">Neville theme</a>'
					);

					/* Print/echo output */
					printf( $format, $credits );
				}
			}

		// Main backtotop
		if( ! function_exists( 'neville__footer_default_main_backtotop' ) ) {
			function neville__footer_default_main_backtotop() {
				/**
				 * Hooked:
				 * neville__footer_default_main_backtotop_start  - 10
				 * neville__footer_default_main_backtotop_button - 20
				 * neville__footer_default_main_backtotop_end    - 999
				 */
				do_action( 'neville__footer_default_main_backtotop' );
			}
		}

			// Main backtotop start
			if( ! function_exists( 'neville__footer_default_main_backtotop_start' ) ) {
				function neville__footer_default_main_backtotop_start() {
					?>
					<div id="backtotop" class="wrap footer-backtotop">
					<?php
				}
			}

			// Main backtotop end
			if( ! function_exists( 'neville__footer_default_main_backtotop_end' ) ) {
				function neville__footer_default_main_backtotop_end() {
					?>
					</div><!-- .footer-backtotop -->
					<?php
				}
			}

			// Main backtotop end
			if( ! function_exists( 'neville__footer_default_main_backtotop_button' ) ) {
				function neville__footer_default_main_backtotop_button() {
					$hide = neville_tm( 'disable_bt_btn', false );

					// Hide button
					if( $hide ) return;

					?>
					<a id="btt-btn" href="#">
					<i class="nicon nicon-angle-up"></i>
					<svg class="btt-btn" width="192" height="61" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 160.7 61.5" enable-background="new 0 0 160.7 61.5" xml:space="preserve" style="transform: translate3d(0px, 0px, 0px);"><path fill="#FFFFFF" d="M80.3,61.5c0,0,22.1-2.7,43.1-5.4s41-5.4,36.6-5.4c-21.7,0-34.1-12.7-44.9-25.4S95.3,0,80.3,0c-15,0-24.1,12.7-34.9,25.4S22.3,50.8,0.6,50.8c-4.3,0-6.5,0,3.5,1.3S36.2,56.1,80.3,61.5z"></path></svg>
					</a>
					<?php
				}
			}

/**
 * Hooked:
 * neville__footer_default_sidebars - 10
 * neville__footer_default_main     - 20
 */
do_action( 'neville__footer_default' );
