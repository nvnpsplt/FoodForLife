class FoodForLifeCountDownWidgetHandler extends elementorModules.frontend.handlers.Base {

	getDefaultSettings() {
		return {
			selectors: {
				container: '.foodforlife-countdown'
			},
		};
	}

	getDefaultElements() {
		const selectors = this.getSettings( 'selectors' );

		return {
			$container: this.$element.find( selectors.container )
		};
	}

	getCountDownInit() {
		jQuery(document.body).trigger('foodforlife_countdown', this.elements.$container);
	}

	onInit() {
		super.onInit();
		this.getCountDownInit();
	}
}

jQuery( window ).on( 'elementor/frontend/init', () => {
	elementorFrontend.hooks.addAction( 'frontend/element_ready/foodforlife-countdown.default', ( $element ) => {
		elementorFrontend.elementsHandler.addHandler( FoodForLifeCountDownWidgetHandler, { $element } );
	} );

	elementorFrontend.hooks.addAction( 'frontend/element_ready/foodforlife-banner.default', ( $element ) => {
		elementorFrontend.elementsHandler.addHandler( FoodForLifeCountDownWidgetHandler, { $element } );
	} );

	elementorFrontend.hooks.addAction( 'frontend/element_ready/foodforlife-product-deals.default', ( $element ) => {
		elementorFrontend.elementsHandler.addHandler( FoodForLifeCountDownWidgetHandler, { $element } );
	} );
} );
