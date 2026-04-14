class FoodForLifeBannerProductsWidgetHandler extends elementorModules.frontend.handlers.Base {
	bindEvents() {
		var $button = this.$element.find( '.foodforlife-banner__button' ),
			$buttonClose = this.$element.find( '.foodforlife-banner__products-close' );

		jQuery( $button ).on( 'click', function ( e ) {
			e.preventDefault();
			
			if( jQuery( this ).closest( '.foodforlife-banner' ).find( '.foodforlife-banner__products' ).hasClass( 'opened' ) ) {
				jQuery( this ).closest( '.foodforlife-banner' ).find( '.foodforlife-banner__products' ).removeClass( 'opened' );
			} else {
				jQuery( this ).closest( '.foodforlife-banner' ).find( '.foodforlife-banner__products' ).addClass( 'opened' );
			}
		} );

		jQuery( $buttonClose ).on( 'click', function ( e ) {
			e.preventDefault();

			jQuery( this ).closest( '.foodforlife-banner' ).find( '.foodforlife-banner__products' ).removeClass( 'opened' );
		} );

		jQuery(document.body).on( 'click', function ( e ) {
			if( ! jQuery( e.target ).closest( '.foodforlife-banner__products' ).length && ! jQuery( e.target ).closest( '.foodforlife-banner__button' ).length && ! jQuery( e.target ).hasClass( '.foodforlife-banner__button' ) ) {
				if( jQuery( '.foodforlife-banner__products' ).hasClass( 'opened' ) ) {
					jQuery( '.foodforlife-banner__products' ).removeClass( 'opened' );
				}
			}
		} );
	}
}

jQuery( window ).on( 'elementor/frontend/init', () => {
	elementorFrontend.hooks.addAction( 'frontend/element_ready/foodforlife-banner-products.default', ( $element ) => {
		elementorFrontend.elementsHandler.addHandler( FoodForLifeBannerProductsWidgetHandler, { $element } );
	} );
} );