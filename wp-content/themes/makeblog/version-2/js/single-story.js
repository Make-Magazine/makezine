// Compiled file - any changes will be overwritten by grunt task
!function($){$(function(){$("div").hasClass("mz-story-infinite-view")&&!function(){function thePostChanges(PostId){$(".latest-story a").removeClass("highlighted"),newHighlightedStory=$(".latest-story").eq(PostId-1),$(newHighlightedStory).find("a").addClass("highlighted"),window.history.pushState("obj","newtitle",$(newHighlightedStory).find("a").attr("id")),document.title=$(".story-header").eq(PostId-1).find(".story-title").text(),$flag=PostId-1}function sendGA(){ga("send","pageview",{page:location.pathname+location.search+location.hash})}function getStoryThumbnail($offset){var firstPostId=$(".first-story").attr("id");$.ajax({type:"GET",url:"/ajax_get_story_thumbnail.php",data:{offset:$offset,excludeId:firstPostId},success:function(data){$(".row.infinity").after(data),$(".row.infinity.current").remove(),$first_time=0},error:function(){}})}function getStory($offset,id,$number){var firstPostId=$(".first-story").attr("id");$.ajax({type:"GET",url:"/ajax_get_story.php",data:{offset:$offset,number:$number,excludeId:firstPostId},success:function(data){if($(".row.infinity").before(data),$(".row.infinity.current").removeClass("current"),$first_time=0,0!==id&&(scrollToStory(id),id=0),$number>1)for(var i=1;$number>=i;i++)copyContextlyWidget();else copyContextlyWidget();essb_get_counters(),make.gpt.loadDyn(),$(".single .story-header .story-title h1").each(function(){newTitle=$(this).html().replace("&nbsp;"," "),$(this).html(newTitle)})},error:function(){}})}function copyContextlyWidget(){var $ctxSiderail=$(".content.first-story .ctx-siderail-container").clone();$(".ctx-siderail-wrapper").each(function(){0==$(this).height()&&$($ctxSiderail).appendTo(this)})}function scrollToStory(id){window.setTimeout(function(){$(".navigator").hasClass("sticky")?$("html, body").animate({scrollTop:$(id).offset().top-80},500):$("html, body").animate({scrollTop:$(id).offset().top-160},500)},2e3),window.setTimeout(function(){$scrollingToPost=0},3e3)}function showSocialSidebar(n){$(".essb_displayed_sidebar_right").hide(),$(".content").each(function(index){n==index&&$(this).find(".essb_displayed_sidebar_right").show()})}var newTitle,basic_network_list="twitter,linkedin,facebook,pinterest,google,stumbleupon,vk,reddit,buffer,love,ok,mwp,xing,pocket,mail,print,comments,yummly",extended_network_list="del,digg,weibo,flattr,tumblr,whatsapp,meneame,blogger,amazon,yahoomail,gmail,aol,newsvine,hackernews,evernote,myspace,mailru,viadeo,line,flipboard,sms,viber",fb_value=essb_settings.essb3_facebook_total,counter_admin=essb_settings.essb3_admin_ajax,interal_counters_all=essb_settings.essb3_internal_counter,button_counter_hidden=essb_settings.essb3_counter_button_min,no_print_mail_counter="undefined"!=typeof essb_settings.essb3_no_counter_mailprint?essb_settings.essb3_no_counter_mailprint:!1,force_single_ajax="undefined"!=typeof essb_settings.essb3_single_ajax?essb_settings.essb3_single_ajax:!1,essb_shorten_number=function(n){"number"!=typeof n&&(n=Number(n));var suffix,digits,sgn=0>n?"-":"",suffixes=["k","M","G","T","P","E","Z","Y"],overflow=Math.pow(10,3*suffixes.length+3);if(n=Math.abs(Math.round(n)),1e3>n)return sgn+n;if(n>=1e100)return sgn+"many";if(n>=overflow)return(sgn+n).replace(/(\.\d*)?e\+?/i,"e");do if(n=Math.floor(n),suffix=suffixes.shift(),digits=n%1e6,n/=1e3,!(n>=1e3))return n>=10&&1e3>n||10>n&&100>digits%1e3?sgn+Math.floor(n)+suffix:(sgn+n).replace(/(\.\d).*/,"$1")+suffix;while(suffixes.length);return sgn+"many"},essb_get_counters=function(){return $(".essb_links.essb_counters").each(function(){if("undefined"!=typeof essb_settings){var counter_pos=$(this).attr("data-essb-counter-pos")||"",post_self_count_id=$(this).attr("data-essb-postid")||"",url=$(this).attr("data-essb-url")||"",instance_id=$(this).attr("data-essb-instance")||"",ajax_url=essb_settings.ajax_url;"light"==essb_settings.ajax_type&&(ajax_url=essb_settings.blog_url);var i,nonapi_counts_url=counter_admin?ajax_url+"?action=essb_counts&nonce="+essb_settings.essb3_nonce+"&":essb_settings.essb3_plugin_url+"/public/get-noapi-counts.php?",nonapi_internal_url=ajax_url+"?action=essb_counts&nonce="+essb_settings.essb3_nonce+"&",basic_networks=basic_network_list.split(","),extended_networks=extended_network_list.split(","),direct_access_networks=[],nonapi_count_networks=[],nonapi_internal_count_networks=[];for(i=0;i<basic_networks.length;i++)if($(this).find(".essb_link_"+basic_networks[i]).length)switch(basic_networks[i]){case"google":case"stumbleupon":case"vk":case"reddit":case"ok":case"mwp":case"xing":case"pocket":counter_admin?nonapi_internal_count_networks.push(basic_networks[i]):nonapi_count_networks.push(basic_networks[i]);break;case"love":case"comments":nonapi_internal_count_networks.push(basic_networks[i]);break;case"mail":case"print":no_print_mail_counter||nonapi_internal_count_networks.push(basic_networks[i]);break;default:direct_access_networks.push(basic_networks[i])}if(interal_counters_all)for(i=0;i<extended_networks.length;i++)$(this).find(".essb_link_"+extended_networks[i]).length&&nonapi_internal_count_networks.push(extended_networks[i]);var network,network_address,operating_elements={};for(i=0;i<direct_access_networks.length;i++)switch(network=direct_access_networks[i],operating_elements[network+""+instance_id]=$(this).find(".essb_link_"+network),operating_elements[network+"_inside"+instance_id]=operating_elements[network+instance_id].find(".essb_network_name"),network){case"facebook":var facebook_url="https://graph.facebook.com/fql?q=SELECT%20like_count,%20total_count,%20share_count,%20click_count,%20comment_count%20FROM%20link_stat%20WHERE%20url%20=%20%22"+url+"%22";$.getJSON(facebook_url).done(function(data){fb_value?counter_display(counter_pos,operating_elements["facebook"+instance_id],operating_elements["facebook_inside"+instance_id],data.data[0].total_count):counter_display(counter_pos,operating_elements["facebook"+instance_id],operating_elements["facebook_inside"+instance_id],data.data[0].share_count)});break;case"linkedin":var linkedin_url="https://www.linkedin.com/countserv/count/share?format=jsonp&url="+url+"&callback=?";$.getJSON(linkedin_url).done(function(data){counter_display(counter_pos,operating_elements["linkedin"+instance_id],operating_elements["linkedin_inside"+instance_id],data.count)});break;case"pinterest":var pinterest_url="https://api.pinterest.com/v1/urls/count.json?callback=?&url="+url;$.getJSON(pinterest_url).done(function(data){counter_display(counter_pos,operating_elements["pinterest"+instance_id],operating_elements["pinterest_inside"+instance_id],data.count)});break;case"buffer":var buffer_url="https://api.bufferapp.com/1/links/shares.json?url="+url+"&callback=?";$.getJSON(buffer_url).done(function(data){counter_display(counter_pos,operating_elements["buffer"+instance_id],operating_elements["buffer_inside"+instance_id],data.shares)});break;case"yummly":var yummly_url="https://www.yummly.com/services/yum-count?callback=?&url="+url;$.getJSON(yummly_url).done(function(data){counter_display(counter_pos,operating_elements["yummly"+instance_id],operating_elements["yummly_inside"+instance_id],data.count)})}for(i=0;i<nonapi_count_networks.length;i++)network=nonapi_count_networks[i],operating_elements[network+instance_id]=$(this).find(".essb_link_"+network),operating_elements[network+"_inside"+instance_id]=operating_elements[network+instance_id].find(".essb_network_name"),network_address=nonapi_counts_url+"nw="+network+"&url="+url+"&instance="+instance_id,$.getJSON(network_address).done(function(data){counter_display(counter_pos,operating_elements[data.network+data.instance],operating_elements[data.network+"_inside"+data.instance],data.count)});var post_network_list=[];for(i=0;i<nonapi_internal_count_networks.length;i++)network=nonapi_internal_count_networks[i],post_network_list.push(network),operating_elements[network+instance_id]=$(this).find(".essb_link_"+network),operating_elements[network+"_inside"+instance_id]=operating_elements[network+instance_id].find(".essb_network_name"),force_single_ajax||(network_address=nonapi_internal_url+"nw="+network+"&url="+url+"&instance="+instance_id+"&post="+post_self_count_id,$.getJSON(network_address).done(function(data){var counter=data[data.network]||"0";counter_display(counter_pos,operating_elements[data.network+data.instance],operating_elements[data.network+"_inside"+data.instance],counter)}));post_network_list.length>0&&force_single_ajax&&(network_address=nonapi_internal_url+"nw="+post_network_list.join(",")+"&url="+url+"&instance="+instance_id+"&post="+post_self_count_id,$.getJSON(network_address).done(function(data){for(var i=0;i<post_network_list.length;i++){var network_key=post_network_list[i],counter=data[network_key]||"0";counter_display(counter_pos,operating_elements[network_key+data.instance],operating_elements[network_key+"_inside"+data.instance],counter)}}));var counter_display=function(counter_pos,$element,$element_inside,$cnt){if($css_hidden_negative="",""!=button_counter_hidden&&parseInt(button_counter_hidden)>parseInt($cnt)&&($css_hidden_negative=' style="display: none;"'),"right"==counter_pos)$element.append('<span class="essb_counter_right" cnt="'+$cnt+'"'+$css_hidden_negative+">"+essb_shorten_number($cnt)+"</span>");else if("inside"==counter_pos)$element_inside.html('<span class="essb_counter_inside" cnt="'+$cnt+'"'+$css_hidden_negative+">"+essb_shorten_number($cnt)+"</span>");else if("insidename"==counter_pos)$element_inside.append('<span class="essb_counter_insidename" cnt="'+$cnt+'"'+$css_hidden_negative+">"+essb_shorten_number($cnt)+"</span>");else if("insidehover"==counter_pos){$element_inside.closest("a").append('<span class="essb_counter_insidehover" cnt="'+$cnt+'"'+$css_hidden_negative+">"+essb_shorten_number($cnt)+"</span>");var current_width=$element_inside.closest("a").find(".essb_network_name").innerWidth();$element_inside.closest("a").find(".essb_counter_insidehover").width(current_width)}else"insidebeforename"==counter_pos?$element_inside.prepend('<span class="essb_counter_insidebeforename" cnt="'+$cnt+'"'+$css_hidden_negative+">"+essb_shorten_number($cnt)+"</span>"):"bottom"==counter_pos?$element_inside.html('<span class="essb_counter_bottom" cnt="'+$cnt+'"'+$css_hidden_negative+">"+essb_shorten_number($cnt)+"</span>"):"hidden"==counter_pos?$element.append('<span class="essb_counter_hidden" cnt="'+$cnt+'"'+$css_hidden_negative+"></span>"):$element.prepend('<span class="essb_counter" cnt="'+$cnt+'"'+$css_hidden_negative+">"+essb_shorten_number($cnt)+"</span>")}}})};$("body").addClass("single-story");var $top,$lastStory,$bottom,infinity,topArray=[],bottomArray=[],$flag=-1,$offset=0,$first_time=0,$scrollingToPost=0,stop=0;$(window).scroll(function(){var $scrollTop=$(window).scrollTop();$(".single .container .row.story-header").each(function(index){$top=$(this).offset().top-100,topArray[index]=$top}),$(".single .container .row.content").each(function(index){$bottom=$(this).find(".essb_right_flag").offset().top-100,bottomArray[index]=$bottom}),viewPortWidth=$(window).width()+17,$(".row").hasClass("infinity")&&(infinity=viewPortWidth<=767?$(".row.infinity").offset().top-$(window).height()-1e3:$(".row.infinity").offset().top-3100),$scrollTop>=infinity&&0==$first_time&&($first_time=1,$(".row.infinity").addClass("current"),window.navigator.userAgent.indexOf("Chrome")>0?viewPortWidth=$(window).width()+17:viewPortWidth=$(window).width(),viewPortWidth<=767?(getStoryThumbnail($offset),$offset+=9):9>$offset?(getStory($offset,0,1),$offset+=1):($("#footer").show(),$(".infinity").remove())),$scrollTop<bottomArray[0]&&(-1!=$flag&&1!=$flag||(thePostChanges(1),stop=1,goTo=-1,$(".content:nth-child(1) .essb_displayed_sidebar_right").show(),1==$lastStory&&sendGA()),showSocialSidebar(0)),$scrollTop>bottomArray[0]&&$scrollTop<topArray[1]||$scrollTop>bottomArray[1]&&$scrollTop<topArray[2]||$scrollTop>bottomArray[2]&&$scrollTop<topArray[3]||$scrollTop>bottomArray[3]&&$scrollTop<topArray[4]||$scrollTop>bottomArray[4]&&$scrollTop<topArray[5]||$scrollTop>bottomArray[5]&&$scrollTop<topArray[6]||$scrollTop>bottomArray[6]&&$scrollTop<topArray[7]||$scrollTop>bottomArray[7]&&$scrollTop<topArray[8]||$scrollTop>bottomArray[8]&&$scrollTop<topArray[9]||($scrollTop>topArray[1]&&$scrollTop<bottomArray[1]?showSocialSidebar(1):$scrollTop>topArray[2]&&$scrollTop<bottomArray[2]?showSocialSidebar(2):$scrollTop>topArray[3]&&$scrollTop<bottomArray[3]?showSocialSidebar(3):$scrollTop>topArray[4]&&$scrollTop<bottomArray[4]?showSocialSidebar(4):$scrollTop>topArray[5]&&$scrollTop<bottomArray[5]?showSocialSidebar(5):$scrollTop>topArray[6]&&$scrollTop<bottomArray[6]?showSocialSidebar(6):$scrollTop>topArray[7]&&$scrollTop<bottomArray[7]?showSocialSidebar(7):$scrollTop>topArray[8]&&$scrollTop<bottomArray[8]?showSocialSidebar(8):$scrollTop>topArray[9]&&$scrollTop<bottomArray[9]&&showSocialSidebar(9)),$scrollTop>=topArray[1]&&$scrollTop<bottomArray[1]&&(0!=$flag&&2!=$flag||(thePostChanges(2),sendGA(),stop=0,$lastStory=1)),$scrollTop>=topArray[2]&&$scrollTop<bottomArray[2]&&(1!=$flag&&3!=$flag||(thePostChanges(3),sendGA())),$scrollTop>=topArray[3]&&$scrollTop<bottomArray[3]&&(2!=$flag&&4!=$flag||(thePostChanges(4),sendGA())),$scrollTop>=topArray[4]&&$scrollTop<bottomArray[4]&&(3!=$flag&&5!=$flag||(thePostChanges(5),sendGA())),$scrollTop>=topArray[5]&&$scrollTop<bottomArray[5]&&(4!=$flag&&6!=$flag||(thePostChanges(6),sendGA())),$scrollTop>=topArray[6]&&$scrollTop<bottomArray[6]&&(5!=$flag&&7!=$flag||(thePostChanges(7),sendGA())),$scrollTop>=topArray[7]&&$scrollTop<bottomArray[7]&&(6!=$flag&&8!=$flag||(thePostChanges(8),sendGA())),$scrollTop>=topArray[8]&&$scrollTop<bottomArray[8]&&(7!=$flag&&9!=$flag||(thePostChanges(9),sendGA())),$scrollTop>=topArray[9]&&8==$flag&&(thePostChanges(10),sendGA())}),$(".thumbnails .latest-story a").click(function(){var scrollTime,id=$(this).attr("href"),parentId=$(this).parent().attr("id"),number=parentId-$offset;number>3&&(scrollTime=7>number?5e3:8e3,window.setTimeout(function(){$(".navigator").hasClass("sticky")?$("html, body").animate({scrollTop:$(id).offset().top-80},500):$("html, body").animate({scrollTop:$(id).offset().top-160},500)},scrollTime));var $current=$(this),$newId=$(this).attr("href");$(".story-header").is($newId)===!1?($(".row.infinity").addClass("current"),getStory($offset,id,number),$offset+=number):$(this).parent().hasClass("first")?$("html, body").animate({scrollTop:0},500):$(".navigator").hasClass("sticky")?$("html, body").animate({scrollTop:$($.attr(this,"href")).offset().top-80},500):$("html, body").animate({scrollTop:$($.attr(this,"href")).offset().top-160},500);var newFlag=$(this).parent().index(),href=$(this).attr("id");return window.setTimeout(function(){$(".latest-story a").removeClass("highlighted"),$($current).addClass("highlighted"),window.history.pushState("obj","newtitle",href),document.title=$(".story-header").eq(newFlag).find(".story-title").text()},501),!1});var newHighlightedStory;$(document).on("mouseover",".sidebar .author-name .bio-wrapper,.sidebar .avatar",function(){$(this).find(".hover-info").show(),$(this).addClass("hover")}),$(document).on("mouseleave",".sidebar .author-name .bio-wrapper,.sidebar .avatar",function(){$(this).find(".hover-info").hide(),$(this).removeClass("hover")}),$(document).on("click touchstart",".essb_item",function(){var socialNetwork;socialNetwork=$(this).hasClass("essb_link_facebook")?"Facebook":$(this).hasClass("essb_link_twitter")?"Twitter":$(this).hasClass("essb_link_google")?"Google":$(this).hasClass("essb_link_reddit")?"Reddit":$(this).hasClass("essb_link_pinterest")?"Pinterest":"Social network",ga("send",{hitType:"event",eventCategory:"Stories social",eventAction:socialNetwork,eventLabel:window.location.href})}),$(document).on("click touchstart",".modal-backdrop, .comments .close",function(){$(".modal-backdrop").remove(),$("html").removeClass("modal-open")}),$(document).on("click touchstart",".comments button.btn",function(){console.log("thing"),$("html").addClass("modal-open")}),$(".single .latest-story h3").each(function(){newTitle=$(this).html().replace("&nbsp;"," "),$(this).html(newTitle)}),$(".single .story-header .story-title h1").each(function(){newTitle=$(this).html().replace("&nbsp;"," "),$(this).html(newTitle)});var windowHeight;$(document).on("click",".comments button",function(){viewPortWidth=$(window).width(),viewPortWidth<=767?(windowHeight=$(window).height()-40,$("#disqus_thread").height(windowHeight)):(windowHeight=$(window).height()-77,$("#disqus_thread").css("max-height",windowHeight))}),$(".ctx-social-container").remove(),$("aside").after('<div class="ctx-social-container ctx-clearfix ctx_default_placement"></div>');var ctx=$("#ctx-module").remove();$(".essb_right_flag").before(ctx);var currentUrl,changeUrl,changeCurrent,storyIndex,storyInNavigator,storyId,goTo=-1,previousUrl=document.referrer;$(window).on("popstate",function(){currentUrl=window.location.pathname,storyInNavigator=$(currentUrl),storyId=$(storyInNavigator).attr("href"),-1!=goTo?(goTo-=1,storyInNavigator=$(goTo),storyIndex=$(storyInNavigator).attr("id"),storyId=$(storyInNavigator).find("a").attr("href"),changeUrl=$(storyInNavigator).find("a").attr("id"),window.history.pushState("obj","newtitle",changeUrl),document.title=$(".story-header").eq(storyIndex).find(".story-title").text(),$("html, body").animate({scrollTop:$(storyId).offset().top-80},500),0==goTo?($("html, body").animate({scrollTop:0},500),goTo=-1,stop=1,window.setTimeout(function(){window.history.pushState("obj","newtitle",changeUrl),document.title=$(".story-header").eq(storyIndex).find(".story-title").text()},1e3)):($("html, body").animate({scrollTop:$(storyId).offset().top-80},500),window.setTimeout(function(){$(".latest-story a").removeClass("highlighted"),changeCurrent=$(".latest-story").eq(storyIndex).find("a").addClass("highlighted"),window.history.pushState("obj","newtitle",changeUrl),document.title=$(".story-header").eq(storyIndex).find(".story-title").text()},500))):(0==stop?($("html, body").animate({scrollTop:$(storyId).offset().top-80},500),goTo=$(storyInNavigator).parent().attr("id")):(window.location.hash=storyId,window.location=previousUrl,window.history.pushState("obj","newtitle",previousUrl)),0==$(storyInNavigator).parent().attr("id")&&(stop=1))})}()})}(window.jQuery),function($){$(function(){"use strict";$("div").hasClass("mz-story-infinite-view")&&!function(){$(".sticky-sidebar-posts-nav .thumbnails").addClass("open"),$(".hamburger-navigator").addClass("open"),$(".sticky-sidebar-posts-nav").addClass("open"),$(".posts-navigator").show(),$(window).resize(function(){$(".sticky-sidebar-posts-nav .thumbnails").addClass("open"),$(".sticky-sidebar-posts-nav").addClass("open")}),$(window).scroll(function(){var $scrollTop=$(window).scrollTop();$scrollTop>="100"?($(".sticky-sidebar-posts-nav").addClass("sticky"),$(".sticky-sidebar-posts-nav").hasClass("open")&&$(".sticky-sidebar-posts-nav").addClass("transition")):($(".posts-navigator").show(),$(".sticky-sidebar-posts-nav .thumbnails").addClass("open"),$(".hamburger-navigator"),$(".sticky-sidebar-posts-nav").removeClass("sticky transition").addClass("open")),stickySideBarDetectsFooter()});var stickySideBarDetectsFooter=function(){var footerPos=$("#footer").offset().top,currentScroll=$(window).scrollTop(),sidebarElem=$(".sticky-sidebar-posts-nav");if(!$("#footer").is(":visible")||footerPos>$(window).height()+currentScroll)return void sidebarElem.css({"max-height":"",overflow:""});var dynamicHeight=footerPos-$(window).scrollTop()-30;dynamicHeight=dynamicHeight>0?dynamicHeight:0,sidebarElem.css({"max-height":dynamicHeight,overflow:"hidden"})};$(".hamburger-navigator").mouseover(function(){$(this).hasClass("open")||$(this).addClass("hover")}).mouseleave(function(){$(this).removeClass("hover")}).click(function(){$(this).removeClass("hover"),$(this).hasClass("open")&&($(".posts-navigator").slideUp("250"),window.setTimeout(function(){$(".sticky-sidebar-posts-nav").removeClass("open transition"),$(".hamburger-navigator").removeClass("open"),$(".thumbnails").removeClass("open")},390)),$(this).hasClass("open")||($(".thumbnails").addClass("open"),$(".hamburger-navigator").addClass("open"),$(".sticky-sidebar-posts-nav").addClass("open"),window.setTimeout(function(){$(".posts-navigator").slideDown("250")},250))})}()})}(window.jQuery);