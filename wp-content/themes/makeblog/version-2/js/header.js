 $( document ).ready(function() {
	 $('.menu-item-has-children').each(function () {
		 $li_item_name = $(this).children('a').attr('title');
		 $(this).addClass($li_item_name);
	 });
	 $window = $(window).width() + 17;
	$(window).scroll(function(){
		$( window ).resize(function() {
			$window = $(window).width() + 17;
		});
		var scrollTop = $(window).scrollTop();
		if ($window >= '481') {
			$( window ).resize(function() {
				$window = $(window).width() + 17;
			});
			if (scrollTop >= '300')  {
				$('.container.header').addClass('width');
				$('.navbar-default').addClass('sticky-header');
				
				if ($('#wpadminbar').height() > 0 ){
					$( window ).resize(function() {
						$window = $(window).width() + 17;
						if (($window >= '601') && ($window <= '782')) {
							$('.container.header.width').css('top','46px');
							$('.minify.sticky').css('top','97px');
						} else if ($window >= '783') {
							$('.container.header.width').css('top','32px');
							$('.minify.sticky').css('top','84px');
						} else if ($window <= '600') {
							$('.container.header.width').css('top','0px');
							$('.minify.sticky').css('top','52px');
						}
					});
					if (($window >= '601') && ($window <= '782')) {
						$('.container.header.width').css('top','46px');
						$('.minify.sticky').css('top','97px');
					} else if ($window >= '783') {
						$('.container.header.width').css('top','32px');
						$('.minify.sticky').css('top','84px');
					} else if ($window <= '600') {
						$('.container.header.width').css('top','0px');
						$('.minify.sticky').css('top','52px');
					}
				}
				else {
					$( window ).resize(function() {
						$window = $(window).width() + 17;
					});
					if ($window >= '481') {
						$('.minify.sticky').css('top','52px');
					}
				}
				if ($('.menu-item-has-children > a').hasClass('active-button')) {
					$('.minify.sticky').css('margin-top','36px');
				}
				$('.menu-item-has-children a').addClass('sticky-a');
			} else {
				$('.container.header').removeClass('width');
				$('.navbar-default').removeClass('sticky-header');
				$('.menu-item-has-children a').removeClass('sticky-a');
				$('.navbar-default').css('top','0px');
				$('.menu-item-has-children > a').removeClass("active-sticky");
				$('.project-navigation').css('margin-top','0px');
				$('.menu-item-has-children').css('width','');
				$('.second-nav').removeClass("displayNav");
			}
			if (scrollTop >= '55'){
				$('.header-wrapper').addClass('mobile-sticky');
			} else {
				$('.header-wrapper').removeClass('mobile-sticky');
			}
		}
		
		if ($window <= '767') {
			if (scrollTop >= '55'){
				$('.header-wrapper').addClass('mobile-sticky');
			} else {
				$('.header-wrapper').removeClass('mobile-sticky');
			}
		}
		
	});




	 
	
	if ($window >= '768') {

		$('.menu-item-has-children').addClass('first-hover');
		$('.menu-item-has-children').mouseover(function (e) {
			e.preventDefault();
			$('.menu-item-has-children').not($(this)).children("a").removeClass('active-button');
			if (!$('.navbar-default').hasClass('sticky-header')) {
				$('.dynamic-header-posts').slideDown('fast');
			}
			if (!$(this).children("a").hasClass('active-button')) {
				$('.minify.sticky').css('margin-top','36px');
				$('.minify.sticky').css('transition-delay','0s');
			}
			var width = $(this)[0].getBoundingClientRect().width;
			$(this).css('width',width);
			$(".menu-item-has-children").not($($(this).get(0))).find('.sub-menu').hide();
			if ($(this).hasClass('first-hover')) {
				$($(this).get(0)).find('.sub-menu').slideDown('fast');
				$('.menu-item-has-children').removeClass('first-hover');
			} else {
				$($(this).get(0)).find('.sub-menu').show();
			}
			$(this).children("a").addClass("active-button");
		}).mouseleave(function(e) {
				if ((!$('.navbar-nav').is(':hover')) && (!$('.dynamic-header-posts').is(':hover'))){
			$(this).children("a").removeClass("active-button");
						$('.dynamic-header-posts').slideUp('fast');
						$(this).find('.sub-menu').slideUp('fast');
					$('.menu-item-has-children').addClass('first-hover');
					if (!$(".menu-item-has-children > a").hasClass('active-button')){
						$('.minify.sticky').css('transition', 'all 0.2s ease');
						$('.minify.sticky').css('margin-top','0px');
					}
				}
		});
		$('.navbar-nav > li').mouseenter(function(e) {
			if (!$(this).hasClass('menu-item-has-children')){
				$('.menu-item-has-children').children("a").removeClass("active-button");
				$('.dynamic-header-posts').slideUp('fast');
				$(".menu-item-has-children").find('.sub-menu').slideUp('fast');
				$('.menu-item-has-children').addClass('first-hover');
				if (!$(".menu-item-has-children > a").hasClass('active-button')){
					$('.minify.sticky').css('margin-top','0px');
				}
			}
		});
	}
	 $('.dynamic-header-posts').mouseleave(function (e) {
		 if (!$('.navbar-nav').is(':hover')){
			 $('.dynamic-header-posts').slideUp('fast');
			 $('.menu-item-has-children').find('.sub-menu').slideUp('fast');
			 $('.menu-item-has-children').children("a").removeClass("active-button");
		 }
	 });
	
	$( window ).resize(function() {
		$window = $(window).width() + 17;
		if ($window >= '768') {
			$('.menu-item-has-children').addClass('first-hover');
			$('.menu-item-has-children').mouseover(function (e) {
			e.preventDefault();
				$('.menu-item-has-children').not($(this)).children("a").removeClass('active-button');
				if (!$('.navbar-default').hasClass('sticky-header')) {
					$('.dynamic-header-posts').slideDown('fast');
				}
			if (!$(this).children("a").hasClass('active-button')) {
				$('.minify.sticky').css('margin-top','36px');
				$('.minify.sticky').css('transition-delay','0s');
			}
			var width = $(this)[0].getBoundingClientRect().width;
			$(this).css('width',width);
			$(".menu-item-has-children").not($($(this).get(0))).find('.sub-menu').hide();
			if ($(this).hasClass('first-hover')) {
				$($(this).get(0)).find('.sub-menu').slideDown('fast');
				$('.menu-item-has-children').removeClass('first-hover');
			} else {
				$($(this).get(0)).find('.sub-menu').show();
			}
			$(this).children("a").addClass("active-button");
		}).mouseleave(function(e) {
				if ((!$('.navbar-nav').is(':hover')) && (!$('.dynamic-header-posts').is(':hover'))){
			$(this).children("a").removeClass("active-button");
					$('.dynamic-header-posts').slideUp('fast');
					$(this).find('.sub-menu').slideUp('fast');
					$('.menu-item-has-children').addClass('first-hover');
					if (!$(".menu-item-has-children > a").hasClass('active-button')){
						$('.minify.sticky').css('transition', 'all 0.2s ease');
						$('.minify.sticky').css('margin-top','0px');
					}
				}
		});
		$('.navbar-nav > li').mouseenter(function(e) {
			if (!$(this).hasClass('menu-item-has-children')){
				$('.menu-item-has-children').children("a").removeClass("active-button");
				$('.dynamic-header-posts').slideUp('fast');
				$(".menu-item-has-children").find('.sub-menu').slideUp('fast');
				$('.menu-item-has-children').addClass('first-hover');
				if (!$(".menu-item-has-children > a").hasClass('active-button')){
					$('.minify.sticky').css('margin-top','0px');
				}
			}
		});
	} else {
		$('.menu-item-has-children').css('width','inherit');
		$('.menu-item-has-children').removeClass('first-hover');
	}
	});
	
	
	$( window ).resize(function() {
			$window = $(window).width() + 17;
		if ($window <= '767') {
			$deviceHeight = $(window).height();
			$('.menu-container').css('height',$deviceHeight);
			$('.menu-container').css('margin-bottom',-$deviceHeight);
		} else {
			$('.menu-container').css('height','inherit');
			$('.menu-container').css('margin-bottom','inherit');
			$('.menu-container').css('margin-left','');
		}
		});
	if ($window <= '767') {
		$deviceHeight = $(window).height();
		$('.menu-container').css('height',$deviceHeight);
		$('.menu-container').css('margin-bottom',-$deviceHeight);
		$('.menu-item-has-children').children("a").click(function (e) {
			e.preventDefault();
			$(".menu-item-has-children").not($($(this).parent().get(0))).find('.sub-menu').slideUp('slow');
			$($(this).parent().get(0)).find('.sub-menu').slideToggle('slow');
			$(".menu-item-has-children").not($($(this).parent().get(0))).children("a").removeClass("active-button");
			$(this).toggleClass("active-button");
			
		});
	 
		
	}
	$('.navbar-toggle').on('click', function(){
			$screenHeight = $('body').height();
			$('.get-dark').css('height',$screenHeight);
			$('.navbar-default .navbar-toggle').toggleClass('close-background');
			$('.navbar-default .navbar-toggle .icon-bar').toggleClass('hide-background');
			$('div.navbar-collapse').toggle(250);
			if (!$('.get-dark').hasClass('show')){
				window.setTimeout(function(){$('.get-dark').addClass('show');}, 250);
				$('.tablet .minify.sticky').hide();
				$('.menu-container').css('overflow-y','scroll');
				$('.menu-container').css('margin-left','0');
			} else {
				$('.menu-container').css('overflow-y','');
				window.setTimeout(function(){$('.menu-container').css('margin-left','-100%');}, 550);
				$('.get-dark').removeClass('show');
				$('.tablet .minify.sticky').show('250');
				$('.tablet .minify.sticky').css('overflow','inherit')
			}
		});
	$('.close-search').on('click', function(){
		$('.search-bar input.search-field[type="search"]').toggleClass('search-click');
		$('.close-search').toggleClass('change-background');
	});
	
	$('.get-dark').on('click', function(){    
		$('.menu-container').css('overflow-y','');
		window.setTimeout(function(){$('.menu-container').css('margin-left','-100%');}, 550);
		$('div.navbar-collapse').toggle(250);
		$('.navbar-default .navbar-toggle').removeClass('close-background');
		$('.navbar-default .navbar-toggle .icon-bar').removeClass('hide-background');
		$(this).removeClass('show');
		$('.tablet .minify.sticky').show('250');
		$('.tablet .minify.sticky').css('overflow','inherit');
	});

});
