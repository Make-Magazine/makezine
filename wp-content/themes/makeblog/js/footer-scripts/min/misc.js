// Compiled file - any changes will be overwritten by grunt task
//!!
//!! js/footer-scripts/auth0.js
//jQuery('#a0LoginButton').hide();
jQuery('#a0Avatar').hide();
var ignore_sso = false;
//document.addEventListener("DOMContentLoaded", function() {

    var callback = null;
    //setting the auth0 options
    var options =
       {"mustAcceptTerms":true,
        "rememberLastLogin":false,
        "languageDictionary":
                { "loadingTitle":"loading...",
                  "close":"close",
                  "error":{ "login":{ "lock.invalid_email_password":"Incorrect email or password. If you logged in previously using Facebook or Google, Sign Up again."}},
                  "success":{ "forgotPassword":"We've just sent you and email to reset your password. If you don't receive the email, Sign Up again. We've updated our login system and may have reset your account."},
                  "reset":  { "serverErrorText":"There was an error processing the reset password."},
                  "signUpTerms":  "I agree to the <a href='http:\/\/makermedia.com\/terms' target='_new'>terms of service<\/a> and <a href='http:\/\/makermedia.com\/privacy' target='_new'>privacy policy<\/a>.",
                  "title":""
                },
        "socialButtonStyle":"small",
        "gravatar":null,
        "usernameStyle":"email",
        "theme":  { logo: 'http://makeco.wpengine.com/wp-content/uploads/2018/03/We-Are-All-Makers_Logo@2x.png',
                    "primaryColor":"#3FAFED"
                  }
        };

  options.additionalSignUpFields = [
    { name: "first_name",
      placeholder: "Enter your first name"
    },
    { name: "last_name",
      placeholder: "Enter your last name"
    },
    { type: "select",
      name: "Month",
      placeholder: "Month",
      options: [
        {value: "1", label: "Jan"},
        {value: "2", label: "Feb"},
        {value: "3", label: "Mar"},
        {value: "4", label: "Apr"},
        {value: "5", label: "May"},
        {value: "6", label: "Jun"},
        {value: "7", label: "Jul"},
        {value: "8", label: "Aug"},
        {value: "9", label: "Sep"},
        {value: "10", label: "Oct"},
        {value: "11", label: "Nov"},
        {value: "12", label: "Dec"}
     ]
    },
    { type: "select",
      name: "Day",
      placeholder: "Day",
      options: [
        {value: "1", label: "1"},
        {value: "2", label: "2"},
        {value: "3", label: "3"},
        {value: "4", label: "4"},
        {value: "5", label: "5"},
        {value: "6", label: "6"},
        {value: "7", label: "7"},
        {value: "8", label: "8"},
        {value: "9", label: "9"},
        {value: "10", label: "10"},
        {value: "11", label: "11"},
        {value: "12", label: "12"},
        {value: "13", label: "13"},
        {value: "14", label: "14"},
        {value: "15", label: "15"},
        {value: "16", label: "16"},
        {value: "17", label: "17"},
        {value: "18", label: "18"},
        {value: "19", label: "19"},
        {value: "20", label: "20"},
        {value: "21", label: "21"},
        {value: "22", label: "22"},
        {value: "23", label: "23"},
        {value: "24", label: "24"},
        {value: "25", label: "25"},
        {value: "26", label: "26"},
        {value: "27", label: "27"},
        {value: "28", label: "28"},
        {value: "29", label: "29"},
        {value: "30", label: "30"},
        {value: "31", label: "31"}
      ]
    },
    { type: "select",
      name: "Year",
      placeholder: "Year",
      options: [
        {value: "2017", label: "2017"},
        {value: "2016", label: "2016"},
        {value: "2015", label: "2015"},
        {value: "2014", label: "2014"},
        {value: "2013", label: "2013"},
        {value: "2012", label: "2012"},
        {value: "2011", label: "2011"},
        {value: "2010", label: "2010"},
        {value: "2009", label: "2009"},
        {value: "2008", label: "2008"},
        {value: "2007", label: "2007"},
        {value: "2006", label: "2006"},
        {value: "2005", label: "2005"},
        {value: "2004", label: "2004"},
        {value: "2003", label: "2003"},
        {value: "2002", label: "2002"},
        {value: "2001", label: "2001"},
        {value: "2000", label: "2000"},
        {value: "1999", label: "1999"},
        {value: "1998", label: "1998"},
        {value: "1997", label: "1997"},
        {value: "1996", label: "1996"},
        {value: "1995", label: "1995"},
        {value: "1994", label: "1994"},
        {value: "1993", label: "1993"},
        {value: "1992", label: "1992"},
        {value: "1991", label: "1991"},
        {value: "1990", label: "1990"},
        {value: "1989", label: "1989"},
        {value: "1988", label: "1988"},
        {value: "1987", label: "1987"},
        {value: "1986", label: "1986"},
        {value: "1985", label: "1985"},
        {value: "1984", label: "1984"},
        {value: "1983", label: "1983"},
        {value: "1982", label: "1982"},
        {value: "1981", label: "1981"},
        {value: "1980", label: "1980"},
        {value: "1979", label: "1979"},
        {value: "1978", label: "1978"},
        {value: "1977", label: "1977"},
        {value: "1976", label: "1976"},
        {value: "1975", label: "1975"},
        {value: "1974", label: "1974"},
        {value: "1973", label: "1973"},
        {value: "1972", label: "1972"},
        {value: "1971", label: "1971"},
        {value: "1970", label: "1970"},
        {value: "1969", label: "1969"},
        {value: "1968", label: "1968"},
        {value: "1967", label: "1967"},
        {value: "1966", label: "1966"},
        {value: "1965", label: "1965"},
        {value: "1964", label: "1964"},
        {value: "1963", label: "1963"},
        {value: "1962", label: "1962"},
        {value: "1961", label: "1961"},
        {value: "1960", label: "1960"},
        {value: "1959", label: "1959"},
        {value: "1958", label: "1958"},
        {value: "1957", label: "1957"},
        {value: "1956", label: "1956"},
        {value: "1955", label: "1955"},
        {value: "1954", label: "1954"},
        {value: "1953", label: "1953"},
        {value: "1952", label: "1952"},
        {value: "1951", label: "1951"},
        {value: "1950", label: "1950"},
        {value: "1949", label: "1949"},
        {value: "1948", label: "1948"},
        {value: "1947", label: "1947"},
        {value: "1946", label: "1946"},
        {value: "1945", label: "1945"},
        {value: "1944", label: "1944"},
        {value: "1943", label: "1943"},
        {value: "1942", label: "1942"},
        {value: "1941", label: "1941"},
        {value: "1940", label: "1940"},
        {value: "1939", label: "1939"},
        {value: "1938", label: "1938"},
        {value: "1937", label: "1937"},
        {value: "1936", label: "1936"},
        {value: "1935", label: "1935"},
        {value: "1934", label: "1934"},
        {value: "1933", label: "1933"},
        {value: "1932", label: "1932"},
        {value: "1931", label: "1931"},
        {value: "1930", label: "1930"},
        {value: "1929", label: "1929"},
        {value: "1928", label: "1928"},
        {value: "1927", label: "1927"},
        {value: "1926", label: "1926"},
        {value: "1925", label: "1925"},
        {value: "1924", label: "1924"},
        {value: "1923", label: "1923"},
        {value: "1922", label: "1922"},
        {value: "1921", label: "1921"},
        {value: "1920", label: "1920"},
        {value: "1919", label: "1919"},
        {value: "1918", label: "1918"},
        {value: "1917", label: "1917"},
        {value: "1916", label: "1916"},
        {value: "1915", label: "1915"},
        {value: "1914", label: "1914"},
        {value: "1913", label: "1913"},
        {value: "1912", label: "1912"},
        {value: "1911", label: "1911"},
        {value: "1910", label: "1910"},
        {value: "1909", label: "1909"},
        {value: "1908", label: "1908"},
        {value: "1907", label: "1907"},
        {value: "1906", label: "1906"},
        {value: "1905", label: "1905"}
      ]
    }
  ];

  // Initializing our Auth0Lock
  var lock = new Auth0Lock(
    '0sR3MQz8ihaSnLstc1dABgENHS5PQR8d',
    'makermedia.auth0.com',
    options
  );

  // Listening for the authenticated event
  lock.on("authenticated", function(authResult) {
    // Use the token in authResult to getUserInfo() and save it to localStorage
    lock.getUserInfo(authResult.accessToken, function(error, profile) {
      if (error) {
        // Handle error
        return;
      }
      //authenticated
      jQuery('#a0LoginButton').hide();
      jQuery('#a0Avatar').show();
      //document.getElementById('nick').textContent = profile.nickname;

      localStorage.setItem('accessToken', authResult.accessToken);
      localStorage.setItem('profile', JSON.stringify(profile));
    });
  });

  document.getElementById('a0LoginButton').addEventListener('click', function() {
    lock.show();
  });
//});;//!!
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


