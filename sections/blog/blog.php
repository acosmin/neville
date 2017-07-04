<?php
if( ! class_exists( 'Neville_Section_Blog' ) ) {
	/**
	 * Blog section
	 *
	 * Will display your blog
	 *
	 * @since 1.0.0
	 */
	class Neville_Section_Blog extends Neville_Widgets_Base {

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
			$this->widget_title = __( 'Blog' , 'neville' );
			$this->widget_id    = 'blog';

			// Settings
			$widget_ops = [
				'classname'   => 'section-blog',
				'description' => esc_html__( 'Adds a Blog section', 'neville' ),
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
			$this->defaults = apply_filters( 'neville___section_blog_defaults', [], $this );
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
			];

			// Filter before we add them
			$widget_options = apply_filters( 'neville___section_blog_options', $widget_options, $this, $instance, $instance_defaults );

			// Add some CSS classes
			$before = apply_filters( 'neville___section_blog_before', [
				'bw'   => $args[ 'before_widget' ],
				'type' => 'blog',
				'css'  => [ 'wrap', ]
			], $instance, $args );

			$before = neville_widget_css_classes( $before );

			// Use default if `$before` returns false.
			$args[ 'before_widget' ] = $before !== false ? $before : $args[ 'before_widget' ];

			// Do nothing if the widget isn't used on the right page
			if( ! is_page_template( 'template-frontpage.php' ) ) return;

			// Widget template output
			echo $args[ 'before_widget' ];

				/**
				 * Hooked:
				 * neville__sec_tmpl_blog_start  - 10
				 * neville__content_area_init    - 20
				 * neville__sec_tmpl_blog_end    - 999
				 *
				 * @see ../sections/blog/blog-tmpl.php
				 */
				do_action( 'neville__section_blog', $widget_options );

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

			// Filter before we update
			$instance = apply_filters( 'neville___section_blog_update', $instance, $new_instance );

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

			$fields = []; // $fields

			// Add a filter
			$fields = apply_filters( 'neville___section_blog_fields', $fields, $instance, $instance_defaults );

			// A simple message
			if( empty( $fields ) ) {
				printf( '<p>%s</p>', esc_html__( 'This section is meant to be used only on the front page. Also, the `Front Page` page template must be active. To change the View More Articles button, go to Theme Settings > Index > Blog Section', 'neville' ) );
			}

			// Output fields
			parent::_fields( $fields );

		} // form()

	} /* Neville_Section_Blog class END */

	/**
	 * Register the section
	 */
	register_widget( 'Neville_Section_Blog' );

} /* Neville_Section_Blog class_exists END */
