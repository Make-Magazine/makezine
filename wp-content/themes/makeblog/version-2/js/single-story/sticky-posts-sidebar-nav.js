(function($) { $(function() {
  'use strict';
  if ($('div').hasClass('mz-story-infinite-view')) {
    (function() {
      $('.sticky-sidebar-posts-nav .thumbnails').addClass('open');
      $('.hamburger-navigator').addClass('open');
      $('.sticky-sidebar-posts-nav').addClass('open');
      $('.posts-navigator').show();
      $(window).resize(function() {
        $('.sticky-sidebar-posts-nav .thumbnails').addClass('open');
        $('.sticky-sidebar-posts-nav').addClass('open');
      });
      $(window).scroll(function() {
        var $scrollTop = $(window).scrollTop();
        if ($scrollTop >= '100') {
          $('.sticky-sidebar-posts-nav').addClass('sticky');
          if ($('.sticky-sidebar-posts-nav').hasClass('open')) {
            $('.sticky-sidebar-posts-nav').addClass('transition');
          }
        } else {
          $('.posts-navigator').show();
          $('.sticky-sidebar-posts-nav .thumbnails').addClass('open');
          $('.hamburger-navigator');
          $('.sticky-sidebar-posts-nav').removeClass('sticky transition').addClass('open');
        }
        stickySideBarDetectsFooter();
      });

      // Detect footer and shrink sticky sidebar to not overlap footer:
      var stickySideBarDetectsFooter = function() {
        var footerPos = $('#footer').offset().top;
        var currentScroll = $(window).scrollTop();
        var sidebarElem = $('.sticky-sidebar-posts-nav');
        if (!$('#footer').is(':visible') || footerPos > $(window).height() + currentScroll) {
          sidebarElem.css({
            'max-height': '',
            'overflow': ''
          });
          return;
        }
        var dynamicHeight = footerPos - sidebarElem.offset().top;
        dynamicHeight = (dynamicHeight > 0) ? dynamicHeight : 0;
        sidebarElem.css({
          'max-height': dynamicHeight,
          'overflow': 'hidden'
        });
      };

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
            $('.sticky-sidebar-posts-nav').removeClass('open transition');
            $('.hamburger-navigator').removeClass('open');
            $('.thumbnails').removeClass('open');

          }, 390);
        }
        if (!$(this).hasClass('open')) {
          $('.thumbnails').addClass('open');
          $('.hamburger-navigator').addClass('open');
          $('.sticky-sidebar-posts-nav').addClass('open');
          window.setTimeout(function() {
            $('.posts-navigator').slideDown('250');
          }, 250);
        }
      });
    })();
  }
});})(window.jQuery);
