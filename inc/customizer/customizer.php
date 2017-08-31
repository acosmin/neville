<?php
/**
 * Cusomizer
 * ---------
 */

// Customizer helper functions
require_once( NEVILLE_CUSTOMIZER . 'customizer-helpers.php' );

/**
 * Init Customizer
 */
if( ! function_exists( 'neville_customizer' ) ) {
	/**
	 * Initialize Customizer options
	 * @see    https://developer.wordpress.org/themes/customize-api/customizer-objects/
	 * @since  1.0.0
	 * @param  object $wp_customize WP_Customize_Manager instance
	 * @return void
	 */
	function neville_customizer( $wp_customize ) {

		/**
		 * Custom controls init
		 */
		require_once( NEVILLE_CUSTOMIZER . 'modules/sortable-options/control.php' );
		require_once( NEVILLE_CUSTOMIZER . 'modules/info/control.php' );
		require_once( NEVILLE_CUSTOMIZER . 'modules/recommend/control.php' );
		require_once( NEVILLE_CUSTOMIZER . 'modules/upsell/control.php' );

		/**
		 * Register custom stuff :)
		 */
		$wp_customize->register_section_type( 'Neville_Installer_Section' );
		$wp_customize->register_section_type( 'Neville_Pro_Section' );

		/**
		 * Panels
		 * ---------------------
		 */

		// Front Page Sections
		$wp_customize->add_panel( 'neville_sections', array(
			'title'           => __( 'Front Page Sections', 'neville' ),
			'priority'        => 35,
			'active_callback' => function() {
				return is_page_template( 'template-frontpage.php') ? true : false;
			},
		) );

			// Colors section
			$wp_customize->get_setting( 'background_color' )->transport   = 'postMessage';
			$wp_customize->get_control( 'background_color' )->description = __( 'This will only work in Boxed mode', 'neville' );

				// Options: Accent color
				$wp_customize->add_setting( 'accent_color', [
					'sanitize_callback' => 'neville_sanitize_rgb',
					'default'           => '#ef0000',
					'capability'        => 'edit_theme_options',
					'transport'         => 'postMessage'
				] );

				$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', [
					'label'       => esc_html__( 'Accent Color', 'neville' ),
					'description' => '',
					'section'     => 'colors',
					'settings'    => 'accent_color',
				] ) );

		// Theme Settings
		$wp_customize->add_panel( 'theme_settings', [
			'priority'    => 1,
			'capability'  => 'edit_theme_options',
			'title'       => esc_html__( 'Theme Settings', 'neville' ),
			'description' => esc_html__( 'Edit theme specific options, related to posts, pages, headers &hellip;', 'neville' ),
		] );

			/**
			 * Sections
			 * ---------------------
			 */

			// Documentation
			$wp_customize->add_section(
				new Neville_Pro_Section( $wp_customize, 'neville-pro-section', [
						'title'    => esc_html__( 'Need help?', 'neville' ),
						'pro_text' => esc_html__( 'Documentation', 'neville' ),
						'pro_url'  => '//www.acosmin.com/documentation/neville/',
						'priority' => 0
					]
				)
			);

			// Recommended plugin
			if ( ! neville_check_exts_state() ) :
				if ( neville_installer_sec_callback() ) :
				$wp_customize->add_section( new Neville_Installer_Section( $wp_customize, 'neville-installer', [
					'title'     => esc_html_x( 'Recommended Plugin:', 'Customizer Extensions Installer', 'neville' ),
					'plugin'    => esc_html_x( 'Neville Extensions', 'Customizer Extensions Installer', 'neville' ),
					'notice'    => [
										'p1' => esc_html_x( 'If you want to take full advantage of all the options this theme has to offer', 'Customizer Extensions Installer', 'neville' ),
										'p2' => esc_html_x( 'please install and activate', 'Customizer Extensions Installer', 'neville' ),
									],
					'docs'      => [
										'url'  => esc_url( '//www.acosmin.com/documentation/neville/' ),
										'text' => esc_html_x( '(Instagram widgets, Title design, Ads widgets...)', 'Customizer Extensions Installer', 'neville' ),
									],
					'install'   => [
										'slug' => 'acosmin-neville-extensions',
										'aria' => esc_attr_x( 'Install Neville Extensions Now', 'Customizer Extensions Installer', 'neville' ),
										'name' => esc_attr_x( 'Neville Extensions', 'Customizer Extensions Installer', 'neville' ),
										'text' => esc_attr_x( 'Install Now', 'Customizer Extensions Installer', 'neville' ),
									],
					'dismiss'   => [
										'id'   => 'neville-dismiss-rec-plugin',
										'aria' => esc_attr_x( 'Dismiss Installer Message', 'Customizer Extensions Installer', 'neville' ),
										'text' => esc_attr_x( 'Dismiss', 'Customizer Extensions Installer', 'neville' ),
									],
					'active'    => [
										'check' => neville_check_exts_installed(),
										'msg'   => esc_attr_x( 'The plugin is installed but not activated.', 'Customizer Extensions Installer', 'neville' ),
										'url'   => esc_url( admin_url( 'plugins.php' ) ),
										'btn'   => esc_attr_x( 'Activate Plugin', 'Customizer Extensions Installer', 'neville' ),
									],
					'priority'  => 0
				] ) );
				endif;
			endif;

			// Front Page
			$fp_section = $wp_customize->get_section( 'sidebar-widgets-sections-front-page');

			if( isset( $fp_section ) ) {
				$fp_section->panel = 'neville_sections';
			}

			// General
			$wp_customize->add_section( 'general_settings', [
				'title' => esc_html__( 'General', 'neville' ),
				'panel' => 'theme_settings'
			] );

				// Options: Boxed version
				$wp_customize->add_setting( 'boxed_version', [
					'sanitize_callback' => 'neville_sanitize_checkbox',
					'default'           => false,
					'capability'        => 'edit_theme_options',
					'transport'         => 'postMessage'
				] );

				$wp_customize->add_control( 'boxed_version', [
					'label'       => esc_html__( 'Boxed version', 'neville' ),
					'description' => esc_html__( 'Display the container as full width or with a maximum width. With boxed version you will be able to view the background image.', 'neville' ),
					'section'     => 'general_settings',
					'settings'    => 'boxed_version',
					'type'        => 'checkbox',
				] );

			// Header
			$wp_customize->add_section( 'header_settings', [
				'title' => esc_html__( 'Header', 'neville' ),
				'panel' => 'theme_settings'
			] );

				// Options: Mobile menu label
				$wp_customize->add_setting( 'mm_label', [
					'sanitize_callback' => 'esc_html',
					'default'           => apply_filters( 'neville___header_mm_label_default', esc_html__( 'navigation', 'neville' ) ),
					'capability'        => 'edit_theme_options',
					'transport'         => 'postMessage'
				] );

				$wp_customize->add_control( 'mm_label', [
					'label'       => esc_html__( 'Mobile menu label', 'neville' ),
					'description' => '',
					'section'     => 'header_settings',
					'settings'    => 'mm_label',
					'type'        => 'text',
				] );

				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial( 'mm_label', [
						'selector' => '.mobile-btn .label-btn',
						'render_callback' => function() { return esc_html( neville_tm( 'mm_label' ) ); }
					] );
				}

			// Footer
			$wp_customize->add_section( 'footer_settings', [
				'title' => esc_html__( 'Footer', 'neville' ),
				'panel' => 'theme_settings'
			] );

				// Options: Copyright info
				$wp_customize->add_setting( 'copyright_info', [
					'sanitize_callback' => 'wp_kses_post',
					'default'           => neville_copyright_info(),
					'capability'        => 'edit_theme_options',
					'transport'         => 'postMessage'
				] );

				$wp_customize->add_control( 'copyright_info', [
					'label'       => esc_html__( 'Copyright info', 'neville' ),
					'description' => esc_html__( 'Change your websites copyright information. You can use most of the HTML tags.', 'neville' ),
					'section'     => 'footer_settings',
					'settings'    => 'copyright_info',
					'type'        => 'textarea',
				] );

				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial( 'copyright_info', [
						'selector' => '.ft-copyright-info',
						'render_callback' => function() { return wp_kses_post( get_theme_mod( 'copyright_info' ) ); }
					] );
				}

				// Options: Disable back to top button
				$wp_customize->add_setting( 'disable_bt_btn', [
					'sanitize_callback' => 'neville_sanitize_checkbox',
					'default'           => false,
					'capability'        => 'edit_theme_options',
					'transport'         => 'postMessage'
				] );

				$wp_customize->add_control( 'disable_bt_btn', [
					'label'       => esc_html__( 'Hide "Back To Top" button', 'neville' ),
					'section'     => 'footer_settings',
					'settings'    => 'disable_bt_btn',
					'type'        => 'checkbox',
				] );

			// Index
			$wp_customize->add_section( 'index_settings', [
				'title' => esc_html__( 'Index', 'neville' ),
				'panel' => 'theme_settings'
			] );

				// Notice
				$wp_customize->add_setting( 'hh_title', [
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
					'capability'        => 'edit_theme_options',
				] );

				$wp_customize->add_control( new Neville_Customizer_Control_Info( $wp_customize, 'hh_title', [
					'label'       => esc_html__( 'Home Page Header', 'neville' ),
					'description' => esc_html__( 'It will display only on the home page, above your latest posts.', 'neville' ),
					'settings'    => 'hh_title',
					'section'     => 'index_settings',
					'type'        => 'info-control',
					'info_type'   => 'info',
					'css_class'   => '',
					'html'        => '',
					'priority'    => 1
				] ) );

				// Options: Home Page show header
				$wp_customize->add_setting( 'index_show_header', [
					'sanitize_callback' => 'neville_sanitize_checkbox',
					'default'           => true,
					'capability'        => 'edit_theme_options',
					'transport'         => 'postMessage'
				] );

				$wp_customize->add_control( 'index_show_header', [
					'label'       => esc_html__( 'Show home page header', 'neville' ),
					'section'     => 'index_settings',
					'settings'    => 'index_show_header',
					'type'        => 'checkbox',
				] );

				// Options: Home Page show header subscribe
				$wp_customize->add_setting( 'index_show_subscr', [
					'sanitize_callback' => 'neville_sanitize_checkbox',
					'default'           => true,
					'capability'        => 'edit_theme_options',
					'transport'         => 'postMessage'
				] );

				$wp_customize->add_control( 'index_show_subscr', [
					'label'       => esc_html__( 'Show subscribe button', 'neville' ),
					'section'     => 'index_settings',
					'settings'    => 'index_show_subscr',
					'type'        => 'checkbox',
				] );

				// Options: Home Page title
				$wp_customize->add_setting( 'index_title', [
					'sanitize_callback' => 'esc_html',
					'default'           => apply_filters( 'neville___index_title_default', esc_html__( 'Latest Articles', 'neville' ) ),
					'capability'        => 'edit_theme_options',
					'transport'         => 'postMessage'
				] );

				$wp_customize->add_control( 'index_title', [
					'label'       => esc_html__( 'Home Page posts title', 'neville' ),
					'description' => '',
					'section'     => 'index_settings',
					'settings'    => 'index_title',
					'type'        => 'text',
				] );

				if ( isset( $wp_customize->selective_refresh ) ) {
					$wp_customize->selective_refresh->add_partial( 'index_title', [
						'selector' => '.section-blog .section-title',
						'render_callback' => function() { return get_theme_mod( 'index_title' ); }
					] );
				}

				// Layout options title
				$wp_customize->add_setting( 'hh_layout_index', [
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
					'capability'        => 'edit_theme_options',
				] );

				$wp_customize->add_control( new Neville_Customizer_Control_Info( $wp_customize, 'hh_layout_index', [
					'label'       => esc_html__( 'Posts Loop Layout', 'neville' ),
					'description' => '',
					'settings'    => 'hh_layout_index',
					'section'     => 'index_settings',
					'type'        => 'info-control',
					'info_type'   => 'editor-alignleft',
					'css_class'   => 'neville-m-t',
					'html'        => '',
				] ) );

				// Options: Start with
				$wp_customize->add_setting( 'posts_start', [
					'sanitize_callback' => 'neville_sanitize_select',
					'default'           => '1',
					'capability'        => 'edit_theme_options',
					'transport'         => 'refresh'
				] );

				$wp_customize->add_control( 'posts_start', [
					'label'       => esc_html__( 'Layout starts with:', 'neville' ),
					'description' => esc_html__( 'Should the posts loop start with a small or big thumbnail layout?', 'neville' ),
					'section'     => 'index_settings',
					'settings'    => 'posts_start',
					'type'        => 'select',
					'choices'     => [
						'0' => esc_html__( 'Large thumbnail', 'neville' ),
						'1' => esc_html__( 'Small thumbnail', 'neville' ),
					]
				] );

				// Options: Show a large thumbnail
				$wp_customize->add_setting( 'posts_when', [
					'sanitize_callback' => 'absint',
					'default'           => 3,
					'capability'        => 'edit_theme_options',
					'transport'         => 'refresh'
				] );

				$wp_customize->add_control( 'posts_when', [
					'label'       => esc_html__( 'Show a large thumbnail post each # of posts', 'neville' ),
					'description' => esc_html__( 'If you make this 1, it will only display large thumbnails', 'neville' ),
					'section'     => 'index_settings',
					'settings'    => 'posts_when',
					'type'        => 'number',
					'input_attrs' => [
						'min' => 1,
						'max' => 999
					]
				] );

				// Options: Show mixed
				$wp_customize->add_setting( 'posts_mixed', [
					'sanitize_callback' => 'neville_sanitize_checkbox',
					'default'           => true,
					'capability'        => 'edit_theme_options',
					'transport'         => 'refresh'
				] );

				$wp_customize->add_control( 'posts_mixed', [
					'label'       => esc_html__( 'Show mixed post thumbnails?', 'neville' ),
					'description' => esc_html__( 'If you disable this, it will only display small thumbnail posts', 'neville' ),
					'section'     => 'index_settings',
					'settings'    => 'posts_mixed',
					'type'        => 'checkbox',
				] );

				// Layout options title
				$wp_customize->add_setting( 'hh_nav_index', [
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
					'capability'        => 'edit_theme_options',
				] );

				$wp_customize->add_control( new Neville_Customizer_Control_Info( $wp_customize, 'hh_nav_index', [
					'label'       => esc_html__( 'Blog Section', 'neville' ),
					'description' => __( 'The following options change the View More Articles button in Blog section', 'neville' ),
					'settings'    => 'hh_nav_index',
					'section'     => 'index_settings',
					'type'        => 'info-control',
					'info_type'   => 'leftright',
					'css_class'   => 'neville-m-t',
					'html'        => '',
				] ) );

				// Options: Show button
				$wp_customize->add_setting( 'more_articles_show', [
					'sanitize_callback' => 'neville_sanitize_checkbox',
					'default'           => true,
					'capability'        => 'edit_theme_options',
					'transport'         => 'postMessage'
				] );

				$wp_customize->add_control( 'more_articles_show', [
					'label'       => esc_html__( 'Show button', 'neville' ),
					'section'     => 'index_settings',
					'settings'    => 'more_articles_show',
					'type'        => 'checkbox',
				] );

				// Options: Button title
				$wp_customize->add_setting( 'more_articles_button', [
					'sanitize_callback' => 'esc_html',
					'default'           => apply_filters( 'neville___more_articles_button', esc_html__( 'View more articles', 'neville' ) ),
					'capability'        => 'edit_theme_options',
					'transport'         => 'postMessage'
				] );

				$wp_customize->add_control( 'more_articles_button', [
					'label'       => esc_html__( 'Button title', 'neville' ),
					'description' => '',
					'section'     => 'index_settings',
					'settings'    => 'more_articles_button',
					'type'        => 'text',
				] );

				// Options: Button url
				$wp_customize->add_setting( 'more_articles_url', [
					'sanitize_callback' => 'esc_url_raw',
					'default'           => '',
					'capability'        => 'edit_theme_options',
					'transport'         => 'postMessage'
				] );

				$wp_customize->add_control( 'more_articles_url', [
					'label'       => esc_html__( 'Button url', 'neville' ),
					'description' => '',
					'section'     => 'index_settings',
					'settings'    => 'more_articles_url',
					'type'        => 'text',
				] );

			// Post
			$wp_customize->add_section( 'post_settings', [
				'title' => esc_html__( 'Post', 'neville' ),
				'panel' => 'theme_settings'
			] );

				// Options: Hide sidebar
				$wp_customize->add_setting( 'hide_sidebar_post', [
					'sanitize_callback' => 'neville_sanitize_checkbox',
					'default'           => false,
					'capability'        => 'edit_theme_options',
					'transport'         => 'refresh'
				] );

				$wp_customize->add_control( 'hide_sidebar_post', [
					'label'       => esc_html__( 'Hide sidebar', 'neville' ),
					'description' => esc_html__( 'This will hide the sidebar globally in all posts (not pages)', 'neville' ),
					'section'     => 'post_settings',
					'settings'    => 'hide_sidebar_post',
					'type'        => 'checkbox',
				] );

				// Notice
				$wp_customize->add_setting( 'sside_title', [
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
					'capability'        => 'edit_theme_options',
				] );

				$wp_customize->add_control( new Neville_Customizer_Control_Info( $wp_customize, 'sside_title', [
					'label'       => esc_html__( 'Jetpack side sharing', 'neville' ),
					'description' => __( 'Sharing icons on the right side of the post. To be able to see these buttons you need to activate <strong>Jetpack</strong> and enable the <strong>Sharing module</strong>. Also, the selected button style must be <strong>Icons only</strong> in <code>WP Administration Panel > Settings > Sharing</code>', 'neville' ),
					'settings'    => 'sside_title',
					'section'     => 'post_settings',
					'type'        => 'info-control',
					'info_type'   => 'info',
					'css_class'   => '',
					'html'        => '',
				] ) );

				// Options: Post show side share
				$wp_customize->add_setting( 'side_share', [
					'sanitize_callback' => 'neville_sanitize_checkbox',
					'default'           => false,
					'capability'        => 'edit_theme_options',
					'transport'         => 'refresh'
				] );

				$wp_customize->add_control( 'side_share', [
					'label'       => esc_html__( 'Show side sharing buttons', 'neville' ),
					'section'     => 'post_settings',
					'settings'    => 'side_share',
					'type'        => 'checkbox',
				] );

				// Options: Sitcky side share
				$wp_customize->add_setting( 'ss_sticky', [
					'sanitize_callback' => 'neville_sanitize_checkbox',
					'default'           => false,
					'capability'        => 'edit_theme_options',
					'transport'         => 'refresh'
				] );

				$wp_customize->add_control( 'ss_sticky', [
					'label'       => esc_html__( 'Sitcky side share buttons?', 'neville' ),
					'section'     => 'post_settings',
					'settings'    => 'ss_sticky',
					'type'        => 'checkbox',
				] );

				// Options: Reorder single sections
				$wp_customize->add_setting( 'ss_reorder_title', [
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
					'capability'        => 'edit_theme_options',
				] );

				$wp_customize->add_control( new Neville_Customizer_Control_Info( $wp_customize, 'ss_reorder_title', [
					'label'       => esc_html__( 'Single View', 'neville' ),
					'description' => __( 'Additional sections. Enable and reorder them below.', 'neville' ),
					'settings'    => 'ss_reorder_title',
					'section'     => 'post_settings',
					'type'        => 'info-control',
					'info_type'   => 'info',
					'css_class'   => '',
					'html'        => '',
				] ) );

				$wp_customize->add_setting(
					'single_sortable',
					array(
						'default'           => neville_cc_sortable_defaults( neville_cc_sortable_post_boxes(), 'single_sortable' ),
						'sanitize_callback' => 'neville_sanitize_cc_sortable',
						'transport'         => 'refresh',
						'capability'        => 'edit_theme_options',
					)
				);

				/* Add Control for the settings. */
				$single_choices  = [];
				$single_services = neville_cc_sortable_post_boxes();

				foreach( $single_services as $skey => $sval ) {
					$single_choices[ $skey ] = $sval[ 'label' ];
				}

				$wp_customize->add_control(
					new Neville_Control_Sortable_Options(
						$wp_customize,
						'single_sortable',
						array(
							'section'     => 'post_settings',
							'settings'    => 'single_sortable',
							'label'       => '',
							'description' => '',
							'choices'     => $single_choices,
						)
					)
				);

			// Page
			$wp_customize->add_section( 'page_settings', [
				'title' => esc_html__( 'Page', 'neville' ),
				'panel' => 'theme_settings'
			] );

				// Options: Hide sidebar
				$wp_customize->add_setting( 'hide_sidebar_page', [
					'sanitize_callback' => 'neville_sanitize_checkbox',
					'default'           => false,
					'capability'        => 'edit_theme_options',
					'transport'         => 'refresh'
				] );

				$wp_customize->add_control( 'hide_sidebar_page', [
					'label'       => esc_html__( 'Hide sidebar', 'neville' ),
					'description' => esc_html__( 'This will hide the sidebar globally in all pages (not posts)', 'neville' ),
					'section'     => 'page_settings',
					'settings'    => 'hide_sidebar_page',
					'type'        => 'checkbox',
				] );

				// Notice
				$wp_customize->add_setting( 'sside_title_page', [
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
					'capability'        => 'edit_theme_options',
				] );

				$wp_customize->add_control( new Neville_Customizer_Control_Info( $wp_customize, 'sside_title_page', [
					'label'       => esc_html__( 'Jetpack side sharing', 'neville' ),
					'description' => __( 'Sharing icons on the right side of the page. To be able to see these buttons you need to activate <strong>Jetpack</strong> and enable the <strong>Sharing module</strong>. Also, the selected button style must be <strong>Icons only</strong> in <code>WP Administration Panel > Settings > Sharing</code>', 'neville' ),
					'settings'    => 'sside_title_page',
					'section'     => 'page_settings',
					'type'        => 'info-control',
					'info_type'   => 'info',
					'css_class'   => '',
					'html'        => '',
				] ) );

				// Options: Post show side share
				$wp_customize->add_setting( 'side_share_page', [
					'sanitize_callback' => 'neville_sanitize_checkbox',
					'default'           => false,
					'capability'        => 'edit_theme_options',
					'transport'         => 'refresh'
				] );

				$wp_customize->add_control( 'side_share_page', [
					'label'       => esc_html__( 'Show side sharing buttons', 'neville' ),
					'section'     => 'page_settings',
					'settings'    => 'side_share_page',
					'type'        => 'checkbox',
				] );

				// Options: Sitcky side share
				$wp_customize->add_setting( 'ss_sticky_page', [
					'sanitize_callback' => 'neville_sanitize_checkbox',
					'default'           => false,
					'capability'        => 'edit_theme_options',
					'transport'         => 'refresh'
				] );

				$wp_customize->add_control( 'ss_sticky_page', [
					'label'       => esc_html__( 'Sitcky side share buttons?', 'neville' ),
					'section'     => 'page_settings',
					'settings'    => 'ss_sticky_page',
					'type'        => 'checkbox',
				] );

			// Background Image
			// Section already exists

				// Notice
				$wp_customize->add_setting( 'cb_notice', [
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
					'capability'        => 'edit_theme_options',
				] );

				$wp_customize->add_control( new Neville_Customizer_Control_Info( $wp_customize, 'cb_notice', [
					'label'       => esc_html__( 'Notice:', 'neville' ),
					'description' => esc_html__( 'This feature will be visible only if you use the Boxed option (Theme Settings > General). Also, depending on screen resolution, it may only show on Desktop computers', 'neville' ),
					'settings'    => 'cb_notice',
					'section'     => 'background_image',
					'type'        => 'info-control',
					'info_type'   => 'info',
					'css_class'   => '',
					'html'        => '',
					'priority'    => 1
				] ) );

			// Header Image
			// Section already exists

				// Notice
				$wp_customize->add_setting( 'ch_notice', [
					'default'           => '',
					'sanitize_callback' => 'sanitize_text_field',
					'capability'        => 'edit_theme_options',
				] );

				$wp_customize->add_control( new Neville_Customizer_Control_Info( $wp_customize, 'ch_notice', [
					'label'       => esc_html__( 'Notice:', 'neville' ),
					'description' => esc_html__( 'This feature will be visible only on archive type pages. If you want to add header images for categories, please consider installing the "Categories Images" plugin, available on WordPress.org', 'neville' ),
					'settings'    => 'ch_notice',
					'section'     => 'header_image',
					'type'        => 'info-control',
					'info_type'   => 'info',
					'css_class'   => '',
					'html'        => '',
					'priority'    => 1
				] ) );

			// Site Identity
			// Section already exists

				// Light logo
				$wp_customize->add_setting( 'light_logo', array(
					'default'           => '',
					'sanitize_callback' => 'esc_url_raw',
					'capability'        => 'edit_theme_options',
					'transport'         => 'postMessage',
				) );
				$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'light_logo', array(
					'label'       => esc_html__( 'Light Logo', 'neville' ),
					'description' => esc_html__( 'This should go well on a dark background color. It will be displayed in the footer', 'neville' ),
					'section'     => 'title_tagline',
					'settings'    => 'light_logo',
					'priority'    => 10
				) ) );

				if ( isset( $wp_customize->selective_refresh ) ) {
					// Custom logo
					$wp_customize->selective_refresh->add_partial( 'custom_logo', [
						'selector'        => '.site-header .site-branding',
						'render_callback' => 'neville_customizer_partial_logo'
					] );

					// Light logo
					$wp_customize->selective_refresh->add_partial( 'light_logo', [
						'selector'        => '.light-logo .site-branding',
						'render_callback' => 'neville_customizer_partial_light_logo'
					] );

					// Site title
					$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

					$wp_customize->selective_refresh->add_partial( 'blogname', [
						'selector'            => '.site-branding .site-title a',
						'render_callback'     => 'neville_customizer_partial_name'
					] );

					// Site description, not supported
					$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

					$wp_customize->selective_refresh->add_partial( 'blogdescription', [
						'selector'        => '.site-description',
						'render_callback' => '__return_empty_string'
					] );
				}

	}
}
add_action( 'customize_register', 'neville_customizer', 11 );


