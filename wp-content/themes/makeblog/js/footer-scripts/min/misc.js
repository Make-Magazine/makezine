// Compiled file - any changes will be overwritten by grunt task
//!!
//!! js/footer-scripts/auth0-variables.js
var AUTH0_CLIENT_ID='0sR3MQz8ihaSnLstc1dABgENHS5PQR8d';
var AUTH0_DOMAIN='makermedia.auth0.com';
var AUTH0_CALLBACK_URL = templateUrl + "/authenticated/";
var AUTH0_REDIRECT_URL = location.href;;//!!
//!! js/footer-scripts/auth0.js
window.addEventListener('load', function() {
  // buttons and event listeners
  var loginBtn    = document.getElementById('qsLoginBtn');
  var logoutBtn   = document.getElementById('qsLogoutBtn');
  var profileView = document.getElementById('profile-view');
  //default profile view to hidden
  loginBtn.style.display    = 'none';
  profileView.style.display = 'none';

  var userProfile;
  var webAuth = new auth0.WebAuth({
    domain: AUTH0_DOMAIN,
    clientID: AUTH0_CLIENT_ID,
    redirectUri: AUTH0_CALLBACK_URL,
    audience: 'https://' + AUTH0_DOMAIN + '/userinfo',
    responseType: 'token id_token',
    scope: 'openid profile',
    leeway: 60
  });

  loginBtn.addEventListener('click', function(e) {
    e.preventDefault();
    localStorage.setItem('redirect_to',AUTH0_REDIRECT_URL);
    webAuth.authorize();
  });

  logoutBtn.addEventListener('click', logout);

  function setSession(authResult) {
    // Set the time that the access token will expire at
    var expiresAt = JSON.stringify(
      authResult.expiresIn * 1000 + new Date().getTime()
    );
    localStorage.setItem('access_token', authResult.accessToken);
    localStorage.setItem('id_token', authResult.idToken);
    localStorage.setItem('expires_at', expiresAt);
  }

  function logout() {
    // Remove tokens and expiry time from localStorage
    localStorage.removeItem('access_token');
    localStorage.removeItem('id_token');
    localStorage.removeItem('expires_at');
    displayButtons();
  }

  function isAuthenticated() {
    // Check whether the current time is past the
    // access token's expiry time
    var expiresAt = JSON.parse(localStorage.getItem('expires_at'));
    return new Date().getTime() < expiresAt;
  }

  function handleAuthentication() {
    webAuth.parseHash(function(err, authResult) {
      if (authResult && authResult.accessToken && authResult.idToken) {
        window.location.hash = '';
        setSession(authResult);
        loginBtn.style.display = 'none';
        //after login redirect to previous page (after 5 second delay)
        var redirect_url = localStorage.getItem('redirect_to');
        setTimeout(function(){location.href=redirect_url} , 5000);
      } else if (err) {
        console.log(err);
        alert(
          'Error: ' + err.error + '. Check the console for further details.'
        );
      }
      displayButtons();
    });
  }

  function displayButtons() {
    if (isAuthenticated()) {
      loginBtn.style.display = 'none';
      getProfile();
      profileView.style.display = 'flex';
    } else {
      loginBtn.style.display = 'flex';
      profileView.style.display = 'none';
    }
  }

  function getProfile() {
    if (!userProfile) {
      var accessToken = localStorage.getItem('access_token');

      if (!accessToken) {
        console.log('Access token must exist to fetch profile');
      }

      webAuth.client.userInfo(accessToken, function(err, profile) {
        if (profile) {
          userProfile = profile;
          displayProfile();
        }
      });
    } else {
      displayProfile();
    }
  }

  function displayProfile() {
    // display the avatar
    document.querySelector('#profile-view img').src = userProfile.picture;
  }

  //handle authentication
  handleAuthentication();
});;//!!
//!! js/footer-scripts/classie.js
/*!
 * classie - class helper functions
 * from bonzo https://github.com/ded/bonzo
 * 
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true */
/*global define: false */

