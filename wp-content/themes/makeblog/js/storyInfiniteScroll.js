// Post infiniste scroll
(function($){
  // Variables from WordPress
  var post_id = postdata.post_id;
  var theme_uri = postdata.theme_uri;
  var rest_url = postdata.rest_url;
  var most_recent_post_ID = postdata.most_recent_post_ID;
  var page_scroll = 1;

  function previous_post_trigger() {
    // When the trigger is activated, do all the things.
    var trigger = $('.ajax-loader');
    var trigger_position = trigger.offset().top - $(window).outerHeight();

    $(window).scroll(function(event) {
      if (trigger_position > $(window).scrollTop()) {
        return;
      }

      get_previous_post(trigger);

      $(this).off(event);
    })
  }
  // Run the above trigger monitor on the current DOM.
  previous_post_trigger();


  // The function in which all the magic happens.
  function get_previous_post(trigger) {

    if ((post_id !== most_recent_post_ID) && (page_scroll == 1)) {
      // Build the resource request URL for the REST API
      var json_url = rest_url + 'posts/' + most_recent_post_ID + '?_embed=true';
    } else {
      // Get the previous post ID from the clicked trigger above.
      var previous_post_ID = trigger.attr('data-id');
      // Build the resource request URL for the REST API.
      var json_url = rest_url + 'posts/' + previous_post_ID + '?_embed=true';
    }

    page_scroll++;

    $('.ajax-loader').css('visibility', 'visible');

    // Run AJAX on the resource request URL
    $.ajax({
      dataType: 'json',
      url: json_url,
      //'excludeId': post_id
    })

    // If AJAX succeeds:
    .done(function(object) {
      the_previous_post(object)
    })
    // If AJAX fails:
    .fail(function(){
      console.log('error');
    })
    // When everything is done:
    .always(function(){
      console.log('AJAX complete');
    });
  } // END get_previous_post()


  
  function the_previous_post(object) {

    // Get the featured image ID (0 if no featured image):
    var featured_img_ID = object.featured_media;

    // Create an empty container for theoretical featured image.
    var feat_image;

    // Create an empty container for theoretical post tags.
    var story_post_tags;

    // Get the featured image if there is a featured image.
    function get_featured_image() {
      var heroImage = object.curent_post_photon_hero;

      if(heroImage) {
        feat_image = '<img class="story-hero-image" src="' + heroImage + '" alt="Article Featured Image" />' +
                     '<div class="story-hero-image-l-xl" style="background: url(' + heroImage + ') no-repeat center center;"></div>';
      } else if(featured_img_ID !== 0) {
        var featured_object = object._embedded['wp:featuredmedia'][0];
        feat_image = '<img class="story-hero-image" src="' + featured_object.media_details.sizes.full.source_url + '" alt="Article Featured Image" />' +
                     '<div class="story-hero-image-l-xl" style="background: url(' + featured_object.media_details.sizes.full.source_url +') no-repeat center center;"></div>';    
      } else {
        feat_image = '<div class="hero-wrapper-clear"></div>';
      }
      return feat_image;
    }


    // Get the post tags
    function get_story_post_tags() {

      // Check if tags exist by looking at tag id list
      var tag_id_array = object.tags;

      // Get the post tag object
      var tag_embedded_array = object._embedded['wp:term'][1];

      if ( tag_id_array.length != 0 ) {
        story_post_tags = '<h3 class="related-topics">Related Topics</h3>' +
                          '<ul class="post-tags">';
                            tag_embedded_array.forEach( function (arrayItem) {
                              story_post_tags += '<li><a href="' + arrayItem.link + '">' + arrayItem.name + '</a></li>';
                            })
        story_post_tags += '</ul>';
      } else {
        story_post_tags = '';
      }
      return story_post_tags;
    }

    // Build the post, with or without the featured image.
    function build_post() {
      var date = new Date(object.date);

      var previous_post_content =
        '<div class="ad-unit">' +
          '<div class="js-ad scroll-load" data-size="[[728,90],[970,90]]" data-size-map="[[[1000,0],[[728,90],[970,90]]],[[730,0],[[728,90]]]]" data-pos="btf"></div><span class="fake-leaderboard-span"></span>' +
        '</div>' +

        '<article itemscope itemtype="https://schema.org/ScholarlyArticle">' +
          '<div class="story-header" id="' + object.id + '">' +

            '<div class="container">' +
              '<div class="story-title">' +
                '<h1 itemprop="name">' + object.title.rendered + ' ' + page_scroll + '</h1>' +
              '</div>' +
            '</div>' +

            get_featured_image() +

          '</div>' +

          '<meta itemprop="name" content="Make: Magazine">' +

          '<div class="container">' +
            '<div class="row content ' + object.id + '">' +
              '<div class="col-sm-7 col-md-8">' +
                '<div class="' + object.curent_post_classes + '">' +
                  // render easy-social-share shortcode
                  '<div class="article-body" itemprop="articleBody">' +
                    object.content.rendered +
                    '<div id="nativobelow"></div>' +
                  '</div>' +
                '</div>' +

                '<div class="ad-unit">' +
                  '<p id="ads-title">Advertisement</p>' +
                  '<div class="js-ad scroll-load" data-size="[[728,90],[320,50]]" data-size-map="[[[730,0],[[728,90]]],[[0,0],[[320,50]]]]" data-pos="btf"></div>' +
                '</div>' +

                '<div class="comments">' +
                  '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#disqus-modal" ' +
                      'onclick="reset(' + object.id + ', ' +
                      object.link + ', ' +
                      object.title.rendered + ', \'en\');">' +
                    'Show comments' +
                  '</button>' +

                  '<div id="disqus-modal" class="modal fade" role="dialog">' +
                    '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
                  '</div>' +
                '</div>' +
              '</div><!-- end story body -->' +


              '<aside class="col-sm-5 col-md-4 sidebar">' +
                '<div class="author-info">' +
                  object.curent_author_profile +
                '</div>' +
                '<div class="date-time">' +
                  '<time itemprop="startDate" datetime="' + date + '">' +
                  date.toDateString() +
                  '</time>' +
                '</div>' +
                '<div class="ad-unit">' +
                  '<p id="ads-title">Advertisement</p>' +
                  '<div class="js-ad scroll-load" data-size="[[300,250],[300,600]]" data-size-map="[[[730,0],[[300,600],[300,250]]],[[0,0],[[300,250]]]]" data-pos="btf"></div>' +
                '</div>' +

                get_story_post_tags() +

                '<div class="ad-unit">' +
                  '<p id="ads-title">Advertisement</p>' +
                  '<div class="js-ad scroll-load" data-size="[[300,250]]"" data-pos="btf"></div>' +
                '</div>' +
                // do shortcode [newsletter_signup_sidebar]
                '<div class="ad-unit">' +
                  '<p id="ads-title">Advertisement</p>' +
                 ' <div class="js-ad scroll-load" data-size="[[300,250],[300,600]]" data-size-map="[[[730,0],[[300,600]]],[[0,0],[[300,250]]]]"" data-pos="btf"></div>' +
                '</div>' +
              '</aside>' +

              '<div class="ctx-social-container"></div>' +
              '<div class="essb_right_flag"></div>' +
            '</div><!-- end .first-story -->' +
          '</div>' +



         '</article>' +
        '<div class="ajax-loader" data-id="' + object.previous_post_ID + '"><img src="' + theme_uri + '/img/spinner.svg" width="32" height="32" /></div>';
        

      // Append related posts to the #related-posts container
      $('.ajax-loader').replaceWith(previous_post_content);

      // Reininitialize the new ads
      make.gpt.loadDyn();

      ga('send', 'pageview',
        {'page': location.pathname + location.search + location.hash}
      );

      // Reininitialize the previous post trigger on new content.
      previous_post_trigger();
    }

    // Run the menagerie.
    build_post()
  }


})(jQuery);