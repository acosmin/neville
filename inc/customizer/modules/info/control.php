<?php

if( ! class_exists( 'Neville_Customizer_Control_Info' ) ) {
	/**
	 * Information Customize Control
	 *
	 * All section widgets can extend this class
	 *
	 * @since 1.0.0
	 */
	class Neville_Customizer_Control_Info extends WP_Customize_Control {

		/**
		 * Control type
		 *
		 * @access public
		 */
		public $type = 'info-control';

		/**
		 * Other needed vars
		 *
		 * @access public
		 */
		public $info_type, $css_class, $html;

		/**
		 * Render the control.
		 *
		 * @return string HTML code
		 * @access public
		 */
		public function render_content() {
			// Validate
			$icon   = isset( $this->info_type ) ? sprintf( '<span class="dashicons dashicons-%s"></span>', esc_attr( $this->info_type ) ) : '';
			$bottom = isset( $this->html ) ? sprintf( '<div class="neville-control-info-bottom">%s</div>', $this->html ) : '';

			// Begin the output. ?>
			<div class="neville-control-info <?php echo esc_attr( $this->css_class ); ?>">
				<?php
				// Output label
				if ( isset( $this->label ) && '' !== $this->label ) {
					printf(
						'<span class="customize-control-title neville-control-info-label">%1$s%2$s</span>',
						sanitize_text_field( $this->label ),
						$icon
					);
				}

				// Output description
				if ( isset( $this->description ) && '' !== $this->description ) {
					printf(
						'<div class="description customize-control-description neville-control-info-description">%s</div>',
						wp_kses_post( $this->description )
					);
				}

				// Echo bottom HTML
				echo wp_kses_post( $bottom );
				?>
			</div>
			<?php
		}
	}
}
