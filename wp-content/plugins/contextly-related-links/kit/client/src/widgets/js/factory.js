/**
 * @class
 */
Contextly.widget.Factory = Contextly.createClass({

  statics: /** @lends Contextly.widget.Factory */{

    construct: function() {
      this.containers = {};
    },

    getContainerClass: function(type) {
      switch (type) {
        case Contextly.widget.types.SIDEBAR:
          return Contextly.widget.SidebarContainers;

        case Contextly.widget.types.AUTO_SIDEBAR:
          return Contextly.widget.AutoSidebarContainers;

        case Contextly.widget.types.STORYLINE_SUBSCRIBE:
          return Contextly.widget.StoryLineSubscribeContainers;

        case Contextly.widget.types.SIDERAIL:
          return Contextly.widget.SiderailContainers;

        case Contextly.widget.types.SOCIAL:
          return Contextly.widget.SocialContainers;

        default:
          return Contextly.widget.SnippetContainers;
      }
    },

    /**
     * @param type
     * @param [widget]
     */
    getContainer: function(type, widget) {
      var containerClass = this.getContainerClass(type);
      if (!containerClass) {
        return null;
      }

      return new containerClass(widget);
    },

    getWidgetClass: function(type, theme) {
      switch (type) {
        case Contextly.widget.types.SIDEBAR:
          return Contextly.widget.Sidebar;

        case Contextly.widget.types.AUTO_SIDEBAR:
          return Contextly.widget.AutoSidebar;

        case Contextly.widget.types.STORYLINE_SUBSCRIBE:
          return Contextly.widget.StoryLineSubscribe;

        case Contextly.widget.types.SIDERAIL:
          switch (theme) {
            case Contextly.widget.sideRailStyles.H_SQUARE:
              return Contextly.widget.SiderailHSquare;

            case Contextly.widget.sideRailStyles.H_LETTER:
              return Contextly.widget.SiderailHLetter;

            default:
              return Contextly.widget.Siderail;
          }

        case Contextly.widget.types.SOCIAL:
          return Contextly.widget.Social;

        default:
          // Snippet.
          switch (theme) {
            case Contextly.widget.styles.TEXT:
              return Contextly.widget.TextSnippet;

            case Contextly.widget.styles.TABS:
            case Contextly.widget.styles.BLOCKS:
              return Contextly.widget.BlocksSnippet;

            case Contextly.widget.styles.BLOCKS2:
              return Contextly.widget.Blocks2Snippet;

            case Contextly.widget.styles.FLOAT:
              return Contextly.widget.FloatSnippet;
          }
      }
    },

    /**
     * @param widget
     *
     * @returns {Contextly.widget.Base|null}
     */
    getWidget: function(widget) {
      if (!widget) {
        return null;
      }

      var widgetTheme = widget.settings.display_type || widget.settings.theme;
      var widgetClass = this.getWidgetClass(widget.type, widgetTheme);
      if (!widgetClass) {
        return null;
      }

      var container = this.getContainer(widget.type, widget);
      return new widgetClass(widget, container);
    }

  }

});
