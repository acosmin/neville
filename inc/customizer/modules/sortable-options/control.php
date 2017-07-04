<?php
/**
 * Sortable items with a checkbox control
 */
if( ! class_exists( 'Neville_Control_Sortable_Options' ) ) {
	class Neville_Control_Sortable_Options extends WP_Customize_Control {

		// Control type
		public $type = 'neville-sortable-options';

		// Render settings
		public function render_content() {

			// Do nothing if we don't have choices
			if ( empty( $this->choices ) ) return;

			// Display label
			if ( ! empty( $this->label ) ) {
				printf( '<span class="customize-control-title">%s</span>', esc_html( $this->label ) );
			}

			// Display description
			if ( ! empty( $this->description ) ) {
				printf( '<span class="description customize-control-description">%s</span>', wp_kses_post( $this->description ) );
			}

			// Choices
			$values = explode( ',', $this->value() );
			$choices = $this->choices;

			// Add options
			$options = array();
			if( $values ){

				// Get individual item
				foreach( $values as $value ){

					// Separate item with option
					$value = explode( ':', $value );

					// Build the array and remove options not listed on choices
					if ( array_key_exists( $value[ 0 ], $choices ) ){
						$options[ $value[ 0 ] ] = $value[ 1 ] ? '1' : '0';
					}
				}
			}
			// If there are new options, add it at the end.
			foreach( $choices as $key => $val ){
				if ( ! array_key_exists( $key, $options ) ){
					$options[ $key ] = '0';
				}
			}
			?>

			<ul class="neville-sortable-options-list"><!--neville-multicheck-sortable-list-->

				<?php foreach ( $options as $key => $value ){ ?>

					<li>
						<label><!--neville-multicheck-sortable-item-->
							<input name="<?php echo esc_attr( $key ); ?>" class="neville-sortable-options-item" type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( $value ); ?> />
							<?php echo esc_html( $choices[$key] ); ?>
						</label>
						<i class="dashicons dashicons-menu neville-sortable-options-handle"></i><!-- neville-multicheck-sortable-handle -->
					</li>

				<?php } // end choices. ?>

					<li class="neville-sortable-options-hideme">
						<input type="hidden" class="neville-sortable-options" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
					</li>

			</ul><!-- .neville-sortable-options-list -->

		<?php
		}
	}
}
