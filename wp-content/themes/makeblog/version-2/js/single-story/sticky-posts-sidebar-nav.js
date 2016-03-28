(function($) { $(function() {
  'use strict';
  if ($('div').hasClass('mz-story-infinite-view')) {
    (function() {
      var first_resize;
      var viewPortWidth = $(window).width() + 17;
      $('.navigator .thumbnails').addClass('open');
      $('.hamburger-navigator').addClass('open');
      $('.row.navigator').addClass('open');
      $('.posts-navigator').show();
      $(window).resize(function() {
        $('.navigator .thumbnails').addClass('open');
        $('.row.navigator').addClass('open');
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
          $('.navigator .thumbnails').addClass('open');
          $('.hamburger-navigator');
          $('.navigator').removeClass('sticky transition').addClass('open');
        }
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
            $('.row.navigator').removeClass('open transition');
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
        }
      });
    })();
  }
});})(window.jQuery);
