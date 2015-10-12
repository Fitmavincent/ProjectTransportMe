
<?php
session_start();

//connection to Database
include 'connection.php';

//checking database
include 'check.php';

//illegal session
include 'illegalacc.php';

//get driver address
$address = $_SESSION['address'];

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


    <!-- DATE TIME PICKER -->
    <link rel="stylesheet" type="text/css" href="js/src/DateTimePicker.css" />

    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
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

    <!-- For star ratings -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="js/star-rating.js" type="text/javascript"></script>
    <!-- End Star Ratings -->

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
                        <!-- Start Title -->
                        <div id="mainTitle">
                            <h3 class="text-center">
                                Let's Ride!
                            </h3>
                        </div>
                        <!-- End Title -->



                        <!-- Destination -->
                        <form class="form-horizontal" role="form" id="forPassenger" method='POST' action='showPass.php' data-ajax="false">
                            <!-- Start Location -->
                            <div id="startlocation">
                                <label for="inputPassword3">Start Location:</label>
                                <input type="text" class="form-control boxNotDriving" id="startpoint" name="startlocation" value="<?php echo $address ?>">
                                <button class=" ui-btn ui-btn-b ui-shadow ui-corner-all" type="button" data-theme="b" onclick="getLocation()" name="gerCurrentLocation">Get Location</button>
                                <div class="ui-grid-solo">
                            </div>
                            </div>
                            <!--Start of Geolocation-->
                            <script>
                                var x = document.getElementById("startpoint");
                                function getLocation() {
                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition(showPosition);
                                    } else {
                                        x.value = "Geolocation is not supported by this browser.";
                                    }
                                }
                                function showPosition(position) {
                                    var pos = {
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude
                                    };
                                    x.value = pos.lat + ", " + pos.lng;
                                }
                            </script>
                            <!--End of Geolocation-->
                            <!-- End Start Location -->
                            <div id="destination">
                                <label for="inputPassword3">Destination:</label>
                                <input type="text" class="form-control boxNotDriving" id="destination" name="destination" value="The University of Queensland" readonly>
                                <div class="ui-grid-solo">
                            </div>
                            <!-- End Destination -->

                            <!-- Select Departure Time & Submit -->
                            <div id="price">

                                <label for="inputPassword3">Departure Time:</label>
                                <div>
                                    <input type="text" data-field="datetime" name="leavingTime" class="form-control boxNotDriving" readonly >
                                    <div id="dtBox"></div>
                                    <script type="text/javascript">
                                        $("#dtBox").DateTimePicker();
                                    </script>
                                </div>

                                <div class="ui-grid-solo">
                                    <div class="ui-block-a"><button type="submit" data-theme="b" name="searchpassenger">Search passenger</button></div>
                                </div>
                            </div>
                            <!-- Select Departure Time & Submit -->

                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </section>

</div>

</body>
</html>
