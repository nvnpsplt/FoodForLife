jQuery( document ).ready(function($) {
	var $gallery = $('.woocommerce-product-gallery'),
		$360 = $gallery.find('.woocommerce-product-gallery__image.foodforlife-product-360');

	if ($360.length > 0) {
		$gallery.addClass('has-360');
	}

	var $pagination = $gallery.find('.foodforlife-product-gallery-thumbnails'),
		$video = $gallery.find('.woocommerce-product-gallery__image.foodforlife-product-360');

	if ($video.length > 0) {
		var videoNumber = $video.index();
		$pagination.find('.woocommerce-product-gallery__image').eq(videoNumber).append('<span class="foodforlife-i-360" role="button"></span>');
	}

	$(document.body).on( 'click', '.foodforlife-product-360 .foodforlife-i-360', function() {
		window.CI360.init();

		$(this).addClass( 'hidden' );

		if( $(this).find( '.foodforlife-product-360__image' ).length ) {
			$(this).find( '.foodforlife-product-360__image' ).remove();
		}
	});
});