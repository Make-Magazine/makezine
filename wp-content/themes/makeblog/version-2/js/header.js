 $( document ).ready(function() {
	 $window = $(window).width();
	 $( window ).resize(function() {
		 $window = $(window).width();
	 });
	$(window).scroll(function(){
		$( window ).resize(function() {
			$window = $(window).width();
		});
		var scrollTop = $(window).scrollTop();
		if ($window >= '481') {
			$( window ).resize(function() {
				$window = $(window).width();
			});
			if (scrollTop >= '300')  {
				$('.container.header').addClass('width');
				$('.navbar-default').addClass('sticky-header');
				
				if ($('#wpadminbar').height() > 0 ){
					$( window ).resize(function() {
						$window = $(window).width();
					});
					if (($window >= '601') && ($window <= '782')) {
						$('.container.header.width').css('top','46px');
						$('.project-navigation.sticky').css('top','97px');
					} else if ($window >= '783') {
						$('.container.header.width').css('top','32px');
						$('.project-navigation.sticky').css('top','84px');
					} else if ($window <= '600') {
						$('.container.header.width').css('top','0px');
						$('.project-navigation.sticky').css('top','52px');
					}
				}
				else {
					$( window ).resize(function() {
						$window = $(window).width();
					});
					if ($window >= '481') {
						$('.project-navigation.sticky').css('top','52px');
					}
				}
				if ($('.menu-item-has-children > a').hasClass('active-button')) {
					$('.project-navigation.sticky').css('margin-top','36px');
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
		}
		
		
	});




	 $( window ).resize(function() {
		 $window = $(window).width();
	 });
	if ($window >= '769') {

	$('.menu-item-has-children').addClass('first-hover');
		$('.menu-item-has-children').mouseover(function (e) {
			$window = $(window).width();
			if ($window >= '769') {
			e.preventDefault();
			if (!$(this).children("a").hasClass('active-button')) {
				$('.project-navigation.sticky').css('margin-top','36px');
				$('.project-navigation.sticky').css('transition-delay','0s');
			}
			var width = $(this)[0].getBoundingClientRect().width;
			$(this).css('width',width);
			$(".menu-item-has-children").not($($(this).get(0))).find('.sub-menu').hide();
			if ($(this).hasClass('first-hover')) {
				$($(this).get(0)).find('.sub-menu').show('fast');
				$('.menu-item-has-children').removeClass('first-hover');
			} else {
				$($(this).get(0)).find('.sub-menu').show();
			}
			$(this).children("a").addClass("active-button");
		}}).mouseleave(function(e) {
			$window = $(window).width();
			if ($window >= '769') {
			$(this).children("a").removeClass("active-button");
					if (!$('.navbar-nav').is(':hover')){
						$(this).find('.sub-menu').hide('fast');
						$('.menu-item-has-children').addClass('first-hover');
						if (!$(".menu-item-has-children > a").hasClass('active-button')){
							$('.project-navigation.sticky').css('transition', 'all 0.2s ease');
							$('.project-navigation.sticky').css('margin-top','0px');
						}
					}
		}});
		$('.navbar-nav > li').mouseleave(function(e) {
			if (!$('.navbar-nav').is(':hover')){
						$(".menu-item-has-children").find('.sub-menu').hide('fast');
						$('.menu-item-has-children').addClass('first-hover');
						if (!$(".menu-item-has-children > a").hasClass('active-button')){
							$('.project-navigation.sticky').css('margin-top','0px');
						}
			}
		});
	}


		$('.menu-item-has-children').children("a").click(function (e) {
			$( window ).resize(function() {
				$window = $(window).width();
			});
			if ($window <= '768') {
			e.preventDefault();
			$(".menu-item-has-children").not($($(this).parent().get(0))).find('.sub-menu').slideUp('slow');
			$($(this).parent().get(0)).find('.sub-menu').slideToggle('slow');
			$(".menu-item-has-children").not($($(this).parent().get(0))).children("a").removeClass("active-button");
			$(this).toggleClass("active-button");
		}
	});
	 $( window ).resize(function() {
		 $window = $(window).width();
	 });
	$('.navbar-toggle').on('click', function(){
		$( window ).resize(function() {
			$window = $(window).width();
		});
		console.log($window, '1');
		if ($window <= '768') {
			console.log($window, '2');
			$screenHeight = $('body').height();
			$('.get-dark').css('height',$screenHeight);
			$('.get-dark').toggleClass('show');
			$('.navbar-default .navbar-toggle').toggleClass('close-background');
			$('.navbar-default .navbar-toggle .icon-bar').toggleClass('hide-background');
		} 
			
		$('div.navbar-collapse').toggle(250);
	});
	
	$('.close-search').on('click', function(){
		$('.search-bar input.search-field[type="search"]').toggleClass('search-click');
		$('.close-search').toggleClass('change-background');
	});
	
	$('.get-dark').on('click', function(){    
		$('div.navbar-collapse').toggle(250);
		$('.navbar-default .navbar-toggle').removeClass('close-background');
		$('.navbar-default .navbar-toggle .icon-bar').removeClass('hide-background');
		$(this).removeClass('show');
	});

});
