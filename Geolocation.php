<?php
session_start();

//connection to Database
include 'connection.php';

//illegal session
include 'illegalacc.php';

//record driver's driving plan
$d_id = $_SESSION['userID'];
$d_start = $_POST['startlocation'];
$d_destination = $_POST['destination'];
$d_time = $_POST['leavingTime'];
$d_status = "pending";

//echo $d_id;
//echo $d_start;
//echo $d_destination;
//echo $d_time;
//echo $d_status;

$passenger_query = mysql_query("SELECT * FROM request, user WHERE (departureTime - INTERVAL 1 HOUR < '$d_time') AND (departureTime > '$d_time') AND user.userID = request.passengerID AND status = 'pending' ORDER BY departureTime");

$passengerList_query = mysql_query("SELECT startLocation, firstName, lastName, phone FROM user, request	WHERE user.userID = request.passengerID");
$passengers_addr = array();
$username = array();

while($row = mysql_fetch_array($passengerList_query)){
  $address = $row['startLocation'];
  $fullname = $row['firstName'];
  array_push($username, $fullname);
  array_push($passengers_addr, $address);
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
<!--    <script src="googlemap.js"></script>-->
<!--
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
-->
   <script>
var sth = "<?php echo $username[0]; ?>";
document.write(sth);
var map;
var passpts = <?php echo json_encode($passengers_addr);?>;
//document.write(passpts[0]);
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
  //var passby = new google.maps.LatLng(-27.501264,152.979343);

  for(var i=0; i<passpts.length; i++){
    waypts.push({
    location: passpts[i],
    stopover: true
  });
  }


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

   </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDubSC2d1uLs5lb-Lio6u0IQq4tzvHNpTQ&signed_in=true&callback=initMap"
        async defer>
    </script>
  </head>
  <body>
    <div id="map"></div>
    <div id="warnings_panel"></div>
<!--
      <script src="googlemap.js"></script>
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDubSC2d1uLs5lb-Lio6u0IQq4tzvHNpTQ&signed_in=true&callback=initMap"
        async defer>
    </script><script src="googlemap.js"></script>
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDubSC2d1uLs5lb-Lio6u0IQq4tzvHNpTQ&signed_in=true&callback=initMap"
        async defer>
    </script>
-->
  </body>
</html>