if( ! function_exists( 'neville_customizer_assets' ) ) {
	/**
	 * Enqueues the needed files to initialize Customizer controls/options
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function neville_customizer_assets() {
		// Enqueue CSS assets
		wp_enqueue_style(
			'neville-customizer-styles',
			NEVILLE_CUSTOMIZER_URI . 'assets/css/customizer.css',
			[],
			'20170118',
			'all'
		);

		// Enqueue JS assets
		wp_enqueue_script(
			'neville-customizer-scripts',
			NEVILLE_CUSTOMIZER_URI . 'assets/js/customizer.js',
			[ 'jquery', 'jquery-ui-sortable', 'customize-controls' ],
			'20170118',
			true
		);

		$vars = apply_filters( 'neville_customizer_js_scripts', [
			'dismiss_ext_nonce' => wp_create_nonce( 'neville_dismiss_ext_nonce' ),
		] );

		wp_localize_script(
			'neville-customizer-scripts',
			'neville_customizer_js_scripts',
			$vars
		);

		wp_enqueue_script(
			'neville-customizer-settings',
			NEVILLE_CUSTOMIZER_URI . 'assets/js/customizer-settings.js',
			[ 'customize-controls', 'wp-util' ],
			'20170118',
			true
		);

		$settings = apply_filters( 'neville_customizer_js_settings', [
			'sections'   => [
				'slider',
				'line',
				'category',
				'blog',
			],
			'addsection' => esc_html_x( 'Add a Section', 'Customizer: Add a Widget button text', 'neville' ),
		] );

		wp_localize_script(
			'neville-customizer-settings',
			'neville_customizer_js_settings',
			$settings
		);
	}
}
add_action( 'customize_controls_enqueue_scripts', 'neville_customizer_assets', 0 );

if( ! function_exists( 'neville_customizer_preview' ) ) {
	/**
	 * Enqueue files needed for `postMessage`
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function neville_customizer_preview() {
		// Customizer preview transport
		wp_enqueue_script(
			'neville-customizer-preview',
			NEVILLE_CUSTOMIZER_URI . 'assets/js/customizer-preview.js',
			[ 'jquery' ],
			'20170118',
			true
		);

		// Add some options
		wp_localize_script( 'neville-customizer-preview', 'neville_preview',
			apply_filters( 'neville___customizer_preview', array(
				'bodyClasses' => neville_body_classes_array(),
			) )
		);
	}
}
add_action( 'customize_preview_init', 'neville_customizer_preview' );

if( ! function_exists( 'neville_customizer_css' ) ) {
	/**
	 * Customizer generated CSS
	 *
	 * @since  1.0.0
	 * @return string
	 */
	function neville_customizer_css() {
		$css = '';

		if( neville_ccd( 'accent_color', '#ef0000' ) ) {
			$css .= neville_gcs( '.rss-btn i, .sb-general i, .required, .sticky .sticky-tag, .header-btns .hbtn-count, .comments-area .comment-respond .comment-reply-title small a', 'color', 'accent_color' );
			$css .= neville_gcs( '.category-link.sty1, .comment-reply-link.sty1, .widget-content .wid-posts-lists .wid-pl-item .entry-thumbnail .wid-pli-pos:before', 'background-color', 'accent_color' );
			$css .= neville_gcs( 'abbr, abbr[title], acronym, .section-title.st2x:before, .category-link.sty2, .comment-reply-link.sty2, .comment-reply-link, .single .entry-content a:not([class]), .single .comment-content a:not([class]), .page-template-default .entry-content a:not([class]), .page-template-default .comment-content a:not([class]), .widget-title-wrap .widget-title span, .widget-content .textwidget a:not([class]), .wid-big-buttons .wid-big-button span:before', 'border-bottom-color', 'accent_color' );
		}

		$css = apply_filters( 'neville___customizer_css', $css );

		if( $css === '' ) return;

		// Adds inline CSS
		wp_add_inline_style( 'neville-style', neville_sanitize_css( $css ) );
	}
}
add_action( 'wp_enqueue_scripts', 'neville_customizer_css', 15 );
