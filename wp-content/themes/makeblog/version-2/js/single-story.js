$( document ).ready(function() {
    if ($('div').hasClass('single')) {
        $('.comments').hide();
        var scrollArray = [];
        var $top;
        var $flag = -1;
        var $offset = 0;
        var $first_time = 0;
        var $first_resize = 0;
        var $navigatorMargin = $('.first-story .story-title').height() + 64;
        $('.row.navigator').css('margin-top',$navigatorMargin);
        $('.span8 iframe').css('max-width','100%');
        $thumbnailsHeight = $(window).height() - 102;
        $navigatorHeight = $(window).height() - 50;
        $('.navigator .thumbnails').css('height', $thumbnailsHeight);
        $(window).resize(function () {
            var $navigatorMargin = $('.first-story .story-title').height() + 64;
            $('.row.navigator').css('margin-top',$navigatorMargin);
            $window = $(window).width() + 17;
            if ($window <= 767) {
                if ($first_resize == 0) {
                    $first_resize = 1;
                    //$('.thumbnails').css('height', '');
                    $('.more-thumbnails .posts-navigator').css('display', '');
                } else {
                    //$('.thumbnails').css('height', $thumbnailsHeight);
                }
            }
        });
        $(window).scroll(function () {
            $('.single .container .row.story-header').each(function (index) {
                $top = $(this).offset().top - 100;
                scrollArray[index] = $top;
            });
            var infinity = $('.row.infinity').offset().top - $(window).height() - 1000;
            var $scrollTop = $(window).scrollTop();
            if ($(window).width() <= 767) {
                if ($scrollTop >= infinity) {
                    if ($first_time == 0) {
                        $first_time = 1;
                        $('.row.infinity').addClass('current');
                        getStory($offset);
                        $offset = $offset + 9;
                    }
                }
            }
            if ($scrollTop < scrollArray[1]) {
                if (($flag == -1) || ($flag == 1)) {
                    $('.latest-story a').removeClass('highlighted');
                    $('.latest-story:nth-child(1) a').addClass('highlighted');
                    $flag = 0;
                }
            }
            if (($scrollTop >= scrollArray[1]) && ($scrollTop < scrollArray[2])) {
                if (($flag == 0) || ($flag == 2)) {
                    $('.latest-story a').removeClass('highlighted');
                    $('.latest-story:nth-child(2) a').addClass('highlighted');
                    $flag = 1;
                }
            }
            if (($scrollTop >= scrollArray[2]) && ($scrollTop < scrollArray[3])) {
                if (($flag == 1) || ($flag == 3)) {
                    $('.latest-story a').removeClass('highlighted');
                    $('.latest-story:nth-child(3) a').addClass('highlighted');
                    $flag = 2;
                }
            }
            if (($scrollTop >= scrollArray[3]) && ($scrollTop < scrollArray[4])) {
                if (($flag == 2) || ($flag == 4)) {
                    $('.latest-story a').removeClass('highlighted');
                    $('.latest-story:nth-child(4) a').addClass('highlighted');
                    $flag = 3;
                }
            }
            if (($scrollTop >= scrollArray[4]) && ($scrollTop < scrollArray[5])) {
                if (($flag == 3) || ($flag == 5)) {
                    $('.latest-story a').removeClass('highlighted');
                    $('.latest-story:nth-child(5) a').addClass('highlighted');
                    $flag = 4;
                }
            }
            if (($scrollTop >= scrollArray[5]) && ($scrollTop < scrollArray[6])) {
                if (($flag == 4) || ($flag == 6)) {
                    $('.latest-story a').removeClass('highlighted');
                    $('.latest-story:nth-child(6) a').addClass('highlighted');
                    $flag = 5;
                }
            }
            if (($scrollTop >= scrollArray[6]) && ($scrollTop < scrollArray[7])) {
                if (($flag == 5) || ($flag == 7)) {
                    $('.latest-story a').removeClass('highlighted');
                    $('.latest-story:nth-child(7) a').addClass('highlighted');
                    $flag = 6;
                }
            }
            if (($scrollTop >= scrollArray[7]) && ($scrollTop < scrollArray[8])) {
                if (($flag == 6) || ($flag == 8)) {
                    $('.latest-story a').removeClass('highlighted');
                    $('.latest-story:nth-child(8) a').addClass('highlighted');
                    $flag = 7;
                }
            }
            if (($scrollTop >= scrollArray[8]) && ($scrollTop < scrollArray[9])) {
                if (($flag == 7) || ($flag == 9)) {
                    $('.latest-story a').removeClass('highlighted');
                    $('.latest-story:nth-child(9) a').addClass('highlighted');
                    $flag = 8;
                }
            }
            if ($scrollTop >= scrollArray[9]) {
                if (($flag == 8)) {
                    $('.latest-story a').removeClass('highlighted');
                    $('.latest-story:nth-child(10) a').addClass('highlighted');
                    $flag = 9;
                }
            }
            if ($scrollTop >= '200') {
                $('.navigator').addClass('sticky');
            } else {
                $('.navigator').removeClass('sticky');
            }
        });
        $('.thumbnails .latest-story a').click(function () {
            $current = $(this);
            $newFlag = $(this).parent().index();
            $id = $(this).attr('id');
            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top
            }, 500);
            window.setTimeout(function () {
                $('.latest-story a').removeClass('highlighted');
                $($current).addClass('highlighted');
                $flag = $newFlag
            }, 501);
            window.history.pushState('obj', 'newtitle', $id);
            return false;
        });
        $('.hamburger-navigator img').click(function () {
            if ($(this).parent().hasClass('open')) {
                $('.row.navigator').css('height', '');
                $('.row.navigator').css('border', '');
                $('.posts-navigator').slideUp('250');
                window.setTimeout(function () {
                    $('.hamburger-navigator').removeClass('open');
                    $('.hamburger-navigator h2').hide();
                    $('.thumbnails').removeClass('open');
                }, 390);
            }
            if (!$(this).parent().hasClass('open')) {
                $('.thumbnails').addClass('open');
                $('.hamburger-navigator').addClass('open');
                window.setTimeout(function () {
                    $('.hamburger-navigator h2').show();
                    $('.posts-navigator').slideDown('250');
                }, 250);
                window.setTimeout(function () {
                    $('.row.navigator').css('height', $navigatorHeight);
                    $('.row.navigator').css('border', '1px solid #979797');
                }, 600);

            }
        });
        function getStory($offset) {
            var firstPostId = $('.first-story').attr('id');
            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data: {
                    'offset': $offset,
                    'excludeId': firstPostId,
                    'action': 'get_story_with_ajax'
                },
                success: function (data) {
                    jQuery(".row.infinity").after(data);
                    jQuery(".row.infinity.current").remove();
                    $first_time = 0;
                },
                error: function (errorThrown) {
                }
            });
        }
        $(document).on('click touchstart', '.comments-button', function () {
            if (!$(this).hasClass('open')){
                $(this).parent().parent().find('.comments').slideDown(500);
                $(this).addClass('open');
                var $commentsHeight = $(this).parent().parent().find('#disqus_thread').height();
                $(this).parent().css('margin-top', $commentsHeight);
            }else {
                $(this).removeClass('open');
                $(this).parent().css('margin-top','0');
                $(this).parent().parent().find('.comments').slideUp(500);
            }

        });
        $('blockquote').each(function(){
            $quoteMarginTop = -($(this).height() + 175);
            $(this).after('<div class="quote" style="margin-top: '+$quoteMarginTop+'px"></div>');
        });
        var $quoteMargin = ($('blockquote').width() + 62 -68) / 2;
        $('.quote').css('margin-left',$quoteMargin);
    }
});
