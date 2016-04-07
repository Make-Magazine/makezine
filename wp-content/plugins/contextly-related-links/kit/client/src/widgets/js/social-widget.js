(function($) {

  /**
   * @class
   * @extends Contextly.widget.Base
   * @extends Contextly.widget.TweetsRenderer
   * @extends Contextly.widget.ViewHandler
   * @extends Contextly.widget.ResponsiveLayout
   */
  Contextly.widget.Social = Contextly.createClass( /** @lends Contextly.widget.Social.prototype */ {

    extend: [
      Contextly.widget.Base,
      Contextly.widget.TweetsRenderer,
      Contextly.widget.ViewHandler,
      Contextly.widget.ResponsiveLayout
    ],

    construct: function(widget) {
      Contextly.widget.Base.apply(this, arguments);

      this.widget_type = Contextly.widget.types.SOCIAL;
      this.widget_displayed = false;
    },

    hasWidgetData: function() {
      var links = this.getWidget().links;
      return links && links.length;
    },

    display: function() {
      if (this.hasWidgetData()) {
        // Rendering is done in three steps:
        // 1. Wait for the Twitter library to load.
        // 2. Render HTML, init Slick, render tweets, wait for all tweets to
        //    load for the first time.
        // 3. On all tweets displayed for the first time broadcast the widget
        //    displayed event.
        this.queueTweetsRendering();
      }
      else {
        this.getWidgetContainers().empty();
        this.broadcastWidgetDisplayed();
      }
    },

    onTwitterReady: function() {
      // Rendering phase 2. Display outer HTML, bind Twitter events, set up
      // Slick,
      var widget_html = this.getWidgetHTML();
      this.displayHTML(widget_html);
      this.setUpResponsiveLayout();
      this.bindTwitterEvents();
      this.setUpSlick();

      this.tweets_rendering_queue = new Contextly.CallbackQueue();
      this.tweets_rendering_queue.appendResult(this.proxy(this.onAllTweetsRendered));
      this.renderTweets(this.getWidgetElements());
    },

    onAllTweetsRendered: function() {
      if (!this.widget_displayed) {
        this.widget_displayed = true;
        this.attachWidgetViewHandler();
        this.attachNavigationEvents();
        this.broadcastWidgetDisplayed();
      }
    },

    getWidgetStyleClass: function() {
      return 'ctx-social-' + this.getSettings().theme;
    },

    getWidgetHTML: function() {
      var html = '';
      var s = this.getSettings();

      if (s.title) {
        html += "<div class='ctx-title'><p>" + this.escape(s.title) + "</p></div>";
      }

      html += "<div class='ctx-content ctx-clearfix'>"
        + "<div class='ctx-tweets'>"
        + this.getLinksHTML()
        + "</div>"
        + "</div>";

      var classes = [
        'ctx-social-widget',
        this.getWidgetStyleClass()
      ];
      return "<div class='" + this.escape(classes.join(' ')) + "'>" + html + "</div>";
    },

    getLinkHTML: function(link) {
      return '<div class="ctx-tweet ctx-icon ctx-icon-hourglass"'
        + ' data-tweet-id="' + this.escape(link.tweet) + '"'
        + ' data-native-url="' + this.escape(link.native_url) + '"'
        + ' data-contextly-url="' + this.escape(link.url) + '"'
        + '></div>';
    },

    getLinksHTML: function() {
      var html = '';

      if (this.hasWidgetData()) {
        var links = this.getWidget().links;
        for (var i = 0; i < links.length; i++) {
          html += this.getLinkHTML(links[i]);
        }
      }

      return html;
    },

    getLayoutModes: function() {
      return {
        "mobile": [0, 350],
        "1-tweet": [350, 1040],
        "2-tweets": [1040, 1510],
        "3-tweets": [1510, 1980],
        "wide": [1980]
      };
    },

    setUpSlick: function() {
      this.eachElement(this.getWidgetElements(), function(widgetElement) {
        var slickElement = widgetElement.find('.ctx-tweets');
        var data = {
          widgetElement: widgetElement
        };

        // Since on Slick breakpoint switch all the tweets loose their content
        // because of DOM manipulations made by the library, we have to handle
        // it in the following way:
        // - Before the refresh we drop frames of the tweets to make the switch
        //   much more lightweight.
        // - After the refresh we just re-load all the tweets.
        callback = this.proxy(this.onSlickBeforeRefresh, false, true);
        slickElement.bind(this.nsEvent('beforeRefresh'), data, callback);
        var callback = this.proxy(this.onSlickAfterRefresh, false, true);
        slickElement.bind(this.nsEvent('refresh'), data, callback);

        var slick = new Contextly.Slick(slickElement, {
          infinite: true,
          slidesToShow: 4,
          slidesToScroll: 1,
          touchMove: false,
          draggable: false,
          centerMode: true,
          centerPadding: '50px',
          zIndex: 5,
          respondTo: 'slider',
          responsive: [
            {
              breakpoint: 1511,
              settings: {
                slidesToShow: 3
              }
            },
            {
              breakpoint: 1041,
              settings: {
                slidesToShow: 2
              }
            },
            {
              breakpoint: 571,
              settings: {
                slidesToShow: 1
              }
            },
            {
              breakpoint: 351,
              settings: {
                slidesToShow: 1,
                centerPadding: '8px'
              }
            }
          ]
        });
        widgetElement.data('ctxSlick', slick);
      });
    },

    onSlickBeforeRefresh: function(e) {
      if (!e.data || !e.data.widgetElement) {
        return;
      }

      this.getTweetContainers(e.data.widgetElement)
        .empty()
        .addClass('ctx-icon ctx-icon-hourglass');
    },

    onSlickAfterRefresh: function(e) {
      if (!e.data || !e.data.widgetElement) {
        return;
      }

      this.renderTweets(e.data.widgetElement);
    },

    buildLayoutClass: function(mode) {
      return 'ctx-social-' + mode;
    },

    getAssetsPackageName: function() {
      return 'widgets/social/carousel';
    },

    getCustomCssCode: function() {
      return Contextly.widget.SocialCssCustomBuilder
        .buildCSS('.' + this.getWidgetStyleClass(), this.getSettings());
    },

    getTweetContainers: function(widgetElements) {
      return widgetElements.find('.ctx-tweet[data-tweet-id]');
    },

    getTweetContainer: function(frameElement) {
      return $(frameElement)
        .parents('.ctx-tweet:first');
    },

    onTweetTargetUrlClick: function(blockquote, e, tweetContainer) {
      var contextlyUrl = tweetContainer.attr('data-contextly-url');
      Contextly.MainServerAjaxClient.call(contextlyUrl);

      // Prevent logging it as an ordinary click.
      return false;
    },

    renderTweet: function(element) {
      element
        .unbind('contextlyTweetRendered')
        .one('contextlyTweetRendered', this.proxy(function(el) {
          var $el = $(el);
          $el.removeClass('ctx-icon ctx-icon-hourglass');

          var $iframe = $el.find('iframe.twitter-tweet');
          var $frameDoc = $iframe.contents();
          var $html = $frameDoc.find('html:first');
          if ($html.length) {
            // Workaround to the Twitter library issue on Firefox & IE9. Tweets
            // appear cropped on these browsers, but as soon as we try to resize
            // them the Twitter library does its job properly and fixes the size.
            var height = $html.height();
            if (height > 0) {
              $iframe.height(height);
            }

            // Cancel clicks on tweet & change the cursor. Since Twitter library
            // binds event handlers to both document and the embedded tweet div
            // we have to use event capturing here and catch the click event on
            // the iframe document to cancel it.
            $html
              .find('div.EmbeddedTweet')
              .css('cursor', 'default');
            if ($frameDoc[0].addEventListener) {
              $frameDoc[0].addEventListener('click', function(e) {
                var $target = $(e.target);
                if (!$target.is('a') && !$target.parents('a:first').length) {
                  e.stopPropagation();
                }
              }, true);
            }
          }
        }, true));

      if (!this.tweets_rendering_queue.isComplete()) {
        element.one('contextlyTweetRendered', this.tweets_rendering_queue.addReason());
      }

      Contextly.widget.TweetsRenderer.fn.renderTweet.apply(this, arguments);
    },

    findViewWatcherElement: function(widgetElement) {
      return widgetElement.find('.ctx-tweets');
    },

    attachNavigationEvents: function() {
      this.getWidgetElements()
        .find('.ctx-tweets')
        .bind(this.nsEvent('beforeChange'), this.proxy(this.onSlickNavigation, false, true));
    },

    onSlickNavigation: function(e, slick, prev, next) {
      var diff = Math.abs(prev - next);

      if (!diff) {
        // Navigation without diff happens on reaching responsive layout
        // breakpoint, we just ignore it.
        return;
      }

      if (diff === 1) {
        if (next > prev) {
          this.onSlickNext();
        }
        else {
          this.onSlickPrev();
        }
      }
      else if (this.hasWidgetData()) {
        var linksNum = this.getWidget().links.length;
        if (prev === 0 && next === linksNum - 1) {
          this.onSlickPrev();
        }
        else if (next === 0 && prev === linksNum - 1) {
          this.onSlickNext();
        }
      }
    },

    onSlickPrev: function() {
      this.logEvent(Contextly.widget.eventNames.CAROUSEL_NAVIGATION, {
        event_direction: 'previous'
      });
    },

    onSlickNext: function() {
      this.logEvent(Contextly.widget.eventNames.CAROUSEL_NAVIGATION, {
        event_direction: 'next'
      });
    }

  });

})(jQuery);
