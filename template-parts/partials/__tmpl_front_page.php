<?php
/**
 * -------------------
 * Front Page template
 *
 * @package Neville
 * -------------------
 */

/**
 * Hook some template actions ;)
 *
 * You can find some of these functions in ../inc/entry/meta.php
 *
 * @see https://developer.wordpress.org/reference/functions/add_action/
 */
add_action( 'neville_tmpl_front_page', 'neville__tmpl_front_page_before', 10 );
add_action( 'neville_tmpl_front_page', 'neville__tmpl_front_page_init',   20 );
add_action( 'neville_tmpl_front_page', 'neville__tmpl_front_page_after',  999 );

add_action( 'widgets_init', 'neville__tmpl_front_page_sidebar', 20 );

/**
 * Called functions
 *
 * @see https://developer.wordpress.org/reference/functions/do_action/
 */

// Register sidebar
if( ! function_exists( 'neville__tmpl_front_page_sidebar' ) ) {
	function neville__tmpl_front_page_sidebar() {
		register_sidebar( array(
			'name'          => esc_html__( 'Add or Configure Sections', 'neville' ),
			'id'            => 'sections-front-page',
			'description'   => esc_html__( 'Add as many sections as you want.', 'neville' ),
			'before_widget' => '<section id="%1$s" class="_wid %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '',
			'after_title'   => '',
		) );
	}
}

// Before sections actions
if( ! function_exists( 'neville__tmpl_front_page_before' ) ) {
	function neville__tmpl_front_page_before() {
		do_action( 'neville__tmpl_front_page_before' );
	}
}

// After sections actions
if( ! function_exists( 'neville__tmpl_front_page_after' ) ) {
	function neville__tmpl_front_page_after() {
		do_action( 'neville__tmpl_front_page_after' );
	}
}

// Front Page sections display
if( ! function_exists( 'neville__tmpl_front_page_init' ) ) {
	function neville__tmpl_front_page_init() {
		if ( is_active_sidebar( 'sections-front-page' ) ) {
			dynamic_sidebar( 'sections-front-page' );
		} else {
			if( current_user_can( 'edit_theme_options' ) ) {
				echo '<div class="widget"><div class="widget-content"><center>' . __( 'Add some sections here. Go to <b>Customizer > Front Page Sections > Add or Configure Sections</b>. Only admins can view this message.', 'neville' ) . '</center></div></div>';
			}
		}
	}
}