( function( window ) {

'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

function classReg( className ) {
  return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
}

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
var hasClass, addClass, removeClass;

if ( 'classList' in document.documentElement ) {
  hasClass = function( elem, c ) {
    return elem.classList.contains( c );
  };
  addClass = function( elem, c ) {
    elem.classList.add( c );
  };
  removeClass = function( elem, c ) {
    elem.classList.remove( c );
  };
}
else {
  hasClass = function( elem, c ) {
    return classReg( c ).test( elem.className );
  };
  addClass = function( elem, c ) {
    if ( !hasClass( elem, c ) ) {
      elem.className = elem.className + ' ' + c;
    }
  };
  removeClass = function( elem, c ) {
    elem.className = elem.className.replace( classReg( c ), ' ' );
  };
}

function toggleClass( elem, c ) {
  var fn = hasClass( elem, c ) ? removeClass : addClass;
  fn( elem, c );
}

var classie = {
  // full names
  hasClass: hasClass,
  addClass: addClass,
  removeClass: removeClass,
  toggleClass: toggleClass,
  // short names
  has: hasClass,
  add: addClass,
  remove: removeClass,
  toggle: toggleClass
};

// transport
if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( classie );
} else {
  // browser global
  window.classie = classie;
}

})( window );
;//!!
//!! js/footer-scripts/navigation.js

