// Initialize the infinite scroll library
const infScrollContainer = jQuery('.wrapper').infiniteScroll({
  // get the first post
  path: '/wp-json/wp/v2/posts?per_page=1&page={{#}}',

  // determine next page based on initial page
  // path: function() {
  //   var mostRecentPost = ;
  //   var curentPost = ;
  //   if (mostRecentPost === curentPost) {
  //     path: '/wp-json/wp/v2/posts?per_page=1&page={{#}}',
  //   } else {
  //     path: '/wp-json/wp/v2/posts?per_page=1&page={{#}}',
  //   }
  // },

  // set response type for json
  responseType: 'text',
  // responses on infinite scroll trigger
  status: '.scroll-status',
  // use history.pushState() or history.replaceState()
  history: 'replace',
  scrollThresold: 600,
  debug: true,
});

// Get the Infinite Scroll instance from a jQuery object
const infScrollData = infScrollContainer.data('infiniteScroll');

// on load event
infScrollContainer.on( 'load.infiniteScroll', function( event, response, path ) {
  // parse response into JSON data
  var data = JSON.parse( response );
  // compile data into HTML
  var itemsHTML = data.map( getItemHTML ).join('');
  // convert HTML string into elements
  var $items = jQuery( itemsHTML );
  // append item elements
  infScrollContainer.infiniteScroll( 'appendItems', $items );
  // load the infinite scroll ad
  make.gpt.loadDyn();

  // testing stuff
  console.log( 'Loaded: ' + path,
    'Current page: ' + infScrollData.pageIndex,
    infScrollData.loadCount + ' pages loaded'
  );
});

// when the item has been added to the container
infScrollContainer.on( 'append.infiniteScroll', function( event, response, path, items ) {
  console.log( 'Loaded: ' + path );
});

// on history event
infScrollContainer.on( 'history.infiniteScroll', function() {
  ga( 'set', 'page', location.pathname );
  ga( 'send', 'pageview' );
});

// when the last item has been added
infScrollContainer.on( 'last.infiniteScroll', function( event, response, path ) {
  
});

// load initial page
// Do this after removing the php version of the first page load
// infScrollContainer.infiniteScroll('loadNextPage');


var itemTemplateSrc = jQuery('#story-item-template').html();

function getItemHTML( story ) {
  return microTemplate( itemTemplateSrc, story );
}

// micro templating
function microTemplate( src, data ) {
  // replace {{tags}} in source
  return src.replace( /\{\{([\w\-_\.]+)\}\}/gi, function( match, key ) {
    // walk through objects to get value
    var value = data;
    key.split('.').forEach( function( part ) {
      value = value[ part ];
    });
    return value;
  });
}
