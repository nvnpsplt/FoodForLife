class FoodForLifeBrandsWidgetHandler extends elementorModules.frontend.handlers.Base {
	getDefaultSettings() {
		return {
			selectors: {
				button: '.foodforlife-brands-filters .foodforlife-brands-filters__button',
				item: '.foodforlife-brands-filters__items',
			},
		};
	}

	getDefaultElements() {
		const selectors = this.getSettings( 'selectors' );

		return {
			$button: this.findElement( selectors.button ),
			$item: this.findElement( selectors.item ),
		};
	}

	changeActiveFilter( data ) {
		const $button     = this.elements.$button.filter( '[data-filter="' + data + '"]' ),
		      $item       = this.elements.$item.filter( '[data-filter="' + data + '"]' ),
		      $itemActive = this.elements.$item.siblings( '.active' ),
		      isActive    = $button.hasClass( 'active' );

		if ( isActive ) {
			return;
		}

		$button.addClass( 'active' ).siblings( '.active' ).removeClass( 'active' );

		if( data == 'all' ) {
			$itemActive.siblings().addClass( 'active' );
		} else {
			$item.addClass( 'active' ).siblings( '.active' ).removeClass( 'active' );
		}
	}

	bindEvents() {
		this.elements.$button.on( {
			click: ( event ) => {
				event.preventDefault();

				this.changeActiveFilter( event.currentTarget.getAttribute( 'data-filter' ) );
			}
		} );
	}

	onInit( ...args ) {
        super.onInit( ...args );
    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
	elementorFrontend.hooks.addAction( 'frontend/element_ready/foodforlife-brands.default', ( $element ) => {
		elementorFrontend.elementsHandler.addHandler( FoodForLifeBrandsWidgetHandler, { $element } );
	} );
} );
