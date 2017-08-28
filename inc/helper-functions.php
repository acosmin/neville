<?php
/**
 * --------------------------------------------------------------
 * Functions used to help arround in other functions or templates
 *
 * @package Neville
 * --------------------------------------------------------------
 */

if( ! function_exists( 'neville_logo' ) ) {
	/**
	 * Logo, site branding
	 *
	 * @since  1.0.0
	 * @param  array  $args Arguments to be parsed
	 * @return string       Logo HTML output
	 */
	function neville_logo( $args = [], $location = 'header' ) {
		// Some empty strings
		$image = $light_url = '';

		// Defaults
		$defaults = [
			'format' => '<%1$s class="site-title"><a href="%2$s" title="%3$s" rel="home" itemprop="url">%4$s</a></%1$s>',
			'image'  => '<img src="%1$s" class="custom-logo" alt="%2$s" title="%2$s" itemprop="logo" />',
			'tag'    => ( is_front_page() || is_home() ) && $location !== 'light' ? 'h1' : 'p',
			'echo'   => true
		];

		// Parse them
		$args = wp_parse_args( $args, $defaults );

		// Logo image
		switch( $location ) {

			// Header
			case 'header':
				$image = wp_get_attachment_image_src( neville_tm( 'custom_logo' ), 'full' );
				$image = sprintf(
					$args[ 'image' ],
					esc_url( $image[ 0 ] ),
					esc_attr( get_bloginfo( 'name' ) )
				);

				$args[ 'logo' ] = has_custom_logo() ? $image : get_bloginfo( 'name' );
				break;

			// Light
			case 'light':
				$light_url = neville_tm( 'light_logo', '' );
				$image     = sprintf(
					$args[ 'image' ],
					esc_url( $light_url ),
					esc_attr( get_bloginfo( 'name' ) )
				);

				$args[ 'logo' ] = $light_url !== '' ? $image : get_bloginfo( 'name' );
				break;
		}

		// Construct the HTML
		$output = sprintf(
			$args[ 'format' ],
			$args[ 'tag' ],
			esc_url( home_url( '/' ) ),
			esc_attr( get_bloginfo( 'name' ) ),
			$args[ 'logo' ]
		);

		// Filter it
		$output = apply_filters( 'neville___logo', $output, $location, $args, $defaults, $image, $light_url );

		// And output or return it
		if( $args[ 'echo' ] ) {
			echo $output;
		} else {
			return $output;
		}
	}
}

if( ! function_exists( 'neville_menu_helpers_primary' ) ) {
	/**
	 * Fallback for Primary location
	 * @since 1.0.0
	 */
	function neville_menu_helpers_primary() {
		if( current_user_can( 'edit_theme_options' ) ) {
			?>
			<nav id="primary-nav" class="primary-nav" role="navigation">
					<ul id="primary-menu" class="large-nav">
						<li class="menu-item"><a href="#"><?php _e( 'Add a menu - "Primary" location. Only you can view this.', 'neville' ); ?></a></li>
					</ul>
			</nav>
			<?php
		}
	}
}

if( ! function_exists( 'neville_check_exts_state' ) ) {
	/**
	 * Checks if Neville Extensions is activated
	 *
	 * @since  1.0.0
	 * @return boolean
	 */
	function neville_check_exts_state() {
		return function_exists( 'nevillex_theme_check' ) ? true : false;
	}
}


if ( ! function_exists( 'neville_installer_sec_callback' ) ) {
	/**
	 * Checks if Installer message is disabled
	 *
	 * @since  1.0.0
	 * @return boolean
	 */
	function neville_installer_sec_callback() {
		$notice = get_theme_mod( 'dismiss_ext_notice', false );
		return $notice ? false : true;
	}
}

if ( ! function_exists( 'neville_check_exts_installed' ) ) {
	/**
	 * Check if Extensions is installed/activated
	 *
	 * @since  1.0.0
	 * @return boolean
	 */
	function neville_check_exts_installed() {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php'; }
		$plugins   = get_plugins();
		$installed = false;

		foreach ( $plugins as $plugin ) {
			if ( 'Neville Extensions' == $plugin['Name'] ) {
				$installed = true;
			}
		}

		return $installed;
	}
}

