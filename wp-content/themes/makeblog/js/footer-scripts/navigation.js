(function($) { 

	jQuery(window).load(function () {
		var sumoHeight = jQuery(".sumome-react-wysiwyg-popup-container").height();
	});
	function sumomeActive() {
		if ( document.querySelector(".sumome-react-wysiwyg-popup-container") != null ) {
			jQuery("#nav-flyout").css('padding-top', sumoHeight * 1.23 + 'px');
			jQuery("#nav-flyout").css('height', 560 * (sumoHeight/100) + 'px');
			jQuery(".ham-menu-animate").css('margin-top', sumoHeight * 1.08 + 'px');
			//jQuery('body').addClass('sumome-active');
		} else {
			//jQuery('body').removeClass('sumome-active');
			jQuery("#nav-flyout").css('padding-top', '17px');
			jQuery("#nav-flyout").css('height', '560px');
			jQuery(".ham-menu-animate").css('margin-top', '');
		}
	}

	$('#hamburger-icon, #hamburger-text, .nav-flyout-underlay').click(function() {
		$('#hamburger-icon').toggleClass('open');
		$('#hamburger-text').animate({opacity: 'toggle'});
		$('#nav-flyout').animate({opacity: 'toggle'});
		$('body').toggleClass('nav-open-no-scroll');
		$('html').toggleClass('nav-open-no-scroll');
		$('.nav-flyout-underlay').animate({opacity: 'toggle'});
		if (typeof sumoHeight !== 'undefined') { sumomeActive(); }
	});
	// forcing some issues - avatar dropdown to open in same tab and search links to actually link
	$(".dropdown-item").attr('target', '_self');
	$(".pop-links-list li a").click(function() {
		window.location.href = $(this).attr('href');
	});

	$('.nav-flyout-column').on('click', '.expanding-underline', function(event) {
	 	if ($(window).width() < 577) { 
			event.preventDefault();
			$(this).toggleClass('underline-open');
			$(this).next('.nav-flyout-ul').slideToggle();
	 	}
	});
	
	jQuery('.sumome-react-wysiwyg-popup-container').on('DOMNodeRemoved', function(e) {
		if (typeof sumoHeight !== 'undefined') { 
			sumomeActive(); 
			jQuery(".nav-hamburger").css('margin-top', '');
		}
	});
    
  // fix nav to top on scrolldown, stay fixed for transition from mobile to desktop
  var e = $(".universal-nav");
  var hamburger = $(".nav-hamburger");
  var y_pos = $(".nav-level-2").offset().top;
  // maybe one day we can just wrap the below the nav content in something consistent
  var nextItemUnderNav = $("#home-featured");
    if($(".second-nav").length && $(".second-nav").css("display") != "none"){
        nextItemUnderNav = $(".second-nav");
    }else{
        if($(".mz-story-infinite-view").length) {
            nextItemUnderNav = $(".mz-story-infinite-view");
        }
        if($(".ad-unit").length) {
            nextItemUnderNav = $(".ad-unit");
        }
    }
    
  if ($(window).width() < 578) {
          jQuery(".auth-target").append(jQuery(".nav-level-1-auth"));
  }
  $(window).on('resize', function(){
	   sumoHeight = jQuery(".sumome-react-wysiwyg-popup-container").height();
      if ($(window).width() < 767) {
          y_pos = 0;
          nextItemUnderNav.css("margin-top", "55px");
      }else{
          y_pos = 75;
          nextItemUnderNav.css("margin-top", "0px");
      }
      if ($(window).width() < 578) {
          jQuery(".auth-target").append(jQuery(".nav-level-1-auth"));
      }else{
          jQuery("nav.container").prepend(jQuery(".nav-level-1-auth"));
      }
  });
  jQuery(document).scroll(function() {
	   sumoHeight = jQuery(".sumome-react-wysiwyg-popup-container").height();
      var scrollTop = $(this).scrollTop();
      if(scrollTop > y_pos && $(window).width() > 767){
          e.addClass("main-nav-scrolled"); 
          hamburger.addClass("ham-menu-animate");
          nextItemUnderNav.css("margin-top", "55px");
      }else if(scrollTop <= y_pos){
          e.removeClass("main-nav-scrolled"); 
			 jQuery(".nav-hamburger").css('margin-top', '');
          hamburger.removeClass("ham-menu-animate");
          if ($(window).width() > 767) {
            nextItemUnderNav.css("margin-top", "0px");
          }
      }
	   if (typeof sumoHeight !== 'undefined') { sumomeActive(); }
  });
  $("#search-modal").fancybox({
        wrapCSS : 'search-modal-wrapper',
        autoSize : true,
        //width  : 400,
        autoHeight : true,
        padding : 0,
        overlay: {
            opacity: 0.8, // or the opacity you want 
            css: {'background-color': '#ff0000'} // or your preferred hex color value
        }, // overlay 
        closeClick  : false, 
        afterShow   : function() {
            // keep it from reloading upon clicks
            $('#search-modal').bind('click', false);
            $(".sb-search-submit").click(function(e){
                if($("#search").val() && $("#search").val() != ""){
                    var searchForm = $(".search-form");
                    window.location.href = searchForm.attr("action") +"?s=" + $("#search").val();
                }else{
                    $("#search").attr('placeholder', "Please enter in some text to search for...");            
                }
            });
            $(".sb-search-input").focus();
        },
        afterClose: function () {
            $('#search-modal').unbind('click', false);
        }
  });

  $(".fa-search").click(function(e){
       $("#search-modal").trigger('click');
       // essb sharing popup is being triggered when logged in to admin
       $(".essb-live-customizer-main, .essb-live-buttons-customizer").attr('style', 'display: none !important');
  });
    
  // to keep this nav universal, let's not have each site's style sheet highlight a different active manually
  var site = window.location.hostname;
  var firstpath = $(location).attr('pathname');
    firstpath.indexOf(1);
    firstpath.toLowerCase();
    firstpath = firstpath.split("/")[1];
  var shareSection = site + "/" + firstpath;
  function universalNavActive( site ) {
    jQuery(".nav-" + site).addClass("active-site");
    jQuery(".nav-" + site + " .nav-level-2-arrow").addClass("active-site")
  }
  // each one has to apply to a number of environments
  switch(site) {
    case "make-zine":
    case "makezine":
    case "makezine.wpengine.com":
    case "makezine.staging.wpengine.com":
    case "makezine.com":
        universalNavActive("zine");
        break;
    case "makeco":
    case "makeco.wpengine.com":
    case "makeco.staging.wpengine.com/":
    case "makeco.com":
        universalNavActive("make");
        break;
    case "makershed.com":
        universalNavActive("shed")
        break;  
    case "maker-faire":
    case "makerfaire":
    case "makerfaire.wpengine.com":
    case "makerfaire.staging.wpengine.com":
    case "makerfaire.com":
        universalNavActive("faire")
        break;
    default:
          break;
  }
  switch(shareSection) {
    case "maker-share/learning":
    case "makershare/learning":
    case "makeshare.wpengine.com/learning":
    case "makershare.staging.wpengine.com/learning":
    case "makershare.com/learning":
        universalNavActive("share")
        break;
    case "maker-share/":
    case "makershare/":
    case "makeshare.wpengine.com/":
    case "makershare.staging.wpengine.com/":
    case "makershare.com/":
        universalNavActive("share-p")
        break;
    default:
          break;
  }
  // just in case, make sure that nav-share is visible
  $(".nav-level-1-nav .nav-share").css("display", "block");
})(jQuery);