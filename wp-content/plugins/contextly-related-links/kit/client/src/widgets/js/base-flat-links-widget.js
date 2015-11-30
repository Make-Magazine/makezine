(function($) {

  /**
   * Base class for widgets with flat links list, without sections.
   *
   * @class
   * @extends Contextly.widget.BaseLinksList
   */
  Contextly.widget.BaseFlatLinksList = Contextly.createClass(/** @lends Contextly.widget.BaseFlatLinksList.prototype */{

    extend: Contextly.widget.BaseLinksList,

    getLinksHTML: function() {
      var html = "";
      if (this.hasWidgetData()) {
        var links = this.widget.links;
        for (var i = 0; i < links.length; i++) {
          var link = links[i];
          if (link && link.id && link.title) {
            html += this.getLinkHTML(link);
          }
        }
      }

      return html;
    },

    hasWidgetData: function () {
      return this.widget.links && this.widget.links.length;
    }

  });

})(jQuery);