//function initMap() {
//  var directionsService = new google.maps.DirectionsService;
//  var directionsDisplay = new google.maps.DirectionsRenderer;
//  var map = new google.maps.Map(document.getElementById('map'), {
//    center: {lat: -27.407, lng: 153.002}, //-27.4073899,153.0028595
//    zoom: 6
//  });
//  directionsDisplay.setMap(map);
//
//  calculateAndDisplayRoute(directionsService, directionsDisplay)
//}
//
//function calculateAndDisplayRoute(directionsService, directionsDisplay) {
//  var mallCenter = new google.maps.LatLng(-27.4998373,152.9724514);
//  var uq = new google.maps.LatLng(-27.4954306,153.0120301);
//
//  directionsService.route({
//    origin: mallCenter,
//    destination: uq,
//    travelMode: google.maps.TravelMode.DRIVING
//  }, function(response, status) {
//    if (status === google.maps.DirectionsStatus.OK) {
//      directionsDisplay.setDirections(response);
//    } else {
//      window.alert('Directions request failed due to ' + status);
//    }
//  });
//}

var map;
var waypts = [];
var directionsDisplay;
var directionsService;

function initMap() {
  //Instantiate a directions service
  var directionsService = new google.maps.DirectionsService;

  //Create a map
  var initcentre = new google.maps.LatLng(-27.4073899,153.0028595); //-27.4073899,153.0028595
  var mapOptions = {
    center: initcentre,
    zoom: 6
  }

  map = new google.maps.Map(document.getElementById('map'), mapOptions);

  var rendererOptions = {
    map: map
  }
  directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions)

  wayptsDisplay = new google.maps.InfoWindow();

  calculateAndDisplayRoute(directionsService, directionsDisplay);
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {

  var mallCenter = new google.maps.LatLng(-27.4998373,152.9724514);
  var uq = new google.maps.LatLng(-27.4954306,153.0120301);
  var passby = new google.maps.LatLng(-27.501264,152.979343);

  waypts.push({
    location: passby,
    stopover: true
  });

  directionsService.route({
    origin: mallCenter,
    destination: uq,
    waypoints: waypts,
    optimizeWaypoints: true,
    travelMode: google.maps.TravelMode.DRIVING,
    unitSystem: google.maps.UnitSystem.METRIC,
    avoidHighways: false,
    avoidTolls: true
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
      var route = response.routes[0];
//      var summaryPanel = document.getElementById('directions-panel');
//      summaryPanel.innerHTML = '';
//      // For each route, display summary information.
//      for (var i = 0; i < route.legs.length; i++) {
//        var routeSegment = i + 1;
//        summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
//            '</b><br>';
//        summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
//        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
//        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
//      }
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
}





//var map;
//var directionsDisplay;
//var directionsService;
//var stepDisplay;
//var markerArray = [];
////preset location
//var currentLoc;
//var mallCenter;
//var uq;
//
//function initMap() {
//  //Instantiate a directions service
//  directionsService = new google.maps.DirectionsService();
//  //initiate Map
//  map = new google.maps.Map(document.getElementById('map'), {
//    center: {lat: -27.407, lng: 153.002}, //-27.4073899,153.0028595
//    zoom: 6
//  });
//
//  //Create a renderer for directions and bind it to the map
//  var rendererOptions = {
//    map: map
//  }
//  directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
//
//  stepDisplay = new google.maps.InfoWindow();
//
//  //initantiate infoWindows
//  var infoWindow = new google.maps.InfoWindow({map: map});
//
//  // Try HTML5 geolocation.
//  if (navigator.geolocation) {
//    navigator.geolocation.getCurrentPosition(function(position) {
//      var pos = {
//        lat: position.coords.latitude,
//        lng: position.coords.longitude
//      };
//      currentLoc = pos;
//      infoWindow.setPosition(currentLoc);
//      infoWindow.setContent('Current Location');
//      map.setCenter(currentLoc);
//      map.setZoom(15);
//    }, function() {
//      handleLocationError(true, infoWindow, map.getCenter());
//    });
//  } else {
//    // Browser doesn't support Geolocation
//    handleLocationError(false, infoWindow, map.getCenter());
//  }
//
//}
//
////Geolocation error checking
//function handleLocationError(browserHasGeolocation, infoWindow, pos) {
//  infoWindow.setPosition(currentLoc);
//  infoWindow.setContent(browserHasGeolocation ?
//                        'Error: The Geolocation service failed.' :
//                        'Error: Your browser doesn\'t support geolocation.');
//}
//
//function calcRoute() {
//  //Clear out any existing markerArray
//  //From previous calculations
//  for (i = 0; i < markerArray.length; i++){
//      markerArray[i].setMap(null);
//  }
//
//  //Retrieve the start and end locations and create
//  // a DirectionsRequest using DRIVING directions.
//  mallCenter = new google.maps.LatLng(-27.4998373,152.9724514);
//  uq = new google.maps.LatLng(-27.4954306,153.0120301);
//
//  var request = {
//    origin: mallCenter,
//    destination: uq,
//    travelMode: google.maps.TravelMode.DRIVING,
//    uniSystem: google.maps.UnitSystem.METRIC,
//    avoidHighways: false,
//    avoidTolls: true
//  };
//
//  //Route the directions and pass the response to a
//  // function to create markers for each step
//  directionsService.route(request, function(response, status){
//    if(status == google.maps.DirectionsStatus.OK) {
//      var warnings = document.getElementById("warnings_panel");
//      warnings.innerHTML = "" + response.routes[0].warnings + "";
//      directionsDisplay.setDirections(response);
//      showSteps(response);
//    }
//  });
//
//}
//
//function showSteps(directionResult) {
//  //For each step, place a marker, and add the text to the marker's
//  //info window. Also attach the marker to an array so we can
//  //track of it and remove it when calculating new routes.
//  var myRoute = directionResult.routes[0].legs[0];
//
//  for (var i = 0; i < myRoute.steps.length; i++) {
//    var marker = new google.maps.Marker({
//      position: myRoute.steps[i].start_point,
//      map: map
//    });
//    attachInstructionText(marker, myRoute.steps[i].instructions);
//    markerArray[i] = marker;
//  }
//}
//
//function attachInstructionText(marker, text) {
//  google.maps.event.addListener(marker, 'click', function(){
//    stepDisplay.setContent(text);
//    stepDisplay.open(open, marker);
//  });
//}
