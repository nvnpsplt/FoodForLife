class FoodForLifeMarqueeWidgetHandler extends elementorModules.frontend.handlers.Base {
	getDefaultSettings() {
		return {
			selectors: {
				container: '.foodforlife-elementor--marquee',
				inner: '.foodforlife-marquee--inner',
				items: '.foodforlife-marquee--original',
			},
		};
	}

	getDefaultElements() {
		const selectors = this.getSettings( 'selectors' );

		return {
			$container: this.$element.find( selectors.container ),
			$inner: this.$element.find( selectors.inner ),
			$items: this.$element.find( selectors.items ),
		};
	}

	dulicateItems() {
		const settings = this.getElementSettings(),
			  $inner = this.elements.$inner,
			  $items = this.elements.$items;

		$inner.imagesLoaded(function () {
			let item, amount = ( parseInt( Math.ceil( jQuery( window ).width() / $items.outerWidth( true ) ) ) || 0 ) + 1,
				speed = 1 / parseFloat( settings.speed ) * ( $items.outerWidth( true ) / 350 );

			$inner.css( '--ffl-marquee-speed', speed + 's' );

			for ( let i = 1; i <= amount; i++ ) {
				item = $items.clone();
				item.addClass( 'foodforlife-marquee--duplicate' );
				item.removeClass( 'foodforlife-marquee--original' );
				item.css( '--ffl-marquee-index', String(i) );

				item.appendTo( $inner );
			}
		});
	}

	onInit( ...args ) {
		super.onInit( ...args );

		this.dulicateItems();
	}
}

jQuery( window ).on( 'elementor/frontend/init', () => {
	elementorFrontend.hooks.addAction( 'frontend/element_ready/foodforlife-marquee.default', ( $element ) => {
		elementorFrontend.elementsHandler.addHandler( FoodForLifeMarqueeWidgetHandler, { $element } );
	} );
} );