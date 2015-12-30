$(document).ready(function () {
    if ($('div').hasClass('single')) {

        /* social share buttons reload counters */
        var basic_network_list = "twitter,linkedin,facebook,pinterest,google,stumbleupon,vk,reddit,buffer,love,ok,mwp,xing,pocket,mail,print,comments,yummly";
        var extended_network_list = "del,digg,weibo,flattr,tumblr,whatsapp,meneame,blogger,amazon,yahoomail,gmail,aol,newsvine,hackernews,evernote,myspace,mailru,viadeo,line,flipboard,sms,viber";

        var plugin_url = essb_settings.essb3_plugin_url;
        var fb_value = essb_settings.essb3_facebook_total;
        var counter_admin = essb_settings.essb3_admin_ajax;
        var interal_counters_all = essb_settings.essb3_internal_counter;
        var button_counter_hidden = essb_settings.essb3_counter_button_min;
        var no_print_mail_counter = typeof(essb_settings.essb3_no_counter_mailprint) != "undefined" ? essb_settings.essb3_no_counter_mailprint : false;
        var force_single_ajax = typeof(essb_settings.essb3_single_ajax) != "undefined" ? essb_settings.essb3_single_ajax : false;
        var twitter_counter = typeof(essb_settings.twitter_counter) != "undefined" ? essb_settings.twitter_counter : "";

        if (twitter_counter == "") {
            twitter_counter = "api";
        }

        var essb_shorten_number = function (n) {
            if ('number' !== typeof n) n = Number(n);
            var sgn = n < 0 ? '-' : ''
                , suffixes = ['k', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y']
                , overflow = Math.pow(10, suffixes.length * 3 + 3)
                , suffix, digits;
            n = Math.abs(Math.round(n));
            if (n < 1000) return sgn + n;
            if (n >= 1e100) return sgn + 'many';
            if (n >= overflow) return (sgn + n).replace(/(\.\d*)?e\+?/i, 'e'); // 1e24

            do {
                n = Math.floor(n);
                suffix = suffixes.shift();
                digits = n % 1e6;
                n = n / 1000;
                if (n >= 1000) continue; // 1M onwards: get them in the next iteration
                if (n >= 10 && n < 1000 // 10k ... 999k
                    || (n < 10 && (digits % 1000) < 100) // Xk (X000 ... X099)
                )
                    return sgn + Math.floor(n) + suffix;
                return (sgn + n).replace(/(\.\d).*/, '$1') + suffix; // #.#k
            } while (suffixes.length)
            return sgn + 'many';
        }

        var essb_get_counters = function () {
            return $('.essb_links.essb_counters').each(function () {

                // missing plugin settings - code cannot run from here
                if (typeof(essb_settings) == "undefined") {
                    return;
                }

                var counter_pos = $(this).attr("data-essb-counter-pos") || "";
                var post_self_count_id = $(this).attr("data-essb-postid") || "";

                var url = $(this).attr("data-essb-url") || "";
                var twitter_url = $(this).attr("data-essb-twitter-url") || "";

                var instance_id = $(this).attr("data-essb-instance") || "";

                var ajax_url = essb_settings.ajax_url;
                if (essb_settings.ajax_type == "light") {
                    ajax_url = essb_settings.blog_url;
                }

                // definy the counter API
                var nonapi_counts_url = (counter_admin) ? ajax_url + "?action=essb_counts&nonce=" + essb_settings.essb3_nonce + "&" : essb_settings.essb3_plugin_url + "/public/get-noapi-counts.php?";
                var nonapi_internal_url = ajax_url + "?action=essb_counts&nonce=" + essb_settings.essb3_nonce + "&";
                //console.log(nonapi_internal_url);
                var basic_networks = basic_network_list.split(",");
                var extended_networks = extended_network_list.split(",");

                var direct_access_networks = [];
                var nonapi_count_networks = [];
                var nonapi_internal_count_networks = [];
                for (var i = 0; i < basic_networks.length; i++) {
                    if ($(this).find('.essb_link_' + basic_networks[i]).length) {
                        switch (basic_networks[i]) {
                            case "google":
                            case "stumbleupon":
                            case "vk":
                            case "reddit":
                            case "ok":
                            case "mwp":
                            case "xing":
                            case "pocket":
                                if (counter_admin) {
                                    nonapi_internal_count_networks.push(basic_networks[i]);
                                }
                                else {
                                    nonapi_count_networks.push(basic_networks[i]);
                                }
                                break;
                            case "love":
                            case "comments":
                                nonapi_internal_count_networks.push(basic_networks[i]);
                                break;
                            case "mail":
                            case "print":
                                if (!no_print_mail_counter) {
                                    nonapi_internal_count_networks.push(basic_networks[i]);
                                }
                                break;
                            case "twitter":
                                if (twitter_counter == "api") {
                                    direct_access_networks.push(basic_networks[i]);
                                }
                                else if (twitter_counter == "self") {
                                    nonapi_internal_count_networks.push(basic_networks[i]);
                                }
                                break;
                            default:
                                direct_access_networks.push(basic_networks[i]);
                                break;
                        }
                    }
                }

                if (interal_counters_all) {
                    for (var i = 0; i < extended_networks.length; i++) {
                        if ($(this).find('.essb_link_' + extended_networks[i]).length) {
                            nonapi_internal_count_networks.push(extended_networks[i]);
                        }
                    }
                }

                // start populating counters - direct access API counters
                var operating_elements = {};
                for (var i = 0; i < direct_access_networks.length; i++) {
                    var network = direct_access_networks[i];

                    operating_elements[network + "" + instance_id] = $(this).find('.essb_link_' + network);
                    operating_elements[network + '_inside' + instance_id] = operating_elements[network + instance_id].find('.essb_network_name');

                    switch (network) {
                        case "facebook":
                            var facebook_url = "https://graph.facebook.com/fql?q=SELECT%20like_count,%20total_count,%20share_count,%20click_count,%20comment_count%20FROM%20link_stat%20WHERE%20url%20=%20%22" + url + "%22";
                            $.getJSON(facebook_url)
                                .done(function (data) {
                                    if (fb_value) {
                                        counter_display(counter_pos, operating_elements['facebook' + instance_id], operating_elements['facebook_inside' + instance_id], data.data[0].total_count);
                                    }
                                    else {
                                        counter_display(counter_pos, operating_elements['facebook' + instance_id], operating_elements['facebook_inside' + instance_id], data.data[0].share_count);
                                    }
                                });
                            break;

                        case "twitter":
                            var twitter_url = "https://cdn.api.twitter.com/1/urls/count.json?url=" + twitter_url + "&callback=?";
                            $.getJSON(twitter_url)
                                .done(function (data) {
                                    counter_display(counter_pos, operating_elements['twitter' + instance_id], operating_elements['twitter_inside' + instance_id], data.count);
                                });
                            break;

                        case "linkedin":
                            var linkedin_url = "https://www.linkedin.com/countserv/count/share?format=jsonp&url=" + url + "&callback=?";
                            $.getJSON(linkedin_url)
                                .done(function (data) {
                                    counter_display(counter_pos, operating_elements['linkedin' + instance_id], operating_elements['linkedin_inside' + instance_id], data.count);
                                });
                            break;

                        case "pinterest":
                            var pinterest_url = "https://api.pinterest.com/v1/urls/count.json?callback=?&url=" + url;
                            $.getJSON(pinterest_url)
                                .done(function (data) {
                                    counter_display(counter_pos, operating_elements['pinterest' + instance_id], operating_elements['pinterest_inside' + instance_id], data.count);
                                });
                            break;
                        case "buffer":
                            var buffer_url = "https://api.bufferapp.com/1/links/shares.json?url=" + url + "&callback=?";
                            $.getJSON(buffer_url)
                                .done(function (data) {
                                    counter_display(counter_pos, operating_elements['buffer' + instance_id], operating_elements['buffer_inside' + instance_id], data.shares);
                                });
                            break;
                        case "yummly":
                            var yummly_url = "https://www.yummly.com/services/yum-count?callback=?&url=" + url;
                            $.getJSON(yummly_url)
                                .done(function (data) {
                                    counter_display(counter_pos, operating_elements['yummly' + instance_id], operating_elements['yummly_inside' + instance_id], data.count);
                                });
                            break;
                    }


                }

                for (var i = 0; i < nonapi_count_networks.length; i++) {
                    var network = nonapi_count_networks[i];

                    operating_elements[network + instance_id] = $(this).find('.essb_link_' + network);
                    operating_elements[network + '_inside' + instance_id] = operating_elements[network + instance_id].find('.essb_network_name');

                    var network_address = nonapi_counts_url + "nw=" + network + "&url=" + url + "&instance=" + instance_id;
                    $.getJSON(network_address)
                        .done(function (data) {
                            var cache_key = data.network + "|" + data.url;
                            counter_display(counter_pos, operating_elements[data.network + data.instance], operating_elements[data.network + '_inside' + data.instance], data.count);
                        });

                }

                var post_network_list = [];

                for (var i = 0; i < nonapi_internal_count_networks.length; i++) {
                    var network = nonapi_internal_count_networks[i];

                    post_network_list.push(network);
                    operating_elements[network + instance_id] = $(this).find('.essb_link_' + network);
                    operating_elements[network + '_inside' + instance_id] = operating_elements[network + instance_id].find('.essb_network_name');
                    //console.log('internal networks =' + network);
                    if (!force_single_ajax) {
                        var network_address = nonapi_internal_url + "nw=" + network + "&url=" + url + "&instance=" + instance_id + "&post=" + post_self_count_id;

                        $.getJSON(network_address)
                            .done(function (data) {
                                var counter = data[data.network] || "0";
                                counter_display(counter_pos, operating_elements[data.network + data.instance], operating_elements[data.network + '_inside' + data.instance], counter);
                            });
                    }
                }

                if (post_network_list.length > 0 && force_single_ajax) {
                    var network_address = nonapi_internal_url + "nw=" + post_network_list.join(",") + "&url=" + url + "&instance=" + instance_id + "&post=" + post_self_count_id;
                    //console.log(network_address);
                    $.getJSON(network_address)
                        .done(function (data) {

                            for (var i = 0; i < post_network_list.length; i++) {
                                var network_key = post_network_list[i];
                                var counter = data[network_key] || "0";

                                //console.log(network_key + " = " + counter);
                                counter_display(counter_pos, operating_elements[network_key + data.instance], operating_elements[network_key + '_inside' + data.instance], counter);
                            }
                        });

                }

                var counter_display = function (counter_pos, $element, $element_inside, $cnt) {
                    $css_hidden_negative = "";
                    if (button_counter_hidden != '') {
                        if (parseInt(button_counter_hidden) > parseInt($cnt)) {
                            $css_hidden_negative = ' style="display: none;"';
                        }
                    }

                    if (counter_pos == "right") {
                        $element.append('<span class="essb_counter_right" cnt="' + $cnt + '"' + $css_hidden_negative + '>' + essb_shorten_number($cnt) + '</span>');
                    }
                    else if (counter_pos == "inside") {
                        $element_inside.html('<span class="essb_counter_inside" cnt="' + $cnt + '"' + $css_hidden_negative + '>' + essb_shorten_number($cnt) + '</span>');
                    }
                    else if (counter_pos == "insidename") {
                        $element_inside.append('<span class="essb_counter_insidename" cnt="' + $cnt + '"' + $css_hidden_negative + '>' + essb_shorten_number($cnt) + '</span>');
                    }
                    else if (counter_pos == "insidehover") {
                        $element_inside.closest("a").append('<span class="essb_counter_insidehover" cnt="' + $cnt + '"' + $css_hidden_negative + '>' + essb_shorten_number($cnt) + '</span>');

                        // fix width of new element
                        var current_width = $element_inside.closest("a").find('.essb_network_name').innerWidth();
                        $element_inside.closest("a").find('.essb_counter_insidehover').width(current_width);
                    }
                    else if (counter_pos == "insidebeforename") {
                        $element_inside.prepend('<span class="essb_counter_insidebeforename" cnt="' + $cnt + '"' + $css_hidden_negative + '>' + essb_shorten_number($cnt) + '</span>');
                    }
                    else if (counter_pos == "bottom") {
                        $element_inside.html('<span class="essb_counter_bottom" cnt="' + $cnt + '"' + $css_hidden_negative + '>' + essb_shorten_number($cnt) + '</span>');
                    }
                    else if (counter_pos == "hidden") {
                        $element.append('<span class="essb_counter_hidden" cnt="' + $cnt + '"' + $css_hidden_negative + '></span>');
                    }
                    else {
                        $element.prepend('<span class="essb_counter" cnt="' + $cnt + '"' + $css_hidden_negative + '>' + essb_shorten_number($cnt) + '</span>');
                    }

                }
            });
        };
        /* end social shares buttons reload counters*/
        $('body').addClass('single-story');
        var topArray = [];
        var bottomArray = [];
        var $top;
        var infinity;
        var $flag = -1;
        var $offset = 0;
        var $first_time = 0;
        var $first_resize = 0;
        var $id = 0;
        var $parentId;
        var $scrollingToPost = 0;
        var stop = 0;
        $window = $(window).width() + 17;
        $thumbnailsHeight = $(window).height() - 76 - $('#wpadminbar').height();
        $('.span8 iframe').css('max-width', '100%');
        $navigatorHeight = $(window).height() - 50;
        $('.navigator .thumbnails').addClass('open').css('height', $thumbnailsHeight);
        $('.hamburger-navigator').addClass('open');
        $('.row.navigator').addClass('open').css('height', $navigatorHeight);
        $('.posts-navigator').show();
        $(window).resize(function () {
            $window = $(window).width() + 17;
            if ($window <= 767) {
                if ($first_resize == 0) {
                    $first_resize = 1;
                    $('.more-thumbnails .posts-navigator').css('display', '');
                }
            }
        });
        $(window).scroll(function () {
            $('.single .container .row.story-header').each(function (index) {
                $top = $(this).offset().top - 100;
                topArray[index] = $top;
            });
            $('.single .container .row.content').each(function (index) {
                $top = $(this).find('.essb_right_flag').offset().top - 100;
                bottomArray[index] = $top;
            });
            $window = $(window).width() + 17;
            if ($window <= 767) {
                infinity = $('.row.infinity').offset().top - $(window).height() - 1000;
            } else {
                infinity = $('.row.infinity').offset().top - 3100;
            }
            var $scrollTop = $(window).scrollTop();
            if ($scrollTop >= infinity) {
                if ($first_time == 0) {
                    $first_time = 1;
                    $('.row.infinity').addClass('current');
                    if ($(window).width() <= 767) {
                        getStoryThumbnail($offset);
                        $offset = $offset + 9;
                    } else {
                        if ($offset < 9) {
                            getStory($offset, 0, 1);
                            $offset = $offset + 1;
                        }else{
                            $('#footer').show();
                            $('.infinity').remove();
                        }
                    }
                }
            }
            if ($scrollTop < bottomArray[0]) {
                if (($flag == -1) || ($flag == 1)) {
                    thePostChanges(1);
                    stop = 1;
                    goTo = -1;
                    $('.content:nth-child(1) .essb_displayed_sidebar_right').show();
                }
                if ($scrollTop > 800) {
                    showSocialSidebar(0);
                } else {
                    $('.essb_displayed_sidebar_right').hide();
                }
            }
            if ((($scrollTop > (bottomArray[0] - 500)) && ($scrollTop < (topArray[1] + 800))) || (($scrollTop > (bottomArray[1] - 500)) && ($scrollTop < (topArray[2] + 800)))
                || (($scrollTop > (bottomArray[2] - 500)) && ($scrollTop < (topArray[3] + 800))) || (($scrollTop > (bottomArray[3] - 500)) && ($scrollTop < (topArray[4] + 800)))
                || (($scrollTop > (bottomArray[4] - 500)) && ($scrollTop < (topArray[5] + 800))) || (($scrollTop > (bottomArray[5] - 500)) && ($scrollTop < (topArray[6] + 800)))
                || (($scrollTop > (bottomArray[6] - 500)) && ($scrollTop < (topArray[7] + 800))) || (($scrollTop > (bottomArray[7] - 500)) && ($scrollTop < (topArray[8] + 800)))
                || (($scrollTop > (bottomArray[8] - 500)) && ($scrollTop < (topArray[9] + 800)))) {
                $('.essb_displayed_sidebar_right').hide();
            } else if (($scrollTop > (topArray[1] + 800)) && ($scrollTop < bottomArray[1])) {
                showSocialSidebar(1);
            } else if (($scrollTop > (topArray[2] + 800)) && ($scrollTop < bottomArray[2])) {
                showSocialSidebar(2);
            } else if (($scrollTop > (topArray[3] + 800)) && ($scrollTop < bottomArray[3])) {
                showSocialSidebar(3);
            } else if (($scrollTop > (topArray[4] + 800)) && ($scrollTop < bottomArray[4])) {
                showSocialSidebar(4);
            } else if (($scrollTop > (topArray[5] + 800)) && ($scrollTop < bottomArray[5])) {
                showSocialSidebar(5);
            } else if (($scrollTop > (topArray[6] + 800)) && ($scrollTop < bottomArray[6])) {
                showSocialSidebar(6);
            } else if (($scrollTop > (topArray[7] + 800)) && ($scrollTop < bottomArray[7])) {
                showSocialSidebar(7);
            } else if (($scrollTop > (topArray[8] + 800)) && ($scrollTop < bottomArray[8])) {
                showSocialSidebar(8);
            } else if (($scrollTop > (topArray[9] + 800)) && ($scrollTop < bottomArray[9])) {
                showSocialSidebar(9);
            }
            if (($scrollTop >= topArray[1]) && ($scrollTop < bottomArray[1])) {
                if (($flag == 0) || ($flag == 2)) {
                    thePostChanges(2);
                    sendGA();
                    stop = 0;
                }
            }
            if (($scrollTop >= topArray[2]) && ($scrollTop < bottomArray[2])) {
                if (($flag == 1) || ($flag == 3)) {
                    thePostChanges(3);
                    sendGA();
                }
            }
            if (($scrollTop >= topArray[3]) && ($scrollTop < bottomArray[3])) {
                if (($flag == 2) || ($flag == 4)) {
                    thePostChanges(4);
                    sendGA();
                }
            }
            if (($scrollTop >= topArray[4]) && ($scrollTop < bottomArray[4])) {
                if (($flag == 3) || ($flag == 5)) {
                    thePostChanges(5);
                    sendGA();
                }
            }
            if (($scrollTop >= topArray[5]) && ($scrollTop < bottomArray[5])) {
                if (($flag == 4) || ($flag == 6)) {
                    thePostChanges(6);
                    sendGA();
                }
            }
            if (($scrollTop >= topArray[6]) && ($scrollTop < bottomArray[6])) {
                if (($flag == 5) || ($flag == 7)) {
                    thePostChanges(7);
                    sendGA();
                }
            }
            if (($scrollTop >= topArray[7]) && ($scrollTop < bottomArray[7])) {
                if (($flag == 6) || ($flag == 8)) {
                    thePostChanges(8);
                    sendGA();
                }
            }
            if (($scrollTop >= topArray[8]) && ($scrollTop < bottomArray[8])) {
                if (($flag == 7) || ($flag == 9)) {
                    thePostChanges(9);
                    sendGA();
                }
            }
            if ($scrollTop >= topArray[9]) {
                if (($flag == 8)) {
                    thePostChanges(10);
                    sendGA();
                }
            }
            if ($scrollTop >= '100') {
                $('.navigator').addClass('sticky');
                if ($('.navigator').hasClass('open')){
                    $('.navigator').addClass('transition');
                }
            } else {
                $('.posts-navigator').show();
                $('.navigator .thumbnails').addClass('open').css('height', $thumbnailsHeight);
                $('.hamburger-navigator').addClass('open');
                $('.navigator').removeClass('sticky transition').addClass('open').css('height', $navigatorHeight);
            }
        });
        $('.thumbnails .latest-story a').click(function () {
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
                window.setTimeout(function () {
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
            if ($(".story-header").is($newId) === false) {
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
            window.setTimeout(function () {
                $('.latest-story a').removeClass('highlighted');
                $($current).addClass('highlighted');
                $flag = $newFlag;
                window.history.pushState('obj', 'newtitle', $href);
                document.title = $('.story-header').eq($newFlag).find('.story-title').text();
            }, 501);
            return false;
        });
        var newHighlightedStory;
        function thePostChanges(PostId){
            $('.latest-story a').removeClass('highlighted');
            newHighlightedStory = $('.latest-story').eq(PostId - 1);
            $(newHighlightedStory).find('a').addClass('highlighted');
            window.history.pushState('obj', 'newtitle', $(newHighlightedStory).find('a').attr('id'));
            document.title = $('.story-header').eq(PostId - 1).find('.story-title').text();
            $flag = PostId - 1;
        }
        function showBio(){
            $('.sidebar .author-name .bio-wrapper,.sidebar .avatar').mouseover(function () {
                $(this).find('.hover-info').show();
                $(this).addClass('hover');
            }).mouseleave(function () {
                $(this).find('.hover-info').hide();
                $(this).removeClass('hover');
            });
        }
        showBio();
        $('.hamburger-navigator').mouseover(function () {
            if (!$(this).hasClass('open')) {
                $(this).addClass('hover');
            }
        }).mouseleave(function () {
            $(this).removeClass('hover');
        }).click(function () {
            $(this).removeClass('hover');
            if ($(this).hasClass('open')) {
                $('.posts-navigator').slideUp('250');
                window.setTimeout(function () {
                    $('.row.navigator').removeClass('open transition').css('height', '').css('top', '');
                    $('.hamburger-navigator').removeClass('open');
                    $('.thumbnails').removeClass('open');

                }, 390);
            }
            if (!$(this).hasClass('open')) {
                $('.thumbnails').addClass('open');
                $('.hamburger-navigator').addClass('open');
                $('.row.navigator').addClass('open');
                window.setTimeout(function () {
                    $('.posts-navigator').slideDown('250');
                }, 250);
                window.setTimeout(function () {
                    $('.row.navigator').css('height', $navigatorHeight);
                }, 600);

            }
        });
        function sendGA() {
            ga('send', 'pageview',
                { 'page': location.pathname + location.search + location.hash }
            )
        }
        function getStoryThumbnail($offset) {
            var firstPostId = $('.first-story').attr('id');
            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data: {
                    'offset': $offset,
                    'excludeId': firstPostId,
                    'action': 'get_story_thumbnail_with_ajax'
                },
                success: function (data) {
                    $(".row.infinity").after(data);
                    $(".row.infinity.current").remove();
                    $first_time = 0;
                },
                error: function (errorThrown) {
                }
            });
        }

        function getStory($offset, $id, $number) {
            var firstPostId = $('.first-story').attr('id');
            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                data: {
                    'offset': $offset,
                    'number': $number,
                    'excludeId': firstPostId,
                    'action': 'get_story_with_ajax'
                },
                success: function (data) {
                    $(".row.infinity").before(data);
                    $(".row.infinity.current").removeClass('current');
                    $first_time = 0;
                    if ($id !== 0) {
                        scrollToStory($id);
                        $id = 0;
                    }
                    if ($number > 1) {
                        for (var i = 1; i <= $number; i++) {
                            copyContextlyWidget();
                        }
                    } else {
                        copyContextlyWidget();
                    }
                    essb_get_counters();
                    showBio();
                    make.gpt.loadDyn();
                    $('.single .story-header .story-title h1').each(function () {
                        newTitle = $(this).html().replace('&nbsp;', ' ');
                        $(this).html(newTitle);
                    });
                },
                error: function (errorThrown) {
                }
            });
        }

        function copyContextlyWidget() {
            var $ctxSiderail = $('.content.first-story .ctx-siderail-container').clone();
            $('.ctx-siderail-wrapper').each(function (index) {
                if ($(this).height() == 0) {
                    $($ctxSiderail).appendTo(this);
                }
            });
        }

        function scrollToStory($id) {
            window.setTimeout(function () {
                if ($('.navigator').hasClass('sticky')) {
                    $('html, body').animate({
                        scrollTop: $($id).offset().top - 80
                    }, 500);
                } else {
                    $('html, body').animate({
                        scrollTop: $($id).offset().top - 160
                    }, 500);
                }
            }, 2000);
            window.setTimeout(function () {
                $scrollingToPost = 0;
            }, 3000);
        }

        function showSocialSidebar(n) {
            $('.essb_displayed_sidebar_right').hide();
            $('.content').each(function (index) {
                if (n == index) {
                    $(this).find('.essb_displayed_sidebar_right').show();
                }
            });
        }

        $(document).on('click touchstart', '.essb_item', function () {
            var socialNetwork;
            if ($(this).hasClass('essb_link_facebook')) {
                socialNetwork = 'Facebook';
            } else if ($(this).hasClass('essb_link_twitter')) {
                socialNetwork = 'Twitter';
            } else if ($(this).hasClass('essb_link_google')) {
                socialNetwork = 'Google';
            } else if ($(this).hasClass('essb_link_reddit')) {
                socialNetwork = 'Reddit';
            } else if ($(this).hasClass('essb_link_pinterest')) {
                socialNetwork = 'Pinterest'
            } else {
                socialNetwork = 'Social network';
            }
            ga('send', {
                hitType: 'event',
                eventCategory: 'Stories social',
                eventAction: socialNetwork,
                eventLabel: window.location.href
            });
        });
        $(document).on('click touchstart', '.comments-button', function () {
            if (!$(this).hasClass('open')) {
                $(this).parent().parent().find('.comments').slideDown(500);
                $(this).addClass('open');
                var $commentsHeight = $(this).parent().parent().find('#disqus_thread').height();
                $(this).parent().css('margin-top', $commentsHeight);
            } else {
                $(this).removeClass('open');
                $(this).parent().css('margin-top', '0');
                $(this).parent().parent().find('.comments').slideUp(500);
            }

        });
        $('blockquote').each(function () {
            $quoteMarginTop = -($(this).height() + 175);
            $(this).after('<div class="quote" style="margin-top: ' + $quoteMarginTop + 'px"></div>');
        });
        var $quoteMargin = ($('blockquote').width() + 62 - 68) / 2;
        $('.quote').css('margin-left', $quoteMargin);
        $(document).on('click touchstart', '.modal-backdrop', function () {
            window.setTimeout(function () {
                $('.modal-backdrop').remove();
                $('#myModal').removeClass('display').addClass('closed');
                $('body').removeClass('no-padding');
            }, 800);
        });
        $(document).on('click touchstart', '.comments button.close', function () {
            window.setTimeout(function () {
                $('.modal-backdrop').remove();
                $('#myModal').removeClass('display');
                $('body').removeClass('no-padding');
            }, 800);
        });
        $(document).on('click touchstart', '.comments button.btn', function () {
            $('body').addClass('no-padding');
            $window = $(window).width() + 17;
            if ($window >= 768) {
                if ($('#myModal').hasClass('closed')) {
                    $('#myModal').addClass('display');
                    window.setTimeout(function () {
                        $('#myModal').addClass('in');
                    }, 200);
                }
            }
        });
        $('.single .latest-story h3').each(function () {
            newTitle = $(this).html().replace('&nbsp;', ' ');
            $(this).html(newTitle);
        });

        $('.single .story-header .story-title h1').each(function () {
            newTitle = $(this).html().replace('&nbsp;', ' ');
            $(this).html(newTitle);
        });

        $('.comments button').on('click', function() {
            $window = $(window).width();
            if($window <= 767){
                var windowHeight = $(window).height() - 40;
                $('#disqus_thread').height(windowHeight)
            }
        });

        var ctx = $('#ctx-module').remove();
        $('.essb_right_flag').before(ctx);

        var currentUrl,changeUrl,changeCurrent,storyIndex,goTo = -1,storyInNavigator,storyId,previousUrl = document.referrer;
        $(window).on('popstate', function(e) {
            currentUrl = window.location.pathname;
            storyInNavigator = document.getElementById(currentUrl);
            storyId= $(storyInNavigator).attr('href');
            if (goTo != -1){
                goTo = goTo - 1;
                storyInNavigator = document.getElementById(goTo);
                storyIndex = $(storyInNavigator).attr('id');
                storyId = $(storyInNavigator).find('a').attr('href');
                changeUrl = $(storyInNavigator).find('a').attr('id');
                window.history.pushState('obj', 'newtitle', changeUrl);
                document.title = $('.story-header').eq(storyIndex).find('.story-title').text();
                $('html, body').animate({
                    scrollTop: $(storyId).offset().top - 80
                }, 500);
                if(goTo == 0){
                    $('html, body').animate({
                        scrollTop: 0
                    }, 500);
                    goTo = -1;
                    stop = 1;
                    window.setTimeout(function(){
                        window.history.pushState('obj', 'newtitle', changeUrl);
                        document.title = $('.story-header').eq(storyIndex).find('.story-title').text();
                    },1000);
                }else{
                    $('html, body').animate({
                        scrollTop: $(storyId).offset().top - 80
                    }, 500);
                    window.setTimeout(function(){
                        $('.latest-story a').removeClass('highlighted');
                        changeCurrent = $('.latest-story').eq(storyIndex).find('a').addClass('highlighted');
                        window.history.pushState('obj', 'newtitle', changeUrl);
                        document.title = $('.story-header').eq(storyIndex).find('.story-title').text();
                    },500);
                }

            }else{
                if(stop == 0){
                    $('html, body').animate({
                        scrollTop: $(storyId).offset().top - 80
                    }, 500);
                    goTo = $(storyInNavigator).parent().attr('id');
                }else{
                    window.location.hash = storyId;
                    window.location = previousUrl;
                    window.history.pushState('obj', 'newtitle', previousUrl);
                }
                if ($(storyInNavigator).parent().attr('id') == 0){
                    stop = 1;
                }
            }
        });
    }
});
