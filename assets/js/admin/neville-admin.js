/**
 * ------------------------
 * Neville Admin Scripts
 * ------------------------
 */
var $ = window.jQuery;

window.NevilleAdmin = {
	/**
	 * Initiazlie
	 *
	 * @since 1.0.0
	 * @return {Void}
	 */
	init : function() {
		var self = this;

		self.widgetsPage();
	},

	/**
	 * Widgets page modifications
	 * @return {Void}
	 */
	widgetsPage : function() {
		/* Hide sidebars on the right page */
		if( ! $( 'body' ).hasClass( 'widgets-php' ) ) return;

		/* Hide the section sidebars */
		$( 'div[id*=sections-].widgets-sortables' ).each( function( i, s ) {
			$( s ).parent( '.widgets-holder-wrap' ).hide();
		});

		/**
		 * Show the right sidebars to select from when a widget
		 * title is clicked
		 */
		$( '#available-widgets .widget .widget-top' ).on( 'click', function( e ) {
			var list = $( '.widgets-chooser > ul > li' ),
			    current = $( this ).parent( '.widget' ).find( list );

			current.each( function( i, element ) {
				var elm = $( element );
				if( elm.text().indexOf( 'Section' ) >= 0 ) { elm.remove(); }
			});

			var newlist = list;
			newlist.first().addClass( 'widgets-chooser-selected' );
		});

		/* Remove our section widgets from the available widgets list. */
		$( '#available-widgets .widget' ).each( function( i, w ) {
			var widget = $( w );
			    thisID = widget.attr( 'id' );

			if( thisID.indexOf( 'neville-section-' ) >= 0 ) widget.remove();
		});
	},
}

$( document ).ready( function ( $ ) {
	var nevilleadmin = window.NevilleAdmin;

	/**
	 * Initialise Neville Admin
	 */
	nevilleadmin.init();
});
