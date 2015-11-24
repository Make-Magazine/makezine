(function() {

  /**
   * @class
   * @extends Contextly.widget.Sidebar
   */
  Contextly.widget.AutoSidebar = Contextly.createClass(/** @lends Contextly.widget.AutoSidebar.prototype */ {

    extend: Contextly.widget.Sidebar,

    construct: function(widget) {
      // Jump over the sidebar constructor to avoid unnecessary work.
      Contextly.widget.BaseLinksList.apply(this, arguments);

      this.widget_type = Contextly.widget.types.AUTO_SIDEBAR;

      if (!this.widget.id) {
        // Fill properties we need with defaults.
        this.widget.name = this.widget.settings.default_name;
        this.widget.description = this.widget.settings.default_description;
        this.widget.layout = this.widget.settings.default_layout;
      }
    },

    getCustomCssCode: function() {
      return Contextly.widget.SidebarCssCustomBuilder
        .buildCSS('.' + this.containers.getTypeClass(), this.getSettings());
    }

  });

})(jQuery);
