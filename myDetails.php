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

    <script type="text/javascript" src="js/src/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/src/DateTimePicker.js"></script>

    <!--[if lt IE 9]>
    <link rel="stylesheet" type="text/css" href="js/src/DateTimePicker-ltie9.css" />
    <script type="text/javascript" src="js/src/DateTimePicker-ltie9.js"></script>
    <![endif]-->

    <style type="text/css">
        div.ui-grid-a > .ui-block-a, .ui-grid-a > .ui-block-b {
            padding-left: 10px;
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
                        <!-- Start my details -->
                        <div class="text-center">
                            <h3>
                                Update Details
                            </h3>
                            <p>&nbsp;</p>
                            <img src="img/dominic-toretto-auto.png" width="100px" height="105px" class="img-circle" />
                            <h4>
                                <?php
                                session_start();
                                $firstName = $_SESSION['firstName'];
                                $lastName = $_SESSION['lastName'];
                                echo $firstName . " " . $lastName;
                                ?>
                            </h4>
                        </div>
                        <div role="main" class="ui-content">
                            <div data-role="tabs">
                                <div data-role="navbar" style="padding-bottom: 20px;">
                                    <ul>
                                        <li><a href="#fragment-1" class="ui-btn-active">Myself</a></li>
                                        <li><a href="#fragment-2">My Car</a></li>
                                    </ul>
                                </div>
                                <div id="fragment-1">
                                    <form id="detailsPart1" method='POST' enctype="multipart/form-data">
                                        <div class="form-group col-lg-12">
                                            <label for="firstName">First Name <a style="color: red">*</a></label>
                                            <input type="text" class="form-control input-control" placeholder="First Name" name="firstName" id="firstName">
<!--
                                            <?php
//                                            require_once "connection.php";
//                                            session_start();
//                                            $userID = $_SESSION['userID'];
//
//                                            $sql = mysqli_query($conNew,"SELECT * FROM users INNER JOIN profiles ON users.userID = profiles.userID WHERE users.userID='$userID';");
//                                            while ($row = mysqli_fetch_assoc($sql))
//                                            {
//                                                $firstName = $row['firstName'];
//                                                echo "<input type='text' class='form-control input-control' placeholder='First Name' name='firstName' id='firstName' value='$firstName'>";
//                                            }
//
//                                            mysqli_close($conNew);
                                            ?>
-->
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="lastName">Last Name <a style="color: red">*</a></label>
                                            <input type="text" class="form-control input-control" placeholder="Last Name" name="lastName" id="lastName" value="Toretto">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="Address">Address</label>
                                            <input type="text" class="form-control input-control" placeholder="Address" name="address" id="address" value="St Lucia QLD 4067">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="phoneNo">Phone Number</label>
                                            <input type="tel" class="form-control input-control" placeholder="Phone Number" name="phoneNo" id="phoneNo" value="03254372884">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="height">Height (cm)</label>
                                            <input type="number" class="form-control input-control" placeholder="Height" name="height" id="height" value="180">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="hairColour">Hair Colour</label>
                                            <input type="text" class="form-control input-control" placeholder="Hair Colour" name="hairColour" id="hairColour">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="profileImg">Profile Image</label>
                                            <input type="file" name="image"><br>
                                        </div>
                                        <div class="form-group col-md-6 col-md-offset-3">
                                            <div class="ui-grid-a">
                                                <div class="ui-block-a"><button type="button" data-theme="b" class="save" style="background-color: green;">Save</button></div>
                                                <div class="ui-block-b"><button type="submit" data-theme="b" style="background-color: brown;" onClick = "parent.location='home.php'">Back</button></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="fragment-2">
                                    <form id="detailsPart2" method='POST' enctype="multipart/form-data">
                                        <div class="form-group col-lg-12">
                                            <label for="licence">Licence Issue Date</label>
                                            <input type="text" data-field="date" name="licence" class="form-control" readonly>
                                            <div id="dtBox"></div>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="lastAccident">Last Accident Date</label>
                                            <input type="text" data-field="date" name="lastAccident" class="form-control" readonly>
                                            <div id="dtBox2"></div>

                                            <script type="text/javascript">
                                                $(document).ready(function()
                                                {
                                                    $("#dtBox").DateTimePicker();
                                                    $("#dtBox2").DateTimePicker();
                                                });
                                            </script>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="carModel">Car Model</label>
                                            <input type="text" class="form-control input-control" placeholder="Car Model" name="carModel" id="carModel" value="2013 Mercedes-AMG C 63 S">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="carRegistration">Car Registration</label>
                                            <input type="text" class="form-control input-control" placeholder="Car Registration" name="carRegistration" id="carRegistration" value="321-BAA">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="carColour">Car Colour</label>
                                            <input type="text" class="form-control input-control" placeholder="Car Colour" name="carColour" id="carColour" value="Black">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="capacity">Seating Capacity (Excl. Driver)</label>
                                            <input type="number" class="form-control input-control" placeholder="Capacity" name="capacity" id="capacity" value="2">
                                        </div>
                                        <div class="form-group col-md-6 col-md-offset-3">
                                            <div class="ui-grid-a">
                                                <div class="ui-block-a"><button type="button" data-theme="b" class="save" style="background-color: green;">Save</button></div>
                                                <div class="ui-block-b"><button type="submit" data-theme="b" style="background-color: brown;" onClick = "parent.location='home.php'">Back</button></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End my details -->
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </section>

</div>

</body>
</html>
