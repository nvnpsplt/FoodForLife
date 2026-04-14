(function ($) {
    'use strict';

	function select_togoto_link () {
		jQuery( document.body ).on( 'change', '.foodforlife-linked-variant__select', function () {
			window.location.href = $(this).val();
		});
	}

    /**
     * Document ready
     */
    $(function () {
		if ( ! $( 'body' ).hasClass( 'single-product' ) ) {
			return;
		}

		if ( $( '#foodforlife-linked-variant' ).length < 1 ) {
			return;
		}
		
		select_togoto_link();
    });

})(jQuery);