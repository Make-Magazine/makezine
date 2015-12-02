(function($) {

  /**
   * Base class for all widgets displaying links list.
   *
   * @class
   * @extends Contextly.widget.Base
   * @extends Contextly.widget.ResponsiveLayout
   */
  Contextly.widget.BaseLinksList = Contextly.createClass( /** @lends Contextly.widget.BaseLinksList.prototype */ {

    extend: [
      Contextly.widget.Base,
      Contextly.widget.ResponsiveLayout
    ],

    construct: function(widget) {
      Contextly.widget.Base.apply(this, arguments);

      this.widget_view_happened = false;
    },

    getScreenWidth: function () {
      return $(window).width();
    },

    hasWidgetData: function() {
      // Descendants must override it.
      return false;
    },

    isDisplaySection: function(section) {
      var display_section = $.inArray(section, this.widget.settings.display_sections) != -1;
      var have_to_display = this.widget.links && this.widget.links[ section ] && this.widget.links[ section ].length > 0;

      return display_section && have_to_display;
    },

    display: function() {
      var widgetHasData = this.hasWidgetData();

      if (widgetHasData) {
        var widget_html = this.getWidgetHTML();
        this.displayHTML( widget_html );
      }
      else {
        // Hide content of the snippet placeholders (e.g. Loading...)
        this.getWidgetContainers().empty();
      }

      this.attachHandlers(widgetHasData);
      this.broadcastWidgetDisplayed();
    },

    getHandlers: function(widgetHasData) {
      var handlers = Contextly.widget.Base.prototype.getHandlers.apply(this, arguments);

      if (widgetHasData) {
        handlers.setUpResponsiveLayout = true;
      }

      return handlers;
    },

    onVideoLinkClick: function(target, e) {
      e.preventDefault();

      var link = $(target);
      var data = {
        videoUrl: link.attr('href'),
        videoTitle: link.attr('title')
      };
      Contextly.overlay.Video.open(data);

      var contextly_url = link.attr('contextly-url');
      Contextly.MainServerAjaxClient.call(contextly_url);
    },

    attachLinksPopups: function() {
      this.getWidgetElements()
        .find("a[rel='ctx-video-dataurl']")
        .click(this.proxy(this.onVideoLinkClick, true, true));
    },

    getImageDimension: function() {
      return this.getImageDimensionFor(this.getSettings().images_type);
    },

    getImageDimensionFor: function(image_type) {
      image_type = image_type.replace('square', '').replace('letter', '');

      var dimensions = image_type.split('x');
      var w = 0;
      var h = 0;

      if (dimensions.length == 2) {
        w = parseInt(dimensions[0]);
        h = parseInt(dimensions[1]);
      }

      return {width: w, height: h};
    },

    getImagesHeight: function() {
      var image_dimension = this.getImageDimension();
      return image_dimension.height;
    },

    getImagesWidth: function() {
      var image_dimension = this.getImageDimension();
      return image_dimension.width;
    },

    getWidgetLinks: function() {
      if (this.getWidget() && this.getWidget().links) {
        return this.getWidget().links;
      }

      return null;
    },

    getModuleType: function() {
      return this.getSettings().display_type;
    },

    getWidgetSectionLinks: function(section) {
      var widget_links = this.getWidgetLinks();

      if (widget_links && widget_links[ section ]) {
        return widget_links[ section ];
      }

      return null;
    },

    getLinkThumbnailUrl: function(link) {
      if (link.thumbnail_url) {
        return link.thumbnail_url;
      }

      return null;
    },

    getLinkIcon: function(link) {
      if (link.video) {
        return '<span class="ctx-icon ctx-icon-video"></span>';
      } else if (link.tweet) {
        return '<span class="ctx-icon ctx-icon-twitter"></span>';
      }
      return '';
    },

    // TODO Check if any use cases left after moving to templates and drop.
    escape: function(text) {
      return Contextly.Utils.escape(text);
    },

    getEventTrackingHtml: function(link) {
      var settings = this.getSettings();
      var html = " onmousedown=\"";

      if (!link.video) {
          html += "this.href='" + this.escape(link.url) + "';"
      }

      if (settings && settings.utm_enable) {
        html += this.getTrackLinkJSHtml(link);
      }

      html += "\"";

      return html;
    },

    getLinkATag: function(link, content) {
      return "<a href=\"" +
        this.escape(link.native_url) + "\" title=\"" +
        this.escape(link.title) + "\" class='ctx-clearfix ctx-nodefs' " +
        this.getEventTrackingHtml(link) + ">" +
        content + "</a>";
    },

    getVideoLinkATag: function(link, content) {
      return "<a rel=\"ctx-video-dataurl\" class='ctx-clearfix ctx-nodefs' href=\"" +
        this.escape(link.native_url) + "\" title=\"" +
        this.escape(link.title) + "\" contextly-url=\"" + link.url + "\" " +
        this.getEventTrackingHtml(link) + ">" + content + "</a>";
    },

    getTweetLinkATag: function(link, content) {
      return "<a rel=\"ctx-tweet-dataurl\" class='ctx-clearfix ctx-nodefs' href=\"" +
        this.escape(link.native_url) + "\" title=\"" +
        this.escape(link.title) + "\" contextly-url=\"" + link.url + "\" " +
        this.getEventTrackingHtml(link) + ">" + content + "</a>";
    },

    getTrackLinkJSHtml: function(link) {
      var widget_type = this.escape(this.getWidgetType());
      var link_type = this.escape(link.type);
      var link_url = this.escape(link.url);
      var link_title = this.escape(link.title);

      return this.escape("Contextly.PageEvents.trackLink('" + widget_type + "','" + link_type + "','" + link_url + "','" + link_title + "');");
    },

    getLinkHTML: function(link) {
      if (link.video) {
        return this.getLinkHTMLVideo(link);
      } else if (link.tweet) {
        return this.getLinkHTMLTweet(link);
      } else {
        return this.getLinkHTMLNormal(link);
      }
    },

    getInnerLinkHTML: function(link) {
      return link.title;
    },

    getLinkHTMLVideo: function(link) {
      return "<div class='ctx-link'>" + this.getVideoLinkATag(link, this.getInnerLinkHTML(link)) + "</div>";
    },

    getLinkHTMLTweet: function(link) {
      return "<div class='ctx-link'>" + this.getTweetLinkATag(link, this.getInnerLinkHTML(link)) + "</div>";
    },

    getLinkHTMLNormal: function(link) {
      return "<div class='ctx-link'><div class='ctx-link-title'>" + this.getLinkATag(link, this.getInnerLinkHTML(link)) + "</div></div>";
    },

    isDisplayContextlyLogo: function() {
      return Contextly.Settings.isBrandingDisplayed();
    },

    getBrandingButtonHtml: function () {
      if (!this.isDisplayContextlyLogo()) {
        return '';
      }

      var div = "<div class='ctx-branding ctx-clearfix'>";
      div += "<a href='https://contextly.com' class='ctx-branding-link ctx-nodefs'>Powered by</a>";
      div += "</div>";
      return div;
    },

    attachBrandingHandlers: function() {
      if (!this.isDisplayContextlyLogo()) {
        return;
      }

      this.getWidgetContainers()
        .find(".ctx-branding-link")
        .click(function(event) {
          event.preventDefault();
          Contextly.overlay.Branding.open();
        });
    }

  });

})(jQuery);
