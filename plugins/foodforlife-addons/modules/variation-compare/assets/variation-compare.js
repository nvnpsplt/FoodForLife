(function ($) {
	'use strict';

	var foodforlife = foodforlife || {};

	foodforlife.init = function () {
        this.selectVariation();
    }

    foodforlife.selectVariation = function() {
        var $selector = $( '#product-variation-compare-modal' );

        if ( !$selector.length ) {
            return;
        }

        var $selects = $selector.find( '.ffl-product-compare-attributes__selects' );

        if ( !$selects.length ) {
            return;
        }

        $selects.on( 'click', '.ffl-product-compare-attributes__item', function() {
            $(this).toggleClass( 'active' );

            var key = $(this).data( 'key' ),
                $product = $selects.siblings( '.ffl-product-compare-attributes__products' ).find( '.ffl-product-compare-attributes__product[data-key="' + key + '"]' );

            $product.toggleClass( 'active' );
        });
    }
	/**
	 * Document ready
	 */
	$(function () {
		foodforlife.init();
	});

})(jQuery);