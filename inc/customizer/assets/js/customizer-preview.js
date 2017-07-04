/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	/**
	 * Colors
	 * -------------------------------
	 */

	// Background color
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'background-color', to );
		} );
	} );

	// Accent color
	wp.customize( 'accent_color', function( value ) {
		value.bind( function( to ) {
			$( '.rss-btn i, .sb-general i, .required, .sticky .sticky-tag, .header-btns .hbtn-count, .comments-area .comment-respond .comment-reply-title small a' ).css( 'color', to );
			$( '.category-link.sty1, .comment-reply-link.sty1, .widget-content .wid-posts-lists .wid-pl-item .entry-thumbnail .wid-pli-pos:before' ).css( 'background-color', to );
			$( 'abbr, abbr[title], acronym, .section-title.st2x:before, .category-link.sty2, .comment-reply-link.sty2, .comment-reply-link, .single .entry-content a:not([class]), .single .comment-content a:not([class]), .page-template-default .entry-content a:not([class]), .page-template-default .comment-content a:not([class]), .widget-title-wrap .widget-title span, .widget-content .textwidget a:not([class]), .wid-big-buttons .wid-big-button span:before' ).css( 'border-bottom-color', to );
		} );
	} );

	/**
	 * General settings
	 * -------------------------------
	 */

	// Boxed version
	wp.customize( 'boxed_version', function( value ) {
		value.bind( function( to ) {
			var body  = $( 'body' ),
			    boxed = neville_preview.bodyClasses.boxed;

			if( to ) {
				if( ! body.hasClass( boxed ) ) {
					body.addClass( boxed );
				}
			} else {
				body.removeClass( boxed )
			}
		} );
	} );

	/**
	 * Index settings
	 * -------------------------------
	 */

	// Home Page show header
	wp.customize( 'index_show_header', function( value ) {
		value.bind( function( to ) {
			var header = $( '.section-blog .section-header' );
			if( to ) {
				header.show();
			} else {
				header.hide();
			}
		} );
	} );

	// Home Page show subscribe
	wp.customize( 'index_show_subscr', function( value ) {
		value.bind( function( to ) {
			var header = $( '.section-blog .sb-subscr' );
			if( to ) {
				header.show();
			} else {
				header.hide();
			}
		} );
	} );

	// Blog section show nav
	wp.customize( 'more_articles_show', function( value ) {
		value.bind( function( to ) {
			var nav = $( '.sec-pagination' );
			if( to ) {
				nav.show();
			} else {
				nav.hide();
			}
		} );
	} );

	// Blog section button
	wp.customize( 'more_articles_button', function( value ) {
		value.bind( function( to ) {
			var button = $( '.sec-pagination .page-numbers' );

			button.html( to );
		} );
	} );

	// Blog section url
	wp.customize( 'more_articles_url', function( value ) {
		value.bind( function( to ) {
			var button = $( '.sec-pagination .page-numbers' );

			button.attr( 'href', to );
		} );
	} );

	/**
	 * Footer settings
	 * -------------------------------
	 */

	// Disable back to top button
	wp.customize( 'disable_bt_btn', function( value ) {
		value.bind( function( to ) {
			var button = $( '#btt-btn' );
			if( to ) {
				button.hide();
			} else {
				button.show();
			}
		} );
	} );

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );
} )( jQuery );
