/**
 * Customizer JS
 */

jQuery( document ).ready( function( $ ) {

	/**
	 * Controls
	 */
	wp.customize.control( 'custom_logo' ).priority( 1 );
	wp.customize.control( 'light_logo' ).priority( 2 );

	/**
	 * Dismiss the Installer notice
	 */
	$(document).on( 'click', '#neville-dismiss-rec-plugin', function(event) {
		event.preventDefault();
		$.ajax({
			url      : ajaxurl,
			type     : 'post',
			dataType : 'json',
			data     : {
				action : 'neville_dismiss_ext',
				neville_dismiss_ext_nonce : neville_customizer_js_scripts.dismiss_ext_nonce,
			}
		}).done( function( data ) {
			wp.customize.section( 'neville-installer' ).deactivate();
		});
	});

	/**
	 * Sortable Options
	 */

	// Make our list sortable
	$( 'ul.neville-sortable-options-list' ).sortable({
		handle: '.neville-sortable-options-handle',
		axis: 'y',
		update: function( e, ui ){
			$( 'input.neville-sortable-options-item' ).trigger( 'change' );
		}
	});

	// On change
	$( 'input.neville-sortable-options-item' ).on( 'change', function() {
		// Get the value, and convert to string.
		this_checkboxes_values = $( this ).parents( 'ul.neville-sortable-options-list' ).find( 'input.neville-sortable-options-item' ).map( function() {
			var active = '0';
			if( $( this ).prop("checked") ){
				var active = '1';
			}
			return this.name + ':' + active;
		}).get().join( ',' );

		// Add the value to hidden input.
		$( this ).parents( 'ul.neville-sortable-options-list' ).find( 'input.neville-sortable-options' ).val( this_checkboxes_values ).trigger( 'change' );
	});

});
