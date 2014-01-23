define(['jquery', 'jquery.easing'], function ($) {
	$.fn.scroller = function(options) {
		
		var defaults = {
			autoScroll: false,
			scrollAll: false,
			resize: false,
			easing: 'easeInOutQuad',
			duration: 1000
		};
		options = $.extend({}, defaults, options);
		
		var scroller = $(this);
		var currItem = $('.scroll-item:eq(0)', scroller);
		if($('.scroll-item', scroller).hasClass('current')){
			currItem = $('.scroll-item.current', scroller);
		}

		var canAutoScroll = true;
		var canScroll = true;
		var firstLoad = true;
		var totalItems = $('.scroll-item', scroller).size();
		
		function gotoItem(id, direction){
			var nextItem = $('.scroll-item[data-id='+id+']', scroller);
			var nextI = nextItem.index();
			var currI = currItem.index();
			var scrollWidth = nextItem.outerWidth(true);
			canScroll = (firstLoad || id !== currItem.data('id'));
			
			if(canScroll && !$('.scroll-item', scroller).is(':animated') && !$('.scroll-items-container', scroller).is(':animated')){
				canScroll = false;
				var targetX = 0;
				if(options.scrollAll){
					if(currI < nextI){
						targetX = scrollWidth * (nextI - currI);
					} else {
						targetX = -scrollWidth * (currI - nextI);
					}
					
					if(!firstLoad){
						setTimeout(function(){
							currItem.removeClass('current');
							nextItem.addClass('current');
						}, options.duration / 2);
						if(currI < nextI){
							$('.scroll-items-container:not(:animated)', scroller).animate({left: -targetX}, options.duration, options.easing, function(){
								var nextII = nextI - 1;
								var nextItemTemp = $('.scroll-item:lt('+nextII+')', scroller);
								$('.scroll-item:last', scroller).after(nextItemTemp);
								$('.scroll-items-container', scroller).css({left: 0 + 'px' });
								nextItemTemp.hide().fadeIn();
								nextItem.addClass('current');
								currItem = nextItem;
								canScroll = false;
							});
						} else {
							$('.scroll-item:first', scroller).before($('.scroll-item:last', scroller));
							$('.scroll-items-container', scroller).css({left: -scrollWidth + 'px' });
							$('.scroll-items-container:not(:animated)', scroller).animate({left: 0}, options.duration, options.easing, function(){
								nextItem.addClass('current');
								currItem = nextItem;
								canScroll = false;
							});
						}
					} else {
						$('.scroll-item:first', scroller).before($('.scroll-item:last', scroller));
						$('.scroll-items-container', scroller).css({left: -scrollWidth + 'px' });
						$('.scroll-items-container:not(:animated)', scroller).css({left: 0});
						nextItem.addClass('current');
						currItem = nextItem;
						canScroll = false;
					}
				} else {
					if(currI < nextI){
						targetX = scrollWidth;
					} else {
						targetX = -scrollWidth;
					}

					if(direction){
						switch(direction){
							case 'next':
								targetX = scrollWidth;
								break;
							case 'prev':
								targetX = -scrollWidth;
								break;
						}
					}
					if(!firstLoad){
						currItem.animate({'left': -targetX}, options.duration, options.easing, function(){
							$(this).removeClass('current');
						});
						nextItem.css({'left': targetX}).addClass('current').animate({'left': 0}, options.duration, options.easing, function(){
							currItem = nextItem;
							canScroll = false;
						});
					} else {
						nextItem.addClass('current');
						currItem = nextItem;
						canScroll = false;
					}
				}
				
				$('.scroller-pagination li', scroller).removeClass('current');
				$('.scroller-pagination li a[data-id='+nextItem.data('id')+']', scroller).parent().addClass('current');
				
				if(options.resize){
					scroller.animate({height: nextItem.outerHeight()});
				}
				scroller.trigger('onChange', [nextItem]);
				
			}
		}
		
		function gotoNextItem(){
			var nextItem = currItem.next();
			if(nextItem.length === 0){
				nextItem = $('.scroll-item:eq(0)', scroller);
			}
			gotoItem(nextItem.data('id'), 'next');
		}
		
		function gotoPrevItem(){
			var prevItem = currItem.prev();
			if(prevItem.length === 0){
				var lastI = totalItems - 1;
				prevItem = $('.scroll-item:eq('+lastI+')', scroller);
			}
			gotoItem(prevItem.data('id'), 'prev');
		}
		
		function init(){
			if(totalItems > 1){
				$('.scroll-item', scroller).hover(function(){
					if($(this).data('id') == currItem.prev().data('id')){
						$('.prev-btn', scroller).addClass('hover');
					} else if($(this).data('id') == currItem.next().data('id')){
						$('.next-btn', scroller).addClass('hover');
					}
				}, function(){
					$('.prev-btn', scroller).removeClass('hover');
					$('.next-btn', scroller).removeClass('hover');
				});

				$('.scroll-item', scroller).on('click', function(){
					gotoItem($(this).data('id'));
				});

				$('.scroller-pagination a', scroller).on('click', function(){
					gotoItem($(this).data('id'));
				});
				
				$('.prev-btn', scroller).on('click', gotoPrevItem);
				
				$('.next-btn', scroller).on('click', gotoNextItem);

				scroller.on('swiperight swiperightup swiperightdown', gotoPrevItem);
				scroller.on('swipeleft swipeleftup swipeleftdown', gotoNextItem);


				if(options.autoScroll){
					var scrollInterval;
					scroller.hover(function(){
						canAutoScroll = false;
					}, function(){
						canAutoScroll = true;
					});
					scrollInterval = setInterval(function(){
						if(canAutoScroll){
							gotoNextItem();
						}
					}, 4000);
				}
				var initId = currItem.data('id');
				gotoItem(initId);
			} else {
				$('.scroller-navigation', scroller).hide();
				$('.scroller-pagination', scroller).hide();
			}

			$(window).load(function(){
				if(options.resize){
					scroller.animate({height: currItem.outerHeight()});
				}
			});
			
			firstLoad = false;
		}
		
		init();
		return scroller;
	};
});