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

$passenger_query = mysql_query("SELECT * FROM request, user WHERE (departureTime - INTERVAL 1 HOUR < '$d_time') AND (departureTime > '$d_time') AND user.userID = request.passengerID AND status = 'pending' ORDER BY departureTime");

//get Driver location
$driverStart = "";
$driver_query = mysql_query("SELECT address FROM user WHERE user.isDriver = 1 AND user.userID = '$d_id' limit 1");
while($row = mysql_fetch_array($driver_query)){
  $driverStart = $row['address'];
}


$passengerINFO_query = mysql_query("SELECT startLocation, firstName, lastName, phone FROM user, request	WHERE user.userID = request.passengerID limit 4");

$passengerList_query = mysql_query("SELECT startLocation, firstName, lastName, phone FROM user, request	WHERE user.userID = request.passengerID limit 4");
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

function initMap(){

}


function calculateDistance(startLocation, endLocation){
    //var dis;
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
          var origin = response.originAddresses;
          var destination = response.destinationAddresses;
          var distance = response.rows[0].elements[0].distance.value;
          var distanceText = response.rows[0].elements[0].distance.text;
          dis = distance;
          var duration = response.rows[0].elements[0].duration.value;
          var dvDistance = document.getElementById("dvDistance");
//          var dvTest = document.getElementById("dvTest");
//          var dvShow = document.getElementById("gdata");

//          dvShow.innerHTML += origin + ": " + distanceText;
//          test.innerHTML = dis;
//          dvDistance.innerHTML = "";
          dvDistance.innerHTML += "Distance: " + dis + "; ";
//          dvDistance.innerHTML += "Duration: " + duration;
//          if(dis > 5000){
//            dvDistance.innerHTML = dis + " d greater than 5km";
//          }
//          if (dis < 8000){
//            //dvDistance.innerHTML += dis + "d less than 5km";
//            dvTest.innerHTML += "<ul data-role='listview' data-inset='true'><li data-icon='false' class='current'><p><b><a>" + destination + dis + "</a></b></p></li></ul>";
//        }

      }else {
          alert("Unable to find the distance");
      }
  });
}

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

                            <div id="dvDistance"></div>
                        </div>
                        <!-- End Title -->

                        <!-- Start Rides info -->

                        <!--Google Map-->
<!--                        <div id="map"></div>-->
                        <!--Google Map-->
                    <form class="form-horizontal" role="form" id="forPassenger" method='POST' action='Geolocation2.php' data-ajax="false">
                        <div class="ui-content">
                            <ul data-role="listview" data-inset="true">
<?php
function getDistance($start, $end){
    $start = str_replace(' ', '+', $start);
    $end = str_replace(' ', '+', $end);
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$start."&destinations=".$end."&mode=driving&language=en-EN&key=key=AIzaSyDubSC2d1uLs5lb-Lio6u0IQq4tzvHNpTQ&sensor=false";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    $dist = $response_a['rows'][0]['elements'][0]['distance']['value'];
    return $dist;
}


while($row = mysql_fetch_array($passengerINFO_query)){
    $pstart = $row['startLocation'];
    $pdest = "The University of Queensland";
//    $a = getDistance($driverStart, $pstart);
//    $b = getDistance($pstart, $pdest);
    $fPstart = urlencode($pstart);
    $fdriverStart = urlencode($driverStart);
    $data = file_get_contents( "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$fdriverStart&destinations=$fPstart&mode=driving&language=en-EN&key=key=AIzaSyDubSC2d1uLs5lb-Lio6u0IQq4tzvHNpTQ&sensor=false");
    $data = json_encode($data);
    $distance = 0;
    foreach($data->rows[0]->elements as $road){
        $distance += $road->distance->value;
    }

?>
                                <li data-icon="false" class="current">
                                    <h3><?php echo "{$row['firstName']}"?><?php echo "{$row['lastName']}"?>
                                    <?php echo $distance;?>
<!--
<?php echo "<script type='text/javascript'>calculateDistance('$driverStart', '$pstart');</script>"; ?>
<?php echo "<script type='text/javascript'>calculateDistance('$pstart', '$pdest');</script>"; ?>
-->


                                    </h3>
                                    <br/>
                                    <p><b>Location:</b> <?php echo "{$row['startLocation']}"?></p>
                                    <p><b>Departure Time:</b> <?php echo "{$row['departureTime']}"?></p>
                                    <p><b>Destination:</b> <?php echo "The University of Queensland"?></p>
                                    <p><b>Contact:</b> <?php echo "{$row['phone']}"?></p>
<!--
                                    <p class='ui-li-aside' style="right: 2em;">
                                        <a href="#popupDialog" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-transition="pop" class="btn-default btn-sm">
                                            <span class="glyphicon glyphicon-trash"></span> Cancel
                                        </a>
                                    </p>
-->
<!--
                                    <p class='ui-li-aside' style="right: 10em;">
                                        <a href="#popupDialog" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-transition="pop" class="btn-default btn-sm">
                                            <span></span> Select
                                        </a>
                                    </p>
-->
                               <div class="ui-block-a"><button type="submit" data-theme="b" name="passSelect">Select</button></div>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>


</div>
</form>
</section>
</body>
</html>
