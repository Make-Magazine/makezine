// Initialize the infinite scroll library
var $container = jQuery( '.wrapper').infiniteScroll({
  // get the first post
  path: '/wp-json/wp/v2/posts?per_page=1&page={{#}}',
  // set response type for json
  responseType: 'text',
  // responses on infinite scroll trigger
  status: '.scroll-status',
  // use history.pushState()
  history: 'push',
  scrollThresold: 500,
  debug: true,
});

$container.on( 'load.infiniteScroll', function( event, response ) {
  // parse response into JSON data
  var data = JSON.parse( response );
  // compile data into HTML
  var itemsHTML = data.map( getItemHTML ).join('');
  // convert HTML string into elements
  var $items = jQuery( itemsHTML );
  // append item elements
  $container.infiniteScroll( 'appendItems', $items );
  // load the infinite scroll ad
  make.gpt.loadDyn();
});

// load initial page
// Do this after removing the php version of the first page load
// $container.infiniteScroll('loadNextPage');

// Get the Infinite Scroll instance from a jQuery object
// var infScroll = $container.data('infiniteScroll');

//------------------//

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
