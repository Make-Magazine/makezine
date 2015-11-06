$( document ).ready(function() {
    if ($('div').hasClass('single')) {
        var scrollArray = [];
        var $top;
        var $flag = -1;
        $navigatorHeight = $(window).height() - 102;
        $('.thumbnails').css('height', $navigatorHeight);
        $(window).scroll(function () {
            $('.single .container .row.story-header').each(function (index) {
                $top = $(this).offset().top - 100;
                scrollArray[index] = $top;
            });
            var $scrollTop = $(window).scrollTop();
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
            if ($scrollTop >= '54') {
                $('.navigator').addClass('sticky');
            } else {
                $('.navigator').removeClass('sticky');
            }
        });
        $('.latest-story a').click(function () {
            $current = $(this);
            $newFlag = $(this).parent().index();
            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top
            }, 500);
            window.setTimeout(function () {
                $('.latest-story a').removeClass('highlighted');
                $($current).addClass('highlighted');
                $flag = $newFlag
            }, 501);
            return false;
        });
        $('.hamburger-navigator img').click(function () {
            if ($(this).parent().hasClass('open')) {
                $('.posts-navigator').slideUp('250');
                window.setTimeout(function () {
                    $('.hamburger-navigator').removeClass('open');
                    $('.thumbnails').removeClass('open');
                }, 390);
            }
            if (!$(this).parent().hasClass('open')) {
                $('.thumbnails').addClass('open');
                $('.hamburger-navigator').addClass('open');
                window.setTimeout(function () {
                    $('.posts-navigator').slideDown('250');
                }, 250);
            }
        });
    }
});
