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



foreach($_POST as $name => $content){
    $passID = $name;
}

$passenger_query = mysql_query("SELECT * FROM request, user WHERE (departureTime - INTERVAL 1 HOUR < '$d_time') AND (departureTime > '$d_time') AND user.userID = request.passengerID AND user.userID = $passID AND status = 'pending' ORDER BY departureTime");

//get Driver location
$driverStart = "";
$driver_query = mysql_query("SELECT address FROM user WHERE user.isDriver = 1 AND user.userID = '$d_id' limit 1");
while($row = mysql_fetch_array($driver_query)){
  $driverStart = $row['address'];
}

//
//$passengerINFO_query = mysql_query("SELECT userID, startLocation, firstName, lastName, phone FROM user, request	WHERE user.userID = request.passengerID limit 4");

$passengerList_query = mysql_query("SELECT userID, startLocation, firstName, lastName, phone FROM user, request	WHERE user.userID = request.passengerID AND user.userID = '$passID'");
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
        width: 100%;
        height: 380px;
      }
    </style>


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
                                Results<?php //echo $passID;?>
                            </h3>
                            <div id="distanceAmount"></div>
                            <div id="dvDistance"></div>
                        </div>
                        <!-- End Title -->

                        <!-- Start Rides info -->

                        <!--Google Map-->
                        <div id="map"></div>
                        <!--Google Map-->

                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

<script type="text/javascript">
var nametag = <?php echo json_encode($username);?>;
var mobile = <?php echo json_encode($phone);?>;
var passpts = <?php echo json_encode($passengers_addr);?>; // passengers location, waypoints
var startLoc = <?php echo json_encode($driverStart);?>; // driver start location

var map;
var waypts = [];

var directionsDisplay;
var directionsService;

var uq = "-27.4954306,153.0120301";

function initMap() {

  //Instantiate a directions service
  var directionsService = new google.maps.DirectionsService;

  //Create a map
  var initcentre = new google.maps.LatLng(-27.4073899,153.0028595); //-27.4073899,153.0028595
  var mapOptions = {
    center: initcentre,
    zoom: 6
  }

  map = new google.maps.Map(document.getElementById("map"), mapOptions);

  //Render direction Display
  var rendererOptions = {
    map: map,
    suppressMarkers: false
  }
  directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);

  wayptsDisplay = new google.maps.InfoWindow();


  calculateAndDisplayRoute(directionsService, directionsDisplay);
}



function calculateDistance(startLocation, endLocation){
    var dis;
    var distanceService = new google.maps.DistanceMatrixService;
    distanceService.getDistanceMatrix({
      origins: [startLocation],
      destinations: [endLocation],
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: true
  }, function(response, status){
      if (status === google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS"){
          var distance = response.rows[0].elements[0].distance.value;
          dis = distance;
          var duration = response.rows[0].elements[0].duration.value;
          //var dvDistance = document.getElementById("dvDistance");
//          var test = document.getElementById("distanceAmount");
//          test.innerHTML = dis;
//          dvDistance.innerHTML = "";
//          dvDistance.innerHTML += "Distance: " + dis;
//          dvDistance.innerHTML += "Duration: " + duration;
//          if(dis > 5000){
//            dvDistance.innerHTML += " greater than 5km";
//          }

      }else {
          alert("Unable to find the distance");
      }
  });
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {

  //var mallCenter = new google.maps.LatLng(-27.4998373,152.9724514);
  //var uq = new google.maps.LatLng(-27.4954306,153.0120301);
  //var uq = new google.maps.LatLng(-27.4954306,153.0120301);
  //var passby = new google.maps.LatLng(-27.501264,152.979343);

  //Remove any Existing markers from the map
  for(var i=0; i<waypts.length; i++){
    waypts[i].setMap(null);
  }

  calculateDistance(startLoc, passpts[3]);

  //var tempStart = startLoc;

  //Add waypoints into waypts array
  for(var i=0; i<passpts.length; i++){//passpts = waypoints addresses
//      calculateDistance(tempStart, passpts[i]);
      waypts.push({
        location: passpts[i],
        stopover: true
      });
      //tempStart = passpts[i];
    }


  directionsService.route({
    origin: startLoc, //driver current location / registered address
    destination: uq, //preset to UQ
    waypoints: waypts,
    optimizeWaypoints: true,
    travelMode: google.maps.TravelMode.DRIVING,
    unitSystem: google.maps.UnitSystem.METRIC,
    avoidHighways: false,
    avoidTolls: true
  }, function(response, status) {
    if (status === google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);

    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });
}


</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDubSC2d1uLs5lb-Lio6u0IQq4tzvHNpTQ&signed_in=true&callback=initMap" async defer>
</script>
</html>