if ( ! function_exists( 'neville_create_exts_install_url' ) ) {
	/**
	 * Create an installation link for our Extensions plugin
	 *
	 * @since  1.0.0
	 * @return string Install link
	 */
	function neville_create_exts_install_url() {
		$plugin_slug = 'neville-extensions';
		$plugin_install_url = add_query_arg(
			[
				'action' => 'install-plugin',
				'plugin' => $plugin_slug,
			],
			self_admin_url( 'update.php' )
		);
		$nonce_key = 'install-plugin_' . $plugin_slug;
		return $plugin_install_url = wp_nonce_url( $plugin_install_url, $nonce_key );
	}
}

if ( ! function_exists( 'neville_dismiss_ext_action' ) ) {
	/**
	 * Sets a theme mod to remember if the user selected to dismiss the
	 * installer message.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function neville_dismiss_ext_action() {
		// Check nonce
		if( ! isset( $_POST[ 'neville_dismiss_ext_nonce' ] ) || ! wp_verify_nonce( $_POST[ 'neville_dismiss_ext_nonce' ], 'neville_dismiss_ext_nonce' ) )
		die( esc_html__( 'Permission denied', 'neville' ) );

		// Add theme mod - true or false
		if( current_user_can( 'edit_theme_options' ) ) {
			set_theme_mod( 'dismiss_ext_notice', true );
		}
		die();
	}
}
add_action( 'wp_ajax_neville_dismiss_ext', 'neville_dismiss_ext_action' );
add_action( 'wp_ajax_nopriv_neville_dismiss_ext', 'neville_dismiss_ext_action' );

if( ! function_exists( 'neville_check_jetpack' ) ) {
	/**
	 * Checks if Jetpack is activated
	 *
	 * @since  1.0.0
	 * @return boolean
	 */
	function neville_check_jetpack() {
		return class_exists( 'Jetpack' ) ? true : false;
	}
}

if( ! function_exists( 'neville_check_jetpack_module' ) ) {
	/**
	 * Checks if a Jetpack module is active
	 *
	 * @since  1.0.0
	 * @return boolean
	 */
	function neville_check_jetpack_module( $module ) {
		// Do nothing if jetpack isn't active
		if( ! neville_check_jetpack() ) return false;

		return Jetpack::is_module_active( $module );
	}
}

