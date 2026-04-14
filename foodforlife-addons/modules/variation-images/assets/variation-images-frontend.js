(function ($) {
    'use strict';
    var foodforlife = foodforlife || {};

    foodforlife.found_data = false;
    foodforlife.variation_id = foodforlifeVariationImages.variation_id_default || 0;

    foodforlife.foundVariationImages = function( ) {
        $( 'div.product .entry-summary .variations_form:not(.form-cart-pbt)' ).on('found_variation', function(e, $variation){
            if( foodforlife.variation_id != $variation.variation_id ) {
                foodforlife.changeVariationImagesAjax($variation.variation_id, $(this).data('product_id'));
                foodforlife.found_data = true;
                foodforlife.variation_id = $variation.variation_id;
            }
        });
    }

    foodforlife.resetVariationImages = function( ) {
        $( 'div.product .entry-summary .variations_form:not(.form-cart-pbt)' ).on('reset_data', function(e){
            if( foodforlife.found_data ) {
                foodforlife.changeVariationImagesAjax(0, $(this).data('product_id'));
                foodforlife.found_data = false;
                foodforlife.variation_id = 0;
            }

        });
    }

    foodforlife.changeVariationImagesAjax = function(variation_id, product_id) {
        var $productGallery = $('.woocommerce-product-gallery'),
            galleryHeight = $productGallery.height();
            $productGallery.addClass('loading').css( {'overflow': 'hidden' });
            if( ! $productGallery.closest('.single-product').hasClass('quick-view-modal') ) {
                $productGallery.css( {'height': galleryHeight });
            }

        var data = {
            'variation_id': variation_id,
            'product_id': product_id,
            nonce: foodforlifeData.nonce,
        },
        ajax_url = foodforlifeData.ajax_url.toString().replace('%%endpoint%%', 'foodforlife_get_variation_images');

        var xhr = $.post(
            ajax_url,
            data,
            function (response) {
                var $gallery = $(response.data);

                $productGallery.html( $gallery.html() );

                $productGallery.imagesLoaded(function () {
                    setTimeout(function() {
                        $productGallery.removeClass('loading').removeAttr( 'style' ).css('opacity', '1');
                    }, 200);

                } );

                $productGallery.trigger('product_thumbnails_slider_vertical');
                $productGallery.trigger('product_thumbnails_slider_horizontal');
                $('body').trigger('foodforlife_product_gallery_zoom');
                $('body').trigger('foodforlife_product_gallery_lightbox');

            }
        );
    }
    /**
     * Document ready
     */
    $(function () {
        if( typeof foodforlifeVariationImages == 'undefined' ) {
            return;
        }
        
        if( $('.single-product').find('div.product' ).hasClass('product-has-variation-images') ) {
            foodforlife.foundVariationImages();
            foodforlife.resetVariationImages();
        }
    });

})(jQuery);