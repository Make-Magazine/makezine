(function($) {

  /**
   * @class
   * @extends Contextly.widget.BaseFlatLinksList
   */
  Contextly.widget.Sidebar = Contextly.createClass( /** @lends Contextly.widget.Sidebar.prototype */ {

    extend: Contextly.widget.BaseFlatLinksList,

    construct: function(widget) {
      Contextly.widget.BaseFlatLinksList.apply(this, arguments);

      this.widget_type = Contextly.widget.types.SIDEBAR;
    },

    getWidgetStyleClass: function() {
      return 'ctx-content-sidebar';
    },

    getWidgetHTML: function() {
      var html = '';

      var title = this.widget.name;
      if (title) {
        html += "<div class='ctx-sb-title'><p>" + this.escape(title) + "</p></div>";
      }

      var description = this.widget.description;
      if (description) {
        html += "<div class='ctx-sb-description'><p>" + this.escape(description) + "</p></div>";
      }

      html += "<div class='ctx-sb-content'>"
        + this.getLinksHTML()
        + "</div>";

      var classes = [
        'ctx-sidebar',
        this.getWidgetStyleClass(),
        'ctx-sidebar-' + this.widget.layout,
        'ctx-clearfix'
      ];
      return "<div class='" + this.escape(classes.join(' ')) + "'>" + html + "</div>";
    },

    getLinkATag: function(link, content) {

      return "<a href=\"" +
        this.escape(link.native_url) + "\" title=\"" +
        this.escape(link.title) + "\" class='ctx-clearfix ctx-nodefs ctx-no-images' " +
        this.getEventTrackingHtml(link) + ">" + content + "</a>";
    },

    getLinkHTML: function(link) {
      var html = '';

      if (link.thumbnail_url) {

        var image_html = "<img src='" + link.thumbnail_url + "' />";
        var image_href;

        if (link.video) {
          image_href = this.getVideoLinkATag(link, image_html);
        }
        else {
          image_href = this.getLinkATag(link, image_html);
        }

        html += "<div class='ctx-sb-img'>" + image_href + "</div>";
      }

      var linkContent = link.title;
      if (!link.thumbnail_url) {
        linkContent = '<span class="ctx-icon ctx-bullet"></span>' + linkContent;
      }
      if (this.widget.settings.display_link_dates && link.publish_date) {
        linkContent += "<br /><span class='ctx-pub-date'>" + Contextly.Utils.dateTextDiff(link.publish_date) + "</span>";
      }

      var a;
      if (link.video) {
        a = this.getVideoLinkATag(link, linkContent);
      }
      else {
        a = this.getLinkATag(link, linkContent);
      }

      var classes = ['ctx-sb-text'];
      if (!link.thumbnail_url) {
        classes.push('ctx-sb-no-thumbnail');
      }
      html += "<div class='" + classes.join(' ') + "'><p>" + a + "</p></div>";

      html = "<div class='ctx-sb-link'><div class='ctx-sb-fotmater ctx-clearfix'>" + html + "</div></div>";
      return html;
    },

    getAssetsPackageName: function() {
      return 'widgets/sidebar/default';
    },

    getCustomCssCode: function() {
      return Contextly.widget.SidebarCssCustomBuilder
        .buildCSS('.' + this.containers.getTypeClass(), this.getSettings());
    },

    setUpResponsiveLayout: function() {
      if (this.widget.layout === 'wide') {
        // There is no sense in normal mode on wide layout as they look exactly
        // the same, just set mobile mode once.
        var elements = this.getWidgetElements();
        this.eachElement(elements, function(element) {
          this.setLayoutMode(element, 'mobile');
        });
      }
      else {
        Contextly.widget.BaseFlatLinksList.prototype.setUpResponsiveLayout.apply(this, arguments);
      }
    },

    getLayoutModes: function() {
      return {
        "mobile": [0, 400],
        "default": [400]
      };
    },

    checkLayoutThresholds: function() {
      var elements = this.getWidgetElements();

      // TODO Avoid hard-coding screen condition.
      if (this.getScreenWidth() <= 540) {
        this.eachElement(elements, function(element) {
          this.setLayoutMode(element, 'mobile');
        });
      }
      else {
        // Since the widget may be set to float left/right with no minimal width
        // we can't measure its size for adaptive layout. We use containers
        // instead (far from perfect, but should work for most cases).
        var modes = this.getLayoutModes();
        this.eachElement(elements, function(element) {
          var width = element.parent().width();
          this.each(modes, function(thresholds, name) {
            if (this.sizeMatchesThresholds(width, thresholds)) {
              this.setLayoutMode(element, name);
              return false;
            }
          });
        });
      }
    },

    buildLayoutClass: function(mode) {
      return 'ctx-sidebar-' + mode;
    }

  })

})(jQuery);