(function($) {   
  $('#hamburger-icon, #hamburger-makey, .nav-flyout-underlay').click(function() {
    $('#hamburger-icon').toggleClass('open');
    $('#hamburger-makey').animate({opacity: 'toggle'});
    $('#nav-flyout').animate({opacity: 'toggle'});
    $('body').toggleClass('nav-open-no-scroll');
    $('.nav-flyout-underlay').animate({opacity: 'toggle'});
  });

  $('.nav-flyout-column').on('click', '.expanding-underline', function(event) {
    if ($(window).width() < 577) { 
      event.preventDefault();
      $(this).toggleClass('underline-open');
      $(this).next('.nav-flyout-ul').slideToggle();
    }
  });
  // fix nav to top on scrolldown, stay fixed for transition from mobile to desktop
  var e = $(".universal-nav");
  var hamburger = $(".nav-hamburger");
  var y_pos = $(".nav-level-2").offset().top;
  var nextItemUnderNav = $("#home-featured");
    if($(".second-nav").length) {
        nextItemUnderNav = $(".second-nav");
    }
  $(window).on('resize', function(){
      if ($(window).width() < 767) {
          y_pos = 0;
          nextItemUnderNav.css("margin-top", "55px");
      }else{
          y_pos = 75;
          nextItemUnderNav.css("margin-top", "0px");
      }
  });
  jQuery(document).scroll(function() {
      var scrollTop = $(this).scrollTop();
      if(scrollTop > y_pos && $(window).width() > 767){
          e.addClass("main-nav-scrolled"); 
          hamburger.addClass("ham-menu-animate");
          nextItemUnderNav.css("margin-top", "55px");
      }else if(scrollTop <= y_pos){
          e.removeClass("main-nav-scrolled"); 
          hamburger.removeClass("ham-menu-animate");
          if ($(window).width() > 767) {
            nextItemUnderNav.css("margin-top", "0px");
          }
      }
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
       $(".essb-live-customizer-main, .essb-live-customizer-buttons").toggle();
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
    case "maker-share/makers":
    case "makershare/makers":
    case "makeshare.wpengine.com/makers":
    case "makershare.staging.wpengine.com/makers":
    case "makershare.com/makers":
        universalNavActive("share-p")
        break;
    default:
          break;
  }
    
})(jQuery);
;//!!
//!! js/footer-scripts/other.js
// This file contains common JavaScript that is loaded into every page.
//


// Track GA links clicked
jQuery( '.ga-nav a' ).click( function(e) {
  var link_name = jQuery(this).text();
  var menu_name = jQuery(this).parents('ul.nav').attr('id');

  // Track this click with Google, yo.
  ga('send', 'event', menu_name, 'Click', link_name);
});



// Include hide/show script for SumoMe sharing widget attached to left side of browser
jQuery(document).scroll(function () {
  if(window.location.href.indexOf('/giftguide') != -1 ) return;
  var y = jQuery(this).scrollTop();
  if (y > 800) {
    jQuery('.sumome-share-client-wrapper-left-page').css({ opacity: 1 });
    jQuery('.sumome-share-client-wrapper-left-page').fadeIn();
  } else {
    jQuery('.sumome-share-client-wrapper-left-page').fadeOut();
  }
});
jQuery( "a.sumome-share-client-share" ).ready(function() {
  jQuery("a[title='Twitter']").addClass("SumoMeTwitter")
  jQuery("a[title='Facebook']").addClass("SumoMeFacebook")
  jQuery("a[title='Google+']").addClass("SumoMeGplus")
  jQuery("a[title='Reddit']").addClass("SumoMeReddit")
  jQuery("a[title='LinkedIn']").addClass("SumoMeLinkedin")
  jQuery("a[title='Pinterest']").addClass("SumoMePinterest")
});


// Open external links in new tab
jQuery(document).ready(function($) {
  $(document.links).filter(function() {
    return this.hostname != window.location.hostname;
  }).attr('target', '_blank');
});


// CrazyEgg
// setTimeout(function(){var a=document.createElement("script");
//   var b=document.getElementsByTagName("script")[0];
//   a.src=document.location.protocol+"//dnn506yrbagrg.cloudfront.net/pages/scripts/0013/2533.js?"+Math.floor(new Date().getTime()/3600000);
//   a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)
// }, 1);


// Begin Chartbeat Tracker
var _sf_async_config={};
/** CONFIGURATION START **/
_sf_async_config.uid = 53627;
_sf_async_config.domain = 'makezine.com';
_sf_async_config.useCanonical = true;
_sf_async_config.sections = 'Change this to your Section name';  //CHANGE THIS
_sf_async_config.authors = 'Change this to your Author name';    //CHANGE THIS
/** CONFIGURATION END **/
(function(){
  function loadChartbeat() {
    window._sf_endpt=(new Date()).getTime();
    var e = document.createElement('script');
    e.setAttribute('language', 'javascript');
    e.setAttribute('type', 'text/javascript');
    e.setAttribute('src', '//static.chartbeat.com/js/chartbeat.js');
    document.body.appendChild(e);
  }
  var oldonload = window.onload;
  window.onload = (typeof window.onload != 'function') ?
    loadChartbeat : function() { oldonload(); loadChartbeat(); };
})();
// End Chartbeat Tracker


jQuery( document ).ready( function( $ ) {
    // Sadly the Facebook Comment Box does not allow us to change the positioning
    $( '.comment-list' ).appendTo( '#comments' );

    // Allow links within bootstrap tabs for sharing URL of a particular tab
    var url = document.location.toString();
    if ( url.match( '#' ) ) {
        $( '.nav-tabs a[href=#' + url.split( '#' )[1] + ']').tab( 'show' ) ;
    }

    // Change hash in URL for tab linking
    $( '.nav-tabs a' ).on( 'shown', function( e ) {
        // Use the History API if possible, or else, fall back.
        // The History API will allow us to hash a URL without page jump in modern browsers.
        if ( history.pushState ) {
            window.history.pushState( null, null, e.target.hash );
        } else {
            window.location.hash = e.target.hash;
        }
    });
});


// Join page scripts
jQuery(document).on('submit', '.nlp-form', function (e) {
  e.preventDefault();
  // First check if any checkboxes are checked
  var anyBoxesChecked = false;
  jQuery('#nlp-form input[type="checkbox"]').each(function() {
    if (jQuery(this).is(":checked")) {
      anyBoxesChecked = true;
    }
  });
  if (anyBoxesChecked == false) {
    jQuery('.list-radio[data-toggle="tooltip"]').tooltip()
    jQuery('.list-radio[data-toggle="tooltip"]').tooltip('show')
    return false;
  }
  // Now get the email into the form and send
  else {
    var nlpEmail = jQuery('#nlp-input').val();
    jQuery('#nlp-form #email').val(nlpEmail);
    if (jQuery('#nlp-form #email').val() == '') {
      jQuery('#nlp-input').tooltip()
      jQuery('#nlp-input').tooltip('show')
      return false;
    }
    else {
      jQuery(document).on('submit', '.nlp-form', function (e) {
        e.preventDefault();
        onSubmitJoinPage();
      });
    }
  }
});


// Fancybox subscribe modal stuff
jQuery(document).ready(function($){
  $(".fancybox-thx").fancybox({
    autoSize : false,
    width  : 400,
    autoHeight : true,
    padding : 0,
    afterLoad   : function() {
      this.content = this.content.html();
    }
  });
  $(".nl-thx-p2").fancybox({
    autoSize : false,
    width  : 400,
    autoHeight : true,
    padding : 0,
    afterLoad   : function() {
      this.content = this.content.html();
    }
  });
  $(".nl-modal-error").fancybox({
    autoSize : false,
    width  : 250,
    autoHeight : true,
    padding : 0,
    afterLoad   : function() {
      this.content = this.content.html();
    }
  });


  // Modal to sign up to more newsletters
  $(document).on('submit', '.whatcounts-signup2', function (e) {
    e.preventDefault();
    $.post('https://secure.whatcounts.com/bin/listctrl', $('.fancybox-inner .whatcounts-signup2').serialize());
    jQuery('.fancybox-close').click();
    jQuery('.nl-thx-p2').trigger('click');
  });
  $('input[type="checkbox"]').click(function(e){
    e.stopPropagation();
  });

  if(window.location.href.indexOf("?thankyou=true&subscribed-to=make-newsletter") > -1) {
    $(".fancybox-thx").fancybox({
      autoSize : false,
      width  : 400,
      autoHeight : true,
      padding : 0,
      afterLoad   : function() {
        this.content = this.content.html();
      }
    });
    $(".fancybox-thx").trigger('click');
  }
  else if(window.location.href.indexOf("?subscribed-to-make-newsletter") > -1) {
    $(".fancybox-thx").fancybox({
      autoSize : false,
      width  : 400,
      autoHeight : true,
      padding : 0,
      afterLoad   : function() {
        this.content = this.content.html();
      }
    });
    $(".nl-thx-p2").trigger('click');
  }
  else if(window.location.href.indexOf("?thankyou=true&subscribed-to=free-pdf") > -1) {
    $(".fancybox-thx-free-pdf").fancybox({
      autoSize : false,
      width  : 580,
      autoHeight : true,
      padding : 0,
      afterLoad   : function() {
        this.content = this.content.html();
      }
    });
    $(".fancybox-thx-free-pdf").trigger('click');
  }
  else if(window.location.href.indexOf("?success=true&subscribe-preferences") > -1) {
    $(".fancybox-sub-pref").fancybox({
      autoSize : false,
      width  : 480,
      autoHeight : true,
      padding : 0,
      afterLoad   : function() {
        this.content = this.content.html();
      }
    });
    $(".fancybox-sub-pref").trigger('click');
  }
  else if(window.location.href.indexOf("?thank-you-project-submission") > -1) {
    $(".fancybox-contribute-submission").fancybox({
      autoSize : false,
      width  : 480,
      autoHeight : true,
      padding : 0,
      afterLoad   : function() {
        this.content = this.content.html();
      }
    });
    $(".fancybox-contribute-submission").trigger('click');
  }
});

// Footer Desktop
var onSubmitFooterDesktop = function(token) {
  var bla = jQuery('#wc-email').val();
  jQuery.post('https://secure.whatcounts.com/bin/listctrl', jQuery('.whatcounts-signup1').serialize());
  jQuery('.fancybox-thx').trigger('click');
  jQuery('.nl-modal-email-address').text(bla);
  jQuery('.whatcounts-signup2 #email').val(bla);
}
jQuery(document).on('submit', '.whatcounts-signup1', function (e) {
  e.preventDefault();
  onSubmitFooterDesktop();
});
// Footer Mobile
var onSubmitFooterMobile = function(token) {
  var bla = jQuery('#wc-email-m').val();
  jQuery.post('https://secure.whatcounts.com/bin/listctrl', jQuery('.whatcounts-signup1m').serialize());
  jQuery('.fancybox-thx').trigger('click');
  jQuery('.nl-modal-email-address').text(bla);
  jQuery('.whatcounts-signup2 #email').val(bla);
}
jQuery(document).on('submit', '.whatcounts-signup1m', function (e) {
  e.preventDefault();
  onSubmitFooterMobile();
});
// Sidebar
var onSubmitPostSide = function(token) {
  var bla = jQuery('#wc-email').val();
  jQuery.post('https://secure.whatcounts.com/bin/listctrl', jQuery('.whatcounts-signup1s').serialize());
  jQuery('.fancybox-thx').trigger('click');
  jQuery('.nl-modal-email-address').text(bla);
  jQuery('.whatcounts-signup2 #email').val(bla);
}
jQuery(document).on('submit', '.whatcounts-signup1s', function (e) {
  e.preventDefault();
  onSubmitPostSide();
});
// Header Overlay
var onSubmitHeaderOverlay = function(token) {
  var bla = jQuery('#wc-email-o').val();
  jQuery.post('https://secure.whatcounts.com/bin/listctrl', jQuery('.whatcounts-signup1o').serialize());
  jQuery('.fancybox-thx').trigger('click');
  jQuery('.nl-modal-email-address').text(bla);
  jQuery('.whatcounts-signup2 #email').val(bla);
}
jQuery(document).on('submit', '.whatcounts-signup1o', function (e) {
  e.preventDefault();
  onSubmitHeaderOverlay();
});
// Header mobile
var onSubmitHeaderMobile = function(token) {
  var bla = jQuery('#wc-email-o').val();
  jQuery.post('https://secure.whatcounts.com/bin/listctrl', jQuery('.whatcounts-head-mobile').serialize());
  jQuery('.fancybox-thx').trigger('click');
  jQuery('.nl-modal-email-address').text(bla);
  jQuery('.whatcounts-signup2 #email').val(bla);
} 
jQuery(document).on('submit', '.whatcounts-head-mobile', function (e) {
  e.preventDefault();
  onSubmitHeaderMobile();
});
// Tag Archive page
var onSubmitTag = function(token) {
  jQuery.post('https://secure.whatcounts.com/bin/listctrl', jQuery('.whatcounts-signupTagArchive').serialize());
  jQuery('.nl-thx-p2').trigger('click');
} 
jQuery(document).on('submit', '.whatcounts-signupTagArchive', function (e) {
  e.preventDefault();
  onSubmitTag();
});
// Build your own page template
var onSubmitPageBuilder = function(token) {
  var bla = jQuery('#wc-email').val();
  jQuery.post('https://secure.whatcounts.com/bin/listctrl', jQuery('.whatcounts-signup3').serialize());
  jQuery('.fancybox-thx').trigger('click');
  jQuery('.nl-modal-email-address').text(bla);
  jQuery('.whatcounts-signup2 #email').val(bla);
} 
jQuery(document).on('submit', '.whatcounts-signup3', function (e) {
  e.preventDefault();
  onSubmitPageBuilder();
});
// Join page
var onSubmitJoinPage = function(token) {
  jQuery.post('https://secure.whatcounts.com/bin/listctrl', jQuery('.nlp-form').serialize());
  jQuery('.nl-thx-p2').trigger('click');
}

var recaptchaKey = '6Lf_-kEUAAAAAHtDfGBAleSvWSynALMcgI1hc_tP';
onloadCallback = function() {
  if ( jQuery('#recapcha-footer-desktop').length ) {
    grecaptcha.render('recapcha-footer-desktop', {
      'sitekey' : recaptchaKey,
      'callback' : onSubmitFooterDesktop
    });
  }
  if ( jQuery('#recapcha-footer-mobile').length ) {
    grecaptcha.render('recapcha-footer-mobile', {
      'sitekey' : recaptchaKey,
      'callback' : onSubmitFooterMobile
    });
  }
  if ( jQuery('#recapcha-header-overlay').length ) {
    grecaptcha.render('recapcha-header-overlay', {
      'sitekey' : recaptchaKey,
      'callback' : onSubmitHeaderOverlay
    });
  }
  if ( jQuery('#recapcha-header-mobile').length ) {
    grecaptcha.render('recapcha-header-mobile', {
      'sitekey' : recaptchaKey,
      'callback' : onSubmitHeaderMobile
    });
  }
  if ( jQuery('#recapcha-join-page').length ) {
    grecaptcha.render('recapcha-join-page', {
      'sitekey' : recaptchaKey,
      'callback' : onSubmitJoinPage
    });
  }
  if ( jQuery('#recapcha-post-side').length ) {
    grecaptcha.render('recapcha-post-side', {
      'sitekey' : recaptchaKey,
      'callback' : onSubmitPostSide
    });
  }
  if ( jQuery('#recapcha-tag').length ) {
    grecaptcha.render('recapcha-tag', {
      'sitekey' : recaptchaKey,
      'callback' : onSubmitTag
    });
  }
  if ( jQuery('#recapcha-page-builder').length ) {
    grecaptcha.render('recapcha-page-builder', {
      'sitekey' : recaptchaKey,
      'callback' : onSubmitPageBuilder
    });
  }
}


// Initialize the Lazyload function
jQuery(document).ready(function() {
  jQuery('img.lazyload').lazyload({
    effect : "fadeIn"
  });
});


// Video Tracker
// note: this will cause the Youtube player to "flash" on the page when reloading to enable the JS API
for (var e = document.getElementsByTagName("iframe"), x = e.length; x--;)
  if (/youtube.com\/embed/.test(e[x].src))
    if(e[x].src.indexOf('enablejsapi=') === -1)
      e[x].src += (e[x].src.indexOf('?') ===-1 ? '?':'&') + 'enablejsapi=1';

var gtmYTListeners = []; // support multiple players on the same page
// attach our YT listener once the API is loaded
function onYouTubeIframeAPIReady() {
  for (var e = document.getElementsByTagName("iframe"), x = e.length; x--;) {
    if (/youtube.com\/embed/.test(e[x].src)) {
      gtmYTListeners.push(new YT.Player(e[x], {
        events: {
          onStateChange: onPlayerStateChange,
          onError: onPlayerError
        }
      }));
      YT.gtmLastAction = "p";
    }
  }
}
// listen for play/pause, other states such as rewind and end could also be added
// also report % played every second
function onPlayerStateChange(e) {
  e["data"] == YT.PlayerState.PLAYING && setTimeout(onPlayerPercent, 1000, e["target"]);
  var video_data = e.target["getVideoData"](),
    label = video_data.title;
  if (e["data"] == YT.PlayerState.PLAYING && YT.gtmLastAction == "p") {
    dataLayer.push({
      event: "videos",
      action: "play",
      label: label
    });
    YT.gtmLastAction = "";
  }
  if (e["data"] == YT.PlayerState.PAUSED) {
    dataLayer.push({
      event: "videos",
      action: "pause",
      label: label
    });
    YT.gtmLastAction = "p";
  }
}
// catch all to report errors through the GTM data layer
// once the error is exposed to GTM, it can be tracked in UA as an event!
function onPlayerError(e) {
  dataLayer.push({
    event: "error",
    action: "GTM",
    label: "videos:" + e["target"]["src"] + "-" + e["data"]
  })
}
// report the % played if it matches 0%, 25%, 50%, 75% or completed
function onPlayerPercent(e) {
  if (e["getPlayerState"]() == YT.PlayerState.PLAYING) {
    var t = e["getDuration"]() - e["getCurrentTime"]() <= 1.5 ? 1 : (Math.floor(e["getCurrentTime"]() / e["getDuration"]() * 4) / 4).toFixed(2);        if (!e["lastP"] || t > e["lastP"]) {
      var video_data = e["getVideoData"](),
        label = video_data.title;
      e["lastP"] = t;
      dataLayer.push({
        event: "videos",
        action: t * 100 + "%",
        label: label
      })
    }
    e["lastP"] != 1 && setTimeout(onPlayerPercent, 1000, e);
  }
}
// load the Youtube JS api and get going
var j = document.createElement("script"),
  f = document.getElementsByTagName("script")[0];
j.src = "//www.youtube.com/iframe_api";
j.async = true;
f.parentNode.insertBefore(j, f);


// YOUTUBE FOR FANCYBOX MODALS
jQuery(document).ready(function() {
  jQuery(".fancytube").fancybox({
    maxWidth  : 800,
    maxHeight : 600,
    fitToView : false,
    width   : '70%',
    height    : '70%',
    autoSize  : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none',
    padding : 0
  });
  jQuery(".fancytube").fancybox();
});


// Page scrolling
jQuery(document).ready(function(){
  jQuery(".scroll").click(function(event){
    //prevent the default action for the click event
    event.preventDefault();
    //get the full url - like mysitecom/index.htm#home
    var full_url = this.href;
    //split the url by # and get the anchor target name - home in mysitecom/index.htm#home
    var parts = full_url.split("#");
    var trgt = parts[1];
    //get the top offset of the target anchor
    var target_offset = jQuery("#"+trgt).offset();
    var target_top = target_offset.top;
    //goto that anchor by setting the body scroll top to anchor top
    jQuery('html, body').animate({scrollTop:target_top - 50}, 1000);
    //Style the pagination links
    jQuery('a span.badge').addClass('badge-info');
  });
  jQuery('.hide-thumbnail').removeClass('img-thumbnail');
});


// Feedback form submit event handler
jQuery(document).on('submit', '#form13', function (e) {
  event.preventDefault();
  jQuery.ajax({
    url:'//makemagazine.wufoo.com/forms/zzv65kl0b09v1f/#public',
    type:'POST',
    data:jQuery(this).serialize()
  });
  jQuery('.fancybox-feedback-inner1').hide();
  jQuery('.fancybox-feedback-inner2').show();
});


