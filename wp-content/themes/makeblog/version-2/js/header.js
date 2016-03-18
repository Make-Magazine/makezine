$(document).ready(function () {
	var isiPhone = navigator.userAgent.toLowerCase().indexOf("iphone");
	var $searchFocus = -1;
	var $counter;
	if(window.navigator.userAgent.indexOf("Chrome") > 0){
		$window = $(window).width() + 17;
	}else {
		$window = $(window).width() ;
	}
	if ($window >= '768') {
		$counter = 0;
	} else {
		$counter = 1;
	}
	$bodyHeight = $(window).height();
	$(window).scroll(function () {
		$(window).resize(function () {
			$window = $(window).width() + 17;
		});
		var scrollTop = $(window).scrollTop();
		$bodyHeight = scrollTop + $(window).height();
		if ($window >= '481') {
			$(window).resize(function () {
				$window = $(window).width() + 17;
			});

			if (scrollTop >= '54') {
				$('.menu-item-has-children').children("a").removeClass("active-button");
				$('.navbar-default .navbar-nav > li:first-child').removeClass('first-child');
				if ($('.dynamic-header-posts').hasClass('sticky-header')) {
					$('.dynamic-header-posts').slideUp('fast');
					$('.minify.sticky').css('margin-top', '0px');
				} else {
					$('.dynamic-header-posts').hide();
				}
				window.setTimeout(function () {
					$('.latest-projects').hide().removeClass('nav-transition');
					$('.latest-stories').hide().removeClass('nav-transition');
					$('.latest-events').hide().removeClass('nav-transition');
					$('.latest-shop').hide().removeClass('nav-transition');
					$('.dynamic-header-content').children().removeClass('moove-left moove-right');
					$('.menu-sub-menu > .sub-menu').hide().removeClass('nav-transition');
					$('.menu-sub-menu > .sub-menu').removeClass('moove-left moove-right');
				}, 0);
				$('.menu-item-has-children').addClass('first-hover');

				$('.container.header').addClass('width');
				$('.navbar-default').addClass('sticky-header');
				$('.dynamic-header-posts').addClass('sticky-header');
				if ($('.header').hasClass('tablet')) {
					$('input.search-field').bind('focusin focus', function (e) {
						window.scrollTo(0, 0);
						document.body.scrollTop = 0;
						$searchFocus = 1;

					});
					$('input.search-field').focusout(function () {
						$(".container.header.width").css("position", "");
						$(".container.header.width").css("margin-top", "");
						$searchFocus = 0;
					});
					if ($searchFocus == 1) {
						$(".container.header.width").css("margin-top", scrollTop);
						$(".container.header.width").css("position", 'absolute');
					}
				}
				if ($('#wpadminbar').height() > 0) {
					$(window).resize(function () {
						$window = $(window).width() + 17;
						if (($window >= '601') && ($window <= '782')) {
							$('.container.header.width').css('top', '46px');
							$('.minify.sticky').css('top', '97px');
							$('.navigator.open.sticky').css('top', '97px');
							$('.dynamic-header-posts.sticky-header').css('top', '95px');
						} else if ($window >= '783') {
							$('.container.header.width').css('top', '32px');
							$('.minify.sticky').css('top', '84px');
							$('.navigator.open.sticky').css('top', '84px');
							$('.dynamic-header-posts.sticky-header').css('top', '82px');
						} else if ($window <= '600') {
							$('.container.header.width').css('top', '0px');
							$('.minify.sticky').css('top', '52px');
							$('.navigator.open.sticky').css('top', '52px');
							$('.dynamic-header-posts.sticky-header').css('top', '50px');
						}
					});
					if (($window >= '601') && ($window <= '782')) {
						$('.container.header.width').css('top', '46px');
						$('.minify.sticky').css('top', '97px');
						$('.navigator.open.sticky').css('top', '97px');
						$('.dynamic-header-posts.sticky-header').css('top', '95px');
					} else if ($window >= '783') {
						$('.container.header.width').css('top', '32px');
						$('.minify.sticky').css('top', '84px');
						$('.navigator.open.sticky').css('top', '84px');
						$('.dynamic-header-posts.sticky-header').css('top', '82px');
					} else if ($window <= '600') {
						$('.container.header.width').css('top', '0px');
						$('.minify.sticky').css('top', '52px');
						$('.navigator.open.sticky').css('top', '52px');
						$('.dynamic-header-posts.sticky-header').css('top', '50px');

					}
				}
				else {
					$(window).resize(function () {
						$window = $(window).width() + 17;
					});
					if ($window >= '481') {
						$('.minify.sticky').css('top', '52px');
						$('.navigator.open.sticky').css('top', '52px');
						$('.dynamic-header-posts.sticky-header').css('top', '50px');
					}
				}
				if ($('.menu-item-has-children > a').hasClass('active-button')) {
					$('.minify.sticky').css('margin-top', '36px');
				}
				$('.menu-item-has-children a').addClass('sticky-a');
			} else {
				$('.container.header').removeClass('width');
				$('.navbar-default').removeClass('sticky-header');
				$('.menu-item-has-children a').removeClass('sticky-a');
				$('.dynamic-header-posts').removeClass('sticky-header').css('top', 'inherit');
				$('.navigator').css('top', '');
				$('.navbar-default').css('top', '0px');
				$('.menu-item-has-children > a').removeClass("active-sticky");
				$('.project-navigation').css('margin-top', '0px');
				$('.second-nav').removeClass("displayNav");
				if ($('.header').hasClass('tablet')) {
					$(".container.header").css("position", "");
					$(".container.header").css("margin-top", "");
					$(".container.header").css("top", "");
				}
			}
			if (scrollTop >= '55') {
				$('.header-wrapper').addClass('mobile-sticky');
			} else {
				$('.header-wrapper').removeClass('mobile-sticky');
			}
		}

		if ($window <= '767') {
			if (scrollTop >= '55') {
				$('.header-wrapper').addClass('mobile-sticky');
			} else {
				$('.header-wrapper').removeClass('mobile-sticky');
			}
		}
	});

	if(window.navigator.userAgent.indexOf("Chrome") > 0){
		$window = $(window).width() + 17;
	}else {
		$window = $(window).width() ;
	}
	if ($window <= '767') {
		$deviceHeight = $(window).height();
		$('.menu-container').css('height', $deviceHeight);
	}
	$(window).resize(function () {
		if(window.navigator.userAgent.indexOf("Chrome") > 0){
			$window = $(window).width() + 17;
		}else {
			$window = $(window).width() ;
		}
		$('.menu-container').css('overflow-y', 'inherit');
		$('body').css('overflow-y', '');
		$('body').css('height', '');
		if ($window <= '767') {
			$('.menu-item-has-children').addClass('first-hover');
			if ($counter == '0') {
				$('div.navbar-collapse').hide();
				$counter = 1;
			}
			$deviceHeight = $(window).height();
			$('.menu-container').css('height', $deviceHeight);
			$('.dynamic-header-posts').hide();
		} else {
			if ($counter == '1') {
				$('div.navbar-collapse').show();
				$('.dynamic-header-posts').hide();
				$('li a').removeClass('active-button');
				$(".menu-item-has-children .sub-menu").hide();
				$counter = 0;
			}
			$('.menu-container').css('height', 'inherit');
			$('.menu-container').css('margin-left', '');
			$('.get-dark').removeClass('show');
			$('.navbar-default .navbar-toggle').removeClass('close-background');
			$('.navbar-default .navbar-toggle .icon-bar').removeClass('hide-background');
		}
	});

	// Title Attribute
	$('#menu-make-main > li').each(function (index) {
		if ($(this).hasClass('menu-item-has-children')) {
			var $title = $(this).children('a').attr('title');
			$(this).addClass($title);
			$menu_content = $(this).find('.sub-menu');
			if ($title == "Projects") {
				$($menu_content).addClass('projects');
			}
			if ($title == "Stories") {
				$($menu_content).addClass('stories');
			}
			$(this).children('a').attr('title', '');
			$($menu_content).clone().appendTo('.menu-sub-menu');
		} else {
			$('.menu-sub-menu').append('<ul class="sub-menu"></ul>');
		}
	});

	if ($window <= '767') {
		$deviceHeight = $(window).height();
		$('.menu-container').css('height', $deviceHeight);
	}
	$('.menu-item-has-children').children("a").click(function (e) {
		if(window.navigator.userAgent.indexOf("Chrome") > 0){
			$window = $(window).width() + 17;
		}else {
			$window = $(window).width() ;
		}
		if ($window <= '767') {
			e.preventDefault();
			$(".menu-item-has-children").not($($(this).parent().get(0))).find('.sub-menu').slideUp('slow');
			$($(this).parent().get(0)).find('.sub-menu').slideToggle('slow');
			$(".menu-item-has-children").not($($(this).parent().get(0))).children("a").removeClass("active-button");
			$(this).toggleClass("active-button");
		}
	});

	// Mobile
	$('.navbar-toggle').on('click', function () {
		$('.get-dark').css('height', $bodyHeight);
		$('.navbar-default .navbar-toggle').toggleClass('close-background');
		$('.navbar-default .navbar-toggle .icon-bar').toggleClass('hide-background');
		if (!$('.get-dark').hasClass('show')) {
			window.setTimeout(function () {
				$('.menu-container').addClass('scroll');
			}, 600);
			$('body').css('overflow-y', 'hidden');
			$('body').css('height', $bodyHeight);
			$('.navbar-default .navbar-collapse').show();
			$('.get-dark').addClass('show');
			$('.get-dark').animate({
				opacity: 0.5
			}, 250, function () {
			});
			$('.tablet .minify.sticky').hide();
			$('.menu-container').css('margin-left', '0');
			$('.sumome-share-client-wrapper.sumome-share-client-wrapper-mobile-bottom-bar').css('display', 'none');
		} else {
			$('body').css('overflow-y', '');
			$('body').css('height', '');
			$('.menu-container').css('margin-left', '-100%').removeClass('scroll');
			$('.get-dark').removeClass('show');
			$('.tablet .minify.sticky').show('250').css('overflow', 'inherit');
		}
	});

	// Search
	var $searchText = 0;
	$(".search-field").keyup(function () {
		$searchText = $(this).val();
	});
	$(".search-form").submit(function (event) {
		if ($searchText == 0) {
			event.preventDefault();
		}
	});
	$('.close-search').on('click', function () {
		$('.search-bar input.search-field[type="search"]').toggleClass('search-click');
		$('.close-search').toggleClass('change-background');
	});

	// Mobile
	$('.get-dark').on('click', function () {
		$('body').css('overflow-y', '');
		$('body').css('height', '');
		$('.get-dark').animate({
			opacity: 0
		}, 250, function () {
			$(this).removeClass('show');
		});
		$('.menu-container').removeClass('scroll').css('margin-left', '-100%');
		$('.navbar-default .navbar-toggle').removeClass('close-background');
		$('.navbar-default .navbar-toggle .icon-bar').removeClass('hide-background');
		$('.tablet .minify.sticky').show('250').css('overflow', 'inherit');
		$('.sumome-share-client-wrapper.sumome-share-client-wrapper-mobile-bottom-bar').css('display', '');
	});
	if (isiPhone > -1) {
		$(window).scroll(function () {
			function screenHeight() {
				return window && window.innerHeight || $(window).height();
			}

			$screenHeight = screenHeight();
			var scrollTop = $(window).scrollTop();
			if (scrollTop > 50) {
				$screenHeight = $screenHeight + 70;
				$('.menu-container').css('height', $screenHeight);
			} else {
				$('.menu-container').css('height', $screenHeight);
			}
		});
	}

	$('.search-field').attr('title', '');
	$('.menu-item-has-children').addClass('first-hover');
	$(document).on('mouseenter', '.menu-item-has-children', function (e) {
		if(window.navigator.userAgent.indexOf("Chrome") > 0){
			$window = $(window).width() + 17;
		}else {
			$window = $(window).width() ;
		}
		if ($window >= '768') {
			$('.navbar-default .navbar-nav > li:first-child').addClass('first-child');
			e.preventDefault();
			$('.menu-item-has-children').not($(this)).children("a").removeClass('active-button');
			$index = $(this).index();
			$item_name = $(this).children('a').attr('title');
			$('#menu-make-main > li').each(function (index) {
				if ($(this).hasClass('menu-item-has-children')) {
					$item_title = $(this).children('a').attr('title');
					switch(true){
						case $(this).hasClass('Projects'):
							$dynamic_content = '.latest-projects';
							break;
						case $(this).hasClass('Stories'):
							$dynamic_content = '.latest-stories';
							break;
						case $(this).hasClass('Events'):
							$dynamic_content = '.latest-events';
							break;
						case $(this).hasClass('Shop'):
							$dynamic_content = '.latest-shop';
							break;
					}
					if (index < $index) {
						$($dynamic_content).removeClass('moove-right').addClass('moove-left').css('visibility', 'hidden');
					} else if (index > $index) {
						$($dynamic_content).removeClass('moove-left').addClass('moove-right').css('visibility', 'hidden');
					} else {
						$($dynamic_content).removeClass('moove-left moove-right').css('visibility', '');
					}
				}
			});
			$('.menu-sub-menu > .sub-menu').each(function (index) {
				if (index < $index) {
					$(this).removeClass('moove-right').addClass('moove-left').css('visibility', 'hidden');
				} else if (index > $index) {
					$(this).removeClass('moove-left').addClass('moove-right').css('visibility', 'hidden');
				} else {
					$(this).removeClass('moove-left moove-right').css('visibility', '');
				}
			});
			$('.menu-sub-menu > .sub-menu').addClass('nav-transition');
			if ($(this).hasClass('first-hover')) {
				$('.menu-sub-menu > .sub-menu').removeClass('nav-transition');
				$('.menu-item-has-children').removeClass('first-hover');
				$('.dynamic-header-posts').slideDown('fast');
				$('.latest-projects').show();
				$('.latest-stories').show();
				$('.latest-events').show();
				$('.latest-shop').show();
				$('.menu-sub-menu > .sub-menu').show();
			} else {
				$('.latest-projects').addClass('nav-transition');
				$('.latest-stories').addClass('nav-transition');
				$('.latest-events').addClass('nav-transition');
				$('.latest-shop').addClass('nav-transition');
			}
			if (!$(this).children("a").hasClass('active-button')) {
				$(this).children("a").addClass("active-button");
				$('.minify.sticky').css('margin-top', '198px');
				$('.minify.sticky').css('transition-delay', '0s');
			} else {
				$(this).children("a").removeClass("active-button");
				$('.navbar-default .navbar-nav > li:first-child').removeClass('first-child');
				$('.dynamic-header-posts').slideUp('fast');
				window.setTimeout(function () {
					$('.latest-projects').hide().removeClass('nav-transition');
					$('.latest-stories').hide().removeClass('nav-transition');
					$('.latest-events').hide().removeClass('nav-transition');
					$('.latest-shop').hide().removeClass('nav-transition');
					$('.dynamic-header-content').children().removeClass('moove-left moove-right');
					$('.menu-sub-menu > .sub-menu').hide().removeClass('nav-transition moove-left moove-right');
				}, 0);
				$('.menu-item-has-children').addClass('first-hover');
				if (!$('.menu-item-has-children > a').hasClass('active-button')) {
					$('.minify.sticky').css('margin-top', '0px');
				}
			}
		}
	});

	// Closees nav on mouseleave
	$('#menu-make-main, .dynamic-header-posts').on('mouseleave', function (e) {
		window.setTimeout(function () {
			$window = $(window).width() + 17;
			if (($window >= '768') && (!$('.dynamic-header-posts').is(':hover')) && (!$('#menu-make-main').is(':hover'))) {
				$('.minify.sticky').css('margin-top', '0px');
				$('.menu-item-has-children').children("a").removeClass("active-button");
				$('.dynamic-header-posts').slideUp('fast');
				$('.navbar-default .navbar-nav > li:first-child').removeClass('first-child');
				$('.latest-projects').hide().removeClass('nav-transition');
				$('.latest-stories').hide().removeClass('nav-transition');
				$('.latest-events').hide().removeClass('nav-transition');
				$('.latest-shop').hide().removeClass('nav-transition');
				$('.dynamic-header-content').children().removeClass('moove-left moove-right');
				$('.menu-sub-menu > .sub-menu').hide().removeClass('nav-transition moove-left moove-right');
				$('.menu-item-has-children').addClass('first-hover');
			}
		}, 100);
	});

	// Tablet
	if ($('.header').hasClass('tablet')) {
		$('body').bind("touchstart", function (e) {
			$window = $(window).width() + 17;
			if ($window >= '768') {
				var dynamicContainer = $(".dynamic-header-posts");
				var headerContainer = $(".navbar-nav");
				if ((dynamicContainer.has(e.target).length === 0) && (headerContainer.has(e.target).length === 0)) {
					$('.minify.sticky').css('margin-top', '0px');
					$('.menu-item-has-children').children("a").removeClass("active-button");
					$('.dynamic-header-posts').slideUp('fast');
					$('.navbar-default .navbar-nav > li:first-child').removeClass('first-child');
					window.setTimeout(function () {
						$('.latest-projects').hide().removeClass('nav-transition');
						$('.latest-stories').hide().removeClass('nav-transition');
						$('.latest-events').hide().removeClass('nav-transition');
						$('.latest-shop').hide().removeClass('nav-transition');
						$('.dynamic-header-content').children().removeClass('moove-left moove-right');
						$('.menu-sub-menu > .sub-menu').hide().removeClass('nav-transition moove-left moove-right');
					}, 0);
					$('.menu-item-has-children').addClass('first-hover');
				}
			}
		});
	}
});