// gift guide entry point
const Vue = require('vue');
const App = require('./App.vue');

window.addEventListener('load', function () {
   new Vue({
      el: '#gift-guide-container',
      data: {
         'title': 'test from vue',
         'foo': 'bar'
      },
      render: render => render(App)
   });
});
