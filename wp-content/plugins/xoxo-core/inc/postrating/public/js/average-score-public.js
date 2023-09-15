(function ($) {
	'use strict';

	/**
	 * All of the code for this plugin public-facing JavaScript source
	 * should reside in this file.
	 */
	var startProductBarPos = -1;
	window.onscroll = function () {
		
		var FERSWidget = document.querySelector('[id^="fers_editorial_rating_widget"]');
		var barTopWidth = FERSWidget.parentElement.clientHeight;
		if (startProductBarPos < 0) startProductBarPos = findPosY(FERSWidget);

		// Set media query.
		var mediaQueryY = window.matchMedia("(min-width: 922px)");

		// Match up element position and media query.
		if (pageYOffset > startProductBarPos && mediaQueryY.matches) {

			FERSWidget.style.position = 'fixed';
			FERSWidget.style.top = '20px';
			FERSWidget.style.width = barTopWidth + 'px';
		} else {

			FERSWidget.style.position = 'relative';
		}

		// Get data-stickyDisable value.
		var stickyDisable = FERSWidget.querySelector('.fers--rating-widget-wrap').dataset.stickydisable;

		// If the scroll position at to bottom of the window + 300 px up.
		if ( (window.innerHeight + window.scrollY + 300) >= document.body.offsetHeight && 'true' == stickyDisable) {

			FERSWidget.style.display = 'none';
		} else {

			FERSWidget.style.display = 'block';
		}
	};

	// Custom method to getting position of an element.
	function findPosY(obj) {
		var curtop = 0;
		if (typeof (obj.offsetParent) != 'undefined' && obj.offsetParent) {
			while (obj.offsetParent) {
				curtop += obj.offsetTop;
				obj = obj.offsetParent;
			}
			curtop += obj.offsetTop;
		}
		else if (obj.y)
			curtop += obj.y;
		return curtop;
	}
	
	
	// Added by Frenify
	var ScorePublicInit = {
		
		init: function () {
			this.imgToSVG();
		},
		
		imgToSVG: function(){
			$('img.fn__svg').each(function(){
				var img 		= $(this);
				var imgClass	= img.attr('class');
				var imgURL		= img.attr('src');

				$.get(imgURL, function(data) {
					var svg 	= $(data).find('svg');
					if(typeof imgClass !== 'undefined') {
						svg 	= svg.attr('class', imgClass+' replaced-svg');
					}
					img.replaceWith(svg);

				}, 'xml');

			});	
		},
	};
	
	// ready functions
	$(document).ready(function(){
		ScorePublicInit.init();
	});

})(jQuery);