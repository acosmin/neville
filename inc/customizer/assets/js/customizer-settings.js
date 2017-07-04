/* Customizer Settings Manager */
( function( $, api ) {

	var api = wp.customize;

	$( document ).ready( function( $ ) {
		var section       = api.section( 'sidebar-widgets-sections-front-page' )
		    searchWidgets = 'neville-c-search';
		    panelWidgets  = 'neville-c-display-widgets',
		    displayWidget = 'neville-c-display-block',
		    addWidget     = $( '.add-new-widget' ),
		    bkAddWidget   = addWidget.html();

		/**
		 * Change some html/settings when the Sections
		 * sidebar is expanded or collapsed
		 *
		 * @since  1.0.0
		 * @param  {Event} e Expanded sidebar
		 * @param  {Event} c Collapsed sidebar
		 * @return {Void}
		 */
		section.expanded.bind( 'nevilleSectionsExpanded', function( e, c ) {
			var widgetsFilter  = $( '#available-widgets-filter' ),
			    sectionWidgets = $( '#available-widgets-list' ),
			    sections       = neville_customizer_js_settings.sections,
			    addSection     = neville_customizer_js_settings.addsection,
			    widgetTmpl     = function( sectionID ) { return $( 'div[id*=widget-tpl-neville-section-' + sectionID +'-]' ) };

			// Epanded
			if( e ) {
				widgetsFilter.addClass( searchWidgets ).find( 'input' ).attr( 'disabled', true );
				sectionWidgets.addClass( panelWidgets );
				_.each( sections, function( sectionID ) {
					widgetTmpl( sectionID ).show().addClass( displayWidget );
				});
				addWidget.html( addSection );
			}

			// Collapsed
			if( c ) {
				widgetsFilter.removeClass( searchWidgets ).find( 'input' ).attr( 'disabled', false );
				sectionWidgets.removeClass( panelWidgets );
				_.each( sections, function( sectionID ) {
					widgetTmpl( sectionID ).hide().removeClass( displayWidget );
				});
				addWidget.html( bkAddWidget );
			}
		});
	});

	// Businessx Extensions installer
	api.sectionConstructor[ 'neville-installer' ] = api.Section.extend( {
		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

	// Pro section
	api.sectionConstructor[ 'neville-pro-section' ] = api.Section.extend( {
		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

})( jQuery, wp.customize );
