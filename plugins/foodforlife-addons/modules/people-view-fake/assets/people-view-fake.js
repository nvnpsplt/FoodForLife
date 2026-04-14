(function ($) {
	"use strict";

	function init() {
		var interval = foodforlifePVF.interval,
		    from = foodforlifePVF.from,
		    to   = foodforlifePVF.to;

		setInterval( function () {
			var number = Math.floor( ( Math.random() * to ) + from );

			number = number < from ? from : number;
			number = number > to ? to : number;

			$( '.foodforlife-people-view__numbers' ).text( number );
		}, interval );
	}

	/**
	 * Document ready
	 */
	$(function () {
		if ( typeof foodforlifePVF === 'undefined' ) {
			return false;
		}

		init();
    });

})(jQuery);