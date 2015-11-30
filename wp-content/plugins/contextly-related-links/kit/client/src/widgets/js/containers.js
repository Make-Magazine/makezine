(function($) {
  /**
   * @class
   */
  Contextly.widget.BaseContainers = Contextly.createClass({

    /**
     * @param [widget]
     */
    construct: function(widget) {
      this.widget = widget;
    },

    getElements: function() {
      if (this.elements == null) {
        this.elements = this.findElements();
      }

      return this.elements;
    },

    findElements: function() {
      var result = $('.' + this.getClass());

      // Backward compatibility.
      if (!result.length) {
        var id = this.getId();
        if (id != null) {
          result = $('#' + id);
        }
      }

      return result;
    },

    getTypeClass: Contextly.abstractMethod(),

    getClass: function() {
      return this.getTypeClass();
    },

    getId: function() {
      // TODO Remove this legacy method and use cases on Kit 4.x
      return null;
    }

  });


  /**
   * @class
   * @extends Contextly.widget.BaseContainers
   */
  Contextly.widget.SnippetContainers = Contextly.createClass({

    extend: Contextly.widget.BaseContainers,

    getTypeClass: function() {
      return 'ctx-module-container';
    },

    getId: function() {
      return 'ctx-module';
    }

  });

  /**
   * @class
   * @extends Contextly.widget.BaseContainers
   */
  Contextly.widget.SidebarContainers = Contextly.createClass({

    extend: Contextly.widget.BaseContainers,

    getTypeClass: function() {
      return 'ctx-sidebar-container';
    },

    getClass: function() {
      if (this.widget && this.widget.id != null) {
        return 'ctx-sidebar-container--' + this.widget.id;
      }
      else {
        return this.getTypeClass();
      }
    },

    getId: function() {
      if (this.widget && this.widget.id != null) {
        return 'contextly-' + this.widget.id;
      }
    }

  });

  /**
   * @class
   * @extends Contextly.widget.BaseContainers
   */
  Contextly.widget.AutoSidebarContainers = Contextly.createClass({

    extend: Contextly.widget.BaseContainers,

    getTypeClass: function() {
      return 'ctx-autosidebar-container';
    },

    getClass: function() {
      if (this.widget && this.widget.id != null) {
        return 'ctx-autosidebar-container--' + this.widget.id;
      }
      else {
        return this.getTypeClass();
      }
    },

    getId: function() {
      if (this.widget && this.widget.id != null) {
        // Backward compatibility with old CMS plug-ins rendering auto-sidebars
        // as sidebars.
        return 'contextly-' + this.widget.id;
      }
    }

  });

  /**
   * @class
   * @extends Contextly.widget.BaseContainers
   */
  Contextly.widget.StoryLineSubscribeContainers = Contextly.createClass({

    extend: Contextly.widget.BaseContainers,

    getTypeClass: function() {
      return 'ctx-subscribe-container';
    },

    getId: function() {
      return 'ctx-sl-subscribe';
    }

  });

  /**
   * @class
   * @extends Contextly.widget.BaseContainers
   */
  Contextly.widget.SiderailContainers = Contextly.createClass({

    extend: Contextly.widget.BaseContainers,

    getTypeClass: function() {
      return 'ctx-siderail-container';
    }

  });

  /**
   * @class
   * @extends Contextly.widget.BaseContainers
   */
  Contextly.widget.SocialContainers = Contextly.createClass({

    extend: Contextly.widget.BaseContainers,

    getTypeClass: function() {
      return 'ctx-social-container';
    }

  });

})(jQuery);