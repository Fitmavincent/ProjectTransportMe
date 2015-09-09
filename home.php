<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);

//this is login checking
session_start();

//connection to Database
include 'connection.php';

//login checking
include 'check.php';
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


            $("#destination").hide();
            $("#carpark").hide();
            $("#mainTitle").hide();
            $("#store_list").hide();

            $("#driving").click(function(){
                $("#destination").show(100);
            });

            $("#next").click(function(){
                $("#carpark").show(100);
                $("#mainQuestion").hide();
                $("#mainTitle").show(100);
            });

            $("#buy").click(function(){
                $("#store_list").show(100);
                $("#destination").hide();
            });

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

    <style type="text/css">
        div.ui-grid-a > .ui-block-a, .ui-grid-a > .ui-block-b {
            padding-left: 10px;
        }
        #driving, #buy {
            background-color: green;
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


    <section class="info">
        <div class="info-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <!-- Start Main Question -->
                        <div id="mainQuestion">
                            <h3 class="text-center">
                                Are you driving today?
                            </h3>
                            <div class="ui-grid-a">
                                <div class="ui-block-a"><button type="button" data-theme="b" id="driving">Yes</button></div>
                                <div class="ui-block-b"><button type="button" data-theme="b" onclick="location.href='notDriving.php'" style="background-color: brown;">No</button></div>
                            </div>
                        </div>
                        <!-- End Main Question -->

                        <!-- Start Title -->
                        <div id="mainTitle">
                            <h3 class="text-center">
                                Let's Ride!
                            </h3>
                        </div>
                        <!-- End Title -->

                        <!-- Destination -->
                        <form class="form-horizontal" role="form" id="logins" method='POST' action='locationSave.php'>
                        <div id="destination">
                                <label for="inputPassword3">Destination:</label>
                                <input type="text" class="form-control" id="destination" name="destination" value="The University of Queensland">
                                <div class="ui-grid-solo">
                                    <div class="ui-block-a"><button type="button" data-theme="b" id="next" onclick="location.href='driving.php'">Next</button></div>
                                </div>
                        </div>
                        <!-- End Destination -->

                        <!-- Start Car Park Question -->
<!--
                        <div id="carpark">
                            <label for="inputPassword3">Do you need car park ticket for today (<span class="DATE"></span>)?</label>
                            <div class="ui-grid-a">
                                <div class="ui-block-a"><button type="button" data-theme="b" id="buy">Yes</button></div>
                                <div class="ui-block-b"><button type="submit" data-theme="b" style="background-color: brown;">No</button></div>
                            </div>
                        </div>
-->
                        <!-- End Car Park Question -->

                            <!-- Start Buy Ticket Confirmation -->
<!--
                            <div data-role="main" class="ui-content" id="store_list">
                                    <ul data-role="listview" data-inset="true">
                                        <li data-icon='false' class="ticket">
                                            <h6>Full day Cash Ticket</h6>
                                            <p>Price: $4.00</p>
                                            <p>For full day parking on <span class="DATE"></span></p>
                                            <p class='ui-li-aside'>
                                                <button type='submit' class='btn btn-default btn-sm' name='packageBtn1'>
                                                    <span class='glyphicon glyphicon-gift'></span> Buy Ticket
                                                </button>
                                            </p>
                                        </li>
                                        <li data-icon='false' class="ticket">
                                            <h6>Full day MePoints Ticket</h6>
                                            <p>Price: 5000 MePoints</p>
                                            <p>For full day parking on <span class="DATE"></span></p>
                                            <p class='ui-li-aside'>
                                                <button type='submit' class='btn btn-default btn-sm' name='packageBtn2'>
                                                    <span class='glyphicon glyphicon-gift'></span> Buy Ticket
                                                </button>
                                            </p>
                                        </li>
                                        <li data-icon='false' class="ticket">
                                            <h6>Cherry Pool Ticket</h6>
                                            <p>Price: 2500 MePoints</p>
                                            <p>For parking on <span class="DATE"></span></p>
                                            <p class='ui-li-aside'>
                                                <button type='submit' class='btn btn-default btn-sm' name='packageBtn3'>
                                                    <span class='glyphicon glyphicon-gift'></span> Buy Ticket
                                                </button>
                                            </p>
                                        </li>
                                    </ul>
                            </div>
-->
                            <!-- End Buy Ticket Confirmation -->
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
