require(['jquery', 'jquery.scroller', 'jquery.sticky-float', 'jquery.animate-in-view', 'jquery.queryloader2'], function ($, scroller, stickyfloat, animateInView, queryLoader2) {
	$(window).load(function(){

		if( !($('html').hasClass('boxsizing')) ){
	        $('.span:visible').each(function(){
	        	var span = $(this);
	            var fullW = span.outerWidth(),
	                actualW = span.width(),
	                wDiff = fullW - actualW,
	                newW = actualW - wDiff;
	 			
	            span.css('width',newW);
	        });
	    }

		$('body').addClass('loaded');
	});

	$(function(){
		
		if(!$('body').hasClass('home')){
			$('.floating').stickyfloat({easing: 'easeInOutQuad', cssTransition: true, duration: 0, delay: 0, offsetBottom: 100});
		}

		if(!$('#intro').is(':visible')){
			$('.animate').animateInView();
		}

		if ( $('#tortilla').is(':hidden') && $.fn.queryLoader2){
			$('body').queryLoader2({
		        barColor: "#FFF",
		        backgroundColor: "#000",
		        percentage: false,
		        barHeight: 1,
		        completeAnimation: "grow",
		        minimumTime: 100
		    });

		    $('#tortilla').show();
		}


		$('.scroller').each(function(){
			var scrollerObj = $(this),
				options = {};
			if(scrollerObj.data('scroll-all') === true) options.scrollAll = true;
			if(scrollerObj.data('auto-scroll') === true ) options.autoScroll = true;
			if(scrollerObj.data('callback')) {
				scrollerObj.bind('onChange', function(e, nextItem){
					var func = window[scrollerObj.data('callback')];
					if(func){
						func($(this), nextItem);
					}
				});
			}
			scrollerObj.scroller(options);
		});

		$('a[href^=#].scroll-to-btn').click(function(){
			var target = $($(this).attr('href'));
			var offsetTop = (target.length != 0) ? target.offset().top : 0;
			$('body, html').animate({scrollTop: offsetTop}, 500);
			return false;
		});

		$('.overlay-btn').hover(function(){
			$('.overlay', this).fadeIn();
		}, function(){
			$('.overlay', this).fadeOut();
		});
		
		
		$('.lightbox-overlay, .lightbox .close-btn').live('click', function(){
			$('.lightbox').fadeOut(function(){
				$('.lightbox-overlay').fadeOut('slow');	
				$('.lightbox').html('');
			});						 
		});
		
		$('.lightbox-btn').on('click', function(e){
			loadPopup($(this).attr('href'));
			return false;
		});
		
		$('.overlay-btn').hover(function(){
			$('.overlay', this).fadeTo(200, 0.5);
		}, function(){
			$('.overlay', this).fadeOut();
		});
		
		$('.fade-btn').hover(function(){
			$(this).fadeTo(200, 0.6);
		}, function(){
			$(this).fadeTo(200, 1);
		});
		
		$('.share-popup-btn').click(function(){
			var url = $(this).attr('href');
			var width = 640;
			var height = 305;
			var left = ($(window).width() - width) / 2;
			var top = ($(window).height() - height) / 2;
			window.open(url, 'sharer', 'toolbar=0,status=0,width='+width+',height='+height+',left='+left+', top='+top);
			return false;
		});

		$('.tooltip-btn').click(function(){
			var tooltip = $('.tooltip', this);
			tooltip.fadeToggle();
			$('input[type=text]', tooltip).select();
			return false;
		});

		$('.has-tooltip').click(function(){
			$('.tooltip', this).fadeIn();
		}, function(){
			$('.tooltip', this).fadeOut();
		});

		if($('.read-more-btn').length !== 0){
	    	$('.read-more-btn').on('click', function(e){
	    		var btn = $(this),
	    			post = $(this).parents('.post'),
	    			more = $('.more', post);
	    		if(post.length){

		    		if(more.is(':hidden')){
		    			post.addClass('current');
		    			more.slideDown();
		    			btn.html(btn.data('less-text'));
		    			btn.removeClass('arrow-down-btn');
		    			btn.addClass('arrow-up-btn');
		    		} else {
		    			post.removeClass('current');
		    			more.slideUp();
		    			btn.html(btn.data('more-text'));
		    			btn.removeClass('arrow-up-btn');
		    			btn.addClass('arrow-down-btn');
		    		}

		    		var offsetTop = (post.length != 0) ? post.offset().top - 46 : 0;
					$('body, html').animate({scrollTop: offsetTop}, 500);
				}
	    		e.preventDefault();
	    		return false;
	    	});
	    }
		
		$('.toggle-header-btn').on('click', function() {
			$('body').toggleClass('expand-header');
		});


		$('#intro .enter-btn').on('click', function(){
			var windowHeight = $(window).height(),
				intro = $('#intro');
			
			$('.content', intro).animate({marginTop: '-600px'}, 1000, 'easeInOutBack');
			$('.animate').hide();
			setTimeout(function(){
				intro.fadeOut(400, function(){
					$('.animate').animateInView();
				});
			}, 600);

		});

		$(window).resize(function(){
			onResize();
		});
		onResize();

		$.fn.preload = function() {
		    this.each(function(){
		        $('<img/>')[0].src = themeUrl + this;
		    });
		}

		function loadPopup(url){
			var val = new RegExp('(\\?|\\&)ajax=.*?(?=(&|$))'),
		        qstring = /\?.+$/;

		    if (val.test(url)){
		        url = url.replace(val, '$1ajax=true');
		    } else if (qstring.test(url)) {
		        url = url + '&ajax=true';
		    } else {
		        url =  url + '?ajax=true';
		    }
		    
		    $('.lightbox').css({'top': ( $(document).scrollTop() - $('#main').offset().top) + 100});
			if(!($.browser.msie && $.browser.version < 8)) {
				$('.lightbox-overlay').fadeIn('slow');
			}
			setTimeout(function() {
				//$('html,body').animate({scrollTop: $('.lightbox').offset().top}, 800);
				$('.lightbox').html('<div class="loader"></div>');
				$('.lightbox').delay(100).fadeIn();
				$.get(url, function(data) {
					$('.lightbox').fadeOut(function(){
						$('.lightbox')
							.html(data)
							.delay(200)
							.fadeIn();
					});
				});
			}, 500)
		}

		function onResize(){
			equalHeights();
		}

		function equalHeights(){
			if($('.equal-height').length !== 0){
				
				var currTallest = 0,
				currTopPos = 0,
				rowDivs = [],
				topPos = 0,
				i = 0;

				$('.equal-height').each(function() {

					var element = $(this);
					element.height('auto');
					topPos = element.position().top;
					if (currTopPos !== topPos) {

						for (i = 0 ; i < rowDivs.length ; i++) {
							rowDivs[i].height(currTallest);
						}

						rowDivs.length = 0;
						currTopPos = topPos;
						currTallest = element.height();
						rowDivs.push(element);
					} else {
						rowDivs.push(element);
						currTallest = (currTallest < element.height()) ? (element.height()) : (currTallest);
					}

					for (i = 0 ; i < rowDivs.length ; i++) {
						rowDivs[i].height(currTallest);
					}

				});
			}
		}

		equalHeights();	
		
	});
});