<?php
/**
 * -----------------------
 * Header default template
 *
 * @package Neville
 * -----------------------
 */

/**
 * Hook some template actions ;)
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 */
add_action( 'neville__header_default', 'neville__header_default_menu_overlay', 5 );
add_action( 'neville__header_default', 'neville__header_default_wrap_start',   10 );
add_action( 'neville__header_default', 'neville__header_default_top_nav',      20 );
add_action( 'neville__header_default', 'neville__header_default_middle',       30 );
add_action( 'neville__header_default', 'neville__header_default_nav',          40 );
add_action( 'neville__header_default', 'neville__header_default_wrap_end',     999 );

add_action( 'neville__header_default_top_nav', 'neville__header_default_top_nav_start',   10 );
add_action( 'neville__header_default_top_nav', 'neville__header_default_top_nav_init',    20 );
add_action( 'neville__header_default_top_nav', 'neville__header_default_top_nav_social',  30 );
add_action( 'neville__header_default_top_nav', 'neville__header_default_top_nav_end',     999 );

add_action( 'neville__header_default_middle', 'neville__header_default_middle_start', 10 );
add_action( 'neville__header_default_middle', 'neville__header_default_logo',         20 );
add_action( 'neville__header_default_middle', 'neville__header_default_lbtns',        30 );
add_action( 'neville__header_default_middle', 'neville__header_default_rbtns',        40 );
add_action( 'neville__header_default_middle', 'neville__header_default_middle_end',   999 );

add_action( 'neville__header_default_lbtns', 'neville__header_default_btn_mobile', 10 );

add_action( 'neville__header_default_rbtns', 'neville__header_default_btn_myac',   10 );
//add_action( 'neville__header_default_rbtns', 'neville__header_default_btn_cart', 10 );
add_action( 'neville__header_default_rbtns', 'neville__header_default_btn_search', 20 );

