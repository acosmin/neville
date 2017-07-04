<?php
if( ! class_exists( 'Neville_Widget_Posts' ) ) {
	/**
	 * Posts widget
	 *
	 * Will display your featured/popular posts.
	 *
	 * @since 1.0.0
	 */
	class Neville_Widget_Posts extends Neville_Widgets_Base {

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
			$this->widget_title = __( 'NEVILLE Posts' , 'neville' );
			$this->widget_id    = 'posts';

			// Settings
			$widget_ops = [
				'classname'   => 'wid-posts',
				'description' => esc_html__( 'Will display your featured/popular posts.', 'neville' ),
				'customize_selective_refresh' => true
			];

			// Control settings
			$idBase = 'neville-wid-' . $this->widget_id;

			$control_ops = [
				'width'   => NULL,
				'height'  => NULL,
				'id_base' => $idBase
			];

			// Create the widget
			parent::__construct( $idBase, $this->widget_title, $widget_ops, $control_ops );

			// Set some widget defaults
			$this->defaults = apply_filters( 'neville_wid_posts___defaults', [
				'title'  => esc_html__( 'Featured', 'neville' ),
				'side_q' => 'featured',
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
				// Options
				'title'    => empty( $instance[ 'title' ] ) ? $instance_defaults[ 'title' ] : $instance[ 'title' ],
				'side_q'   => isset( $instance[ 'side_q' ] ) ? $instance[ 'side_q' ] : $instance_defaults[ 'side_q' ],
				'btitle'   => $args[ 'before_title' ],
				'atitle'   => $args[ 'after_title' ],
			];

			// Filter before we add them
			$widget_options = apply_filters( 'neville_wid_posts___options', $widget_options, $this, $instance, $instance_defaults );

			// Widget template output
			echo $args[ 'before_widget' ];

				/**
				 * Hooked:
				 * neville__widget_posts_title - 10
				 * neville__widget_posts_query - 20
				 *
				 * @see ../widgets/posts/posts-tmpl.php
				 */
				do_action( 'neville__widget_posts', $widget_options );

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
			$instance[ 'title' ]    = sanitize_text_field( $new_instance[ 'title' ] );

			// Select
			$instance[ 'side_q' ]  = (string) neville_sanitize_select(
				$new_instance[ 'side_q' ],
				[ 'featured', 'popular' ],
				$this->defaults[ 'side_q' ],
				false
			);

			// Filter before we update
			$instance = apply_filters( 'neville_wid_posts___update', $instance, $new_instance );

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

				// Title
				'title'   => [
					'type'     => 'text_field',
					'label'    => __( 'Title:', 'neville' ),
					'instance' => empty( $instance['title'] ) ? $instance_defaults[ 'title' ] : $instance[ 'title' ],
				],

				// Display on side
				'side_q'   => [
					'type'     => 'select',
					'label'    => __( 'Display:', 'neville' ),
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

			]; // $fields

			// Add a filter
			$fields = apply_filters( 'neville_wid_posts___fields', $fields, $instance, $instance_defaults );

			// Output fields
			parent::_fields( $fields );

		} // form()

	} /* Neville_Widget_Posts class END */

	/**
	 * Register the section
	 */
	register_widget( 'Neville_Widget_Posts' );

} /* Neville_Widget_Posts class_exists END */
