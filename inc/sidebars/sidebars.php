<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @package Neville
 */

if ( ! function_exists( 'neville_widgets_init' ) ) {
	function neville_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Mobile Menu', 'neville' ),
			'id'            => 'sidebar-offset',
			'description'   => esc_html__( 'Displays widgets in the offset mobile menu.', 'neville' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<header class="widget-title-wrap"><h2 class="widget-title"><span>',
			'after_title'   => '</span></h2></header>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Home Sidebar', 'neville' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Displays widgets in home/archives view.', 'neville' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<header class="widget-title-wrap"><h2 class="widget-title"><span>',
			'after_title'   => '</span></h2></header>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Posts Sidebar', 'neville' ),
			'id'            => 'sidebar-2',
			'description'   => esc_html__( 'Displays widgets in single view.', 'neville' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<header class="widget-title-wrap"><h2 class="widget-title"><span>',
			'after_title'   => '</span></h2></header>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Pages Sidebar', 'neville' ),
			'id'            => 'sidebar-3',
			'description'   => esc_html__( 'Displays widgets in page view.', 'neville' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<header class="widget-title-wrap"><h2 class="widget-title"><span>',
			'after_title'   => '</span></h2></header>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar #1', 'neville' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'neville' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<header class="widget-title-wrap"><h2 class="widget-title"><span>',
			'after_title'   => '</span></h2></header>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar #2', 'neville' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'neville' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<header class="widget-title-wrap"><h2 class="widget-title"><span>',
			'after_title'   => '</span></h2></header>',
		) );

		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar #3', 'neville' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'neville' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<header class="widget-title-wrap"><h2 class="widget-title"><span>',
			'after_title'   => '</span></h2></header>',
		) );
	}
}
add_action( 'widgets_init', 'neville_widgets_init' );
