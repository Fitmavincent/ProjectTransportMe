<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

//this is login checking
session_start();

//illegal access
include "illegalacc.php";

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
    <script>
        $(document).ready(function(){

            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!

            var yyyy = today.getFullYear();
            if(dd<10){
                dd='0'+dd
            }
            if(mm<10){
                mm='0'+mm
            }
            var today = dd+'/'+mm+'/'+yyyy;
            var x = document.getElementsByClassName("DATE");
            x[0].innerHTML = today;
            x[1].innerHTML = today;
            x[2].innerHTML = today;
            x[3].innerHTML = today;

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


    <section class="info">
        <div class="info-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <!-- Start Main Question -->
                        <div id="mainQuestion">
                            <h3 class="text-center">
                                Welcome, Driver!  <a class='my-tool-tip' data-toggle="tooltip" data-placement="left" title="You are registered as a Driver. To Request a Ride, select 'Not Driving?' or update details in 'Profile'">
                                                    <i class='glyphicon glyphicon-question-sign'></i>
                                                    </a>
                                                <script>
                                                    $(document).ready(function()
                                                    {
                                                        $("a.my-tool-tip").tooltip();
                                                    });

                                                </script>
                            </h3>
                            <div class="ui-grid-a">
                                <div class="ui-block-a"><button type="button" data-theme="b" id="driving" onclick="location.href='planDrive.php'">Plan Drive</button></div>
                                <div class ="ui-block-a"><button type="button" data-theme="b" id="parking" onclick="location.href='carparkCheck.php'" >View Parking</button></div>
                                <div class ="ui-block-a"><button type="button" data-theme="b" id="history" onclick="location.href='myRides.php'" >My Rides</button></div>
                                <div class ="ui-block-a"><button type="button" data-theme="b" id= "passenger" onclick="location.href='home_pass.php'">Not Driving?</button></div>
                            </div>
                        <!-- End Main Question -->


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
