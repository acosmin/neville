<?php
if( ! class_exists( 'Neville_Section_Line' ) ) {
	/**
	 * Line section
	 *
	 * Will display a break line
	 *
	 * @since 1.0.0
	 */
	class Neville_Section_Line extends Neville_Widgets_Base {

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
			$this->widget_title = __( 'Line' , 'neville' );
			$this->widget_id    = 'line';

			// Settings
			$widget_ops = [
				'classname'   => 'section-breakline',
				'description' => esc_html__( 'Adds a break line, useful between sections', 'neville' ),
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
			$this->defaults = apply_filters( 'neville___section_line_defaults', [
				'margin' => false,
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
				// Line options
				'margin'   => isset( $instance[ 'margin' ] ) ? $instance[ 'margin' ] : false,
			];

			// Filter before we add them
			$widget_options = apply_filters( 'neville___section_line_options', $widget_options, $this, $instance, $instance_defaults );

			// Add some CSS classes
			$margin = $widget_options[ 'margin' ] ? 'small' : 'not-small';
			$before = apply_filters( 'neville___section_line_before', [
				'bw'   => $args[ 'before_widget' ],
				'type' => 'line',
				'css'  => [
					'wrap',
					$margin
				]
			], $instance, $args, $widget_options );

			$before = neville_widget_css_classes( $before );

			// Use default if `$before` returns false.
			$args[ 'before_widget' ] = $before !== false ? $before : $args[ 'before_widget' ];

			// Show only where it's allowed
			$not_allowed = apply_filters( 'neville___section_line_conditions', [
				'funcs' => [
					'is_paged' => null
				]
			] );

			if( parent::_conditioned( $not_allowed ) ) return;

			// Widget template output
			echo $args[ 'before_widget' ];

				/**
				 * Hooked:
				 * neville__sec_tmpl_line  - 10
				 *
				 * @see ../sections/line/line-tmpl.php
				 */
				do_action( 'neville__section_line', $widget_options );

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

			// Checkboxes
			$instance[ 'margin' ] = isset( $new_instance[ 'margin' ] ) ? (bool) $new_instance[ 'margin' ] : false;

			// Filter before we update
			$instance = apply_filters( 'neville___section_line_update', $instance, $new_instance );

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
				// Exclude children
				'margin' => [
					'type'     => 'checkbox',
	 				'label'    => __( 'Make margin bottom smaller', 'neville' ),
	 				'instance' => isset( $instance[ 'margin' ] ) ? (bool) $instance[ 'margin' ] : false,
				],
			]; // $fields

			// Add a filter
			$fields = apply_filters( 'neville___section_line_fields', $fields, $instance, $instance_defaults );

			// Output fields
			parent::_fields( $fields );

		} // form()

	} /* Neville_Section_Line class END */

	/**
	 * Register the section
	 */
	register_widget( 'Neville_Section_Line' );

} /* Neville_Section_Line class_exists END */
