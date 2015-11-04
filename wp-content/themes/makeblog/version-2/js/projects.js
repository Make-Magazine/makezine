jQuery(document).ready(function ($) {

    // Handle the click actions on the list items in the steps box
    $('body').on('click', '#tabs li.steps', function () {
        var id = $(this).attr('id');

        // Progress the slider
        $('#steppers').find('.jstep#js-' + id).slideDown().removeClass('hide');
        $('#steppers').find('.jstep:not( #js-' + id + ')').slideUp();

        // Update the side navigation list
        $(this).addClass('current');
        $('#tabs li:not(#' + id + ')').removeClass('current');

        // Run our trackers
        googletag.pubads().refresh();
        ga('send', 'pageview');
    });

    // Allows us to advance in the slider
    $('body').on('click', '.nexter', function () {
        var id = $(this).attr('id');

        // Progress the slider
        $('#steppers').find('.jstep#js-' + id).slideDown().removeClass('hide');
        $('#steppers').find('.jstep:not( #js-' + id + ')').slideUp();

        // Update side navigation list
        $('#tabs').find(' li#' + id).addClass('current');
        $('#tabs').find('li:not( #' + id + ')').removeClass('current');

        // Run our trackers
        googletag.pubads().refresh();
        ga('send', 'pageview');
    });

    // Display all projects when we click "View All"
    $('body').on('click', '.aller', function () {
        // Display all the slides
        $('#steppers').find('.jstep').each(function () {
            $(this).removeClass('hide');
            $(this).slideDown();
        });

        // Hide the next/previous buttons
        $('#steppers .nexter, #steppers .disabled').hide();

        // Run our trackers
        googletag.pubads().refresh();
        ga('send', 'pageview');
    });

    jQuery('.carousel').on('slid', function () {
        jQuery('.slide').find('iframe').each(function () {
            jQuery(this).attr('src', '');
            var url = jQuery(this).attr('data-src');
            jQuery(this).delay(1000).attr('src', url);
        });
        // Find the active slide, and then add an active class to the thumb.
        var index = jQuery(this).find('.active').data('index');
        jQuery('.inner-thumbs .active').removeClass('active');
        jQuery('*[data-slide-to="' + index + '"]').addClass('active');
        if (!jQuery(this).hasClass('huffington')) {
            googletag.pubads().refresh();
        }
        ga('send', 'pageview');
        var urlref = location.href;
        PARSELY.beacon.trackPageView({
            url: urlref,
            urlref: urlref,
            js: 1,
            action_name: "Next Slide"
        });
        return true;
    });
    if (jQuery('.item.active')) {
        jQuery('.slide').find('iframe').each(function () {
            var url = jQuery(this).attr('src');
            jQuery(this).attr('data-src', url);
        });
    } else {
        jQuery('.slide').find('iframe').each(function () {
            var url = jQuery(this).attr('src');
            jQuery(this).attr('data-src', url);
        });
    }

    jQuery('.thumbs').click(function () {
        var mydata = jQuery(this).data();
        jQuery('#' + mydata.loc + ' .main').attr('src', mydata.src);
    });

    jQuery('.modal').on('show', function () {
        // Check to see if we have shown the video. If so, bail so that we don't embed multiples.
        if (jQuery(this).attr('data-shown') !== 'true') {
            // Get the URL of the video.
            var id = jQuery(this).attr('data-video');
            // Create a link in the modal body.
            jQuery('.modal-body .link', this).append('<a href="' + id + '" class="oembed">Video Link</a>');
            // Trigger the jQuery Oembed
            jQuery("a.oembed").oembed();
        }
    });

    jQuery('.modal').on('hide', function () {
        // Add a data-shown="true" to the modal. Will prevent further lookups.
        jQuery(this).attr('data-shown', 'true');
        // Look for the iframe tag, and clear the video SRC out.
        var video = jQuery('.modal-body', this).find('iframe');
        var url = video.attr('src');
        // Empty the src attribute so we can stop the video when it closes. Then we'll put it back right after.
        video.attr('src', '');
        video.attr('src', url);
    });
    jQuery('.huff .starter').click(function () {
        jQuery('.huff').removeClass('small');
        jQuery(this).hide();
        jQuery('.nexus').show();

        // Open external links inside gallery into new window
        jQuery('.scroller a').each(function () {
            var link = new RegExp('/' + window.location.host + '/');
            if (!link.test(this.href)) {
                jQuery(this).click(function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    window.open(this.href, '_blank');
                });
            }
        });

        // Listen for a keydown event and run the proper action.
        jQuery(document).keydown(function (event) {
            switch (event.which) {
                case 37:
                    jQuery('.carousel').carousel('prev');
                    jQuery('.carousel').on('slid', function () {
                        jQuery(this).carousel('pause');
                    });
                    break;
                case 39:
                    jQuery('.carousel').carousel('next');
                    jQuery('.carousel').on('slid', function () {
                        jQuery(this).carousel('pause');
                    });
                    break;
                case 27:
                    jQuery('.huff').addClass('small');
                    jQuery('.huff .starter').show();

                    // Disable our event listener
                    jQuery(document).off('keydown');
                    break;
            }
        });

    });
    jQuery(".huff .close").click(function () {
        jQuery('.huff').addClass('small');
        jQuery('.huff .starter').show();

        // Disable our event listener
        jQuery(document).off('keydown');
    });
    (function ($) {
        $(document.body).on('post-load', function () {
            googletag.pubads().refresh();
            ga('send', 'pageview');
        });
    })(jQuery);

    (function ($) {
        $(document.body).on('post-load', function () {
            googletag.pubads().refresh();
            ga('send', 'pageview');
        });
    })(jQuery);

    jQuery('.print-page').on('click', function () {
        window.print();
    });

    var currentDataDiff = '';
    var checkerSelectDiff = 0;
    var checkerSelectDur = 0;
    $(document).on('click', '.all-lvl', function () {
        jQuery('.diff-item li span').removeClass('diff-selected filter_selected');
        if (checkerSelectDiff == 0) {
            jQuery('.all-lvl').addClass('diff-selected');
            $(this).addClass('filter_selected');
            checkerSelectDiff = 1;
        } else {
            $(this).removeClass('filter_selected diff-selected');
            checkerSelectDiff = 0;
        }
        jQuery('.clear').addClass('show-me');
    });
    $(document).on('touchstart', '.all-lvl', function () {
        jQuery('.diff-item li span').removeClass('diff-selected filter_selected');
        if (checkerSelectDiff == 0) {
            jQuery('.all-lvl').addClass('diff-selected');
            $(this).addClass('filter_selected');
            checkerSelectDiff = 1;
        } else {
            $(this).removeClass('filter_selected diff-selected');
            checkerSelectDiff = 0;
        }
        jQuery('.clear').addClass('show-me');
    });

    $(document).on('touchstart click', '.moderate', function () {
        jQuery('.diff-item li span').removeClass('diff-selected filter_selected');
        jQuery('.all-lvl').addClass('diff-selected');
        jQuery('.moderate').addClass('diff-selected');
        $(this).addClass('filter_selected');
        jQuery('.clear').addClass('show-me');
        checkerSelectDiff = 0;
    });


    $(document).on('touchstart click', '.spec-skill', function () {
        jQuery('.diff-item li span').removeClass('diff-selected filter_selected');
        jQuery('.spec-skill').addClass('diff-selected');
        jQuery('.all-lvl').addClass('diff-selected');
        jQuery('.moderate').addClass('diff-selected');
        $(this).addClass('filter_selected');
        jQuery('.clear').addClass('show-me');
        checkerSelectDiff = 0;
    });

    $(document).on('touchstart click', '.1-3h', function () {
        jQuery('.duration-item li span').removeClass('dur-selected filter_selected');
        if (checkerSelectDur == 0) {
            jQuery('.1-3h').addClass('dur-selected');
            $(this).addClass('filter_selected');
            checkerSelectDur = 1;
        } else {
            $(this).removeClass('filter_selected dur-selected');
            checkerSelectDur = 0;
        }
        jQuery('.clear').addClass('show-me');
    });

    $(document).on('touchstart click', '.3-8h', function () {
        jQuery('.duration-item li span').removeClass('dur-selected filter_selected');
        jQuery('.3-8h').addClass('dur-selected');
        jQuery('.1-3h').addClass('dur-selected');
        $(this).addClass('filter_selected');
        jQuery('.clear').addClass('show-me');
        checkerSelectDur = 0;
    });

    $(document).on('touchstart click', '.8-16h', function () {
        jQuery('.duration-item li span').removeClass('dur-selected filter_selected');
        jQuery('.8-16h').addClass('dur-selected');
        jQuery('.1-3h').addClass('dur-selected');
        jQuery('.3-8h').addClass('dur-selected');
        $(this).addClass('filter_selected');
        jQuery('.clear').addClass('show-me');
        checkerSelectDur = 0;
    });

    $(document).on('touchstart click', '.16h', function () {
        jQuery('.duration-item li span').removeClass('dur-selected filter_selected');
        jQuery('.8-16h').addClass('dur-selected');
        jQuery('.1-3h').addClass('dur-selected');
        jQuery('.3-8h').addClass('dur-selected');
        jQuery('.16h').addClass('dur-selected');
        $(this).addClass('filter_selected');
        jQuery('.clear').addClass('show-me');
        checkerSelectDur = 0;
    });

    $(document).on('touchstart click', '.clear', function () {
        jQuery('.duration-item li span').removeClass('dur-selected dur-hover filter_selected');
        jQuery('.diff-item li span').removeClass('diff-selected diff-hover filter_selected');
        jQuery('div.post-filter p').removeClass('current');
        jQuery('div.post-filter p.recent').addClass('current filter_selected');
        jQuery('.clear').removeClass('show-me');
        jQuery('.sortby div.post-filter p.recent').removeClass('filter_selected');
        jQuery('.mobile-dur .duration-item li').removeClass('filter_selected').hide();
        jQuery('.mobile_diff .diff-item li').removeClass('filter_selected current').hide();
        jQuery('.diff-item li.first-item').show().addClass('current');
        checkerSelectDiff = 0;
        checkerSelectDur = 0;
        jQuery('.first-item').show().addClass('current');
        jQuery('.filter-applied').hide();
        jQuery('.filter_max .filter').removeClass('open-list chosen')
    });

    $(document).on('touchstart click', '.recent', function () {
        jQuery('.popular').removeClass('current filter_selected');
        jQuery('.recent').addClass('current');
        $(this).addClass('filter_selected');
    });

    $(document).on('touchstart click', '.popular', function () {
        jQuery('.recent').removeClass('current filter_selected');
        jQuery('.popular').addClass('current');
        $(this).addClass('filter_selected');
    });

    if (($('.all-projects').hasClass('pc')) || ($('.projects-cat').hasClass('pc'))) {
        jQuery('.all-lvl').hover(function () {
            jQuery('.all-lvl').toggleClass('diff-hover');
        });
        jQuery('.moderate').hover(function () {
            jQuery('.all-lvl').toggleClass('diff-hover');
            jQuery('.moderate').toggleClass('diff-hover');
        });
        jQuery('.spec-skill').hover(function () {
            jQuery('.spec-skill').toggleClass('diff-hover');
            jQuery('.all-lvl').toggleClass('diff-hover');
            jQuery('.moderate').toggleClass('diff-hover');
        });
        jQuery('.1-3h').hover(function () {
            jQuery('.1-3h').toggleClass('dur-hover');
        });
        jQuery('.3-8h').hover(function () {
            jQuery('.1-3h').toggleClass('dur-hover');
            jQuery('.3-8h').toggleClass('dur-hover');
        });
        jQuery('.8-16h').hover(function () {
            jQuery('.8-16h').toggleClass('dur-hover');
            jQuery('.1-3h').toggleClass('dur-hover');
            jQuery('.3-8h').toggleClass('dur-hover');
        });
        jQuery('.16h').hover(function () {
            jQuery('.8-16h').toggleClass('dur-hover');
            jQuery('.1-3h').toggleClass('dur-hover');
            jQuery('.3-8h').toggleClass('dur-hover');
            jQuery('.16h').toggleClass('dur-hover');
        });
    }


    $(document).on('touchstart click', '.mobile_diff ul.diff-item li', function () {
        $('.mobile_diff ul.diff-item li').removeClass('filter_selected');
        $(this).addClass('filter_selected');
    });

    $(document).on('touchstart click', '.mobile-dur .duration-item li', function () {
        $(this).addClass('filter_selected');
    });

    var indikator = ".minify .fa-chevron-down";
    var cat_wrapp_indicator = 0;
    var scrollTop = $(window).scrollTop();
    $(window).scroll(function () {
        $window = $(window).width();
    });
    if (scrollTop >= '530') {
        jQuery('.minify').addClass('sticky');
        jQuery(indikator).show();
        if (($window > '768') || ( $('.all-projects ').hasClass('tablet') ) || ( $('.projects-cat ').hasClass('tablet') )) {
            if (cat_wrapp_indicator == 0) {
                jQuery('.minify .cat-list-wrapp').hide();
            }
            else {
                jQuery('.minify .cat-list-wrapp').slideDown();
            }
        }
    } else {
        jQuery('.minify').removeClass('sticky');
        jQuery(".minify .fa-chevron-up").hide();
        jQuery(".minify .fa-chevron-down").hide();
        jQuery('.minify .cat-list-wrapp').show();
    }
    var what_filter = 'max';
    jQuery(window).scroll(function () {
        var scrollTop = $(window).scrollTop();

        if (scrollTop >= '300') {
            what_filter = 'min';
            jQuery('.minify').addClass('sticky').slideDown();
            jQuery(indikator).show();
            if (($window > '768') || ( $('.all-projects ').hasClass('tablet') ) || ( $('.projects-cat ').hasClass('tablet') )) {

                if (cat_wrapp_indicator == 0) {
                    jQuery('.minify .cat-list-wrapp').hide();
                } else {
                    jQuery('.minify .cat-list-wrapp').show();
                }
            }
        } else {
            jQuery('.minify').removeClass('sticky').hide();
            jQuery(".minify .fa-chevron-up").hide();
            jQuery(".minify .fa-chevron-down").hide();
            jQuery('.minify .cat-list-wrapp').show();
            what_filter = 'max';
        }
    });

    jQuery(".minify .fa-chevron-down").hide();
    jQuery(".minify .fa-chevron-up").click(function () {
        jQuery('.minify .cat-list-wrapp').slideToggle("slow");
        jQuery(".minify .fa-chevron-up").hide();
        jQuery(".minify .fa-chevron-down").show();
        indikator = ".minify .fa-chevron-down";
        cat_wrapp_indicator = 0;
    });
    jQuery(".minify .fa-chevron-down").click(function () {
        jQuery('.minify .cat-list-wrapp').slideToggle("slow");
        jQuery(".minify .fa-chevron-down").hide();
        jQuery(".minify .fa-chevron-up").show();
        indikator = ".minify .fa-chevron-up";
        cat_wrapp_indicator = 1;
    });
    $.ajax({
        url: '/wp-admin/admin-ajax.php',
        data: {
            'action': 'make_shopify_featured_products'
        },
        success: function (data) {
            jQuery(".before-ads").after(data);
        },
        error: function (errorThrown) {
        }
    });

    $(document).on('touchstart click', '.filter-item ul li ul li span', function () {
        if ($(this).hasClass('clicks')) {
            $('.spinner').show();
            getProjects();
        }
    });
    $(document).on('touchstart click', '.clear', function () {
        $('.spinner').show();
        getProjects();
    });
    $(document).on('touchstart click', '.post-filter p', function () {
        $('.spinner').show();
        getProjects();
    });

    $(document).on('touchstart click', '.mobile_diff .clicks', function () {
        $('.spinner').show();
        getProjects();
    });

    $(document).on('touchstart click', '.mobile-dur ul li', function () {
        if ($(this).hasClass('clicks')) {
            $('.spinner').show();
            getProjects();
        }
    });
    function getProjects(type, callback) {
        var DataDiff, DataDur, DataCat, DataSort;

        if (typeof type === 'undefined') type = 'initial_load';
        if (typeof callback === 'undefined') callback = function () {
        };

        if (type === 'initial_load') paged = 1;

        //if ( what_filter == 'max' ) {
        DataDiff = $('.project-navigation ul.diff-item .filter_selected').attr('data-value');
            $('.minify ul.diff-item .filter_selected').attr('data-value', DataDiff);
        DataDur = $('.project-navigation ul.duration-item .filter_selected').attr('data-value');
            $('.minify ul.duration-item .filter_selected').attr('data-value', DataDur);
        DataSort = $('.project-navigation .post-filter .filter_selected').attr('data-value');
            $('.minify .filter_selected').attr('data-value', DataSort);
        DataCat = $('.cat-list-wrapp h1').attr('data-value');
            $('.minify .cat-list-wrapp h1').attr('data-value', DataCat);
        //} else {
            DataDiff = $('.minify ul.diff-item .filter_selected').attr('data-value');
                $('.project-navigation ul.diff-item .filter_selected').attr('data-value', DataDiff);
            DataDur = $('.minify ul.duration-item .filter_selected').attr('data-value');
                $('.project-navigation ul.duration-item .filter_selected').attr('data-value', DataDur);
            DataSort = $('.minify .filter_selected').attr('data-value');
                $('.project-navigation .post-filter .filter_selected').attr('data-value', DataSort);
            DataCat = $('.minify .cat-list-wrapp h1').attr('data-value');
                $('.cat-list-wrapp h1').attr('data-value', DataCat);
        //}
        console.log(DataDiff, ' ', DataDur, ' ',  DataCat);
        $.ajax({
            type: 'POST',
            url: '/wp-admin/admin-ajax.php',
            data: {
                action: 'sorting_posts',
                diff: DataDiff,
                dur: DataDur,
                sort: DataSort,
                cat: DataCat,
                type: type,
                paged: paged
            },
            success: function (data) {
                var projectsWrapper = $(".selected-posts-list");
                $('.spinner').hide();
                if (type === 'load_more') {
                    projectsWrapper.append(data);
                    callback();

                } else {
                    projectsWrapper.remove();
                    $(".posts-list").html(data);
                }

                var error_message = $(".posts-list").find('.error_message');
                if (error_message.length > 0) {
                    return;
                }

                $.ajax({
                    url: '/wp-admin/admin-ajax.php',
                    data: {
                        'action': 'make_shopify_featured_products'
                    },
                    success: function (data) {
                        jQuery(".before-ads").after(data);
                    },
                    error: function (errorThrown) {
                    }
                });

            },
            error: function (errorThrown) {
            }
        });
    }

    var paged = 1;

    $(document).on('touchstart click', '#pbd-alp-load-posts a', function () {
        if (!$(this).hasClass('first-click')) {
            $(this).addClass('first-click');
            paged++;
            // Show that we're working.
            $(this).text('Loading');
            $(this).parent().addClass('loading');
            $(".before-ads:first").removeClass('before-ads');
            getProjects('load_more', function () {
                var max_num_pages = $(".selected-posts-list").attr('data-max_num_pages');
                if (parseInt(max_num_pages) === paged) {
                    $('#pbd-alp-load-posts').remove();
                    return;
                }
                $('#pbd-alp-load-posts a').text('More');
                $('#pbd-alp-load-posts a').removeClass('first-click');
                $('#pbd-alp-load-posts').removeClass('loading');
                // Load placeholder ads.
                make.gpt.loadDyn();
            });
            return false;
        }
    });

    $(document).on('touchstart click', '#blog-load-posts a', function () {
        var get_offset = $("#blog-load-posts").attr('data-offset');
        var blog_output_with_ajax = '';
        $(this).text('Loading');
        $(this).parent().addClass('loading');
        $.ajax({
            type: 'POST',
            url: '/wp-admin/admin-ajax.php',
            data: {
                action: 'blog_output_with_ajax',
                offset: get_offset
            },
            success: function (data) {
                $('#blog-load-posts').remove();
                $('.container.all-stories .post-list').append('<li class="row post">' + data);
            },
            error: function (data) {

            }
        });
    });

    // MOBILE NAVIGATION

    jQuery(document).mouseup(function (e) {
        if (e.which != 1) return false;
        var container = $(".filter_max .filter" );
        if (container.has(e.target).length === 0) {
            container.hide('slow');
            $('.filter_max .sortby').hide('slow');
            jQuery('.filter_mini').show('slow');
            $('.filter_max').removeClass('show-now');
        }
    });

    $(document).on('touchstart click', '.filter_mini .filter-button', function (event) {
        event.stopPropagation();
        event.preventDefault();
        $('.filter_mini').hide('slow');
        $('.filter_max .filter').show('slow');
        $('.filter_max').addClass('show-now');
    });

    $(document).on('touchstart click', '.filter_mini .sort-button', function (event) {
        event.stopPropagation();
        event.preventDefault();
        $('.filter_mini').hide('slow');
        $('.filter_max .sortby').show('slow');
        $('.filter_max').addClass('show-now');
    });

        $(document).on('touchstart click', '.close-button', function (event) {
            event.stopPropagation();
            event.preventDefault();
            $('.filter_max .filter').hide('slow');
            $('.filter_mini').show('slow');
            $('.filter_max').removeClass('show-now');
            $('.filter-applied').show();
        });

    $(document).on('change', '#mobile_cat', function () {
        var cat_id;
        cat_id = $(this).val();
        $('.project-category-title').attr('data-value', cat_id);
        var cat_link;
        var cat_href;
        cat_link = $(this).val();
        cat_href = $('a.' + cat_link).attr('href') + '/';
        window.location.replace(cat_href);

    });

    $(document).on('touchstart click', '.mobile-dur ul.duration-item li', function (event) {
        event.stopPropagation();
        event.preventDefault();
        if ($(this).hasClass('current')) {
            $('.mobile-dur ul.duration-item li').removeClass('chosen').addClass('clicks');
            onClickDurationList();
            $(this).removeClass('current').show().addClass('chosen');
        } else {
            onClickDurationCheck();
            $(this).show('fast').addClass('current').removeClass('clicks');
        }
    });

    function onClickDurationList() {
        $('.mobile-dur ul.duration-item li').show('slow').removeClass('filter_selected');
        $('.mobile-dur ul.duration-item').addClass('open-list');
    }

    function onClickDurationCheck() {
        $('.mobile-dur ul.duration-item li').removeClass('current');
        $('.mobile-dur ul.duration-item li').hide('slow');
        $(this).show('fast');
        $('.mobile-dur ul.duration-item').removeClass('open-list chosen');
    }


    $(document).on('touchstart click', '.mobile_diff ul.diff-item li', function (event) {
        event.stopPropagation();
        event.preventDefault();
        if ($(this).hasClass('current')) {
            $('.mobile_diff ul.diff-item li').removeClass('chosen').addClass('clicks');
            onClickDiffList();
            $(this).removeClass('current').show().addClass('chosen');
        } else {
            onClickDiffCheck();
            $(this).show('fast').addClass('current').removeClass('clicks');
        }
    });

    function onClickDiffList() {
        $('.mobile_diff ul.diff-item li').show('slow').removeClass('filter_selected');
        $('.mobile_diff ul.diff-item').addClass('open-list');
    }

    function onClickDiffCheck() {
        $('.mobile_diff ul.diff-item li').removeClass('current');
        $('.mobile_diff ul.diff-item li').hide('slow');
        $(this).show('fast');
        $('.mobile_diff ul.diff-item').removeClass('open-list chosen');
    }


    $(".filter-item ul li ul li span").tooltip({
        'delay': {show: 1, hide: 0}
    }).hover(function () {
        $('.fade').removeClass('fade');
    });
});
