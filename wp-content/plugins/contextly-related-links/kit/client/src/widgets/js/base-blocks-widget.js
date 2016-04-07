(function($) {

  /**
   * Base class for all widgets displaying blocks.
   *
   * @class
   * @extends Contextly.widget.TextSnippet
   * @extends Contextly.widget.TweetsRenderer
   */
  Contextly.widget.BaseBlocksSnippet = Contextly.createClass( /** @lends Contextly.widget.BaseBlocksSnippet.prototype */ {

    extend: [
      Contextly.widget.TextSnippet,
      Contextly.widget.TweetsRenderer
    ],

    getLinksLimit: function() {
      return 6;
    },

    getLinksHTMLOfType: function(type) {
      var html = "";
      var widget = this.widget;

      if (widget.links && widget.links[ type ]) {
        var placeCounter = 0;
        var links_limit = this.getLinksLimit();
        for (var link_idx in widget.links[ type ]) {
          var link = widget.links[ type ][ link_idx ];

          placeCounter++;
          if (placeCounter > links_limit) {
            break;
          }

          if (link.id && link.title) {
            html += this.getLinkHTML(link, placeCounter);
          }
        }
      }

      return html;
    },

    getWidgetHTML: function() {
      var div = "";

      div += "<div class='" + this.escape(this.getWidgetClasses().join(' ')) + "'>";

      var sections = this.widget.settings.display_sections;

      div += "<div class='ctx-sections-container ctx-nomar'>";
      for (var i = 0; i < sections.length; i++ ) {
        var section_name = sections[i];

        if (this.isDisplaySection(section_name)) {
          var section_key = section_name + '_subhead';
          var section_header = this.widget.settings[ section_key ];

          var section_classes = ['ctx-section', 'ctx-clearfix', 'ctx-section-' + section_name];
          div += "<div class='" + this.escape(section_classes.join(' ')) + "'>";

          if (section_header) {
            div += "<div class='ctx-links-header'><p class='ctx-nodefs'>" + this.escape(section_header) + "</p></div>";
          }

          div += "<div class='ctx-links-content ctx-nodefs ctx-clearfix'>";
          div += this.getLinksHTMLOfType(section_name);
          div += "</div></div>";
        }
      }
      div += "</div>";

      div += this.getBrandingButtonHtml();

      div += "</div>";

      return div;
    },

    getLinkHTMLVideo: function(link, linkCounter) {
      return "<div class='ctx-link ctx-" + linkCounter + "'>" + this.getVideoLinkATag(link, this.getInnerLinkHTML(link)) + "</div>";
    },

    getLinkHTMLTweet: function(link, linkCounter) {
      return "<div class='ctx-link ctx-"  + linkCounter + "' data-tweet-id='" + this.escape(link.tweet) + "'>" + this.getTweetLinkATag(link, this.getInnerLinkHTML(link)) + "</div>";
    },

    getLinkHTMLNormal: function(link, linkCounter) {
      return "<div class='ctx-link ctx-" + linkCounter + "'>" + this.getLinkATag(link, this.getInnerLinkHTML(link)) + "</div>";
    },

    getHandlers: function(widgetHasData) {
      var handlers = Contextly.widget.TextSnippet.prototype.getHandlers.apply(this, arguments);

      if (widgetHasData) {
        handlers.queueTweetsRendering = true;
      }

      return handlers;
    },

    getTweetContainers: function(widgetContainers) {
      return widgetContainers.find('.ctx-link[data-tweet-id]')
    },

    getTweetContainer: function(frameElement) {
      return $(frameElement)
        .parents('.ctx-link.ctx-tweet:first');
    },

    onTweetTargetUrlClick: function(blockquote, e, tweetContainer) {
      var contextlyUrl = tweetContainer.attr('data-contextly-url');
      Contextly.MainServerAjaxClient.call(contextlyUrl);

      // Prevent logging it as an ordinary click.
      return false;
    },

    renderTweet: function(element) {
      // Before actually rendering the tweet we:
      // - Prepare the data-* attributes expected by the event handlers.
      // - Cleanup the element content.
      // - Mark widget section with special class.
      var a = element.find('a[rel="ctx-tweet-dataurl"]:first');
      var nativeUrl = a.attr('href');
      var contextlyUrl = a.attr('contextly-url');
      element
        .attr('data-native-url', nativeUrl)
        .attr('data-contextly-url', contextlyUrl)
        .empty()
        .addClass('ctx-tweet');
      element
        .parents('.ctx-section:first')
        .not('.ctx-social-section')
        .addClass('ctx-social-section');

      Contextly.widget.TweetsRenderer.fn.renderTweet.apply(this, arguments);
    }

  });

})(jQuery);
