(function($) {

  /**
   * @mixin
   */
  Contextly.widget.TweetsRenderer = Contextly.createClass({

    queueTweetsRendering: function() {
      twttr.ready(this.proxy(this.onTwitterReady));
    },

    /**
     * @function
     * @param widgetElements
     */
    getTweetContainers: Contextly.abstractMethod(),

    /**
     * @function
     * @param frameElement
     *   The window.frameElement of the tweet iframe.
     */
    getTweetContainer: Contextly.abstractMethod(),

    onTwitterReady: function() {
      this.bindTwitterEvents();
      this.renderTweets(this.getWidgetElements());
    },

    renderTweets: function(widgetElements) {
      var tweetContainers = this.getTweetContainers(widgetElements);
      if (!tweetContainers.length) {
        return;
      }

      // Twitter event handlers are global and we should check whether the
      // event was triggered on tweet inside current widget, so we mark all
      // the containers with the widget index.
      this.markWithWidgetIndex(tweetContainers);

      this.eachElement(tweetContainers, this.renderTweet);
    },

    renderTweet: function(element) {
      var id = element.attr('data-tweet-id');
      twttr.widgets.createTweet(id, element[0], {
        cards: 'hidden',
        conversation: 'none'
      });
    },

    bindTwitterEvents: function() {
      // Bind the events provided by Twitter.
      var types = ['click', 'tweet', 'follow', 'retweet', 'favorite'];
      this.each(types, function(eventName) {
        this.bindTwitterEvent(eventName, this.onTweetInteraction);
      });
      this.bindTwitterEvent('rendered', this.onTweetRendered);
    },

    bindTwitterEvent: function(type, callback) {
      twttr.events.bind(type, this.proxy(function(e) {
        var link = this.getTweetContainer(e.target)
          .filter(this.proxy(this.widgetIndexMatches, true));
        if (!link.length) {
          return;
        }

        callback.call(this, e, link);
      }, false, true));
    },

    onTweetRendered: function(e) {
      // Bind tweet click events using jQuery as soon as the tweet rendering is
      // complete, because twitter doesn't provide events here.
      $(e.target)
        .contents()
        .find('blockquote')
        .bind('click', this.proxy(this.onTweetClick, true, true));

      // Trigger custom event on the tweet container.
      this.getTweetContainer(e.target)
        .triggerHandler('contextlyTweetRendered');
    },

    /**
     * Returns DOM frame element on the parent document.
     *
     * @see http://stackoverflow.com/a/16010322/404521
     *
     * @param element
     *   Element of the iframe DOM tree.
     */
    getTweetFrameElement: function(element) {
      var doc = element.ownerDocument;
      if (!doc) {
        return null;
      }

      var win = doc.defaultView || doc.parentWindow;
      if (!win) {
        return null;
      }

      return win.frameElement;
    },

    onTweetClick: function(blockquote, e) {
      var frameElement = this.getTweetFrameElement(blockquote);
      if (!frameElement) {
        return;
      }
      var link = this.getTweetContainer(frameElement);
      if (!link.length) {
        return;
      }

      var targetSelector = 'a[data-scribe^="element:"]';
      var target = $(e.target);
      if (!target.is(targetSelector)) {
        target = target.parents(targetSelector + ':first');
        if (!target.length) {
          return;
        }
      }

      var tweetId = $(blockquote).attr('data-tweet-id');
      if (!tweetId) {
        return;
      }

      var scribeType = target.attr('data-scribe')
        .replace(/^element:/, '');
      if ($.inArray(scribeType, ['reply', 'retweet', 'favorite']) !== -1) {
        // These types are handled through native Twitter events.
        return;
      }

      var href = target.attr('href');
      if (scribeType === 'url') {
        var expandedUrl = target.attr('data-expanded-url');

        if (expandedUrl) {
          // Use expanded rather than shortened URL on the events log.
          href = expandedUrl;

          // On the target URL we should send a request to the main server and
          // exit.
          var nativeUrl = link.attr('data-native-url');
          if (expandedUrl.toLowerCase() === nativeUrl.toLowerCase()) {
            if (!this.onTweetTargetUrlClick(blockquote, e, link)) {
              return;
            }
          }
        }
      }

      this.logTweetEvent('link', this.alterLoggedEventParams({
        event_element: scribeType,
        event_tweet_id: tweetId,
        event_url: href
      }));
    },

    onTweetTargetUrlClick: function(blockquote, e, tweetContainer) {
      // Nothing by default.
      return true;
    },

    onTweetInteraction: function(e, link) {
      var tweetId = link.attr('data-tweet-id');
      if (!tweetId) {
        return;
      }

      this.logTweetEvent(e.type, this.alterLoggedEventParams({
        event_element: e.region,
        event_tweet_id: tweetId
      }));
    },

    logTweetEvent: function(name, params) {
      params = this.alterLoggedEventParams(params);

      Contextly.EventsLogger.tweetEvent(name, params);
    }

  });

})(jQuery);