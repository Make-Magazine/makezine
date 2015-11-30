(function($) {

  // Init global namespace.
  Contextly.widget = Contextly.widget || {};

  // Widget types.
  Contextly.widget.types = {
    SNIPPET: 'snippet',
    SIDEBAR: 'sidebar',
    AUTO_SIDEBAR: 'auto-sidebar',
    STORYLINE_SUBSCRIBE: 'storyline-subscribe',
    SIDERAIL: 'side-rail',
    SOCIAL: 'social'
  };

  // Snippet styles.
  Contextly.widget.styles = {
    TEXT: 'default',
    TABS: 'tabs',
    BLOCKS: 'blocks',
    BLOCKS2: 'blocks2',
    FLOAT: 'float'
  };

  // Widget link types.
  Contextly.widget.linkTypes = {
    PREVIOUS: 'previous',
    RECENT: 'recent',
    WEB: 'web',
    INTERESTING: 'interesting',
    CUSTOM: 'custom',
    PROMO: 'sticky'
  };

  // Widget recommendation types.
  Contextly.widget.recommendationTypes = {
    VIDEO: 10,
    PRODUCT: 9,
    COOKIE: 8,
    EVERGREEN: 7,
    OPTIMIZATION: 6
  };

  // Widget-related broadcast event types.
  Contextly.widget.broadcastTypes = {
    DISPLAYED: 'contextlyWidgetDisplayed',
    IN_VIEWPORT: 'contextlyWidgetInViewport',
    LAYOUT_CHANGED: 'contextlyWidgetLayoutChanged'
  };

  // Widget-related API event names.
  Contextly.widget.eventNames = {
    MODULE_VIEW: 'module_view',
    CAROUSEL_NAVIGATION: 'carousel_navigation'
  };

  // Unique index of the widget.
  Contextly.widget.index = 0;

  /**
   * Base abstract class for all widgets.
   *
   * @class
   * @extends Contextly.Proxy
   */
  Contextly.widget.Base = Contextly.createClass( /** @lends Contextly.widget.Base.prototype */ {

    extend: [Contextly.Proxy, Contextly.Transmitter],

    // TODO Replace with template rendering and drop.
    abstracts: [ 'getWidgetHTML' ],

    construct: function(widget, containers) {
      this.widget = widget;
      this.containers = containers;

      this.widget_elements = null;
      this.widget_index = ++Contextly.widget.index;
    },

    getWidget: function() {
      return this.widget;
    },

    getWidgetType: function() {
      return this.widget_type;
    },

    getSettings: function() {
      return this.getWidget().settings;
    },

    getWidgetIndex: function() {
      return this.widget_index;
    },

    markWithWidgetIndex: function(elements) {
      $(elements)
        .data('ctxWidgetIndex', this.getWidgetIndex());
    },

    widgetIndexMatches: function(element) {
      return $(element).data('ctxWidgetIndex') === this.getWidgetIndex();
    },

    getWidgetStyleClass: function() {
      return 'default-widget';
    },

    getWidgetElements: function() {
      if (this.widget_elements === null) {
        this.widget_elements = this.getWidgetContainers()
          .find('.' + this.getWidgetStyleClass());
      }

      return this.widget_elements;
    },

    getWidgetContainers: function() {
      return this.containers.getElements();
    },

    getEventsNamespace: function() {
      // TODO Per-type widget namespaces if necessary.
      return 'ctxWidget';
    },

    /**
     * Adds namespace to the passed jQuery event type.
     */
    nsEvent: function(type) {
      var ns = '.' + this.getEventsNamespace();

      if (type) {
        type = type.split(/\s+/)
          .join(ns + ' ');
      }
      else {
        type = '';
      }
      type += ns;

      return type;
    },

    // TODO Replace use cases with template and drop.
    displayHTML: function (html) {
      this.getWidgetContainers().html(html);
    },

    // TODO Replace use cases with template and drop.
    appendHTML: function(html) {
      this.getWidgetContainers().append(html);
    },

    /**
     * @param {Contextly.CallbackQueue} queue
     */
    loadAssets: function(queue) {
      var name = this.getAssetsPackageName();
      if (name != null) {
        Contextly.AssetManager.render(name, queue);
      }

      this.loadCssCode(queue);
      this.loadFonts(queue);
    },

    removeAssets: function() {
      var name = this.getAssetsPackageName();
      if (name != null) {
        Contextly.AssetManager.remove(name);
      }

      this.removeCssCode();
    },

    display: function() {
      var widget_html = this.getWidgetHTML();
      this.displayHTML(widget_html);
      this.attachHandlers();
      this.broadcastWidgetDisplayed();
    },

    attachHandlers: function() {
      var handlers = this.getHandlers.apply(this, arguments);
      for (var name in handlers) {
        this[name].call(this);
      }
    },

    getHandlers: function() {
      return {};
    },

    /**
     * @param type
     * @param {...*}
     *   The rest arguments are passed to the handler after widget type and
     *   current instance of {Contextly.widget.Base}.
     */
    broadcast: function(type) {
      var args = [type, this.widget_type, this];

      // Pass arguments after type.
      if (arguments.length > 1) {
        Array.prototype.push.apply(args, Array.prototype.slice.call(arguments, 1));
      }

      Contextly.Transmitter.fn.broadcast.apply(this, args);
    },

    broadcastWidgetDisplayed: function() {
      this.broadcast(Contextly.widget.broadcastTypes.DISPLAYED);
    },

    getCssCodeKey: function() {
      return 'widgets/settings:' + this.getWidgetType();
    },

    /**
     * @param {Contextly.CallbackQueue} queue
     */
    loadCssCode: function(queue) {
      var key = this.getCssCodeKey();
      if (Contextly.CssManager.getCodeElement(key).length) {
        return;
      }

      // Make needed CSS rules and load widget settings CSS.
      var code = this.getCustomCssCode();
      if (!code) {
        return;
      }

      Contextly.CssManager.loadCode(code, key);
    },

    removeCssCode: function() {
      var key = this.getCssCodeKey();
      Contextly.CssManager.removeCode(key);
    },

    /**
     * @param {Contextly.CallbackQueue} queue
     */
    loadFonts: function(queue) {
      var fonts = this.getSettings().external_fonts;
      if (fonts) {
        Contextly.FontManager.load({
          fonts: fonts,
          callback: queue.addReason()
        });
      }
    },

    getAssetsPackageName: function() {
      // None by default.
    },

    getCustomCssCode: function() {
      // Do nothing by default.
    },

    // TODO Check if any use cases left after moving to templates and drop.
    escape: function(text) {
      return Contextly.Utils.escape(text);
    },

    logEvent: function(name, params) {
      params = this.alterLoggedEventParams(params);

      Contextly.EventsLogger.logEvent(name, params);
    },

    alterLoggedEventParams: function(params) {
      params.event_widget_type = this.getWidgetType();
      return params;
    }

  });

})(jQuery);
