<?php
session_start();
$ID=$_SESSION['isDriver'];
?>

<!--send the value of ID to cid in javascript.-->
<script language='javascript'>
var cid="<?php echo $ID; ?>";

//    //pas.style.display="none";
//   if(cid==1) {
//    document.getElementById("pass").style.display="none";
////    pas.style.display="block";
////    dri.style.display="none";
//}
//    else if(cid==0) {
//    document.getElementById("drive").style.display="none";
//   // dri.style.display="block";
//   // pas.style.display="none";
//   }

</script>
<!--end send the value of ID to cid in javascript.-->
<!--menu of passenger-->

<section data-role="panel" id="nav" data-display="overlay">
<div ID="pass">
<!-- decide which div shows dependent on the value of cid-->
 <script>
   if (cid==1) {
   document.getElementById("pass").style.display="none";
//    pas.style.display="block";
//    dri.style.display="none";
}
  /*  else if(cid==1) {
        document.write("123");
    //document.getElementById("pass").style.display="none";
   // dri.style.display="block";
   // pas.style.display="none";
   } */

     //  document.getElementById("pass").style.display="none";
    </script>
    <!--end decide which div shows dependent on the value of cid-->
    <ul data-role="listview">
        <li>
            <a href="profile.php" data-ajax="false" style="background-color: #CD4F39">
                <h4>
                    <img src="img/dominic-toretto-auto.png" width="50px" height="50px" class="img-circle" hspace="10" style="border:none;" />
                    <?php
                    session_start();
                    $firstName = $_SESSION['firstName'];
                    $lastName = $_SESSION['lastName'];
                    echo $firstName . " " . $lastName;
                    ?>
                    <br>
                </h4>
            </a>
        </li>



        <li>
            <a href="home_pass.php" data-ajax="false" style="background-color: #2a2a2a">
                <span class="glyphicon glyphicon-home"></span>
                Home
            </a>
        </li>

        <li>
            <a href="notDriving.php" data-ajax="false" style="background-color: #2a2a2a">
                <span><img src="icons/hail.png" height="20px" width="20px"/></span>
                Not Driving
            </a>
        </li>
        <li>
            <a href="myRides.php" data-ajax="false" style="background-color: #2a2a2a">
                <span class="glyphicon glyphicon-time"></span>
                My Rides
            </a>
        </li>
<!--
        <li>
            <a href="myTickets.php" data-ajax="false" style="background-color: #2a2a2a">
                <span class="glyphicon glyphicon-tags"></span>
                &nbsp;My Tickets
            </a>
        </li>
-->
<!--
        <li>
            <a href="carparkCheck.php" data-ajax="false" style="background-color: #2a2a2a">
                <span><img src="icons/map.png" height="20px" width="20px"/></span>
                Car Park Availability
            </a>
        </li>
-->
        <li>
            <a href="help.php" data-ajax="false" style="background-color: #2a2a2a">
                <span class="glyphicon glyphicon-warning-sign"></span>
                Help
            </a>
        </li>
        <li>
            <a href="settings.php" data-ajax="false" style="background-color: #2a2a2a">
                <span class="glyphicon glyphicon-cog"></span>
                Settings
            </a>
        </li>

        <!--Save Logout -->
        <li>
            <a href="logout.php" data-ajax="false" style="background-color: #2a2a2a">
                <span><img src="icons/exit.png" height="15px" width="15px"/></span>
                Log out
            </a>
        </li>
    </ul>
</div>
    <!--end menu of passenger-->
 <!--menu of driver-->
<div ID="drive" >
    <!-- decide which div shows dependent on the value of cid-->
    <script>
     if (cid==0) {
         document.getElementById("drive").style.display="none";
    }
    </script>
    <!-- end decide which div shows dependent on the value of cid-->
    <ul data-role="listview">
        <li>
            <a href="profile.php" data-ajax="false" style="background-color: #CD4F39">
                <h4>
                    <img src="img/dominic-toretto-auto.png" width="50px" height="50px" class="img-circle" hspace="10" style="border:none;" />
                    <?php
                    session_start();
                    $firstName = $_SESSION['firstName'];
                    $lastName = $_SESSION['lastName'];
                    echo $firstName . " " . $lastName;
                    ?>
                    <br>
                </h4>
            </a>
        </li>



        <li>
            <a href="home_driver.php" data-ajax="false" style="background-color: #2a2a2a">
                <span class="glyphicon glyphicon-home"></span>
                Home
            </a>
        </li>
        <li>
            <a href="forDrivers.php" data-ajax="false" style="background-color: #2a2a2a" >
                <span><img src="icons/car.png" height="20px" width="20px"/></span>
                Plan Drives
            </a>
        </li>
        <li>
            <a href="notDriving.php" data-ajax="false" style="background-color: #2a2a2a">
                <span><img src="icons/hail.png" height="20px" width="20px"/></span>
                Not Driving
            </a>
        </li>
        <li>
            <a href="myRides.php" data-ajax="false" style="background-color: #2a2a2a">
                <span class="glyphicon glyphicon-time"></span>
                My Rides(Passenger)
            </a>
        </li>
        <li>
            <a href="myRides.php" data-ajax="false" style="background-color: #2a2a2a">
                <span class="glyphicon glyphicon-time"></span>
                My Rides(Driver)
            </a>
        </li>
<!--
        <li>
            <a href="myTickets.php" data-ajax="false" style="background-color: #2a2a2a">
                <span class="glyphicon glyphicon-tags"></span>
                &nbsp;My Tickets
            </a>
        </li>
-->
        <li>
            <a href="carparkCheck.php" data-ajax="false" style="background-color: #2a2a2a">
                <span><img src="icons/map.png" height="20px" width="20px"/></span>
                Car Park Availability
            </a>
        </li>
        <li>
            <a href="help.php" data-ajax="false" style="background-color: #2a2a2a">
                <span class="glyphicon glyphicon-warning-sign"></span>
                Help
            </a>
        </li>
        <li>
            <a href="settings.php" data-ajax="false" style="background-color: #2a2a2a">
                <span class="glyphicon glyphicon-cog"></span>
                Settings
            </a>
        </li>

        <!--Save Logout -->
        <li>
            <a href="logout.php" data-ajax="false" style="background-color: #2a2a2a">
                <span><img src="icons/exit.png" height="15px" width="15px"/></span>
                Log out
            </a>
        </li>
    </ul>
</div>
<!--end menu of driver-->
</section>
