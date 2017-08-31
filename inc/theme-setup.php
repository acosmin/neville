<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @package Neville
 */
if ( ! function_exists( 'neville_setup' ) ) {
	function neville_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Neville, use a find and replace
		 * to change 'neville' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'neville' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Use CORE to add a logo image
		 */
		add_theme_support( 'custom-logo' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 370, 265, true );
		add_image_size( 'neville-full-4x', 1170, 530, true );
		add_image_size( 'neville-gird1-2x-tall', 584, 530, true );
		add_image_size( 'neville-gird1-2x-small', 584, 264, true );
		add_image_size( 'neville-gird1-1x-tall', 291, 530, true );
		add_image_size( 'neville-gird1-1x-small', 291, 264, true );
		add_image_size( 'neville-gird2-2x', 370, 265, true );
		add_image_size( 'neville-gird2-2x-auto', 370 );
		add_image_size( 'neville-small-1x', 70, 70, true );

		/**
		 * This theme uses wp_nav_menu() in multiple locations.
		 * Use 'neville_register___menus' filter to add more.
		 */
		register_nav_menus( apply_filters( 'neville_register___menus', [
			'primary'       => esc_html__( 'Primary', 'neville' ),
			'secondary'     => esc_html__( 'Header Top', 'neville' ),
			'header-social' => esc_html__( 'Header Top Social', 'neville' ),
			'footer'        => esc_html__( 'Footer', 'neville' ),
			'footer-social' => esc_html__( 'Footer Social', 'neville' ),
		] ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		] );

		/**
		 * Theme support for Custom Header
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#custom-header
		 */
		add_theme_support( 'custom-header', apply_filters( 'neville___custom_header', [
			'width'            => 1920,
			'height'           => 300,
			'flex-height'      => true,
			'header-text'      => false
		] ) );

		/**
		 * Theme support for Custom Background
		 *
		 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#custom-background
		 */
		add_theme_support( 'custom-background', apply_filters( 'neville___custom_bg', [
			'wp-head-callback' => 'neville_custom_bg_cb',
			'default-color' => 'e8e8e8',
		] ) );

		/**
		 * Adds excerpt functionality to pages
		 *
		 * @see https://codex.wordpress.org/Function_Reference/add_post_type_support
		 */
		add_post_type_support( 'page', 'excerpt' );

		/**
		 * Selective refresh for widgets
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Content width
		 */
		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 900;
	}
}
add_action( 'after_setup_theme', 'neville_setup' );

if( ! function_exists( 'neville_widgets_base_init' ) ) {
	/**
	 * Base widget class to extend our custom widgets
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function neville_widgets_base_init() {
		require_once( NEVILLE_WIDGETS . 'base.php' );

		// Custom widgets
		require_once( NEVILLE_WIDGETS . 'init.php' );
	}
}
add_action( 'widgets_init', 'neville_widgets_base_init', 20 );

if( ! function_exists( 'neville___body_classes' ) ) {
	/**
	 * Add new CSS classes on the <body> tag
	 *
	 * @since  1.0.0
	 * @param  array $classes Current classes
	 * @return array          New classes
	 */
	function neville___body_classes( $classes ) {
		// @see ../inc/helper-functions.php
		$body = neville_body_classes_array();

		// Boxed version
		$boxed = neville_tm( 'boxed_version', false );

		if( $boxed ) {
			$classes[] = $body[ 'boxed' ];
		}

		// Three little lines
		$three = neville_header_navextra( false );

		if( $three ) {
			$classes[] = $body[ 'three' ];
		}

		// Sharedaddy single side share
		$side_share = neville_tm( 'side_share', false );

		if( $side_share && neville_check_ss_display() && is_single() ) {
			$classes[] = $body[ 'sshare' ];
		}

		// Sharedaddy page side share
		$side_share_page = neville_tm( 'side_share_page', false );

		if( $side_share_page && neville_check_ss_display( [ 'show' => 'page' ] ) && is_page() ) {
			$classes[] = $body[ 'sshare' ];
		}

		// Drop cap
		if( is_single() ) {
			$drop_cap = get_post_meta(
				get_queried_object_id(),
				'neville_meta_drop_cap',
				true
			);

			if( $drop_cap ) {
				$classes[] = $body[ 'dropcap' ];
			}
		}

		// No sidebars
		$ns_post = neville_tm( 'hide_sidebar_post', false );
		$ns_page = neville_tm( 'hide_sidebar_page', false );

		if( $ns_post && is_single() ) {
			$classes[] = $body[ 'nosidepo' ];
		}

		if( $ns_page && is_page() && ! ( is_front_page() || is_home() ) ) {
			$classes[] = $body[ 'nosidepa' ];
		}

		// Return new $classes
		return $classes;
	}
}
add_filter( 'body_class', 'neville___body_classes' );


if( ! function_exists( 'neville_jetpack_sharedaddy' ) ) {
	/**
	 * Sharedaddy options
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function neville_jetpack_sharedaddy() {
		// Do nothing if the module is not enabled
		if( ! neville_check_jetpack_module( 'sharedaddy' ) ) return;

		// Remove it from the excerpt, we'll add it styled later
		remove_filter( 'the_excerpt', 'sharing_display', 19 );

		// Sticky side sharing in single view.
		add_filter( 'neville___sharing_display',   'sharing_display', 19 );
		add_filter( 'neville_share_display_index', 'sharing_display', 19 );
	}
}
add_action( 'init', 'neville_jetpack_sharedaddy', 20 );

if( ! function_exists( 'neville_register_recommended_plugins' ) ) {
	/**
	 * Register the required plugins for this theme.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function neville_register_recommended_plugins() {
		$plugins = array(

			// Acosmin Neville Extensions
			array(
				'name'      => 'Neville Extensions',
				'slug'      => 'neville-extensions',
				'required'  => false,
			),

		);

		$config = array(
			'id'           => 'neville',
			'default_path' => '',
			'menu'         => 'tgmpa-install-plugins',
			'has_notices'  => true,
			'dismissable'  => true,
			'dismiss_msg'  => '',
			'is_automatic' => false,
			'message'      => '',
		);

		tgmpa( $plugins, $config );
	}
}
add_action( 'tgmpa_register', 'neville_register_recommended_plugins' );
