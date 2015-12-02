(function($) {

  /**
   * @mixin
   */
  Contextly.widget.ResponsiveLayout = Contextly.createClass(/** @lends Contextly.widget.ResponsiveLayout */{

    getLayoutModes: function() {
      return {};
    },

    setUpResponsiveLayout: function() {
      if (Contextly.Utils.isEmptyObject(this.getLayoutModes())) {
        return;
      }

      this.checkLayoutThresholds();

      var checkCount = 0;
      var interval = setInterval(this.proxy(function() {
        checkCount++;
        if (checkCount > 5) {
          clearInterval(interval);
        }

        this.checkLayoutThresholds();
      }), 500);

      $(window)
        .resize(this.proxy(this.checkLayoutThresholds))
        .load(this.proxy(function() {
          clearInterval(interval);
          this.checkLayoutThresholds();
        }));
    },

    sizeMatchesThresholds: function(size, thresholds) {
      return (size >= thresholds[0] && (!thresholds[1] || size < thresholds[1]));
    },

    checkLayoutThresholds: function() {
      var modes = this.getLayoutModes();
      var elements = this.getWidgetElements();
      this.eachElement(elements, function(element) {
        var width = element.width();
        this.each(modes, function(thresholds, name) {
          if (this.sizeMatchesThresholds(width, thresholds)) {
            this.setLayoutMode(element, name);
            return false;
          }
        });
      });
    },

    buildLayoutClass: function(mode) {
      return 'ctx-' + mode;
    },

    setLayoutMode: function(element, mode) {
      var key = 'ctxLayoutMode';
      var lastMode = element.data(key);

      if (mode === lastMode) {
        // Nothing to do.
        return;
      }

      // Be silent on the first time.
      var firstTime = (lastMode == null);

      if (!firstTime) {
        element.removeClass(this.buildLayoutClass(lastMode));
      }

      element.data(key, mode);
      element.addClass(this.buildLayoutClass(mode));

      if (!firstTime) {
        this.broadcast(Contextly.widget.broadcastTypes.LAYOUT_CHANGED, mode);
      }
    }

  });

})(jQuery);