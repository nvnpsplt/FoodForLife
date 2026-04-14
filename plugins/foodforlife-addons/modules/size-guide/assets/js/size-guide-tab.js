jQuery( document ).ready( function( $ ) {
	$( '.foodforlife-size-guide-tabs' ).on( 'click', '.foodforlife-size-guide-tabs__nav li', function() {
        var $tab = $( this ),
            index = $tab.data( 'target' ),
            $panels = $tab.closest( '.foodforlife-size-guide-tabs' ).find( '.foodforlife-size-guide-tabs__panels' ),
            $panel = $panels.find( '.foodforlife-size-guide-tabs__panel[data-panel="' + index + '"]' );

        if ( $tab.hasClass( 'active' ) ) {
            return;
        }

        $tab.addClass( 'active' ).siblings( 'li.active' ).removeClass( 'active' );

        if ( $panel.length ) {
            $panel.addClass( 'active' ).siblings( '.foodforlife-size-guide-tabs__panel.active' ).removeClass( 'active' );
        }
    } );
} );