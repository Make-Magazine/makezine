var make = make || {},
    _ = _,
    $ = jQuery || $;

console.log(this);

make.iScroller = (function(make, _, $, window) {
  var def = function($cont, $template) {
    this.$cont = $cont;
    this.$template = $template;
    
    this.loadFuncResponse = {};
    
    this.options = {
      // get the first post
      path: '/wp-json/wp/v2/posts?per_page=1&page={{#}}',

      // set response type for json
      responseType: 'text',
      // responses on infinite scroll trigger
      status: '.scroll-status',
      // use history.pushState() or history.replaceState()
      history: 'push',
      scrollThresold: 600,
      debug: true
    };

    init.call(this);
  };

  var setup = function() {
    this.$cont.infiniteScroll(this.options);
    this.instanceData = this.$cont.data('infiniteScroll');
    
    this.templateMarkup = this.$template.html();
  };

  var init = function() {
    setup.call(this);
    this.bind();
  };

  def.prototype = {
    bind: function() {
      this.$cont.on('load.infiniteScroll', _.bind(this.loadFunc, this));
      this.$cont.on('append.infiniteScroll', _.bind(this.appendFunc, this));
      this.$cont.on('history.infiniteScroll', _.bind(this.historyFunc, this));
      this.$cont.on('last.infiniteScroll', _.bind(this.lastFunc, this));
    },

    loadFunc: function( event, response, path ) {
      this.loadFuncResponse = {
        //data: JSON.parse(response),
        storyTemplate: _.template( $('#story-item-template').html() ),
        compiled: storyTemplate( JSON.parse(response) ),
      };
      return compiled;
     
      this.$cont.infiniteScroll( 'appendItems', this.loadFuncResponse.$items );
      // load the infinite scroll ad
      make.gpt.loadDyn();

      // testing stuff
      console.log( 'Loaded: ' + path,
        'Current page: ' + infScrollData.pageIndex,
        infScrollData.loadCount + ' pages loaded'
      );
    },

    appendFunc: function( event, response, path, items ) {
      console.log( 'Loaded: ' + path );
    },

    historyFunc: function() {
      ga( 'set', 'page', window.location.pathname );
      ga( 'send', 'pageview' );
    },

    lastFunc: function( event, response, path ) {
      // do stuff after last item is loaded
    }
  };
  
  return def;
}).call(this, make, _, $, window);

make._instances = {}; // i want a place to store instances of modules
make._instances.iScroll = new make.iScroller($('.js-infinite-scroll-container'), $('#story-item-template')); // create a new instance of the module
