/**
 * @file gpt.js
 * All javascript for ad creating.
 *
 * @Author Ben Voran
 */

(function (make, window, document, $, undefined) {

  // Set global
  make = window.make = window.make || {};

  // Set object merge function
  /**
   * Function make.extend()
   *
   * @description
   * Merge defaults with user options
   * Could be shorter but supports IE < 9
   */
  make.extend = function (defaults, options) {
    var extended = {};
    var prop;
    for (prop in defaults) {
      if (Object.prototype.hasOwnProperty.call(defaults, prop)) {
        extended[prop] = defaults[prop];
      }
    }
    for (prop in options) {
      if (Object.prototype.hasOwnProperty.call(options, prop)) {
        extended[prop] = options[prop];
      }
    }
    return extended;
  };

  // namespace for advertisement related functions
  make.gpt = {

    /**
     * Function make.gpt.init()
     *
     * @description
     * loads dependencies & set global vars
     *
    **/
    init: function() {

      if (!window.googletag) {

        window.googletag = {cmd:[]};

        (function() { var gads = document.createElement('script'); gads.async = true; gads.type = 'text/javascript'; var useSSL = 'https:' == document.location.protocol; gads.src = (useSSL ? 'https:' : 'http:') + '//www.googletagservices.com/tag/js/gpt.js'; var node = document.getElementsByTagName('script')[0]; node.parentNode.insertBefore(gads, node); })();

        googletag.cmd.push(function() {

          googletag.pubads().collapseEmptyDivs();

          // page level targeting
          if (window.ad_vars) {
            if (ad_vars.page) {
              googletag.pubads().setTargeting("page", ad_vars.page);
            }
            if (ad_vars.cat) {
              googletag.pubads().setTargeting("cat", ad_vars.cat);
            }
            if (ad_vars.tags) {
              googletag.pubads().setTargeting("tags", ad_vars.tags);
            }
          }

          // Test
          if (window.location.hostname !== "makezine.com") {
            googletag.pubads().setTargeting('t', ['y']);
          }

        });

      }

      // Try loading any placeholder for ads.
      $(document).ready(function(){
        make.gpt.loadDyn();
      });

    },

    /**
     * Function make.gpt.loadDyn()
     *
     * @description
     *  renders ads from placeholders in the DOM. 
     *  example placeholder: <div class='js-ad' data-size='[[300,250]]' data-pos='"btf"'></div>
     */
    loadDyn: function($elem) {
      $elem = !$elem || !$elem.size() ? $('.js-ad') : $elem;
      // Loop through js ads.
      $elem.filter(':empty').each(function(){
        var $t = $(this),
            a = {};
        // Attempt to parse data attributes.
        a.size = [300,250]; // default.
        try {
          a.size =  $t.attr('data-size') ? JSON.parse($t.attr('data-size')) : null;
          a.sizeMap = $t.attr('data-size-map') ? JSON.parse($t.attr('data-size-map')) : null;
          a.pos = $t.attr('data-pos') ? JSON.parse($t.attr('data-pos')) : null;
        }
        catch (e) {}
        // Generate ad from placeholder vars.
        var ad = make.gpt.getVars(a.size),
            adDiv = '<div id="' + ad.slot + '" class="make_ad ' + a.size.join().replace(/\[\]/g,'').replace(/,/g,'x') + '"></div>';
        $t.append(adDiv);
        make.gpt.setAd({'size' : a.size, 'pos' : a.pos, 'adPos' : ad.adPos, 'slot' : ad.slot, 'tile' : ad.tile});
      });
    },

    /**
     * Function make.gpt.setAd()
     *
     * @description
     *  creates an ad to display
     */
    setAd: function(options) {

      var defaults = {
            'size': [300,250],
            'pos': 'btf', // @TODO: needs refactoring.
            'adPos': 1,
            'tile': 1,
            'slot': "ad_300x250_1",
            'zone': window.ad_vars ? ad_vars.zone : "/11548178/Makezine/",
            'sizeMap': null,
            'viewport' : null,
            'page': window.ad_vars ? ad_vars.page : null,
            'cat': window.ad_vars ? ad_vars.cat : null,
            'tags': window.ad_vars ? ad_vars.tags : null,
            'companion': false,
            'custom': window.ad_vars && ad_vars.custom_target_name ? [ad_vars.custom_target_name, ad_vars.custom_target_value] : null
          },
          ad = make.extend(defaults, options),
          winWidth = document.documentElement.clientWidth,
          display = ad.viewport == 'small' && winWidth > 800 || ad.viewport == 'large' && winWidth < 800 ? false : true;

      // Call the ad
      if (display) {
        googletag.cmd.push(function() {

          // Define ad
          window[ad.slot] = googletag.defineSlot(ad.zone, ad.size, ad.slot).addService(googletag.pubads());

          // Do companion
          if (ad.companion) {
            window[ad.slot].addService(googletag.companionAds());
          }

          // Set size map
          if (ad.sizeMap) {
            window[ad.slot].defineSizeMapping(ad.sizeMap);
          }

          // Set targeting
          if (ad.page) {
            window[ad.slot].setTargeting("page", ad.page);
          }
          if (ad.cat) {
            window[ad.slot].setTargeting("cat", ad.cat);
          }
          if (ad.tags) {
            window[ad.slot].setTargeting("tags", ad.tags);
          }
          if (ad.custom) {
            window[ad.slot].setTargeting(ad.custom[0], ad.custom[1]);
          }

          // Set pos & tile
          window[ad.slot].setTargeting("pos", [ad.pos]);
          window[ad.slot].setTargeting("adPos", [ad.adPos]);
          window[ad.slot].setTargeting("tile", [ad.tile]);
          document.getElementById(ad.slot).setAttribute("data-adPos", ad.adPos);
          document.getElementById(ad.slot).setAttribute("data-tile", ad.tile);
          document.getElementById(ad.slot).setAttribute("data-tags", JSON.stringify(ad));

          // Display Ad
          googletag.enableServices();
          googletag.display(ad.slot);

        });
      }

    },

    /**
     * Function make.gpt.getVars()
     *
     * @description
     *  creates an ad position specific to the size & title
     */
    getVars: function(adSize) {
      var sizeStr = adSize instanceof Array ? adSize.join("x").replace(/,/g,"x") : undefined ,
          a = sizeStr ? {} : sizeStr;
      if (sizeStr) {
        this["adPos" + sizeStr] = this["adPos" + sizeStr] || 1;
        a.adPos = this["adPos" + sizeStr]++;
        this.tile = this.tile || 1;
        a.tile = this.tile++;
        a.slot = 'ad_' + sizeStr + '_' + a.adPos;
      }
      return a;
    }

  };

  make.gpt.init();

})(this.make, this, this.document, jQuery);
