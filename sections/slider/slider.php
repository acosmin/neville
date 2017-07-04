<?php
if( ! class_exists( 'Neville_Section_Slider' ) ) {
	/**
	 * Slider section
	 *
	 * Will display a slider
	 *
	 * @since 1.0.0
	 */
	class Neville_Section_Slider extends Neville_Widgets_Base {

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
			$this->widget_title = __( 'Slider' , 'neville' );
			$this->widget_id    = 'slider';

			// Settings
			$widget_ops = [
				'classname'   => 'section-slider',
				'description' => esc_html__( 'Adds a Slider section', 'neville' ),
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
			$this->defaults = apply_filters( 'neville___section_slider_defaults', [
				// Slider
				'slides'        => '2',
				'autoplay'      => false,
				'timeout'       => '3',
				'rewind'        => false,
				'show_slider'   => true,
				'show_dots'     => true,
				'show_arrows'   => true,
				'show_title'    => true,
				'show_category' => true,
				'show_comments' => true,
				// Statics
				'statics'       => '3',
				'show_statics'  => false,
				'offset_more'   => false
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
				'widget'        => $this,
				// Slider options
				'slides'        => isset( $instance[ 'slides' ] ) ? $instance[ 'slides' ] : $instance_defaults[ 'slides' ],
				'show_slider'   => isset( $instance[ 'show_slider' ] ) ? $instance[ 'show_slider' ] : false,
				'autoplay'      => isset( $instance[ 'autoplay' ] ) ? $instance[ 'autoplay' ] : false,
				'timeout'       => isset( $instance[ 'timeout' ] ) ? $instance[ 'timeout' ] : $instance_defaults[ 'timeout' ],
				'rewind'        => isset( $instance[ 'rewind' ] ) ? $instance[ 'rewind' ] : false,
				'show_dots'     => isset( $instance[ 'show_dots' ] ) ? $instance[ 'show_dots' ] : false,
				'show_arrows'   => isset( $instance[ 'show_arrows' ] ) ? $instance[ 'show_arrows' ] : false,
				'show_title'    => isset( $instance[ 'show_title' ] ) ? $instance[ 'show_title' ] : false,
				'show_category' => isset( $instance[ 'show_category' ] ) ? $instance[ 'show_category' ] : false,
				'show_comments' => isset( $instance[ 'show_comments' ] ) ? $instance[ 'show_comments' ] : false,
				// Statics options
				'statics'       => isset( $instance[ 'statics' ] ) ? $instance[ 'statics' ] : $instance_defaults[ 'statics' ],
				'show_statics'  => isset( $instance[ 'show_statics' ] ) ? $instance[ 'show_statics' ] : false,
				'offset_more'   => isset( $instance[ 'offset_more' ] ) ? $instance[ 'offset_more' ] : false,
			];

			// Filter before we add them
			$widget_options = apply_filters( 'neville___section_slider_options', $widget_options, $this, $instance, $instance_defaults );

			// Add some CSS classes
			$before = apply_filters( 'neville___section_slider_before', [
				'bw'   => $args[ 'before_widget' ],
				'type' => 'slider',
				'css'  => [ 'wrap' ]
			], $instance, $args );

			$before = neville_widget_css_classes( $before );

			// Use default if `$before` returns false.
			$args[ 'before_widget' ] = $before !== false ? $before : $args[ 'before_widget' ];

			// Show only where it's allowed
			$not_allowed = apply_filters( 'neville___section_slider_conditions', [
				'funcs' => [
					'is_paged' => null
				]
			] );

			if( parent::_conditioned( $not_allowed ) ) return;

			// Widget template output
			echo $args['before_widget'];

				/**
				 * Hooked:
				 * neville__sec_tmpl_slider  - 10
				 * neville__sec_tmpl_statics - 20
				 *
				 * @see ../sections/slider/slider-tmpl.php
				 */
				do_action( 'neville__section_slider', $widget_options );

			echo $args['after_widget'];
		}

		/**
		 * Widget update instance
		 *
		 * @since  1.0.0
		 * @access public
		 */
		public function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			// Select
			$instance[ 'slides' ]  = (string) neville_sanitize_select(
				$new_instance[ 'slides' ],
				[ '2', '3', '4' ],
				$this->defaults[ 'slides' ],
				false
			);
			$instance[ 'statics' ] = (string) neville_sanitize_select(
				$new_instance[ 'statics' ],
				[ '3', '6' ],
				$this->defaults[ 'statics' ],
				false
			);
			$instance[ 'timeout' ]  = (string) neville_sanitize_select(
				$new_instance[ 'timeout' ],
				[ '2', '3', '4' ],
				$this->defaults[ 'timeout' ],
				false
			);

			// Checkboxes
			$instance[ 'show_slider' ]   = isset( $new_instance[ 'show_slider' ] ) ? (bool) $new_instance[ 'show_slider' ] : false;
			$instance[ 'autoplay' ]      = isset( $new_instance[ 'autoplay' ] ) ? (bool) $new_instance[ 'autoplay' ] : false;
			$instance[ 'rewind' ]        = isset( $new_instance[ 'rewind' ] ) ? (bool) $new_instance[ 'rewind' ] : false;
			$instance[ 'show_dots' ]     = isset( $new_instance[ 'show_dots' ] ) ? (bool) $new_instance[ 'show_dots' ] : false;
			$instance[ 'show_arrows' ]   = isset( $new_instance[ 'show_arrows' ] ) ? (bool) $new_instance[ 'show_arrows' ] : false;
			$instance[ 'show_category' ] = isset( $new_instance[ 'show_category' ] ) ? (bool) $new_instance[ 'show_category' ] : false;
			$instance[ 'show_title' ]    = isset( $new_instance[ 'show_title' ] ) ? (bool) $new_instance[ 'show_title' ] : false;
			$instance[ 'show_comments' ] = isset( $new_instance[ 'show_comments' ] ) ? (bool) $new_instance[ 'show_comments' ] : false;
			$instance[ 'show_statics' ]  = isset( $new_instance[ 'show_statics' ] ) ? (bool) $new_instance[ 'show_statics' ] : false;
			$instance[ 'offset_more' ]   = isset( $new_instance[ 'offset_more' ] ) ? (bool) $new_instance[ 'offset_more' ] : false;

			// Filter before we update
			$instance = apply_filters( 'neville___section_slider_update', $instance, $new_instance );

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
				// Title - show or hide
				'title_hide'   => [
					'type'      => 'title',
					'label'     => __( 'Show or hide parts', 'neville' ),
					'instance'  => 'title_show_hide',
				],

				// Show slider
				'show_slider'  => [
					'type'      => 'checkbox',
					'label'     => __( 'Show slider', 'neville' ),
					'instance'  => isset( $instance[ 'show_slider' ] ) ? (bool) $instance[ 'show_slider' ] : false,
				],

				// Show statics
				'show_statics' => [
					'type'      => 'checkbox',
					'label'     => __( 'Show statics', 'neville' ),
					'instance'  => isset( $instance[ 'show_statics' ] ) ? (bool) $instance[ 'show_statics' ] : false,
				],

				// Title - slider options
				'title_option' => [
					'type'      => 'title',
					'label'     => __( 'Slider options', 'neville' ),
					'instance'  => 'title_slider_options',
				],

				// How many slides
				'slides'       => [
					'type'      => 'select',
					'label'     => __( 'How many slides?', 'neville' ),
					'instance'  => $instance[ 'slides' ],
					'options'   => [
						[
							'value' 	=> '2',
							'title' 	=> esc_html_x( '2 slides', 'slides - how many', 'neville' ),
							'disabled'	=> false
						],
						[
							'value' 	=> '3',
							'title' 	=> esc_html_x( '3 slides', 'slides - how many', 'neville' ),
							'disabled'	=> false
						],
						[
							'value' 	=> '4',
							'title' 	=> esc_html_x( '4 slides', 'slides - how many', 'neville' ),
							'disabled'	=> false
						],
					]
				],

				// Autoplay slider
				'autoplay'    => [
					'type'     => 'checkbox',
					'label'    => __( 'Autoplay slides', 'neville' ),
					'instance' => isset( $instance[ 'autoplay' ] ) ? (bool) $instance[ 'autoplay' ] : false,
				],

				// Autoplay timeout
				'timeout'     => [
					'type'     => 'select',
					'label'    => __( 'Autoplay - delay between slides', 'neville' ),
					'instance' => $instance[ 'timeout' ],
					'options'  => [
						[
							'value' 	=> '2',
							'title' 	=> esc_html_x( '2 seconds', 'slides timeout - how many', 'neville' ),
							'disabled'	=> false
						],
						[
							'value' 	=> '3',
							'title' 	=> esc_html_x( '3 seconds', 'slides timeout - how many', 'neville' ),
							'disabled'	=> false
						],
						[
							'value' 	=> '4',
							'title' 	=> esc_html_x( '4 seconds', 'slides timeout - how many', 'neville' ),
							'disabled'	=> false
						],
					]
				],

				// Rewind
				'rewind'      => [
					'type'     => 'checkbox',
					'label'    => __( 'Rewind slides', 'neville' ),
					'instance' => isset( $instance[ 'rewind' ] ) ? (bool) $instance[ 'rewind'] : false,
				],

				// Show arrows
				'show_arrows' => [
					'type'     => 'checkbox',
					'label'    => __( 'Show navigation arrows', 'neville' ),
					'instance' => isset( $instance[ 'show_arrows' ] ) ? (bool) $instance[ 'show_arrows' ] : false,
				],

				// Show dots
				'show_dots'   => [
					'type'     => 'checkbox',
					'label'    => __( 'Show navigation dots', 'neville' ),
					'instance' => isset( $instance[ 'show_dots' ] ) ? (bool) $instance[ 'show_dots' ] : false,
				],

				// Title - statics
				'title_stats' => [
					'type'     => 'title',
					'label'    => __( 'Statics options', 'neville' ),
					'instance' => 'title_statics',
				],

				// How many statics
				'statics'     => [
					'type'     => 'select',
					'label'    => __( 'How many statics?', 'neville' ),
					'instance' => $instance[ 'statics' ],
					'options'  => [
						[
							'value' 	=> '3',
							'title' 	=> esc_html_x( '3 posts', 'statics - how many', 'neville' ),
							'disabled'	=> false
						],
						[
							'value' 	=> '6',
							'title' 	=> esc_html_x( '6 posts', 'statics - how many', 'neville' ),
							'disabled'	=> false
						],
					]
				],

				// Offset more
				'offset_more' => [
					'type'     => 'checkbox',
					'label'    => __( 'Add 3 more to offset', 'neville' ),
					'instance' => isset( $instance[ 'offset_more' ] ) ? (bool) $instance[ 'offset_more' ] : false,
				],

				// Title - general
				'title_gen'   => [
					'type'     => 'title',
					'label'    => __( 'Works for both slides and statics', 'neville' ),
					'instance' => 'title_general',
				],

				// Show title
				'show_title'  => [
					'type'     => 'checkbox',
					'label'    => __( 'Show post title', 'neville' ),
					'instance' => isset( $instance[ 'show_title' ] ) ? (bool) $instance[ 'show_title' ] : false,
				],

				// Show category
				'show_category' => [
					'type'       => 'checkbox',
					'label'      => __( 'Show category', 'neville' ),
					'instance'   => isset( $instance[ 'show_category' ] ) ? (bool) $instance[ 'show_category' ] : false,
				],

				// Show comments
				'show_comments' => [
					'type'       => 'checkbox',
					'label'      => __( 'Show comments number', 'neville' ),
					'instance'   => isset( $instance[ 'show_comments' ] ) ? (bool) $instance[ 'show_comments' ] : false,
				],

			]; // $fields

			// Add a filter
			$fields = apply_filters( 'neville___section_slider_fields', $fields, $instance, $instance_defaults );

			// Output fields
			parent::_fields( $fields );

		} // form()

	} /* Neville_Section_Slider class END */

	/**
	 * Register the section
	 */
	register_widget( 'Neville_Section_Slider' );

} /* Neville_Section_Slider class_exists END */
