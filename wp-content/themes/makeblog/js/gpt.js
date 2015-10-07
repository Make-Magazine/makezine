/**
 * @file gpt.js
 * All javascript for ad creating.
 */

(function (make, window, document, undefined) {

  // Set global
  make = make || {};

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
          if (window.make_gpt) {
            if (make_gpt.sec) {
              googletag.pubads().setTargeting("sec", make_gpt.sec);
            }
            if (make_gpt.page) {
              googletag.pubads().setTargeting("page", make_gpt.page);
            }
            if (make_gpt.cat) {
              googletag.pubads().setTargeting("cat", make_gpt.cat);
            }
          }

          // Test
          // if (window.location.hostname !== "makezine.com") {
          //   googletag.pubads().setTargeting('t','dev');
          // }

        });

      }

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
            'zone': window.make_gpt ? make_gpt.zone : "/11548178/Makezine/",
            'sizeMap': null,
            'viewport' : null,
            'sec': window.make_gpt ? make_gpt.sec : null,
            'page': window.make_gpt ? make_gpt.page : null,
            'cat': window.make_gpt ? make_gpt.cat : null,
            'companion': false
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
          if (ad.sec) {
            window[ad.slot].setTargeting("sec", ad.sec);
          }
          if (ad.page) {
            window[ad.slot].setTargeting("page", ad.page);
          }
          if (ad.cat) {
            window[ad.slot].setTargeting("cat", ad.cat);
          }

          // Set pos & tile
          window[ad.slot].setTargeting("pos", [ad.pos]);
          window[ad.slot].setTargeting("adPos", [ad.adPos]);
          window[ad.slot].setTargeting("tile", [ad.tile]);
          document.getElementById(ad.slot).setAttribute("data-pos",ad.pos);
          document.getElementById(ad.slot).setAttribute("data-tile",ad.tile);
          document.getElementById(ad.slot).setAttribute("data-tags",JSON.stringify(ad));

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
        this["pos" + sizeStr] = this["pos" + sizeStr] || 1;
        a.pos = this["pos" + sizeStr]++;
        this.tile = this.tile || 1;
        a.tile = this.tile++;
        a.slot = 'ad_' + sizeStr + '_' + a.pos;
      }
      return a;
    }

  };

  make.gpt.init();

})(this.make, this, this.document);
