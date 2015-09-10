<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

//this is login checking
session_start();

//connection to Database
include 'connection.php';

//illegal session
include 'illegalacc.php';

//accept the request//
if (isset($_POST['sendrequest']))
{
    $uid = $_SESSION['userID'];
    $start = $_POST['startlocation'];
    $destination = $_POST['destination'];
    $time = $_POST['leavingTime'];
    $status = "pending";
    $insert_query = "INSERT INTO request(passengerID, departureTime, startLocation,
    destination, status)VALUES($uid, '$time', '$start', '$destination', '$status')";
    if(mysql_query($insert_query, $conn)){
      //exit('Request accepted! <a href="home_driver.php">Back</a>');
        echo $insert_query;
    }else {
        echo $insert_query;
        echo 'Error occured ',mysql_error(),'<br />';
        echo '<a href="javascript:history.back(-1);">Try Again</a>';
    }
}

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

    <!-- Panel -->
    // <script>
    //     $(document).ready(function(){

    //         $("#price").hide();
    //         $(".bestRatings").hide();
    //         $("#drivers").hide();

    //         $("#next").click(function(){
    //             $("#price").show(100);
    //         });

    //         $("#search").click(function(){
    //             $("#drivers").show(100);
    //             $("#destination").hide();
    //         });
    //     });
    // </script>
    <!-- END PANEL -->

    <!-- DATE TIME PICKER -->
    <link rel="stylesheet" type="text/css" href="js/src/DateTimePicker.css" />

    <script type="text/javascript" src="js/src/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/src/DateTimePicker.js"></script>

    <!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="js/src/DateTimePicker-ltie9.css" />
    <script type="text/javascript" src="js/src/DateTimePicker-ltie9.js"></script>
    <![endif]-->

    <style type="text/css">
        input
        {
            width: 200px;
            padding: 10px;
            margin-left: 20px;
            margin-bottom: 20px;
        }
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
        }
        .moreInfo{
            font-size: 12px;
        }
    </style>
    <!-- End Date Time Picker -->
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


    <section class="info">
        <div class="info-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <!-- Start to show info -->
                         <div id="mainQuestion">
                                <br>
                                <img src="img/success.png" alt="Successful request" width="250px" height="250px" class="img-responsive center-block">
                                <br>
                            <div class="ui-grid-a">
                                <div class="ui-block-a"><button type="button" data-theme="b" id="next" onclick="location.href='myRides.php'">View My Rides</button></div>
                            </div>

                            </div>
                            <!-- End info -->
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </section>

</div>

</body>
</html>
