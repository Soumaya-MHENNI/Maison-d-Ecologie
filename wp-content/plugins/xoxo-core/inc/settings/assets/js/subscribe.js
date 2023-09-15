/*
 * Copyright (c) 2023 frenify
 * Author: Frenify
 * This file is made for CURRENT Theme
*/

(function($){
	"use strict";
	
	var FrenifySubscribeInit = {
			
		init: function(){
			this.helpCenterOpener();
		},
		
		helpCenterOpener: function(){
			var divs = $('.xoxo_be_header .icons_panel > div');
			var span = $('.xoxo_be_header .icons_panel > div > span');
			if(span.length){
				span.off().on('click',function(event){
					event.stopPropagation();

					var button = $(this);
					var parent = button.parent();
					if(parent.hasClass('opened')){
						parent.removeClass('opened');
					}else{
						divs.removeClass('opened');
						parent.addClass('opened');
					}
				});
				$('.xoxo_be_help_popup,.xoxo_be_shortcode_popup').on('click',function(event){
					event.stopPropagation();
				});
				$(window).on('click',function(){
					divs.removeClass('opened');
				});
			}
		},
		
		svg: function(){
			$('img.fn__svg').each(function(){
				var e 				= $(this);
				var imgclass		= e.attr('class');
				var URL				= e.attr('src');
				$.get(URL, function(data) {
					var svg 		= $(data).find('svg');
					if(typeof imgclass !== 'undefined') {
						svg = svg.attr('class', imgclass + ' ready-svg');
					}
					svg = svg.removeAttr('xmlns:a');
					e.replaceWith(svg);
				}, 'xml');
			});
		},
		bg_images: function(){
			var data			= $('*[data-bg-img]');
			data.each(function(){
				var element			= $(this);
				var url				= element.data('bg-img');
				element.css({backgroundImage: 'url('+url+')'});
			});
		},
	};
	
	$(document).ready(function(){
		// initialization
		FrenifySubscribeInit.init();

	});
	
	$(window).on('resize', function(){
		// initialization

	});
	
})(jQuery);
