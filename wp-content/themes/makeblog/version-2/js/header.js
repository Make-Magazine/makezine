 $( document ).ready(function() {
	 $window = $(window).width() + 17;
	 if ($window >= '768'){
		 $counter = 0;
	 }else {
		 $counter = 1;
	 }
	 $bodyHeight = $(window).height();
	$(window).scroll(function(){
		$( window ).resize(function() {
			$window = $(window).width() + 17;
		});
		var scrollTop = $(window).scrollTop();
		$bodyHeight = scrollTop + $(window).height();
		if ($window >= '481') {
			$( window ).resize(function() {
				$window = $(window).width() + 17;
			});
			if (scrollTop >= '300')  {
				$('.container.header').addClass('width');
				$('.navbar-default').addClass('sticky-header');
				$('.dynamic-header-posts').addClass('sticky-header');
				$('.close-dynamic-content').addClass('sticky-header');
				if ($('#wpadminbar').height() > 0 ){
					$( window ).resize(function() {
						$window = $(window).width() + 17;
						if (($window >= '601') && ($window <= '782')) {
							$('.container.header.width').css('top','46px');
							$('.minify.sticky').css('top','97px');
							$('.dynamic-header-posts.sticky-header').css('top','95px');
							$('.close-dynamic-content.sticky-header').css('margin-top','95px');
						} else if ($window >= '783') {
							$('.container.header.width').css('top','32px');
							$('.minify.sticky').css('top','84px');
							$('.dynamic-header-posts.sticky-header').css('top','82px');
							$('.close-dynamic-content.sticky-header').css('margin-top','82px');
						} else if ($window <= '600') {
							$('.container.header.width').css('top','0px');
							$('.minify.sticky').css('top','52px');
							$('.dynamic-header-posts.sticky-header').css('top','50px');
							$('.close-dynamic-content.sticky-header').css('margin-top','50px');
						}
					});
					if (($window >= '601') && ($window <= '782')) {
						$('.container.header.width').css('top','46px');
						$('.minify.sticky').css('top','97px');
						$('.dynamic-header-posts.sticky-header').css('top','95px');
						$('.close-dynamic-content.sticky-header').css('margin-top','95px');
					} else if ($window >= '783') {
						$('.container.header.width').css('top','32px');
						$('.minify.sticky').css('top','84px');
						$('.dynamic-header-posts.sticky-header').css('top','82px');
						$('.close-dynamic-content.sticky-header').css('margin-top','82px');
					} else if ($window <= '600') {
						$('.container.header.width').css('top','0px');
						$('.minify.sticky').css('top','52px');
						$('.dynamic-header-posts.sticky-header').css('top','50px');
						$('.close-dynamic-content.sticky-header').css('margin-top','50px');

					}
				}
				else {
					$( window ).resize(function() {
						$window = $(window).width() + 17;
					});
					if ($window >= '481') {
						$('.minify.sticky').css('top','52px');
						$('.dynamic-header-posts.sticky-header').css('top','50px');
						$('.close-dynamic-content.sticky-header').css('margin-top','50px');
					}
				}
				if ($('.menu-item-has-children > a').hasClass('active-button')) {
					$('.minify.sticky').css('margin-top','36px');
				}
				$('.menu-item-has-children a').addClass('sticky-a');
			} else {
				$('.close-dynamic-content').removeClass('sticky-header');
				$('.container.header').removeClass('width');
				$('.navbar-default').removeClass('sticky-header');
				$('.menu-item-has-children a').removeClass('sticky-a');
				$('.dynamic-header-posts').removeClass('sticky-header');
				$('.dynamic-header-posts').css('top','inherit');
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

	 $mozilla = $.browser.mozilla ;
	 if ($mozilla == true) {
		 $('.menu-item-has-children').mouseenter(function (e) {
			 $('.close-dynamic-content').show();
		 });
		 $('.navbar-nav').on('mouseleave', function (e) {
			 var div = $(".dynamic-header-posts"),
				 divTop = div.offset().top,
				 divLeft = div.offset().left,
				 divRight = divLeft + div.width(),
				 divBottom = divTop + div.height();
			 mouseX = e.pageX;
			 mouseY = e.pageY;
			 if(!(mouseX >= divLeft && mouseX <= divRight && mouseY >= divTop && mouseY <= divBottom)) {
				 $('.menu-item-has-children > a').removeClass("active-button");
				 $('.menu-item-has-children').find('.sub-menu').slideUp('fast');
				 $('.dynamic-header-posts').slideUp('fast');
				 $('.dynamic-header-content').children().removeClass('moove-left moove-right');
				 $('.close-dynamic-content').hide();
				 $('.latest-projects').hide();
				 $('.latest-stories').hide();
				 $('.latest-events').hide();
				 $('.latest-shop').hide();
				 $('.latest-projects').removeClass('nav-transition');
				 $('.latest-stories').removeClass('nav-transition');
				 $('.latest-events').removeClass('nav-transition');
				 $('.latest-shop').removeClass('nav-transition');
				 $('.menu-sub-menu > .sub-menu').removeClass('nav-transition');
				 $('.menu-sub-menu > .sub-menu').hide();
				 $('.menu-sub-menu > .sub-menu').removeClass('moove-left moove-right');
				 $('.navbar-default .navbar-nav > li:first-child').removeClass('first-child');
				 $('.menu-item-has-children').addClass('first-hover');
			 }

		 });
		 $('.close-dynamic-content').on('hover', function() {
			 $('.menu-item-has-children > a').removeClass("active-button");
			 $('.menu-item-has-children').find('.sub-menu').slideUp('fast');
			 $('.dynamic-header-posts').slideUp('fast');
			 $('.dynamic-header-content').children().removeClass('moove-left moove-right');
			 $('.close-dynamic-content').hide();
			 $('.latest-projects').hide();
			 $('.latest-stories').hide();
			 $('.latest-events').hide();
			 $('.latest-shop').hide();
			 $('.latest-projects').removeClass('nav-transition');
			 $('.latest-stories').removeClass('nav-transition');
			 $('.latest-events').removeClass('nav-transition');
			 $('.latest-shop').removeClass('nav-transition');
			 $('.menu-sub-menu > .sub-menu').removeClass('nav-transition');
			 $('.menu-sub-menu > .sub-menu').hide();
			 $('.menu-sub-menu > .sub-menu').removeClass('moove-left moove-right');
			 $('.navbar-default .navbar-nav > li:first-child').removeClass('first-child');
			 $('.menu-item-has-children').addClass('first-hover');
			 $('.minify.sticky').css('transition', 'all 0.2s ease');
			 $('.minify.sticky').css('margin-top', '0px');
		 });
		 $('.menu-item-has-children').mouseleave(function (e) {
			 var div = $(".dynamic-header-posts"),
				 divTop = div.offset().top,
				 divLeft = div.offset().left,
				 divRight = divLeft + div.width(),
				 divBottom = divTop + div.height();
			 mouseX = e.pageX;
			 mouseY = e.pageY;
			 if(!(mouseX >= divLeft && mouseX <= divRight && mouseY >= divTop && mouseY <= divBottom)) {
				 if ($('.navbar-default').hasClass('sticky-header')) {
					 $('.menu-item-has-children > a').removeClass("active-button");
					 $('.menu-item-has-children').find('.sub-menu').slideUp('fast');
					 $('.close-dynamic-content').hide();
					 $('.dynamic-header-content').children().removeClass('moove-left moove-right');
					 $('.close-dynamic-content').hide();
					 $('.latest-projects').hide();
					 $('.latest-stories').hide();
					 $('.latest-events').hide();
					 $('.latest-shop').hide();
					 $('.latest-projects').removeClass('nav-transition');
					 $('.latest-stories').removeClass('nav-transition');
					 $('.latest-events').removeClass('nav-transition');
					 $('.latest-shop').removeClass('nav-transition');
					 $('.menu-sub-menu > .sub-menu').removeClass('nav-transition');
					 $('.menu-sub-menu > .sub-menu').hide();
					 $('.menu-sub-menu > .sub-menu').removeClass('moove-left moove-right');
					 $('.navbar-default .navbar-nav > li:first-child').removeClass('first-child');
					 $('.menu-item-has-children').addClass('first-hover');
					 $('.minify.sticky').css('transition', 'all 0.2s ease');
					 $('.minify.sticky').css('margin-top', '0px');
				 }
			 }
		 });

	 }
	 $('#menu-make-main > li').each(function(index){
		 if ($(this).hasClass('menu-item-has-children')) {
			 $menu_content = $(this).find('.sub-menu');
			 $($menu_content).clone().appendTo('.menu-sub-menu');
		 }else {
			 $('.menu-sub-menu').append('<ul class="sub-menu"></ul>');
		 }
	 });
	if ($window >= '768') {
		$('.menu-item-has-children').addClass('first-hover');
		$('.menu-item-has-children').mouseover(function (e) {
			$('.navbar-default .navbar-nav > li:first-child').addClass('first-child');
			e.preventDefault();
			$('.menu-item-has-children').not($(this)).children("a").removeClass('active-button');
				$index = $(this).index();
				$item_name = $(this).children('a').attr('title');
			if (!$('.dynamic-header-posts').hasClass('sticky-header')) {
				$('#menu-make-main > li').each(function (index) {
					if ($(this).hasClass('menu-item-has-children')) {
						$item_title = $(this).children('a').attr('title');
						if ($item_title == 'Projects') {
							$dynamic_content = '.latest-projects';
						} else if ($item_title == 'Stories') {
							$dynamic_content = '.latest-stories';
						} else if ($item_title == 'Events') {
							$dynamic_content = '.latest-events';
						} else if ($item_title == 'Shop') {
							$dynamic_content = '.latest-shop';
						}
						if (index < $index) {
							$($dynamic_content).addClass('moove-left');
						} else if (index > $index) {
							$($dynamic_content).addClass('moove-right');
						} else {
							$($dynamic_content).removeClass('moove-left moove-right');
						}
					}
				});
			}
				$('.menu-sub-menu > .sub-menu').each(function(index){
					if (index < $index ){
						$(this).addClass('moove-left');
					}else if (index > $index){
						$(this).addClass('moove-right');
					}else{
						$(this).removeClass('moove-left moove-right');
					}
				});
			if (!$('.dynamic-header-posts').hasClass('sticky-header')) {
				if ($item_name == 'Projects') {
					$('.latest-projects').show();
				} else if ($item_name == 'Stories') {
					$('.latest-stories').show();
				} else if ($item_name == 'Events') {
					$('.latest-events').show();
				} else if ($item_name == 'Shop') {
					$('.latest-shop').show();
				}
			}
			if (!$(this).children("a").hasClass('active-button')) {
				$('.minify.sticky').css('margin-top','36px');
				$('.minify.sticky').css('transition-delay','0s');
			}
			if ($(this).hasClass('first-hover')) {
				$('.menu-item-has-children').removeClass('first-hover');
				$('.dynamic-header-posts').slideDown('fast');
				if (!$('.dynamic-header-posts').hasClass('sticky-header')) {
					$('.latest-projects').show();
					$('.latest-stories').show();
					$('.latest-events').show();
					$('.latest-shop').show();
				}
				$('.menu-sub-menu > .sub-menu').show();

			}else {
				if (!$('.dynamic-header-posts').hasClass('sticky-header')) {
					$('.latest-projects').addClass('nav-transition');
					$('.latest-stories').addClass('nav-transition');
					$('.latest-events').addClass('nav-transition');
					$('.latest-shop').addClass('nav-transition');
				}
				$('.menu-sub-menu > .sub-menu').addClass('nav-transition');
			}
			$(this).children("a").addClass("active-button");


		}).mouseleave(function(e) {
				if ((!$('.navbar-nav').is(':hover')) && (!$('.dynamic-header-posts').is(':hover'))){
					if ($mozilla != true ) {
						$(this).children("a").removeClass("active-button");
						$('.dynamic-header-content').children().removeClass('moove-left moove-right');
						$('.navbar-default .navbar-nav > li:first-child').removeClass('first-child');
						$('.dynamic-header-posts').slideUp('fast');
						$('.latest-projects').hide();
						$('.latest-stories').hide();
						$('.latest-events').hide();
						$('.latest-shop').hide();
						$('.latest-projects').removeClass('nav-transition');
						$('.latest-stories').removeClass('nav-transition');
						$('.latest-events').removeClass('nav-transition');
						$('.latest-shop').removeClass('nav-transition');
						$('.menu-sub-menu > .sub-menu').removeClass('nav-transition');
						$('.menu-sub-menu > .sub-menu').hide();
						$('.menu-sub-menu > .sub-menu').removeClass('moove-left moove-right');
						$('.menu-item-has-children').addClass('first-hover');
						if (!$(".menu-item-has-children > a").hasClass('active-button')){
							$('.minify.sticky').css('transition', 'all 0.2s ease');
							$('.minify.sticky').css('margin-top','0px');
						}
					}

				}
		});

		$('.navbar-nav > li').mouseenter(function(e) {
			if (!$(this).hasClass('menu-item-has-children')){
				$('.menu-item-has-children').children("a").removeClass("active-button");
				$('.dynamic-header-posts').slideUp('fast');
				$('.dynamic-header-content').children().removeClass('moove-left moove-right');
				$('.navbar-default .navbar-nav > li:first-child').removeClass('first-child');
				$('.latest-projects').hide();
				$('.latest-stories').hide();
				$('.latest-events').hide();
				$('.latest-shop').hide();
				$('.latest-projects').removeClass('nav-transition');
				$('.latest-stories').removeClass('nav-transition');
				$('.latest-events').removeClass('nav-transition');
				$('.latest-shop').removeClass('nav-transition');
				$('.menu-sub-menu > .sub-menu').removeClass('nav-transition');
				$('.menu-sub-menu > .sub-menu').hide();
				$('.menu-sub-menu > .sub-menu').removeClass('moove-left moove-right');
				$('.menu-item-has-children').addClass('first-hover');
				if (!$(".menu-item-has-children > a").hasClass('active-button')){
					$('.minify.sticky').css('margin-top','0px');
				}
			}
		});
	}
	 if ($mozilla != true ) {
		 $('.dynamic-header-posts').mouseleave(function (e) {
			 if (!$('.navbar-nav').is(':hover')) {
				 $('.dynamic-header-posts').slideUp('fast');
				 $('.latest-projects').hide();
				 $('.latest-stories').hide();
				 $('.latest-events').hide();
				 $('.latest-shop').hide();
				 $('.latest-projects').removeClass('nav-transition');
				 $('.latest-stories').removeClass('nav-transition');
				 $('.latest-events').removeClass('nav-transition');
				 $('.latest-shop').removeClass('nav-transition');
				 $('.menu-sub-menu > .sub-menu').removeClass('nav-transition');
				 $('.menu-sub-menu > .sub-menu').hide();
				 $('.menu-sub-menu > .sub-menu').removeClass('moove-left moove-right');
				 $('.navbar-default .navbar-nav > li:first-child').removeClass('first-child');
				 //$('.menu-item-has-children').find('.sub-menu').slideUp('fast');
				 $('.menu-item-has-children').children("a").removeClass("active-button");
				 $('.menu-item-has-children').addClass('first-hover');
				 if (!$(".menu-item-has-children > a").hasClass('active-button')){
					 $('.minify.sticky').css('transition', 'all 0.2s ease');
					 $('.minify.sticky').css('margin-top','0px');
				 }
			 }

		 });
	 }
	$( window ).resize(function() {
		$window = $(window).width() + 17;
		if ($window >= '768') {
			$('.menu-item-has-children').addClass('first-hover');
			$('.menu-item-has-children').mouseover(function (e) {
				$('.navbar-default .navbar-nav > li:first-child').addClass('first-child');
				e.preventDefault();
				$('.menu-item-has-children').not($(this)).children("a").removeClass('active-button');
				if (!$('.navbar-default').hasClass('sticky-header')) {
					$index = $(this).index();
					$item_name = $(this).children('a').attr('title');
					$('#menu-make-main > li').each(function(index){
						if ($(this).hasClass('menu-item-has-children')) {
							$item_title = $(this).children('a').attr('title');
							if ($item_title == 'Projects') {
								$dynamic_content = '.latest-projects';
							} else if ($item_title == 'Stories') {
								$dynamic_content = '.latest-stories';
							} else if ($item_title == 'Events') {
								$dynamic_content = '.latest-events';
							} else if ($item_title == 'Shop') {
								$dynamic_content = '.latest-shop';
							}
							if (index < $index) {
								$($dynamic_content).addClass('moove-left');
							} else if (index > $index) {
								$($dynamic_content).addClass('moove-right');
							} else {
								$($dynamic_content).removeClass('moove-left moove-right');
							}
						}
					});
					$('.menu-sub-menu > .sub-menu').each(function(index){
						if (index < $index ){
							$(this).addClass('moove-left');
						}else if (index > $index){
							$(this).addClass('moove-right');
						}else{
							$(this).removeClass('moove-left moove-right');
						}
					});
					if ($item_name == 'Projects') {
						$('.latest-projects').show();
					} else if ($item_name == 'Stories') {
						$('.latest-stories').show();
					} else if ($item_name == 'Events') {
						$('.latest-events').show();
					} else if ($item_name == 'Shop') {
						$('.latest-shop').show();
					}
				}
				if (!$(this).children("a").hasClass('active-button')) {
					$('.minify.sticky').css('margin-top','36px');
					$('.minify.sticky').css('transition-delay','0s');
				}
				$(".menu-item-has-children").not($($(this).get(0))).find('.sub-menu').hide();
				if ($(this).hasClass('first-hover')) {
					$($(this).get(0)).find('.sub-menu').slideDown('fast');
					$('.menu-item-has-children').removeClass('first-hover');
					$('.dynamic-header-posts').slideDown('fast');
					$('.latest-projects').show();
					$('.latest-stories').show();
					$('.latest-events').show();
					$('.latest-shop').show();
					$('.menu-sub-menu > .sub-menu').show();
				}else {
					$($(this).get(0)).find('.sub-menu').show();
					$('.latest-projects').addClass('nav-transition');
					$('.latest-stories').addClass('nav-transition');
					$('.latest-events').addClass('nav-transition');
					$('.latest-shop').addClass('nav-transition');
					$('.menu-sub-menu > .sub-menu').addClass('nav-transition');
				}
				$(this).children("a").addClass("active-button");


			}).mouseleave(function(e) {
				if ((!$('.navbar-nav').is(':hover')) && (!$('.dynamic-header-posts').is(':hover'))){
					if ($mozilla != true ) {
						$(this).find('.sub-menu').slideUp('fast');
						$(this).children("a").removeClass("active-button");
						$('.dynamic-header-content').children().removeClass('moove-left moove-right');
						$('.navbar-default .navbar-nav > li:first-child').removeClass('first-child');
						$('.dynamic-header-posts').slideUp('fast');
						$('.latest-projects').hide();
						$('.latest-stories').hide();
						$('.latest-events').hide();
						$('.latest-shop').hide();
						$('.latest-projects').removeClass('nav-transition');
						$('.latest-stories').removeClass('nav-transition');
						$('.latest-events').removeClass('nav-transition');
						$('.latest-shop').removeClass('nav-transition');
						$('.menu-sub-menu > .sub-menu').removeClass('nav-transition');
						$('.menu-sub-menu > .sub-menu').hide();
						$('.menu-sub-menu > .sub-menu').removeClass('moove-left moove-right');
						$('.menu-item-has-children').addClass('first-hover');
					}
					if (!$(".menu-item-has-children > a").hasClass('active-button')){
						$('.minify.sticky').css('transition', 'all 0.2s ease');
						$('.minify.sticky').css('margin-top','0px');
					}
				}
			});

			$('.navbar-nav > li').mouseenter(function(e) {
				if (!$(this).hasClass('menu-item-has-children')){
					$(".menu-item-has-children").find('.sub-menu').slideUp('fast');
					$('.menu-item-has-children').children("a").removeClass("active-button");
					$('.dynamic-header-posts').slideUp('fast');
					$('.dynamic-header-content').children().removeClass('moove-left moove-right');
					$('.navbar-default .navbar-nav > li:first-child').removeClass('first-child');
					$('.latest-projects').hide();
					$('.latest-stories').hide();
					$('.latest-events').hide();
					$('.latest-shop').hide();
					$('.latest-projects').removeClass('nav-transition');
					$('.latest-stories').removeClass('nav-transition');
					$('.latest-events').removeClass('nav-transition');
					$('.latest-shop').removeClass('nav-transition');
					$('.menu-sub-menu > .sub-menu').removeClass('nav-transition');
					$('.menu-sub-menu > .sub-menu').hide();
					$('.menu-sub-menu > .sub-menu').removeClass('moove-left moove-right');
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
		$('.menu-container').css('overflow-y','inherit');
		$('body').css('overflow-y','');
		$('body').css('height','');
		if ($window <= '767') {
			if ($counter == '0'){
				$('div.navbar-collapse').hide();
				$counter = 1;
			}
			$deviceHeight = $(window).height();
			$('.menu-container').css('height',$deviceHeight);
			$('.dynamic-header-posts').hide();
		}else {
			if ($counter == '1') {
				$('div.navbar-collapse').show();
				$('.dynamic-header-posts').hide();
				$counter = 0;
			}
			$('.menu-container').css('height','inherit');
			$('.menu-container').css('margin-left','');
			$('.get-dark').removeClass('show');
			$('.navbar-default .navbar-toggle').removeClass('close-background');
			$('.navbar-default .navbar-toggle .icon-bar').removeClass('hide-background');
		}

	});
	if ($window <= '767') {
		$deviceHeight = $(window).height();
		$('.menu-container').css('height',$deviceHeight);
		$('.menu-item-has-children').children("a").click(function (e) {
			e.preventDefault();
			$(".menu-item-has-children").not($($(this).parent().get(0))).find('.sub-menu').slideUp('slow');
			$($(this).parent().get(0)).find('.sub-menu').slideToggle('slow');
			$(".menu-item-has-children").not($($(this).parent().get(0))).children("a").removeClass("active-button");
			$(this).toggleClass("active-button");
			
		});


	}

	 $('.navbar-toggle').on('click', function(){
			$('.get-dark').css('height',$bodyHeight);
			$('.navbar-default .navbar-toggle').toggleClass('close-background');
			$('.navbar-default .navbar-toggle .icon-bar').toggleClass('hide-background');
			if (!$('.get-dark').hasClass('show')){
				window.setTimeout(function(){$('.menu-container').addClass('scroll');}, 600);
				$('body').css('overflow-y','hidden');
				$('body').css('height',$bodyHeight);
				$('.navbar-default .navbar-collapse').show();
				$('.get-dark').addClass('show');
				$('.get-dark').animate({
					opacity:0.5
				}, 250, function() {
				});
				$('.tablet .minify.sticky').hide();
				$('.menu-container').css('margin-left','0');
			} else {
				$('body').css('overflow-y','');
				$('body').css('height','');
				$('.menu-container').css('margin-left','-100%');
				$('.menu-container').removeClass('scroll');
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
		$('body').css('overflow-y','');
		$('body').css('height','');
		$('.get-dark').animate({
			opacity:0
		}, 250, function() {
			$(this).removeClass('show');
		});
		$('.menu-container').removeClass('scroll');
		$('.menu-container').css('margin-left','-100%');
		$('.navbar-default .navbar-toggle').removeClass('close-background');
		$('.navbar-default .navbar-toggle .icon-bar').removeClass('hide-background');
		$('.tablet .minify.sticky').show('250');
		$('.tablet .minify.sticky').css('overflow','inherit');
	});

});
