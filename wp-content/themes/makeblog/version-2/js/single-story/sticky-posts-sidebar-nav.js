(function($) { $(function() {
  'use strict';
  /**
   * detect IE
   * returns version of IE or false, if browser is not Internet Explorer
   */
  function detectIE() {
    var ua = window.navigator.userAgent;
    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
      // IE 10 or older => return version number
      return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }
    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
      // IE 11 => return version number
      var rv = ua.indexOf('rv:');
      return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }
    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
      // Edge (IE 12+) => return version number
      return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    }
    // other browser
    return false;
  }

  if ($('div').hasClass('mz-story-infinite-view')) {
    (function() {
      var viewPortWidth = $(window).width() + 17;
      var thumbnailsHeight = $(window).height() - 89 - $('#wpadminbar').height();
      if (detectIE() != false) {
        thumbnailsHeight -= 20;
      }
      $('.span8 iframe').css('max-width', '100%');
      var navigatorHeight = $(window).height() - 50;
      $('.navigator .thumbnails').addClass('open').css('height', thumbnailsHeight);
      $('.hamburger-navigator').addClass('open');
      $('.row.navigator').addClass('open').css('height', navigatorHeight);
      $('.posts-navigator').show();
      $(window).resize(function() {
        thumbnailsHeight = $(window).height() - 89 - $('#wpadminbar').height();
        if (detectIE() != false) {
          thumbnailsHeight -= 20;
        }
        navigatorHeight = $(window).height() - 50;
        $('.navigator .thumbnails').addClass('open').css('height', thumbnailsHeight);
        $('.row.navigator').addClass('open').css('height', navigatorHeight);
        viewPortWidth = $(window).width() + 17;
        if (viewPortWidth <= 767) {
          if ($first_resize == 0) {
            $first_resize = 1;
            $('.more-thumbnails .posts-navigator').css('display', '');
          }
        }
      });
      $(window).scroll(function() {
        var $scrollTop = $(window).scrollTop();
        if ($scrollTop >= '100') {
          $('.navigator').addClass('sticky');
          if ($('.navigator').hasClass('open')) {
            $('.navigator').addClass('transition');
          }
        } else {
          $('.posts-navigator').show();
          $('.navigator .thumbnails').addClass('open').css('height', thumbnailsHeight);
          $('.hamburger-navigator').addClass('open');
          $('.navigator').removeClass('sticky transition').addClass('open').css('height', navigatorHeight);
        }
      });
      $('.thumbnails .latest-story a').click(function() {
        $id = $(this).attr('href');
        $parentId = $(this).parent().attr('id');
        $scrollingToPost = 1;
        var scrollTime;
        var $number = $parentId - $offset;
        if ($number > 3) {
          if ($number < 7) {
            scrollTime = 5000;
          } else {
            scrollTime = 8000;
          }
          window.setTimeout(function() {
            if ($('.navigator').hasClass('sticky')) {
              $('html, body').animate({
                scrollTop: $($id).offset().top - 80
              }, 500);
            } else {
              $('html, body').animate({
                scrollTop: $($id).offset().top - 160
              }, 500);
            }
          }, scrollTime);
        }
        var $current = $(this);
        $newId = $(this).attr('href');
        if ($('.story-header').is($newId) === false) {
          $('.row.infinity').addClass('current');
          getStory($offset, $id, $number);
          $offset = $offset + $number;
        } else {
          if ($(this).parent().hasClass('first')) {
            $('html, body').animate({
              scrollTop: 0
            }, 500);
          } else {
            if ($('.navigator').hasClass('sticky')) {
              $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top - 80
              }, 500);
            } else {
              $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top - 160
              }, 500);
            }
          }
        }
        $newFlag = $(this).parent().index();
        $href = $(this).attr('id');
        window.setTimeout(function() {
          $('.latest-story a').removeClass('highlighted');
          $($current).addClass('highlighted');
          $flag = $newFlag;
          window.history.pushState('obj', 'newtitle', $href);
          document.title = $('.story-header').eq($newFlag).find('.story-title').text();
        }, 501);
        return false;
      });

      $('.hamburger-navigator').mouseover(function() {
        if (!$(this).hasClass('open')) {
          $(this).addClass('hover');
        }
      }).mouseleave(function() {
        $(this).removeClass('hover');
      }).click(function() {
        $(this).removeClass('hover');
        if ($(this).hasClass('open')) {
          $('.posts-navigator').slideUp('250');
          window.setTimeout(function() {
            $('.row.navigator').removeClass('open transition').css('height', '').css('top', '');
            $('.hamburger-navigator').removeClass('open');
            $('.thumbnails').removeClass('open');

          }, 390);
        }
        if (!$(this).hasClass('open')) {
          $('.thumbnails').addClass('open');
          $('.hamburger-navigator').addClass('open');
          $('.row.navigator').addClass('open');
          window.setTimeout(function() {
            $('.posts-navigator').slideDown('250');
          }, 250);
          window.setTimeout(function() {
            $('.row.navigator').css('height', navigatorHeight);
          }, 600);
        }
      });
    })();
  }
});})(window.jQuery);
