(function($) {

  Contextly.JsManager = Contextly.createClass({

    statics: {

      loadFile: function(url, key, callback) {
        var head = $("head:first")[0] || document.documentElement;
        var script = document.createElement("script");

        if (typeof callback === 'function') {
          // Taken from http://stackoverflow.com/a/4845802/404521
          var done = false;
          var onSuccess = function() {
            if (done) {
              return;
            }
            done = true;

            // Handle memory leak in IE
            script.onload = script.onreadystatechange = null;
            if ( head && script.parentNode ) {
              head.removeChild( script );
            }

            callback.call(script, key);
          };
          script.onload = onSuccess;
          script.onreadystatechange = function() {
            if (!this.readyState || this.readyState === "loaded" || this.readyState === "complete") {
              onSuccess();
            }
          };
        }

        $(script).attr({
          "data-ctx-key": key
        });
        script.src = url;

        // Use insertBefore instead of appendChild  to circumvent an IE6 bug.
        // This arises when a base node is used (#2709 and #4378).
        head.insertBefore(script, head.firstChild);
      },

      removeFile: function(key) {
        // Impossible.
      }

    }

  });

  Contextly.CssManager.broadcastTypes = {
    FILE_LOADING: 'contextlyJsFileLoading',
    FILE_LOADED: 'contextlyJsFileLoaded'
  };

})(jQuery);