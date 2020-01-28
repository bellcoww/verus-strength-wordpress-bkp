(function( $ ){
	'use strict';

	var jetMenu = {

		init: function() {
			var rollUp                   = false,
				jetMenuMouseleaveDelay   = 500,
				jetMenuMegaWidthType     = 'container',
				jetMenuMegaWidthSelector = '',
				jetMenuMegaOpenSubType   = 'hover';

			if ( window.jetMenuPublicSettings && window.jetMenuPublicSettings.menuSettings ) {
				rollUp                   = ( 'true' === jetMenuPublicSettings.menuSettings.jetMenuRollUp ) ? true : false;
				jetMenuMouseleaveDelay   = jetMenuPublicSettings.menuSettings.jetMenuMouseleaveDelay || 500;
				jetMenuMegaWidthType     = jetMenuPublicSettings.menuSettings.jetMenuMegaWidthType || 'container';
				jetMenuMegaWidthSelector = jetMenuPublicSettings.menuSettings.jetMenuMegaWidthSelector || '';
				jetMenuMegaOpenSubType   = jetMenuPublicSettings.menuSettings.jetMenuMegaOpenSubType || 'hover';
			}

			$( '.jet-menu-container' ).JetMenu( {
				enabled: rollUp,
				mouseLeaveDelay: +jetMenuMouseleaveDelay,
				megaWidthType: jetMenuMegaWidthType,
				megaWidthSelector: jetMenuMegaWidthSelector,
				openSubType: jetMenuMegaOpenSubType
			} );

		},

	};

	jetMenu.init();

}( jQuery ));
