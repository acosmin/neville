<?php
if( ! class_exists( 'Neville_Section_Category' ) ) {
	/**
	 * Category section
	 *
	 * Will display a featured category
	 *
	 * @since 1.0.0
	 */
	class Neville_Section_Category extends Neville_Widgets_Base {

		/**
		 * Widget defaults
		 *
		 * @var    array
		 * @since  1.0.0
		 * @access protected
		 */
		protected $defaults;

		/**
		 * Widget instance
		 *
		 * @since  1.0.0
		 * @access public
		 */
		function __construct() {
			// Variables
			$this->widget_title = __( 'Category' , 'neville' );
			$this->widget_id    = 'category';

			// Settings
			$widget_ops = [
				'classname'   => 'section-category',
				'description' => esc_html__( 'Adds a Category section', 'neville' ),
				'customize_selective_refresh' => true
			];

			// Control settings
			$idBase = 'neville-section-' . $this->widget_id;

			$control_ops = [
				'width'   => NULL,
				'height'  => NULL,
				'id_base' => $idBase
			];

			// Create the widget
			parent::__construct( $idBase, $this->widget_title, $widget_ops, $control_ops );

			// Set some widget defaults
			$this->defaults = apply_filters( 'neville___section_category_defaults', [
				'category' => 0,
				'header'   => true,
				'no_child' => false,
				'link'     => true,
				'nav'      => '',
				'qty'      => 4,
				'nothumbs' => false,
				'thumbs'   => true,
				'lthumb'   => true,
				'othumb'   => true,
				'ptitle'   => true,
				'excerpt'  => true,
				'excpts'   => 20,
				'meta'     => true,
				'com'      => true,
				'share'    => true,
				'date'     => true,
				'side'     => true,
				'sticky'   => false,
				'side_t'   => __( 'Side Title', 'neville' ),
				'side_q'   => 'featured',
				'side_btn' => true,
			], $this );
		}

		/**
		 * Widget output
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function widget( $args, $instance ) {
			// Turn $args array into variables.
			extract( $args );

			// $instance Defaults
			$instance_defaults = $this->defaults;

			// Parse $instance
			$instance = wp_parse_args( $instance, $instance_defaults );

			// Pass arguments to our template
			$widget_options = [
				// General
				'widget'   => $this,
				// Category options
				'category' => isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : $instance_defaults[ 'category' ],
				'header'   => isset( $instance[ 'header' ] ) ? $instance[ 'header' ] : false,
				'no_child' => isset( $instance[ 'no_child' ] ) ? $instance[ 'no_child' ] : false,
				'link'     => isset( $instance[ 'link' ] ) ? $instance[ 'link' ] : false,
				'nav'      => empty( $instance[ 'nav' ] ) ? false : wp_get_nav_menu_object( $instance[ 'nav' ] ),
				'qty'      => isset( $instance[ 'qty' ] ) ? $instance[ 'qty' ] : $instance_defaults[ 'qty' ],
				'excpts'   => isset( $instance[ 'excpts' ] ) ? $instance[ 'excpts' ] : $instance_defaults[ 'excpts' ],
				'nothumbs' => isset( $instance[ 'nothumbs' ] ) ? $instance[ 'nothumbs' ] : false,
				'thumbs'   => isset( $instance[ 'thumbs' ] ) ? $instance[ 'thumbs' ] : false,
				'lthumb'   => isset( $instance[ 'lthumb' ] ) ? $instance[ 'lthumb' ] : false,
				'othumb'   => isset( $instance[ 'othumb' ] ) ? $instance[ 'othumb' ] : false,
				'ptitle'   => isset( $instance[ 'ptitle' ] ) ? $instance[ 'ptitle' ] : false,
				'excerpt'  => isset( $instance[ 'excerpt' ] ) ? $instance[ 'excerpt' ] : false,
				'meta'     => isset( $instance[ 'meta' ] ) ? $instance[ 'meta' ] : false,
				'com'      => isset( $instance[ 'com' ] ) ? $instance[ 'com' ] : false,
				'share'    => isset( $instance[ 'share' ] ) ? $instance[ 'share' ] : false,
				'date'     => isset( $instance[ 'date' ] ) ? $instance[ 'date' ] : false,
				'side'     => isset( $instance[ 'side' ] ) ? $instance[ 'side' ] : false,
				'sticky'   => isset( $instance[ 'sticky' ] ) ? $instance[ 'sticky' ] : false,
				'side_t'   => empty( $instance[ 'side_t' ] ) ? $instance_defaults[ 'side_t' ] : $instance[ 'side_t' ],
				'side_q'   => isset( $instance[ 'side_q' ] ) ? $instance[ 'side_q' ] : $instance_defaults[ 'side_q' ],
				'side_btn' => isset( $instance[ 'side_btn' ] ) ? $instance[ 'side_btn' ] : false,
			];

			// Filter before we add them
			$widget_options = apply_filters( 'neville___section_category_options', $widget_options, $this, $instance, $instance_defaults );

			// Add some CSS classes
			$before = apply_filters( 'neville___section_category_before', [
				'bw'   => $args[ 'before_widget' ],
				'type' => 'category',
				'css'  => [
					'wrap',
					$widget_options[ 'side' ] ? 's-c-masonry-sidebar': 's-c-masonry-full',
				]
			], $instance, $args );

			$before = neville_widget_css_classes( $before );

			// Use default if `$before` returns false.
			$args[ 'before_widget' ] = $before !== false ? $before : $args[ 'before_widget' ];

			// Show only where it's allowed
			$not_allowed = apply_filters( 'neville___section_category_conditions', [
				'funcs' => [
					'is_paged' => null
				]
			] );

			if( parent::_conditioned( $not_allowed ) ) return;

			// Widget template output
			echo $args[ 'before_widget' ];

				/**
				 * Hooked:
				 * neville__sec_tmpl_category  - 10
				 *
				 * @see ../sections/category/category-tmpl.php
				 */
				do_action( 'neville__section_category', $widget_options );

			echo $args[ 'after_widget' ];
		}

		/**
		 * Widget update instance
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			// Strings
			$instance[ 'side_t' ]    = sanitize_text_field( $new_instance[ 'side_t' ] );

			// Select
			$instance[ 'side_q' ]  = (string) neville_sanitize_select(
				$new_instance[ 'side_q' ],
				[ 'featured', 'popular' ],
				$this->defaults[ 'side_q' ],
				false
			);

			// Numbers
			$instance[ 'category' ] = (int) $new_instance[ 'category' ];
			$instance[ 'nav' ]      = (int) $new_instance[ 'nav' ];
			$instance[ 'qty' ]      = (int) $new_instance[ 'qty' ];
			$instance[ 'excpts' ]   = (int) $new_instance[ 'excpts' ];

			// Checkboxes
			$instance[ 'header' ]   = isset( $new_instance[ 'header' ] ) ? (bool) $new_instance[ 'header' ] : false;
			$instance[ 'no_child' ] = isset( $new_instance[ 'no_child' ] ) ? (bool) $new_instance[ 'no_child' ] : false;
			$instance[ 'link' ]     = isset( $new_instance[ 'link' ] ) ? (bool) $new_instance[ 'link' ] : false;
			$instance[ 'nothumbs' ] = isset( $new_instance[ 'nothumbs' ] ) ? (bool) $new_instance[ 'nothumbs' ] : false;
			$instance[ 'thumbs' ]   = isset( $new_instance[ 'thumbs' ] ) ? (bool) $new_instance[ 'thumbs' ] : false;
			$instance[ 'lthumb' ]   = isset( $new_instance[ 'lthumb' ] ) ? (bool) $new_instance[ 'lthumb' ] : false;
			$instance[ 'othumb' ]   = isset( $new_instance[ 'othumb' ] ) ? (bool) $new_instance[ 'othumb' ] : false;
			$instance[ 'ptitle' ]   = isset( $new_instance[ 'ptitle' ] ) ? (bool) $new_instance[ 'ptitle' ] : false;
			$instance[ 'excerpt' ]  = isset( $new_instance[ 'excerpt' ] ) ? (bool) $new_instance[ 'excerpt' ] : false;
			$instance[ 'meta' ]     = isset( $new_instance[ 'meta' ] ) ? (bool) $new_instance[ 'meta' ] : false;
			$instance[ 'com' ]      = isset( $new_instance[ 'com' ] ) ? (bool) $new_instance[ 'com' ] : false;
			$instance[ 'side' ]     = isset( $new_instance[ 'side' ] ) ? (bool) $new_instance[ 'side' ] : false;
			$instance[ 'share' ]    = isset( $new_instance[ 'share' ] ) ? (bool) $new_instance[ 'share' ] : false;
			$instance[ 'date' ]     = isset( $new_instance[ 'date' ] ) ? (bool) $new_instance[ 'date' ] : false;
			$instance[ 'sticky' ]   = isset( $new_instance[ 'sticky' ] ) ? (bool) $new_instance[ 'sticky' ] : false;
			$instance[ 'side_btn' ] = isset( $new_instance[ 'side_btn' ] ) ? (bool) $new_instance[ 'side_btn' ] : false;

			// Filter before we update
			$instance = apply_filters( 'neville___section_category_update', $instance, $new_instance );

			// Return updated instance
			return $instance;
		}

		/**
		 * Widget form
		 *
		 * @since  1.0.0.
		 * @access public
		 */
		public function form( $instance ) {
			// Parse $instance
			$instance_defaults = $this->defaults;
			$instance = wp_parse_args( $instance, $instance_defaults );
			extract( $instance, EXTR_SKIP );

			/**
			 * Form inputs
			 */

			$fields = [
				// Title - options
				'title_options' => [
					'type'       => 'title',
					'label'      => __( 'Options', 'neville' ),
					'instance'   => 'title_options',
				],

					// Select a category
					'category' => [
						'type'     => 'categories',
						'label'    => __( 'Select a category: ', 'neville' ),
						'instance' => $instance[ 'category' ],
					],

					// How many posts
					'qty'      => [
						'type'     => 'number',
		 				'label'    => __( 'How many posts? ', 'neville' ),
		 				'instance' => isset( $instance[ 'qty' ] ) ? $instance[ 'qty' ] : $instance_defaults[ 'qty' ],
						'options'  => [
							'min' => 1,
							'max' => 9
						]
					],

					// Exclude children
					'no_child' => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Exclude child categories', 'neville' ),
		 				'instance' => isset( $instance[ 'no_child' ] ) ? (bool) $instance[ 'no_child' ] : false,
					],

				// Title - header
				'title_header' => [
					'type'      => 'title',
					'label'     => __( 'Header area', 'neville' ),
					'instance'  => 'title_header',
				],

					// Show header
					'header'   => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Show section header', 'neville' ),
		 				'instance' => isset( $instance[ 'header' ] ) ? (bool) $instance[ 'header' ] : false,
					],

					// Link on category name
					'link'     => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Link on category name', 'neville' ),
		 				'instance' => isset( $instance[ 'link' ] ) ? (bool) $instance[ 'link' ] : false,
					],

					// Navigation
					'nav'      => [
						'type'     => 'navigation',
		 				'label'    => __( 'Menu on top right corner: ', 'neville' ),
		 				'instance' => isset( $instance[ 'nav' ] ) ? $instance[ 'nav' ] : '',
					],

				// Title - articles
				'title_articles' => [
					'type'        => 'title',
					'label'       => __( 'Articles options', 'neville' ),
					'instance'    => 'title_articles',
				],

					// Excerpt size
					'excpts'   => [
						'type'     => 'number',
		 				'label'    => __( 'Excerpt # words: ', 'neville' ),
		 				'instance' => isset( $instance[ 'excpts' ] ) ? $instance[ 'excpts' ] : $instance_defaults[ 'excpts' ],
						'options'  => [
							'min' => 5,
							'max' => 999
						]
					],

					// Show thumbnails
					'thumbs'   => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Show thumbnails', 'neville' ),
		 				'instance' => isset( $instance[ 'thumbs' ] ) ? (bool) $instance[ 'thumbs' ] : false,
					],

					// Exclude posts without thumbnails
					'nothumbs' => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Exclude posts without thumbnails', 'neville' ),
		 				'instance' => isset( $instance[ 'nothumbs' ] ) ? (bool) $instance[ 'nothumbs' ] : false,
					],

					// Thumb link
					'lthumb'   => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Link on thumbnail', 'neville' ),
		 				'instance' => isset( $instance[ 'lthumb' ] ) ? (bool) $instance[ 'lthumb' ] : false,
					],

					// Thumb overlay
					'othumb'   => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Show overlay on thumbnail', 'neville' ),
		 				'instance' => isset( $instance[ 'othumb' ] ) ? (bool) $instance[ 'othumb' ] : false,
					],

					// Show post title
					'ptitle'   => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Show post title', 'neville' ),
		 				'instance' => isset( $instance[ 'ptitle' ] ) ? (bool) $instance[ 'ptitle' ] : false,
					],

					// Show post excerpt
					'excerpt'  => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Show post excerpt', 'neville' ),
		 				'instance' => isset( $instance[ 'excerpt' ] ) ? (bool) $instance[ 'excerpt' ] : false,
					],

					// Show post meta
					'meta'     => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Show post meta', 'neville' ),
		 				'instance' => isset( $instance[ 'meta' ] ) ? (bool) $instance[ 'meta' ] : false,
					],

					// Show post comments #
					'com'      => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Show post comments #', 'neville' ),
		 				'instance' => isset( $instance[ 'com' ] ) ? (bool) $instance[ 'com' ] : false,
					],

					// Show post share
					'share'    => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Show post share', 'neville' ),
		 				'instance' => isset( $instance[ 'share' ] ) ? (bool) $instance[ 'share' ] : false,
					],

					// Show post date
					'date'     => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Show post date', 'neville' ),
		 				'instance' => isset( $instance[ 'date' ] ) ? (bool) $instance[ 'date' ] : false,
					],

				// Title - sidebar
				'title_sidebar' => [
					'type'        => 'title',
					'label'       => __( 'Section sidebar', 'neville' ),
					'instance'    => 'title_sidebar',
				],

					// Display on side
					'side_q'   => [
						'type'     => 'select',
						'label'    => __( 'Display on side', 'neville' ),
						'instance' => $instance[ 'side_q' ],
						'options'  => [
							[
								'value' 	=> 'featured',
								'title' 	=> esc_html_x( 'Featured posts', 'display on side', 'neville' ),
								'disabled'	=> false
							],
							[
								'value' 	=> 'popular',
								'title' 	=> esc_html_x( 'Popular posts', 'display on side', 'neville' ),
								'disabled'	=> false
							]
						]
					],

					// Sidebar
					'side'     => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Show side', 'neville' ),
		 				'instance' => isset( $instance[ 'side' ] ) ? (bool) $instance[ 'side' ] : false,
					],

					// Sitcky side
					'sticky'   => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Sticky side', 'neville' ),
		 				'instance' => isset( $instance[ 'sticky' ] ) ? (bool) $instance[ 'sticky' ] : false,
					],

					// Posts title
					'side_t'   => [
						'type'     => 'text_field',
		 				'label'    => __( 'Side posts title', 'neville' ),
		 				'instance' => empty( $instance['side_t'] ) ? $instance_defaults[ 'side_t' ] : $instance[ 'side_t' ],
					],

					// Sidebar buttons
					'side_btn'     => [
						'type'     => 'checkbox',
		 				'label'    => __( 'Show side buttons', 'neville' ),
		 				'instance' => isset( $instance[ 'side_btn' ] ) ? (bool) $instance[ 'side_btn' ] : false,
					],

			]; // $fields

			// Add a filter
			$fields = apply_filters( 'neville___section_category_fields', $fields, $instance, $instance_defaults );

			// Output fields
			parent::_fields( $fields );

		} // form()

	} /* Neville_Section_Category class END */

	/**
	 * Register the section
	 */
	register_widget( 'Neville_Section_Category' );

} /* Neville_Section_Category class_exists END */
