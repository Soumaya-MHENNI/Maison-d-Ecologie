(function($, fnFrontend){
	"use strict";
	
	
	
	var FrenifyXoxo = {
		
		isAdmin: false,
		adminBarH: 0,
		
		ajaxClicksForAjaxGridPosts: 0,
		
		init: function() {
			
			if($('body').hasClass('admin-bar')){
				FrenifyXoxo.isAdmin 		= true;
				FrenifyXoxo.adminBarH 	= $('#wpadminbar').height();
			}

			var widgets = {
				'frel-categories.default' : FrenifyXoxo.categoriesFunction,
				'frel-posts.default' : FrenifyXoxo.postsFunction,
				'frel-latest-posts-by-category.default' : FrenifyXoxo.postsTripleFunction,
				'frel-top-posts-by-category.default' : FrenifyXoxo.postsTripleFunction,
				'frel-podcasts.default' : FrenifyXoxo.podcastsFunction,
				'frel-hosts.default' : FrenifyXoxo.hostsFunction,
				'frel-sponsors.default' : FrenifyXoxo.sponsorsFunction,
			};

			$.each( widgets, function( widget, callback ) {
				fnFrontend.hooks.addAction( 'frontend/element_ready/' + widget, callback );
			});
		},
		
		postsTicker: function(){
			$(".TickerNews .marquee").each(function(){
				var e = $(this);
				if(!e.hasClass('ready')){
					e.addClass('ready').marquee({
						duplicated: true,
						duration: parseInt(e.data('speed'))*1000,
						delayBeforeStart: 0,
						direction: 'left',
					}).bind('finished', function () {
						FrenifyXoxo.ImgToSVG();
					});
					FrenifyXoxo.ImgToSVG();
				}
			});	
		},
		
		sponsorsFunction: function(){
			$('.fn_cs_sponsor.layout_carousel .swiper-container').each(function(){
				var element				= $(this);
				// Main Slider
				var mainSliderOptions 	= {
					loop: true,
					slidesPerView: 5,
					speed: 1000,
					autoplay:{
						delay: 5000,
						disableOnInteraction: false,
					},
					navigation: {
						nextEl: element.closest('.fn_cs_sponsor').find('.next'),
						prevEl: element.closest('.fn_cs_sponsor').find('.prev'),
					},
					spaceBetween: 50,
					direction: 'horizontal',
					loopAdditionalSlides: 10,
					watchSlidesProgress: true,
					breakpoints:{
						768:{slidesPerView:1},
						1040:{slidesPerView:2},
						1200:{slidesPerView:3},
						1400:{slidesPerView:4},
						1600:{slidesPerView:5},
					}
				};
				new Swiper(element, mainSliderOptions);
			});
		},
		
		hostsFunction: function(){
			$('.fn_cs_hosts.layout_carousel .swiper-container').each(function(){
				var element				= $(this);
				// Main Slider
				var mainSliderOptions 	= {
					loop: true,
					slidesPerView: 3,
					speed: 1000,
					autoplay:{
						delay: 5000,
						disableOnInteraction: false,
					},
					navigation: {
						nextEl: element.closest('.fn_cs_hosts').find('.next'),
						prevEl: element.closest('.fn_cs_hosts').find('.prev'),
					},
					spaceBetween: 50,
					direction: 'horizontal',
					loopAdditionalSlides: 10,
					watchSlidesProgress: true,
					breakpoints:{
						768:{slidesPerView:1},
						1040:{slidesPerView:2},
						1200:{slidesPerView:3},
					}
				};
				new Swiper(element, mainSliderOptions);
			});
			FrenifyXoxo.BgImg();
			FrenifyXoxo.ImgToSVG();
		},
		
		postsTripleFunction: function(){
			$('.fn__title_holder .cat_list li a').off().on('click',function(){
				var e = $(this),
					slug = e.data('id'),
					url = e.data('link'),
					layout = e.data('layout'),
					count = e.data('count'),
					parent = e.closest('.cat_list_holder'),
					wrapper = e.closest('.fn_cs_posts__ajax'),
					active = parent.find('.active');
				if(e.hasClass('selected')){
					return false;
				}
				if(!active.hasClass('loading')){
					active.addClass('loading');
					
					var requestData = {
						action: 'xoxo_fn_cs_ajax_get_last_posts_by_category',
						slug: slug,
						layout: layout,
						count: count,
						security: XoxoAjaxObject.nonce,
					};


					$.ajax({
						type: 'POST',
						url: XoxoAjaxObject.ajax_url,
						cache: false,
						data: requestData,
						success: function(data) {
							var fnQueriedObj 	= $.parseJSON(data);
							wrapper.find('.posts').html(fnQueriedObj.list);
							active.find('.text').text(e.find('.text').text());
							e.closest('.right_title').find('.see_all a').attr('href',url);
							e.parent().siblings().find('a').removeClass('selected');
							e.addClass('selected');
							active.removeClass('loading');
							FrenifyXoxo.BgImg();
							FrenifyXoxo.ImgToSVG();
						},
						error: function(xhr, textStatus, errorThrown){
							console.log(errorThrown);
							console.log(textStatus);
							console.log(xhr);
							active.removeClass('loading');
						}
					});
					
					
				}
				
				return false;
			});
		},
		
		postsFunction: function(){
			FrenifyXoxo.postSlider();
			FrenifyXoxo.postAjax();
			FrenifyXoxo.fixedColAjax();
			FrenifyXoxo.postCarousel();
			FrenifyXoxo.parallaxClassicAjax();
			FrenifyXoxo.parallaxEffect();
			FrenifyXoxo.postsTicker();
		},
		
		
		postCarousel: function(){
			$('.fn_cs_post_carousel .swiper-container').each(function(){
				var element				= $(this);
				// Main Slider
				var mainSliderOptions 	= {
					loop: true,
					slidesPerView: 2,
					speed: 1000,
					autoplay:{
						delay: 5000,
						disableOnInteraction: false,
					},
					navigation: {
						nextEl: element.closest('.fn_cs_post_carousel').find('.next'),
						prevEl: element.closest('.fn_cs_post_carousel').find('.prev'),
					},
					spaceBetween: 50,
					direction: 'horizontal',
					loopAdditionalSlides: 10,
					watchSlidesProgress: true,
				};
				new Swiper(element, mainSliderOptions);
			});
		},
		
		
		podcastsFunction: function(){
			$('.fn_cs_podcast_listed.layout_carousel .swiper-container').each(function(){
				var element				= $(this);
				// Main Slider
				var mainSliderOptions 	= {
					loop: false,
					slidesPerView: 2,
					speed: 1000,
					autoplay:{
						delay: 5000,
						disableOnInteraction: false,
					},
					navigation: {
						nextEl: element.closest('.fn_cs_podcast_listed').find('.next'),
						prevEl: element.closest('.fn_cs_podcast_listed').find('.prev'),
					},
					spaceBetween: 50,
					direction: 'horizontal',
					watchSlidesProgress: true,
				};
				new Swiper(element, mainSliderOptions);
				FrenifyXoxo.ImgToSVG();
			});
		},
		
		fixedColAjax: function(){
			var ajax_more = $('.fn_cs_posts_fixed_col .xoxo_fn_pagination a');
			if(ajax_more.length){
				ajax_more.off().on('click',function(){
					var element = $(this);
					if(!element.hasClass('current')){
						var parent = element.closest('.fn_cs_posts_fixed_col');
						FrenifyXoxo.fixedColPosts__function(parent,element.data('page'));
					}
					
					return false;
				});
			}	
		},
		
		fixedColPosts__function: function(parent,page){
			if(parent.hasClass('loading')){
				return false;
			}
			$('.fn_ajax__preloader').addClass('loading');
			parent.addClass('loading');
			
			$([document.documentElement, document.body]).animate({
				scrollTop: parent.offset().top - FrenifyXoxo.adminBarH
			}, 1500);

			var requestData = {
				action: 'xoxo_fn_cs_ajax_fixed_col_posts',
				myarguments: XoxoArgumentsFixedCol,
				paged: page,
				security: XoxoAjaxObject.nonce,
			};


			$.ajax({
				type: 'POST',
				url: XoxoAjaxObject.ajax_url,
				cache: false,
				data: requestData,
				success: function(data) {
					var fnQueriedObj 	= $.parseJSON(data);
					parent.removeClass('loading');
					$('.fn_ajax__preloader').removeClass('loading');
					parent.html(fnQueriedObj.list);
					
					if(fnQueriedObj.disabled === 'disabled'){
						parent.find('.fn_ajax_more').slideUp(500);
					}else{
						parent.find('.fn_ajax_more').slideDown(500);
					}
					var url = window.location.href.split("?")[0];
					window.history.pushState("", '', url + '?page_number='+page);
					FrenifyXoxo.BgImg();
					FrenifyXoxo.ImgToSVG();
					FrenifyXoxo.fixedColAjax();
				},
				error: function(xhr, textStatus, errorThrown){
					parent.removeClass('loading');
					console.log(errorThrown);
					console.log(textStatus);
					console.log(xhr);
				}
			});
		},
		
		parallaxClassicAjax: function(){
			var ajax_more = $('.fn_cs_posts_parallax_classic .xoxo_fn_pagination a');
			if(ajax_more.length){
				ajax_more.off().on('click',function(){
					var element = $(this);
					if(!element.hasClass('current')){
						var parent = element.closest('.fn_cs_posts_parallax_classic');
						FrenifyXoxo.parallaxClassicPosts__function(parent,element.data('page'));
					}
					
					return false;
				});
			}	
		},
		
		parallaxClassicPosts__function: function(parent,page){
			if(parent.hasClass('loading')){
				return false;
			}
			$('.fn_ajax__preloader').addClass('loading');
			parent.addClass('loading');
			
			$([document.documentElement, document.body]).animate({
				scrollTop: parent.offset().top - FrenifyXoxo.adminBarH
			}, 1500);

			var requestData = {
				action: 'xoxo_fn_cs_ajax_parallax_classic_posts',
				myarguments: XoxoArgumentsParallaxClassic,
				paged: page,
				security: XoxoAjaxObject.nonce,
			};


			$.ajax({
				type: 'POST',
				url: XoxoAjaxObject.ajax_url,
				cache: false,
				data: requestData,
				success: function(data) {
					var fnQueriedObj 	= $.parseJSON(data);
					parent.removeClass('loading');
					$('.fn_ajax__preloader').removeClass('loading');
					parent.html(fnQueriedObj.list);
					
					if(fnQueriedObj.disabled === 'disabled'){
						parent.find('.fn_ajax_more').slideUp(500);
					}else{
						parent.find('.fn_ajax_more').slideDown(500);
					}
					var url = window.location.href.split("?")[0];
					window.history.pushState("", '', url + '?page_number='+page);
					FrenifyXoxo.BgImg();
					FrenifyXoxo.ImgToSVG();
					FrenifyXoxo.parallaxClassicAjax();
					FrenifyXoxo.parallaxEffect();
				},
				error: function(xhr, textStatus, errorThrown){
					parent.removeClass('loading');
					console.log(errorThrown);
					console.log(textStatus);
					console.log(xhr);
				}
			});
		},
		
		parallaxEffect: function(){
			var detail       = $('.moving_effect');
			var offset    = 0;
			detail.each(function(){
				var element  = $(this);
				var direction = element.attr('data-direction');
				$(window).on('scroll',function(){
					offset  = $(window).scrollTop();
					var h  = $(window).height();
					var i  = element.offset().top - offset - h;
					if(element.attr('data-reverse') === 'yes'){
						i*= -1;
					}
					var x  = direction === 'x' ?  (i*150)/h : 0;
					var y   = direction === 'x' ?  0 : (i*150)/h;
					if(element.attr('data-reverse') === 'yes'){
						i*= -1;
					}
					if((i*(-1))<h+300 && i<300){
						element.css({transform: 'translate3d('+x+'px, '+y+'px, 0px)'});
					}
				});
			});	
		},
		
		postAjax: function(){
			var ajax_more = $('.fn_cs_posts_ajax_grid .fn_ajax_more a');
			if(ajax_more.length){
				ajax_more.on('click',function(){
					var element = $(this);
					var parent 	= element.closest('.fn_cs_posts_ajax_grid');
					FrenifyXoxo.ajaxGridPosts__function(parent);
					return false;
				});
			}	
		},
		
		ajaxGridPosts__function: function(parent){
			var self = this;
			if(parent.hasClass('loading')){
				return false;
			}
			parent.addClass('loading');
			self.ajaxClicksForAjaxGridPosts++;
			

			var requestData = {
				action: 'xoxo_fn_cs_ajax_grid_filter_posts',
				myarguments: XoxoArguments,
				clicked: self.ajaxClicksForAjaxGridPosts,
				security: XoxoAjaxObject.nonce,
			};


			$.ajax({
				type: 'POST',
				url: XoxoAjaxObject.ajax_url,
				cache: false,
				data: requestData,
				success: function(data) {
					var fnQueriedObj 	= $.parseJSON(data);
					parent.removeClass('loading');
					parent.find('.fn_posts ul').append(fnQueriedObj.list);
					
					if(fnQueriedObj.disabled === 'disabled'){
						parent.find('.fn_ajax_more').slideUp(500);
					}else{
						parent.find('.fn_ajax_more').slideDown(500);
					}
					FrenifyXoxo.BgImg();
					FrenifyXoxo.ImgToSVG();
				},
				error: function(xhr, textStatus, errorThrown){
					parent.removeClass('loading');
					console.log(errorThrown);
					console.log(textStatus);
					console.log(xhr);
				}
			});
		},
		
		postSlider: function(){
			$('.fn_cs_post_slider .swiper-container').each(function(){
				var element				= $(this);
				var transform 			= 'Y';
				var direction 			= 'horizontal';
				var	interleaveOffset 	= 0.5;
				if(direction === 'horizontal'){
					transform 			= 'X';
				}
				var rate				= 1;
				if($('body').hasClass('rtl')){
					rate = -1;
				}
				// Main Slider
				var mainSliderOptions 	= {
					loop: true,
					speed: 1500,
					autoplay:{
						delay: 5000,
						disableOnInteraction: false,
					},
					navigation: {
						nextEl: element.closest('.fn_cs_post_slider').find('.next'),
						prevEl: element.closest('.fn_cs_post_slider').find('.prev'),
					},
					slidesPerView: 1,
					direction: direction,
					loopAdditionalSlides: 10,
					watchSlidesProgress: true,
					on: {
						init: function(){
							this.autoplay.stop();
						},
						imagesReady: function(){
							this.autoplay.start();
						},
						progress: function(){
							var swiper = this;
							for (var i = 0; i < swiper.slides.length; i++) {
								var slideProgress 	= swiper.slides[i].progress,
								innerOffset 		= swiper.width * interleaveOffset,
								innerTranslate 		= slideProgress * innerOffset * rate;
								$(swiper.slides[i]).find(".abs_img").css({transform: "translate"+transform+"(" + innerTranslate + "px)"});
							}
						},
						touchStart: function() {
							var swiper = this;
							for (var i = 0; i < swiper.slides.length; i++) {
								swiper.slides[i].style.transition = "";
							}
						},
						setTransition: function(speed) {
							var swiper = this;
							for (var i = 0; i < swiper.slides.length; i++) {
								swiper.slides[i].style.transition = speed + "ms";
								swiper.slides[i].querySelector(".abs_img").style.transition =
								speed + "ms";
							}
						}
					}
				};
				new Swiper(element, mainSliderOptions);
			});
		},
		
		
		categoriesFunction: function(){
			$('.fn_cs_category_alpha .swiper-container').each(function(){
				var element				= $(this);
				// Main Slider
				var mainSliderOptions 	= {
					loop: true,
					slidesPerView: 'auto',
					speed: 1500,
					autoplay:{
						delay: 5000,
						disableOnInteraction: false,
					},
					spaceBetween: 50,
					direction: 'horizontal',
					loopAdditionalSlides: 10,
					watchSlidesProgress: true,
				};
				new Swiper(element, mainSliderOptions);
			});
		},
		
		
		/* COMMMON FUNCTIONS */
		BgImg: function(){
			var div = $('*[data-fn-bg-img]');
			div.each(function(){
				var element = $(this);
				var attrBg	= element.attr('data-fn-bg-img');
				var dataBg	= element.data('fn-bg-img');
				if(typeof(attrBg) !== 'undefined'){
					element.addClass('frenify-ready');
					element.css({backgroundImage:'url('+dataBg+')'});
				}
			});
			var div2 = $('*[data-bg-img]');
			div2.each(function(){
				var element = $(this);
				var attrBg	= element.attr('data-bg-img');
				var dataBg	= element.data('bg-img');
				if(typeof(attrBg) !== 'undefined'){
					element.addClass('frenify-ready');
					element.css({backgroundImage:'url('+dataBg+')'});
				}
			});
		},
		
		ImgToSVG: function(){
			
			$('img.fn__svg').each(function(){
				var $img 		= $(this);
				var imgClass	= $img.attr('class');
				var imgURL		= $img.attr('src');

				$.get(imgURL, function(data) {
					var $svg = $(data).find('svg');
					if(typeof imgClass !== 'undefined') {
						$svg = $svg.attr('class', imgClass+' replaced-svg');
					}
					$img.replaceWith($svg);

				}, 'xml');
			});
		},
		
		jarallaxEffect: function(){
			$('.jarallax').each(function(){
				var element			= $(this);
				var	customSpeed		= element.data('speed');

				if(customSpeed !== "undefined" && customSpeed !== ""){
					customSpeed = customSpeed;
				}else{
					customSpeed 	= 0.5;
				}
				element.jarallax({
					speed: customSpeed,
					automaticResize: true
				});
			});
		},
		
		isotopeFunction: function(){
			var masonry = $('.fn_cs_masonry');
			if($().isotope){
				masonry.each(function(){
					$(this).isotope({
					  itemSelector: '.fn_cs_masonry_in',
					  masonry: {}
					});
					$(this).isotope( 'reloadItems' ).isotope();
				});
			}
		},
		
		lightGallery: function(){
			if($().lightGallery){
				// FIRST WE SHOULD DESTROY LIGHTBOX FOR NEW SET OF IMAGES
				var gallery = $('.fn_cs_lightgallery');

				gallery.each(function(){
					var element = $(this);
					element.lightGallery(); // binding
					if(element.length){element.data('lightGallery').destroy(true); }// destroying
					$(this).lightGallery({
						selector: ".lightbox",
						thumbnail: 1,
						loadYoutubeThumbnail: !1,
						loadVimeoThumbnail: !1,
						showThumbByDefault: !1,
						mode: "lg-fade",
						download:!1,
						getCaptionFromTitleOrAlt:!1,
					});
				});
			}	
		},
	};
	
	$( window ).on( 'elementor/frontend/init', FrenifyXoxo.init );
	
	
	$( window ).on('resize',function(){
		FrenifyXoxo.isotopeFunction();
		setTimeout(function(){
			FrenifyXoxo.isotopeFunction();
		},700);
	});
	$( window ).on('load',function(){
		FrenifyXoxo.isotopeFunction();
	});
	
	$(window).on('scroll',function(){
		
	});
	
})(jQuery, window.elementorFrontend);