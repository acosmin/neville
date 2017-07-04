var $ = window.jQuery;

window.NevilleFront = {
	/**
	 * Initiazlie
	 *
	 * @since  1.0.0
	 * @return {Void}
	 */
	init : function() {
		var self = this;

		self.mobileMenu();
		self.subMenu();
		self.backToTop();
		self.dropCap();
		self.searchButton();
		self.socialFront();
	},

	/**
	 * Mobile menu actions
	 *
	 * @since  1.0.0
	 * @return {Void}
	 */
	mobileMenu : function() {
		var _doc   = $( document ),
		    _body  = $( 'body' ),
		    mobile = 'overlay-opened';

		_doc.on( 'click keydown touchend', '#mobile-button', function( e ) {
			e.preventDefault();

			_body.addClass( mobile );
			_body.trigger( 'neville-mobile-open' );
		});

		_doc.on( 'click keydown touchend', '#offset-close-sidebar, .os-empty', function( e ) {
			e.preventDefault();

			_body.removeClass( mobile );
			_body.trigger( 'neville-mobile-close' );
		});
	},

	/**
	 * Sub-menu feature, adds a dark background overlay
	 * for a nice effect.
	 *
	 * @since  1.0.0
	 * @return {Void}
	 */
	subMenu : function() {
		var target    = $( '.primary-nav .menu-item-has-children' ),
		    overlay   = $( '.menu-overlay' ),
		    activated = 'activated';

		target.on( 'mouseover', function( e ) {
			overlay.addClass( activated );
		});
		target.on( 'mouseout', function( e ) {
			overlay.removeClass( activated );
		});
	},

	/**
	 * Returns back to top, animated, if button is clicked.
	 *
	 * @since  1.0.0
	 * @return {Void}
	 */
	backToTop : function() {
		$( '#btt-btn' ).on( 'click', function( e ) {
			e.preventDefault();
			$( 'html, body' ).animate( { scrollTop: 0 }, 50 );
		});
	},

	/**
	 * Adds a drop cap to the first paragraph.
	 *
	 * @since  1.0.0
	 * @return {String|Void}
	 */
	dropCap : function() {
		if( $( 'body' ).is( '.single.has-dropcap' ) ) {
			var firstP     = $( '.entry-content > p' ).get( 0 ),
			    firstPsel  = $( firstP ),
			    checkFirst = function( str ) { return str.length === 1 && str.match(/[a-z]/i); };

			if( typeof firstP !== undefined ) {
				var firstLetter      = firstPsel.html().charAt( 0 ),
				    firstLetterCheck = checkFirst( firstLetter );

				if( firstLetterCheck != null && firstLetterCheck.constructor === Array ) {
					firstPsel.prepend( '<span class="drop-cap">' + firstLetter + '</span>' );
				}
			}
		}
	},

	/**
	 * Search functionality
	 *
	 * @since  1.0.0
	 * @return {Void}
	 */
	searchButton : function() {
		var self   = this,
		    _doc   = $( document ),
		    _body  = $( 'body' ),
		    opened = 'search-opened',
		    sform  = $( '#search-overlay .search-form' ),
		    sfield = sform.find( '.search-field' ),
		    vars   = { body: _body, opened: opened, field: sfield };

		sform.append( '<button id="search-close" class="search-close">' + neville_front_vars.searchx + '</button>' );
		sfield.attr( 'placeholder', neville_front_vars.search );

		_doc.on( 'click keydown touchend', '.hbtn-search', function( e ) {
			e.preventDefault();
			self.openCloseSearch( 'open', vars );
		});

		_doc.on( 'click keydown touchend', '#search-close', function( e ) {
			e.preventDefault();
			self.openCloseSearch( 'close', vars );
		});
	},

	/**
	 * Open/close search overlay
	 *
	 * @since  1.0.0
	 * @param  {String} type Opened or closed search overlay
	 * @param  {Object} vars A few variables need to initialize
	 * @return {Void}
	 */
	openCloseSearch : function( type, vars ) {
 		if( type === 'open' ) {
 			vars.body.addClass( vars.opened );
 			vars.field.focus();
			vars.body.trigger( 'neville-search-open' );
 		} else {
 			vars.body.removeClass( vars.opened );
 			vars.field.blur();
 			vars.field.val( '' );
			vars.body.trigger( 'neville-search-close' );
 		}
 	},

	/**
	 * Display social sharing buttons in index view
	 *
	 * @since  1.0.0
	 * @return {Void}
	 */
	socialFront : function() {
		var _doc      = $( document ),
		    display   = '.jp-share-display',
		    classes   = '.post, .page, .masonry-item',
		    openClass = 'open',
		    getElem   = function( parent ) { return $( parent ).closest( classes ).find( display ); };

		_doc.on( 'touchend click', '.jp-share-init', function( e ) {
			$( 'body' ).find( display ).removeClass( openClass );
			getElem( this ).addClass( openClass );
			e.preventDefault();
		});

		_doc.on( 'touchend click', '.jp-share-close', function( e ) {
			getElem( this ).removeClass( openClass );
			e.preventDefault();
		});
	},

}

$( document ).ready( function ( $ ) {
	var nevillefront = window.NevilleFront;

	/**
	 * Initialise Neville Front
	 */
	nevillefront.init();
});
