<?php
/**
 * ---------------------
 * Global template parts
 *
 * @package Neville
 * ---------------------
 */

/**
 * Hook some template actions ;)
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 */
add_action( 'neville__global_start', 'neville__global_menu',       0 );
add_action( 'neville__global_start', 'neville__global_search',     5 );
add_action( 'neville__global_start', 'neville__global_start_wrap', 10 );

add_action( 'neville__global_end', 'neville__global_end_wrap', 999 );

add_action( 'wp_head', 'neville__head_elements', 0 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Global menu
if( ! function_exists( 'neville__global_menu' ) ) {
	function neville__global_menu() {
		?>
		<div id="offset-sidebar-overlay" class="os-overlay">
			<div id="offset-sider-wrap" class="os-wrap">
				<aside id="sidebar-offset" class="sidebar os-sidebar" role="complementary">
					<div class="os-close-wrap">
						<a href="#" id="offset-close-sidebar" class="os-close"><?php esc_html_e( 'close menu', 'neville' ) ?></a>
					</div>
					<?php
					$sidebar = apply_filters( 'neville___global_menu_sidebar', [
						'sidebar-offset',
						__( 'Mobile Menu', 'neville' )
					] );

					if ( is_active_sidebar( $sidebar[ 0 ] ) ) {
						dynamic_sidebar( $sidebar[ 0 ] );
					} else {
						if( current_user_can( 'edit_theme_options' ) ) {
							printf(
								'<div class="widget"><div class="widget-content"><center>' . __( 'This sidebar will show up when you click the "hamburger" menu. Add some widgets in the "%s" sidebar, example: "Custom Menu" widget. Only admins can view this message.', 'neville' ) . '</center></div></div>',
								'<strong>' . $sidebar[ 1 ] . '</strong>'
							);
						};
					}
					?>
				</aside>
			</div>
			<div class="os-empty"></div>
		</div>
		<?php
	}
}

// Global search
if( ! function_exists( 'neville__global_search' ) ) {
	function neville__global_search() {
		?>
		<div id="search-overlay" class="search-overlay">
			<?php get_search_form(); ?>
		</div>
		<?php
	}
}

// Global wrapper start
if( ! function_exists( 'neville__global_start_wrap' ) ) {
	function neville__global_start_wrap() {
		?><div id="page" class="site"><?php
	}
}

// Global wrapper end
if( ! function_exists( 'neville__global_end_wrap' ) ) {
	function neville__global_end_wrap() {
		?></div><!-- #page --><?php
	}
}

// Head elements
if( ! function_exists( 'neville__head_elements' ) ) {
	/**
	 * All the elements needed to be outputed in the header (meta info)
	 *
	 * @since  1.0.0
	 * @return string
	 */
	function neville__head_elements() {
		$el = apply_filters( 'neville_head_elements___args', array(
			'charset'  => get_bloginfo( 'charset' ),
			'viewport' => 'width=device-width, initial-scale=1',
			'profile'  => 'http://gmpg.org/xfn/11',
			'pingback' => get_bloginfo( 'pingback_url' )
		) );

		$format  = '<meta charset="%1$s">' . "\n";
		$format .= '<meta name="viewport" content="%2$s">' . "\n";
		$format .= '<link rel="profile" href="%3$s">' . "\n";
		$format .= ( is_singular() && 'open' === get_option( 'default_ping_status' ) ) ? '<link rel="pingback" href="%4$s">' . "\n" : '';
		$output  = sprintf(
			$format, esc_attr( $el[ 'charset' ] ), esc_attr( $el[ 'viewport' ] ), esc_url( $el[ 'profile' ] ), esc_url( $el[ 'pingback' ] )
		);

		echo apply_filters( 'neville_head_elements___output', $output, $format, $el );
	}
}
