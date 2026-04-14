class FoodForLifeCategoriesGridWidgetHandler extends elementorModules.frontend.handlers.Base {
	getDefaultSettings() {
        return {
            selectors: {
                container: '.foodforlife-categories-grid'
            },
        };
    }

    getDefaultElements() {
        const selectors = this.getSettings('selectors');

        return {
            $container: this.$element.find(selectors.container)
        };

    }

	loadMoreCategories() {
		var self = this;
        // Load Products
        this.elements.$container.on('click', 'a.ajax-load-products', function (e) {
            e.preventDefault();

            var $pagination = jQuery(this);

            self.loadCategoriesAJAX($pagination);
        });
    };

	loadCategoriesInfinite() {
		var self = this;
		var $pagination = this.elements.$container.find('.woocommerce-pagination');
		if (!$pagination.hasClass('woocommerce-pagination--infinite')) {
			return;
		}

		jQuery(window).on('scroll', function () {
			if (foodforlifeIsVisible($pagination)) {
				self.loadCategoriesAJAX($pagination.find('.woocommerce-pagination-button'));
			}
		}).trigger('scroll');
	}

    loadCategoriesAJAX($pagination) {
        var ajax_url = '';
        if (typeof foodforlifeData !== 'undefined') {
            ajax_url = foodforlifeData.ajax_url;
        } else if (typeof wc_add_to_cart_params !== 'undefined') {
            ajax_url = wc_add_to_cart_params.wc_ajax_url;
        }

		if ($pagination.hasClass('loading')) {
			return;
		}

		var $container = $pagination.closest('.foodforlife-categories-grid'),
			$list = $container.find('.foodforlife-categories-grid__items');

		$pagination.addClass('loading');

        jQuery.ajax({
            type: 'POST',
            url: ajax_url.toString().replace('%%endpoint%%', 'foodforlife_load_more_categories'),
            data: {
                action: 'foodforlife_load_more_categories',
				page: $pagination.data('page'),
				number: $pagination.data('number'),
				button_type: $pagination.data('button-type')
            },
            success: (response) => {
				if ( ! response ) {
					return;
				}

				var $data = jQuery(response),
					$list_response = $data.find('.foodforlife-categories-grid__item'),
					$pagination_response = $data.find('.woocommerce-pagination-button'),
					$pagination_number = $pagination_response.data('page');

				$list_response.addClass( 'ffl-fadeinup ffl-animated' );

				let delay = 0.5;
				$list_response.each( function( i, item ) {
					jQuery(item).css( '--ffl-fadeinup-delay', delay + 's' );
					delay = delay + 0.1;
				});

				$list.append($list_response);

				if( $list_response.hasClass( 'ffl-animated' ) ) {
					setTimeout( function() {
						$list_response.removeClass( 'ffl-animated' );
					}, 10 );
				}

				if ( !$pagination_response.length) {
					$pagination.closest('.woocommerce-pagination').remove();
					$pagination.remove();
				} else {
					$pagination.data('page', $pagination_number);
				}

				$pagination.removeClass('loading');

            },
        });
    }

	onInit() {
        var self = this;
        super.onInit();

        self.loadMoreCategories();
        self.loadCategoriesInfinite();
    }
}

jQuery( window ).on( 'elementor/frontend/init', () => {
	elementorFrontend.hooks.addAction( 'frontend/element_ready/foodforlife-products-categories-grid.default', ( $element ) => {
		elementorFrontend.elementsHandler.addHandler( FoodForLifeCategoriesGridWidgetHandler, { $element } );
	} );
} );
