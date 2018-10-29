// gift guide entry point
const Vue = require('vue');
const App = require('./App.vue');
const VueLazyLoad = require('vue-lazyload');

Vue.use(VueLazyLoad);

window.addEventListener('load', function () {
   new Vue({
      el: '#gift-guide-temp',
      data: {},
      //render: render => render(App) // this is the ES6 way, but don't use it until we have proper babel set up
      render: function(createElement) { // do it in the old style for now
         return createElement(App);
      }
   });
});
