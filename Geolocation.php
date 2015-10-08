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

$driverStart = "";
$driver_query = mysql_query("SELECT address FROM user WHERE user.isDriver = 1 AND user.userID = '$d_id' limit 1");
while($row = mysql_fetch_array($driver_query)){
  $driverStart = $row['address'];
}


$passengerINFO_query = mysql_query("SELECT startLocation, firstName, lastName, phone FROM user, request	WHERE user.userID = request.passengerID");

$passengerList_query = mysql_query("SELECT startLocation, firstName, lastName, phone FROM user, request	WHERE user.userID = request.passengerID");
$passengers_addr = array();
$username = array();
$phone = array();

while($row = mysql_fetch_array($passengerList_query)){
  $address = $row['startLocation'];
  $fullname = "{$row['firstName']}{$row['lastName']}";
  $phoneno = $row['phone'];
  array_push($username, $fullname);
  array_push($phone, $phoneno);
  array_push($passengers_addr, $address);
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/jquery.mobile-1.4.2.css">
    <link rel="stylesheet" href="css/jquery.mobile-core.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/jquery.mobile-1.4.2.js"></script>

    <!-- For star ratings -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="js/star-rating.js" type="text/javascript"></script>
    <!-- End Star Ratings -->
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
var nametag = <?php echo json_encode($username);?>;
var mobile = <?php echo json_encode($phone);?>;
var passpts = <?php echo json_encode($passengers_addr);?>;
var startLoc = <?php echo json_encode($driverStart);?>;

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
    map: map,
    suppressMarkers: false
  }
  directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);

//  var wayptsContent;


  wayptsDisplay = new google.maps.InfoWindow();

  calculateAndDisplayRoute(directionsService, directionsDisplay);
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {

  var mallCenter = new google.maps.LatLng(-27.4998373,152.9724514);
  var uq = new google.maps.LatLng(-27.4954306,153.0120301);
  //var passby = new google.maps.LatLng(-27.501264,152.979343);

  //Remove any Existing markers from the map
  for(var i=0; i<waypts.length; i++){
    waypts[i].setMap(null);
  }

  //Add waypoints
  for(var i=0; i<passpts.length; i++){
    waypts.push({
    location: passpts[i],
    stopover: true
  });
  }


  directionsService.route({
    origin: startLoc, // need changes to current location
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

//      var getRoute = response.routes[0];
//
//      for (var i=0; i<getRoute.legs.length; i++){
//
//      }

//      var marker = new google.maps.Marker({
//      position: {lat: -27.501264, lng: 152.979343},
//      map: map,
//      draggable:false,
//      title:"marker",
//      animation: google.maps.Animation.DROP
//});
//      marker.addListener('click', function(){
//          if(wayptsDisplay.open()){
//              wayptsDisplay.close();
//          }
//          wayptsDisplay.open(map, marker);
//      });

      //var route = response.routes[0];
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


//function addressToLocation(address){
//  var geocoder = new google.maps.Geocoder();
//  geocoder.geocode(){
//    address: address
//  },
//  function(results, status){
//    var resultLocations = [];
//  }
//}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDubSC2d1uLs5lb-Lio6u0IQq4tzvHNpTQ&signed_in=true&callback=initMap" async defer>
</script>
  </head>

<body>
    <div data-role="page" data-theme="a">
    <!--start top bar-->
    <div data-role="header" id="header_brown">
        <?php require("banner.php"); ?>
    </div>
    <!--end top bar-->

    <!--nav bar-->
    <?php require("menu.php"); ?>
    <!--end nav bar-->

<!--<section class = "info">-->
    <section class="info">
        <div class="info-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <!-- Start Title -->
                        <div id="mainTitle">

                            <h3 class="text-center">
                                Results
                            </h3>
                        </div>
                        <!-- End Title -->

                        <!-- Start Rides info -->

                        <!--Google Map-->
                        <div id="map" style="width:100%;height:380px;"></div>
                        <!--Google Map-->

                        <div class="ui-content">
                            <ul data-role="listview" data-inset="true">
                                <?php
                                while($row = mysql_fetch_array($passengerINFO_query))
                                { ?>
                                <li data-icon="false" class="current">
                                    <h3><?php echo "{$row['firstName']}"?>
                                        <?php echo "{$row['lastName']}"?>
                                    </h3>
                                    <br/>
                                    <p><b>Location:</b> <?php echo "{$row['startLocation']}"?></p>
                                    <p><b>Departure Time:</b> <?php echo "{$row['departureTime']}"?></p>
                                    <p><b>Destination:</b> <?php echo "UQ"?></p>
                                    <p><b>Contact:</b> <?php echo "{$row['phone']}"?></p>
<!--
                                    <p class='ui-li-aside' style="right: 2em;">
                                        <a href="#popupDialog" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-transition="pop" class="btn-default btn-sm">
                                            <span class="glyphicon glyphicon-trash"></span> Cancel
                                        </a>
                                    </p>
-->
                                    <p class='ui-li-aside' style="right: 10em;">
                                        <a href="#popupDialog" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-transition="pop" class="btn-default btn-sm">
                                            <span></span> Select
                                        </a>
                                    </p>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>

    </section>
</div>

</body>
</html>
