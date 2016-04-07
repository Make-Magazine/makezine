(function($) {

  /**
   * @class
   * @extends Contextly.Proxy
   */
  Contextly.widget.ViewWatcher = Contextly.createClass({

    extend: [Contextly.Proxy.prototype],

    statics: /** @lends Contextly.widget.ViewWatcher */ {

      construct: function() {
        this.widgets = {};
        this.pollTimer = null;
        this.$window = $(window);
      },

      start: function() {
        if (this.isActive()) {
          return;
        }

        this.pollTimer = setInterval(this.proxy(this.checkWidgetsVisibility), 300);
      },

      stop: function() {
        if (!this.isActive()) {
          return;
        }

        clearInterval(this.pollTimer);
        this.pollTimer = null;
      },

      isActive: function() {
        return !!this.pollTimer;
      },

      /**
       * @param {Contextly.widget.Base} widget
       */
      watch: function(widget) {
        if (Contextly.Utils.isEmptyObject(this.widgets)) {
          this.start();
        }

        var index = widget.getWidgetIndex();
        this.widgets[index] = widget;
      },

      /**
       * @param {Contextly.widget.Base} widget
       */
      unwatch: function(widget) {
        var index = widget.getWidgetIndex();
        delete this.widgets[index];

        if (Contextly.Utils.isEmptyObject(this.widgets)) {
          this.stop();
        }
      },

      /**
       * @param {Contextly.widget.Base} widget
       */
      isWatched: function(widget) {
        var index = widget.getWidgetIndex();
        return typeof this.widgets[index] !== 'undefined';
      },

      getViewport: function() {
        var viewport = {
          top : this.$window.scrollTop(),
          left : this.$window.scrollLeft()
        };
        viewport.right = viewport.left + this.$window.width();
        viewport.bottom = viewport.top + this.$window.height();
        return viewport;
      },

      isElementInsideViewport: function(el, viewport) {
        var bounds = el.offset();
        bounds.right = bounds.left + el.outerWidth();
        bounds.bottom = bounds.top + el.outerHeight();

        var isOutsideViewport = (
          viewport.right < bounds.left
            || viewport.left > bounds.right
            || viewport.bottom < bounds.top
            || viewport.top > bounds.bottom
          );

        return !isOutsideViewport;
      },

      checkWidgetsVisibility: function() {
        this.each(this.widgets, function(widget) {
          /**
           * @var {Contextly.widget.ViewHandler} widget
           */
          var viewport = this.getViewport();
          var elements = widget.getWidgetElements();
          this.eachElement(elements, function(element, index) {
            var targetElement = widget.getViewWatcherElement(index, element);
            if (this.isElementInsideViewport(targetElement, viewport)) {
              widget.onWidgetInViewport();

              // No reasons to continue the loop.
              return false;
            }
          });
        });
      }

    }

  });

  /**
   * @mixin
   */
  Contextly.widget.ViewHandler = Contextly.createClass( /** @lends Contextly.widget.ViewHandler.prototype */ {

    /**
     * @function
     * @param widgetElement
     */
    findViewWatcherElement: Contextly.abstractMethod(),

    getViewWatcherElement: function(index, widgetElement) {
      this.widget_view_element = this.widget_view_element || [];

      if (this.widget_view_element[index] == null) {
        this.widget_view_element[index] = this.findViewWatcherElement(widgetElement);
      }

      return this.widget_view_element[index];
    },

    attachWidgetViewHandler: function() {
      if (this.widget_view_happened || Contextly.widget.ViewWatcher.isWatched(this)) {
        Contextly.Utils.logError('Widget view handler attempted to bind after the widget view event has been recorded or polling is in progress.');
        return;
      }

      Contextly.widget.ViewWatcher.watch(this);
    },

    onWidgetInViewport: function() {
      Contextly.widget.ViewWatcher.unwatch(this);

      if (this.widget_view_happened) {
        return;
      }
      this.widget_view_happened = true;

      var guid = Contextly.Visitor.getGuid();
      if (guid != null) {
        this.logEvent(Contextly.widget.eventNames.MODULE_VIEW, {
          event_guid: guid,
          event_success: true
        });
      }

      this.broadcast(Contextly.widget.broadcastTypes.IN_VIEWPORT);
    }

  });

})(jQuery);
