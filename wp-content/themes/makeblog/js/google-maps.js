
// Load our map and center it on San Francisco
function initialize() {

   var latlng = new google.maps.LatLng(39.8282, -98.5795);
   var mapOptions = {
      zoom: 4,
      center: latlng,
      panControl: true,
      scaleControl: true,
      streetViewControl: false,
      zoomControl: true,
      zoomControlOptions: {
         style: google.maps.ZoomControlStyle.SMALL
      },
      mapTypeId: google.maps.MapTypeId.ROADMAP
   };
   var map = new google.maps.Map( document.getElementById( 'map-canvas' ), mapOptions );

   // Loop through each object
   jQuery.each( JSON.parse( makercamp.addresses ), function( key, value ) {

      // Set up are markers
      var contentString = '<div id="content">'+
         '<div id="siteNotice"></div>'+
            '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
            '<div id="bodyContent">'+
               '<p></p>'+
               '<p>Attribution: Uluru, <a href="http://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">http://en.wikipedia.org/w/index.php?title=Uluru</a> (last visited June 22, 2009).</p>'+
            '</div>'+
         '</div>';
      var infowindow = new google.maps.InfoWindow({
         content: contentString
      });
      var myLatLng = new google.maps.LatLng( value.Lat,value.Lng );
      var marker = new google.maps.Marker({
         position: myLatLng,
         map: map
      });

      google.maps.event.addListener( marker, 'click', function() {
         infowindow.open( map,marker );
      });

   });

}

// Load our initialize function on window load
google.maps.event.addDomListener( window, 'load', initialize );