add_action( 'neville__header_default_nav', 'neville__header_default_nav_start', 10 );
add_action( 'neville__header_default_nav', 'neville__header_default_nav_init',  20 );
add_action( 'neville__header_default_nav', 'neville__header_default_nav_end',   999 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Wrapper start
if( ! function_exists( 'neville__header_default_wrap_start' ) ) {
	function neville__header_default_wrap_start() {
		?>
		<header id="masthead" class="site-header" role="banner">
		<?php
	}
}

// Wrapper end
if( ! function_exists( 'neville__header_default_wrap_end' ) ) {
	function neville__header_default_wrap_end() {
		?>
		</header><!-- #masthead -->
		<?php
	}
}

// Menu overlay
if( ! function_exists( 'neville__header_default_menu_overlay' ) ) {
	function neville__header_default_menu_overlay() {
		?>
		<div class="menu-overlay"></div>
		<?php
	}
}

// Top Navigation
if( ! function_exists( 'neville__header_default_top_nav' ) ) {
	function neville__header_default_top_nav() {
		/**
		 * Hooked:
		 * neville__header_default_top_nav_start - 10
		 * neville__header_default_top_nav_init  - 20
		 * neville__header_default_top_nav_end   - 999
		 */
		do_action( 'neville__header_default_top_nav' );
	}
}

	// Top navigation - wrap start
	if( ! function_exists( 'neville__header_default_top_nav_start' ) ) {
		function neville__header_default_top_nav_start() {
			?>
			<div id="topnav" class="wrap top-navigation">
				<div class="container">
			<?php
		}
	}

	// Top navigation - wrap end
	if( ! function_exists( 'neville__header_default_top_nav_end' ) ) {
		function neville__header_default_top_nav_end() {
			?>
				</div><!-- .container -->
			</div><!-- #topnav -->
			<?php
		}
	}

	// Top navigation - init
	if( ! function_exists( 'neville__header_default_top_nav_init' ) ) {
		function neville__header_default_top_nav_init() {
			$tmpl = 'default';
			?>
			<nav id="secondary-nav" class="secondary-nav" role="navigation">
				<?php
				$secondary_menu_args = apply_filters( 'neville_secondary_menu___args', array(
					'theme_location' => 'secondary',
					'container'      => 'ul',
					'menu_id'        => 'secondary-menu',
					'menu_class'     => 'small-nav',
					'depth'          => 1
				), $tmpl );
				wp_nav_menu( $secondary_menu_args );
				?>
			</nav><!-- #secondary-nav -->
			<?php
		}
	}

	// Top navigation - social
	if( ! function_exists( 'neville__header_default_top_nav_social' ) ) {
		function neville__header_default_top_nav_social() {
			$tmpl = 'default';
			?>
			<nav id="header-social-nav" class="social-nav-header" role="navigation">
				<?php
				$social_menu_args = apply_filters( 'neville_header_social_menu___args', array(
					'theme_location' => 'header-social',
					'container'      => 'ul',
					'menu_id'        => 'header-social-menu',
					'menu_class'     => 'header-social-menu',
					'fallback_cb'    => '__return_false',
					'depth'          => 1
				), $tmpl );
				wp_nav_menu( $social_menu_args );
				?>
			</nav><!-- #header-social-nav -->
			<?php
		}
	}

// Middle header
if( ! function_exists( 'neville__header_default_middle' ) ) {
	function neville__header_default_middle() {
		/**
		 * Hooked:
		 * neville__header_default_middle_start - 10
		 * neville__header_default_logo         - 20
		 * neville__header_default_lbtns        - 30
		 * neville__header_default_rbtns        - 40
		 * neville__header_default_middle_end   - 999
		 */
		do_action( 'neville__header_default_middle' );
	}
}

	// Middle header - wrap start
	if( ! function_exists( 'neville__header_default_middle_start' ) ) {
		function neville__header_default_middle_start() {
			?>
			<div id="midhead" class="wrap middle-header">
				<div class="container midhead">
			<?php
		}
	}

	// Middle header - wrap start
	if( ! function_exists( 'neville__header_default_middle_end' ) ) {
		function neville__header_default_middle_end() {
			?>
				</div><!-- .container.midhead -->
			</div><!-- #midhead -->
			<?php
		}
	}

	// Middle header - left side buttons
	if( ! function_exists( 'neville__header_default_lbtns' ) ) {
		function neville__header_default_lbtns() {
			?>
			<div class="header-btns left-side">
				<?php
				/**
				 * Hooked:
				 * neville__header_default_btn_mobile - 10
				 */
				do_action( 'neville__header_default_lbtns' );
				?>
			</div>
			<?php
		}
	}
		// Left side - mobile button
		if( ! function_exists( 'neville__header_default_btn_mobile' ) ) {
			function neville__header_default_btn_mobile() {
				$format = '
				<div class="header-btn">
					<a href="#" id="mobile-button" class="mobile-btn">
						<span class="burger-bars">
							<span class="mbtn-top"></span>
							<span class="mbtn-mid"></span>
							<span class="mbtn-bot"></span>
						</span>
						<span class="label-btn">%s</span>
					</a>
				</div>';

				$o = apply_filters( 'neville___header_default_btn_mobile', [
					'label'  => neville_tm( 'mm_label', __( 'navigation', 'neville' ) ),
					'format' => $format,
					'show'   => true
				] );

				if( ! $o[ 'show'] ) return;

				printf( $o[ 'format' ], esc_html( $o[ 'label' ] ) );
			}
		}

	// Middle header - right side buttons
	if( ! function_exists( 'neville__header_default_rbtns' ) ) {
		function neville__header_default_rbtns() {
			?>
			<div class="header-btns right-side">
				<?php
				/**
				 * Hooked:
				 * neville__header_default_btn_myac   - 10
				 * neville__header_default_btn_cart   - 20
				 * neville__header_default_btn_search - 30
				 */
				do_action( 'neville__header_default_rbtns' );
				?>
			</div>
			<?php
		}
	}

		// Right side - my account
		if( ! function_exists( 'neville__header_default_btn_myac' ) ) {
			function neville__header_default_btn_myac() {
				$format = '
				<div  id="hbtn-account" class="header-btn">
					<a href="%1$s" class="label-btn">%2$s</a>
				</div>';

				$o = apply_filters( 'neville___header_default_btn_myac', [
					'url'    => is_user_logged_in() ? admin_url() : wp_login_url(),
					'label'  => is_user_logged_in() ? __( 'my account', 'neville' ) : __( 'log in or register', 'neville' ),
					'format' => $format,
					'show'   => true
				] );

				if( ! $o[ 'show'] ) return;

				printf( $o[ 'format' ], esc_url( $o[ 'url' ] ), esc_html( $o[ 'label' ] ) );
			}
		}

		// Right side - shopping cart
		if( ! function_exists( 'neville__header_default_btn_cart' ) ) {
			function neville__header_default_btn_cart() {
				$format = '
				<div class="header-btn">
					<a href="#" class="hbtn-cart"><i class="nicon nicon-shopping-%s"></i><span class="hbtn-count">0</span></a>
				</div>';

				$o = apply_filters( 'neville___header_default_btn_cart', [
					'type'  => 'bag',
					'format' => $format,
					'show'   => true
				] );

				if( ! $o[ 'show'] ) return;

				printf( $o[ 'format' ], esc_attr( $o[ 'type' ] ) );
			}
		}

		// Right side - search
		if( ! function_exists( 'neville__header_default_btn_search' ) ) {
			function neville__header_default_btn_search() {
				$format = '
				<div id="hbtn-search" class="header-btn">
					<a href="#" class="hbtn-search"><i class="nicon nicon-%s"></i></a>
				</div>';

				$o = apply_filters( 'neville___header_default_btn_search', [
					'type'  => 'search',
					'format' => $format,
					'show'   => true
				] );

				if( ! $o[ 'show'] ) return;

				printf( $o[ 'format' ], esc_attr( $o[ 'type' ] ) );
			}
		}

	// Logo
	if( ! function_exists( 'neville__header_default_logo' ) ) {
		function neville__header_default_logo() {
			// Some options
			$o = apply_filters( 'neville___header_default_logo', [
				'before'   => '<div class="site-branding">',
				'after'    => '</div><!-- .site-branding -->',
				'location' => 'header'
			] );

			// Output logo
			echo $o[ 'before' ] . neville_logo( [ 'echo' => false ], $o[ 'location' ] ) . $o[ 'after' ];

			// Display a container for the tagline, but show it only in the Customizer
			// This feature isn't supported
			if( is_customize_preview() ) {
				echo '<span style="display: none !important" class="site-description"></span>';
			}
		}
	}

// Middle header
if( ! function_exists( 'neville__header_default_nav' ) ) {
	function neville__header_default_nav() {
		/**
		 * Hooked:
		 * neville__header_default_nav_start - 10
		 * neville__header_default_nav_init  - 20
		 * neville__header_default_nav_end   - 999
		 */
		do_action( 'neville__header_default_nav' );
	}
}

	// Primary navigation - wrap start
	if( ! function_exists( 'neville__header_default_nav_start' ) ) {
		function neville__header_default_nav_start() {
			?>
			<div id="mainnav" class="wrap main-navigation">
				<div class="container">
			<?php
		}
	}

	// Primary navigation - wrap end
	if( ! function_exists( 'neville__header_default_nav_end' ) ) {
		function neville__header_default_nav_end() {
			?>
				</div><!-- .container -->
				<?php neville_header_navextra() ?>
			</div><!-- #mainnav -->
			<?php
		}
	}

	// Primary navigation - init
	if( ! function_exists( 'neville__header_default_nav_init' ) ) {
		function neville__header_default_nav_init() {
			$tmpl = 'default';
			?>
			<nav id="primary-nav" class="primary-nav" role="navigation">
				<?php
				/**
				 * neville_primary_menu___args: Use this filter to change arguments for the primary menu
				 * @var array
				 */
				$primary_menu_args = apply_filters( 'neville_primary_menu___args', array(
					'theme_location' => 'primary',
					'container'      => 'ul',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'large-nav',
					'fallback_cb'    => 'neville_menu_helpers_primary',
					'depth'          => 2
				), $tmpl );
				wp_nav_menu( $primary_menu_args );
				?>
			</nav><!-- #primary-nav -->
			<?php
		}
	}

/**
 * Hooked:
 * neville__header_default_wrap_start - 10
 * neville__header_default_top_nav    - 20
 * neville__header_default_middle     - 30
 * neville__header_default_nav        - 40
 * neville__header_default_wrap_end   - 999
 */
do_action( 'neville__header_default' );
