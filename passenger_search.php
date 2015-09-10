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

echo $d_id;
echo $d_start;
echo $d_destination;
echo $d_time;
echo $d_status;

$passenger_query = mysql_query("SELECT * FROM request, user WHERE (departureTime - INTERVAL 1 HOUR < '$d_time') AND (departureTime > '$d_time') AND user.userID = request.passengerID AND status = 'pending' ORDER BY departureTime");
?>


<!DOCTYPE html>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transport Me</title>
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
   <style type="text/css">
        div.ui-corner-all{
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            -o-box-shadow: none;
            box-shadow: none;
            border-style: none;
        }
        .boxNotDriving {
            border-color: #ddd /*{a-body-border}*/;
            box-shadow: inset 0 1px 3px /*{global-box-shadow-size}*/ rgba(0,0,0,.2) /*{global-box-shadow-color}*/;
            border-radius: .3125em /*{global-radii-blocks}*/;
            background-color: transparent;
        }
        .moreInfo{
            font-size: 12px;
        }
    </style>

    <!-- Panel -->
    <script>
        $(document).ready(function(){
            $(".past").hide();
        });
    </script>
    <!-- END PANEL -->

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

<section class = "info">
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
                        <div class="ui-content">
                            <ul data-role="listview" data-inset="true">
                                <?php
                                while($row = mysql_fetch_array($passenger_query))
                                { ?>
                                <li data-icon="false" class="current">
                                    <h3><?php echo "{$row['firstName']}"?>
                                        <?php echo "{$row['lastName']}"?>
                                    </h3>
                                    <br/>
                                    <p><b>Location:</b> <?php echo "{$row['startLocation']}"?></p>
                                    <p><b>Departure Time:</b> <?php echo "{$row['departureTime']}"?></p>
                                    <p><b>Destination:</b> <?php echo "{$row['destination']}"?></p>
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
<!--
                                <li data-icon="false" class="current">
                                    <h5><img src="img/mia.png" width="50px" height="50px" class="img-circle" style/>
                                        <a href="mia.php" data-ajax="false">Mia Toretto</a></h5>
                                    <p><b>Accident Free Hours:</b> 800</p>
                                    <p><b>Car Model: </b>2012 Alfa Romeo Giulietta JTD-M</p>
                                    <p><b>Car Colour: </b>Red</p>
                                    <p><b>Car Registration: </b>865 GTF</p>
                                    <p><b>General Rating: </b><input class="rating-input" type="number" value="5" readonly/></p>
                                    <p style="font-size: 18px;"><b>ETA to your location: 15 mins</b></p>
                                    <p style="font-size: 12pt"><strong>Suggested Fee: <span style="color: red;">$1.00</span></strong></p>
                                    <p>Notification: 5 mins before arrival</p>
                                    <p class='ui-li-aside' style="right: 2em;">
                                        <a href="#popupDialog" data-rel="popup" data-position-to="window" data-role="button" data-inline="true" data-transition="pop" class="btn-default btn-sm">
                                            <span class="glyphicon glyphicon-trash"></span> Cancel
                                        </a>
                                    </p>
                                </li>
-->
                                <!-- End First Driver -->
    </section>
</div>

</body>
</html>
-->
