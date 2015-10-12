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

$passenger_query = mysql_query("SELECT * FROM request, user WHERE (departureTime - INTERVAL 1 HOUR < '$d_time') AND (departureTime > '$d_time') AND user.userID = request.passengerID AND status = 'pending' ORDER BY departureTime limit 5");

//get Driver location
$driverStart = "";
$driver_query = mysql_query("SELECT address FROM user WHERE user.isDriver = 1 AND user.userID = '$d_id' limit 1");
while($row = mysql_fetch_array($driver_query)){
  $driverStart = $row['address'];
}


$passengerINFO_query = mysql_query("SELECT userID, startLocation, firstName, lastName, phone FROM user, request	WHERE user.userID = request.passengerID limit 5");

$passengerList_query = mysql_query("SELECT userID, startLocation, firstName, lastName, phone FROM user, request	WHERE user.userID = request.passengerID limit 5");
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
                    <form class="form-horizontal" role="form" id="forPassenger" method='POST' name="showMap" action='showMap.php' data-ajax="false">
                        <div class="ui-content">
                            <ul data-role="listview" data-inset="true">
<?php
function getDistance($start, $end){
    $fstart = urlencode($start);
    $fend = urlencode($end);
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=$fstart&destinations=$fend&mode=driving&language=en-EN&key=AIzaSyDMnOJjJdodhxLjdCNKK5kPgI5N0IXy1Xk&sensor=false";
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
    $passID = $row['userID'];
    $pstart = $row['startLocation'];
    $pdest = "The University of Queensland";
    $a = getDistance($driverStart, $pstart);
    $b = getDistance($pstart, $pdest);
    $c = getDistance($driverStart, $pdest);
    $plusDist = ($a + $b) - $c;
    if ($plusDist < 2000){
?>
                                <li data-icon="false" class="current">
                                    <h3><?php echo "{$row['firstName']}"?><?php echo "{$row['lastName']}"?>
                                    <?php //echo $a?>
                                    <?php //echo $b;?>
                                    <?php echo $plusDist;?>
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
                            <?php echo "<div class='ui-block-a'><input type='submit' data-theme='b' name='$passID' value='SELECT'></div>"; ?>
                                </li>
                                <?php
    }
                                }
                                ?>
                            </ul>


</div>
</form>
</div>
</div>
</div>
</div>
</section>
</body>
</html>
