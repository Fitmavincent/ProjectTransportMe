<!DOCTYPE html>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Transport Me</title>
    <link rel="stylesheet" href="css/jquery.mobile-1.4.2.css">
    <link rel="stylesheet" href="css/jquery.mobile-core.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
<!--    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>-->

    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

    <script src="js/jquery.mobile-1.4.2.js"></script>

    <script>
        $(document).ready(function(){
            $("#carinfo").hide();
            $("#carreg").click(function(){
                $("#carinfo").show(100);
            });
        });
    </script>

    <!-- DATE TIME PICKER -->
    <link rel="stylesheet" type="text/css" href="js/src/DateTimePicker.css" />

    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
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
    <section class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <!-- Start my details -->
                        <div class="text-center" style="color: black;">
                            <h3>
                                Register Account
                            </h3>
                        </div>
                        <div role="main" class="ui-content">
                            <div data-role="tabs">
<!--
                                <div data-role="navbar" style="padding-bottom: 20px;">
                                    <ul>
                                        <li><a href="#fragment-1" class="ui-btn-active">Myself</a></li>
                                        <li><a href="#fragment-2">My Car</a></li>
                                    </ul>
                                </div>
-->



                                <!--UserInfo RegisterForm-->
                                <div id="register">
                                <!--User info-->
                                    <div id="userinfo">
                                    <form data-ajax="false" id="detailsPart1" method='POST' enctype="multipart/form-data" action="regsubmit.php">
                                        <div class="form-group col-lg-12">
                                            <label for="firstName" style="color: black;">First Name <a style="color: red">*</a></label>
                                            <input type="text" class="form-control input-control" placeholder="First Name" name="firstName" id="firstName">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="lastName" style="color: black;">Last Name <a style="color: red">*</a></label>
                                            <input type="text" class="form-control input-control" placeholder="Last Name" name="lastName" id="lastName">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="Email" style="color: black;">Email <a style="color: red">* Will be your username</a></label>
                                            <input type="email" class="form-control input-control" placeholder="Email" name="email" id="email">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="password" style="color: black;">Password</label>
                                            <input type="password" class="form-control input-control" placeholder="Password must be more than 6 characters" name="password" id="password">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="Address" style="color: black;">Address</label>
                                            <input type="text" class="form-control input-control" placeholder="Address" name="address" id="address">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="phoneNo" style="color: black;">Phone Number</label>
                                            <input type="tel" class="form-control input-control" placeholder="Phone Number" name="phoneNo" id="phoneNo">
                                        </div>

<!--
                                        <div class="form-group col-lg-12">
                                            <label for="height" style="color: black;">Height (cm)</label>
                                            <input type="number" class="form-control input-control" placeholder="Height" name="height" id="height">
                                        </div>
-->
<!--
                                        <div class="form-group col-lg-12">
                                            <label for="hairColour" style="color: black;">Hair Colour</label>
                                            <input type="text" class="form-control input-control" placeholder="Hair Colour" name="hairColour" id="hairColour">
                                        </div>
-->
                                        <div class="form-group col-lg-12">
                                            <label for="profileImg" style="color: black;">Profile Image</label>
                                            <input type="file" name="userimage"><br>
                                        </div>


                                        <div class="ui-block-a"><button type="button" data-theme="b" id="carreg">Do You Have A Car?</button></div>
                                        <!--Car info-->
                                        <div id="carinfo">

                                        <div class="form-group col-lg-12">
                                            <label for="licence" style="color: black;">Licence Issue Date</label>
                                            <input type="text" data-field="date" name="licence" class="form-control" readonly>
                                            <div id="dtBox"></div>
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="lastAccident" style="color: black;">Last Accident Date</label>
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
                                            <label for="carModel" style="color: black;">Car Model</label>
                                            <input type="text" class="form-control input-control" placeholder="Car Model" name="carModel" id="carModel">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="carRegistration" style="color: black;">Car Registration</label>
                                            <input type="text" class="form-control input-control" placeholder="Car Registration" name="carRegistration" id="carRegistration">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="carColour" style="color: black;">Car Colour</label>
                                            <input type="text" class="form-control input-control" placeholder="Car Colour" name="carColour" id="carColour">
                                        </div>
                                        <div class="form-group col-lg-12">
                                            <label for="capacity" style="color: black;">Seating Capacity (Excl. Driver)</label>
                                            <input type="number" class="form-control input-control" placeholder="Capacity" name="capacity" id="capacity">
                                        </div>


                                        <!--Register Button-->
                                        <div class="form-group col-md-6 col-md-offset-3">
                                            <div class="ui-grid-a">
                                                <div class="ui-block-a"><button type="submit" name="regsubmit" data-theme="b" class="save" style="background-color: green;">Register</button></div>
                                                <div class="ui-block-b"><button type="submit" data-theme="b" style="background-color: brown;" onClick = "parent.location='index.php'">Back</button></div>
                                            </div>
                                        </div>

                                        </div>
                                   </form>
                                </div>



                                <!--Car info Form-->
<!--                                <div id="fragment-2">-->
<!--                                    <form id="detailsPart2" method='POST' enctype="multipart/form-data">-->

<!--
                                        <div class="form-group col-md-6 col-md-offset-3">
                                            <div class="ui-grid-a">
                                                <div class="ui-block-a"><button type="button" data-theme="b" class="save" style="background-color: green;">Register</button></div>
                                                <div class="ui-block-b"><button type="submit" data-theme="b" style="background-color: brown;" onClick = "parent.location='index.php'">Back</button></div>
                                            </div>
                                        </div>
-->
<!--                                    </form>-->
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
