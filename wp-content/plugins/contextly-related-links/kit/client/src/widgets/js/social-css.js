/**
 * @class
 * @extends Contextly.widget.CssCustomBuilder
 */
Contextly.widget.SocialCssCustomBuilder = Contextly.createClass({

  extend: Contextly.widget.CssCustomBuilder,

  statics: /** @lends Contextly.widget.SiderailCssCustomBuilder */ {

    buildCSS: function(entry, settings) {
      var result = '';
      var css = settings.css || {};

      if (css.custom_code) {
        result += css.custom_code;
      }

      var selector = '.ctx-title p';
      if (css.title_font_family) {
        result += this.buildCSSRule(entry, selector, 'font-family', css.title_font_family);
      }
      if (css.title_font_size) {
        result += this.buildCSSRule(entry, selector, 'font-size', css.title_font_size);
      }
      if (css.title_color) {
        result += this.buildCSSRule(entry, selector, 'color', css.title_color);
      }

      selector = '';
      if (css.border_color) {
        result += this.buildCSSRule(entry, selector, 'border-color', css.border_color);
      }
      if (css.background_color) {
        result += this.buildCSSRule(entry, selector, 'background-color', css.background_color);
      }

      selector = '.ctx-slick-arrow:before';
      if (css.arrow_foreground_color) {
        result += this.buildCSSRule(entry, selector, 'color', css.arrow_foreground_color);
      }
      if (css.arrow_background_color) {
        result += this.buildCSSRule(entry, selector, 'background-color', css.arrow_background_color);
      }

      selector = '.ctx-tweet.ctx-icon-hourglass:before';
      if (css.arrow_foreground_color) {
        result += this.buildCSSRule(entry, selector, 'color', css.arrow_foreground_color);
      }

      return result;
    }

  }

});