if( ! function_exists( 'neville_check_sharing_show' ) ) {
	/**
	 * Checks if where should Sharedaddy show
	 *
	 * @since  1.0.0
	 * @return boolean
	 */
	function neville_check_sharing_show( $location ) {
		if( neville_check_jetpack_module( 'sharedaddy' ) ) {
			$sharing = get_option( 'sharing-options' );
			if( $sharing !== false && ! empty( $sharing[ 'global' ] ) ) {
				$show = $sharing[ 'global' ][ 'show' ];
				if( ! empty( $show ) ) {
					return in_array( $location, $show, TRUE );
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}
}

if( ! function_exists( 'neville_check_sharing_style' ) ) {
	/**
	 * Checks Sharedaddy display style is selected
	 *
	 * @since  1.0.0
	 * @return boolean
	 */
	function neville_check_sharing_style( $style ) {
		if( neville_check_jetpack_module( 'sharedaddy' ) ) {
			$sharing = get_option( 'sharing-options' );
			if( $sharing !== false && ! empty( $sharing[ 'global' ] ) ) {
				return $style == $sharing[ 'global' ][ 'button_style' ] ? true : false;
			}
		} else {
			return false;
		}
	}
}

if( ! function_exists( 'neville_check_ss_display' ) ) {
	/**
	 * Checks for right condition to display side sharing
	 * in single view
	 *
	 * @since  1.0.0
	 * @param  array   $args An array containing the style and show option from Sharedaddy
	 * @return boolean
	 */
	function neville_check_ss_display( $args = [] ) {
		// Defaults
		$defaults = apply_filters( 'neville___check_ss_side', [
			'style' => 'icon',
			'show'  => 'post'
		] );

		// Parse arguments
		$args = wp_parse_args( $args, $defaults );

		// Conditions
		$style    = neville_check_sharing_style( $args[ 'style' ] );
		$location = neville_check_sharing_show( $args[ 'show' ] );

		// Return
		return ( ! $style || ! $location ) ? false : true;
	}
}

if( ! function_exists( 'neville_check_categories_imgs' ) ) {
	/**
	 * Checks if the Categories Images plugin is activated
	 *
	 * @since  1.0.0
	 * @return boolean
	 */
	function neville_check_categories_imgs() {
		return function_exists( 'z_taxonomy_image_url' ) ? true : false;
	}
}

if( ! function_exists( 'neville_widget_css_classes' ) ) {
	/**
	 * Adds custom CSS classes to the `$args[ 'before_widget' ]` argument
	 *
	 * @since  1.0.0
	 * @param  array        $args `bw` => current before_widget, `type` => widget type, `css` => custom classes
	 * @return string|false        A `string` with new classes or `false` if `bw` is not set or empty $classes
	 */
	function neville_widget_css_classes( $args ) {
		/* Defaults */
		$defaults = [
			'bw'   => [],
			'type' => 'default',
			'css'  => []
		];

		/* Do nothing if we don't have `before_widget` */
		if( empty( $args[ 'bw' ] ) ) return false;

		/* Parse arguments */
		$args = wp_parse_args( $args, $defaults );

		/* Get classes and filter them */
		$classes = empty( $args[ 'css' ] ) ? array() : $args[ 'css' ];
		$classes = apply_filters( 'neville___widget_' . $args[ 'type' ] . '_css_classes', $args[ 'css' ], $args );

		/* Do nothing if we don't have classes */
		if( empty( $classes ) ) return false;

		/* Stringify them :) */
		$classes = join( ' ', array_unique( array_map( 'esc_attr', $classes ) ) );

		/* Return the new `before_widget` */
		if( strpos( $args[ 'bw' ], 'class' ) === false ) {
			return str_replace( '>', ' class="' . $classes . '">', $args[ 'bw' ] );
		} else {
			return str_replace( 'class="', 'class="' . $classes . ' ', $args[ 'bw' ] );
		}
	}
}

if( ! function_exists( 'neville_content_title' ) ) {
	/**
	 * Wrapper for `the_title()` with a filter based on location
	 *
	 * @see    https://developer.wordpress.org/reference/functions/the_title/#parameters
	 * @since  1.0.0
	 * @param  array   $args     Same as `the_title()` arguments
	 * @param  string  $location Location or style where this title is displayed
	 * @param  boolean $echo     Return or echo title
	 * @return string            The post title
	 */
	function neville_content_title( $args = array(), $location = 'small', $echo = true ) {
		$defaults = array(
			'before' => '<h3 class="entry-title t-1x"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">',
			'after'  => '</a></h3>'
		);

		$args  = apply_filters( "neville_content_title___{$location}_defaults", wp_parse_args( $args, $defaults ) );

		$title = the_title( $args[ 'before' ], $args[ 'after' ], false );

		if( $echo ) {
			echo $title;
		} else {
			return $title;
		}
	}
}

if( ! function_exists( 'neville_get_tmpl_partials') ) {
	/**
	 * Get a template containing partials
	 *
	 * @since  1.0.0
	 * @param  string $location In which directory should we look
	 * @param  string $mod      Theme mod set by user to select a template
	 * @return void             Outputs a template
	 */
	function neville_get_tmpl_partials( $location, $mod ) {
		$default  = apply_filters( 'neville_get_tmpl_partials___default', 'default', $location, $mod );
		$type     = neville_tm( $mod, $default );
		$location = 'template-parts/partials/' . $location;
		$location = apply_filters( 'neville_get_tmpl_partials___location', $location, $mod, $default );

		/* The selected template, returns default if none selected */
		get_template_part( $location, sanitize_key( $type ) );
	}
}

if( ! function_exists( 'neville_body_classes_array' ) ) {
	/**
	 * Filtered body classes
	 *
	 * @since  1.0.0
	 * @return array An array with body classes
	 */
	function neville_body_classes_array() {
		return array_unique( array_map( 'esc_attr', apply_filters( 'neville___body_classes_array', [
			'boxed'    => 'boxed',
			'three'    => 'nav-lines',
			'sshare'   => 'side-share',
			'nosidepo' => 'no-sidebar-post',
			'nosidepa' => 'no-sidebar-page',
			'dropcap'  => 'has-dropcap',
		] ) ) );
	}
}

if( ! function_exists( 'neville_header_navextra' ) ) {
	/**
	 * Shows three lines below the header, for design purpose
	 *
	 * @since  1.0.0
	 * @param  boolean        $echo Echo or return
	 * @return string|boolean       Echo HTML or return true or false to disable lines
	 */
	function neville_header_navextra( $echo = true ) {
		// Filtered
		$args = apply_filters( 'neville__header_navextra', [
			'html' => '<div id="navextra" class="navigation-extra"></div>',
			'show' => true
		] );

		if( $echo && $args[ 'show' ] ) {
			// Output
			echo $args[ 'html' ];
		} else {
			// Make sure we have a way to disable this
			return $args[ 'show' ];
		}
	}
}

if( ! function_exists( 'neville_copyright_info' ) ) {
	/**
	 * Copyright info, used mostly in footer.php
	 *
	 * @since  1.0.0
	 * @return string
	 */
	function neville_copyright_info() {
		$format    = esc_html_x( 'Copyright &copy; %1$s %2$s. All rights reserved', 'copyright info: 1. Year; 2. Title', 'neville' );
		$home_link = '<a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a>';
		$format    = apply_filters( 'neville_copyright_info', $format, $home_link );

		return sprintf( $format, date_i18n( __( 'Y', 'neville') ), $home_link );
	}
}

if( ! function_exists( 'neville_custom_bg_cb' ) ) {
	/**
	 * Custom Background feature callback
	 *
	 * @since  1.0.0
	 * @return string|void Inlyne styles if boxed version, nothing the othery way around
	 */
	function neville_custom_bg_cb() {
		$boxed = neville_tm( 'boxed_version', false );
		if( $boxed ) {
			_custom_background_cb();
		} else {
			return;
		}
	}
}

if( ! function_exists( 'neville_featured_posts' ) ) {
	/**
	 * Get all featured posts IDs
	 *
	 * @todo   add transient
	 * @since  1.0.0
	 * @return array IDs
	 */
	function neville_featured_posts() {
		$args = [
			'numberposts' => -1,
			'meta_key'    => 'neville_meta_featured_article',
			'meta_value'  => 1,
		];

		$posts = get_posts( $args );
		$ids   = [];

		foreach ( $posts as $k => $postobj ) {
			$ids[] = $postobj->ID;
		}

		return $ids;
	}
}

if( ! function_exists( 'neville_get_widget_number' ) ) {
	/**
	 * Returns the current widget instance number
	 *
	 * @since  1.0.1
	 * @param  string $widget_id Widget ID
	 * @return string            Current widget instance number
	 */
	function neville_get_widget_number( $widget_id ) {
		return array_slice( explode( '-', $widget_id ), -1 )[ 0 ];
	}
}

if( ! function_exists( 'neville_sortable_items_ouput' ) ) {
	function neville_sortable_items_ouput( $items, $new, $mod ) {
		if( ! $new ) return;

		foreach( $new as $key => $item ) {
			$func = $items[ $item ][ 'callback' ];
			$args = array_key_exists( 'args', $items[ $item ] ) ? $items[ $item ][ 'args' ] : array();

			if( function_exists( $func ) ) {
				if( ! empty( $args ) ) {
					call_user_func( $func, $args );
				} else {
					call_user_func( $func );
				}
			}
		}
	}
}

if( ! function_exists( 'neville_sortable_items_to_array' ) ) {
	function neville_sortable_items_to_array( $mod, $items ) {
		$new = [];

		foreach( $mod as $val ){
			$val = explode( ':', $val );
			if( isset( $val[ 0 ] ) && isset( $val[ 1 ] ) && array_key_exists( $val[ 0 ], $items ) && '1' == $val[ 1 ] ){
				$new[] = $val[ 0 ];
			}
		}

		return $new;
	}
}
