// Post infiniste scroll
(function($){
  // Variables from WordPress
  var post_id = postdata.post_id;
  var theme_uri = postdata.theme_uri;
  var rest_url = postdata.rest_url;


  function previous_post_trigger() {
    // When the trigger is activated, do all the things.
    var trigger = $('.ajax-loader');
    console.log(trigger + 'this is the trigger');
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

    // Get the previous post ID from the clicked trigger above.
    var previous_post_ID = trigger.attr('data-id');
    // Build the resource request URL for the REST API.
    var json_url = rest_url + 'posts/' + previous_post_ID + '?_embed=true';

    // Run AJAX on the resource request URL
    $.ajax({
      dataType: 'json',
      url: json_url,
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

    // Get the featured image if there is a featured image.
    function get_featured_image() {
      if (featured_img_ID === 0) {
        feat_image = '';
      } else {
        var featured_object = object._embedded['wp:featuredmedia'][0];
        var img_large = '';
        var img_width = featured_object.media_details.sizes.full.width;
        var img_height = featured_object.media_details.sizes.full.height;
        if (featured_object.media_details.sizes.hasOwnProperty("large")) {
          img_large = featured_object.media_details.sizes.large.source_url +  ' 1024w, ';
        }
        feat_image = '<div class="single-featured-image-header">' +
                     '<img src="' + featured_object.media_details.sizes.full.source_url + '" ' +
                     'width="' + img_width + '" ' +
                     'height="' + img_height + '" ' +
                     'class="attachment-twentyseventeen-featured-image size-twentyseventeen-featured-image wp-post-image" ' +
                     'alt="" ' +
                     'srcset="' + featured_object.media_details.sizes.full.source_url + ' ' + img_width + 'w, ' + img_large + featured_object.media_details.sizes.medium.source_url + ' 300w" ' +
                     'sizes="100vw">' +
                     '</div>';
      }
      return feat_image;
    }

    // Build the post, with or without the featured image.
    function build_post() {
      var date = new Date(object.date);
      var heroImage = '';
      var featureImage = get_featured_image();
      object.link
      date
      date.toDateString()
      object.content.rendered
      var previous_post_content =
        '<div class="ad-unit">' +
          '<div class="js-ad scroll-load" data-size="[[728,90],[970,90]]" data-size-map="[[[1000,0],[[728,90],[970,90]]],[[730,0],[[728,90]]]]" data-pos="btf"></div><span class="fake-leaderboard-span"></span>' +
        '</div>' +

        '<article itemscope itemtype="https://schema.org/ScholarlyArticle">' +
          '<div class="story-header" id="<' + object.id + '">' +

            '<div class="container">' +
              '<div class="story-title">' +
                '<h1 itemprop="name">' + object.title.rendered + '</h1>' +
              '</div>' +
            '</div>'

            if(heroImage) {
              '<img class="story-hero-image" src="" alt="Article Featured Image" />' +
              '<div class="story-hero-image-l-xl" style="background: url() no-repeat center center;"></div>'
            } else if(featureImage) {
              '<img class="story-hero-image" src="' + get_featured_image() + '" alt="Article Featured Image" />' +
              '<div class="story-hero-image-l-xl" style="background: url(' + get_featured_image() +') no-repeat center center;"></div>'      
            } else {
              '<div class="hero-wrapper-clear"></div>'
            }


          '</div>' +
        '</article>' +

        '<div class="ajax-loader" data-id="' + object.previous_post_ID + '"><img src="' + theme_uri + '/img/spinner.svg" width="32" height="32" /></div>';
        

      // Append related posts to the #related-posts container
      $('.ajax-loader').replaceWith(previous_post_content);

      // Reininitialize the new ads
      make.gpt.loadDyn();

      // Reininitialize the previous post trigger on new content.
      previous_post_trigger();
    }

    // Run the menagerie.
    build_post()
  }


})(jQuery);