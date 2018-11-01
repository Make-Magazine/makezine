// gift guide entry point
const Vue = require('vue');
const App = require('./App.vue');
const VueLazyLoad = require('vue-lazyload');

Vue.use(VueLazyLoad);



window.addEventListener('load', function () {
   vm = new Vue({
      el: '#gift-guide-temp',
      data: {},
      //render: render => render(App) // this is the ES6 way, but don't use it until we have proper babel set up
      render: function(createElement) { // do it in the old style for now
         return createElement(App);
      }
   });
   // Google Tag Manager - Virtual Pageview Tracking
   vm.$Lazyload.$on('loaded', function (img) {
      // The requirement is to register a pageview everytime an image is loaded
      // ergo it makes sense to put it in this callback from the lazyload library
      // We've added a couple of data-attr to the image els which we use to pass
      // meaningful data back to GTM
      var data = img.el.dataset,
         virtualUrl,
         virtualTitle;
      // first we check that this particular image has something meaningful (i.e. something we've added)
      if(data.itemUrl) {
         // then we construct some values to pass along with the GTM event
         virtualUrl = window.location.href + '#' + data.itemUrl;
         virtualTitle = data.itemTitle;
         //console.log(virtualTitle, virtualUrl);
         // TBD (ts): move this custom GTM implementation into global.js?
         if(window.dataLayer) {
            window.dataLayer.push({
               'event': 'VirtualPageview',
               'virtualPageURL': virtualUrl,
               'virtualPageTitle' : virtualTitle
            });
         }
      }
    });
});
