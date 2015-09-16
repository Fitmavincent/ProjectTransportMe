<?php
//session_start();

//connection to Database
//include 'connection.php';
//
////illegal session
//if (!isset($_SESSION['userID']))
//{
//    $_SESSION['userID'] = $_SESSION['userID'];
//    exit('illegal access');
//}

//accept the request
//
//if (isset($_POST['sendrequest']))
//{
//    $uid = $_SESSION['userID'];
//    $start = $_POST['startlocation'];
//    $destination = $_POST['destination'];
//    $time = $_POST['leavingTime'];
//    $status = "pending";
//    $insert_query = "INSERT INTO request(passengerID, departureTime, startLocation,
//    destination, status)VALUES($uid, '$time', '$start', '$destination', '$status')";
//    if(mysql_query($insert_query, $conn)){
//      exit('Request accepted! <a href="home.php">Back</a>');
//        echo $insert_query;
//    }else {
//        echo $insert_query;
//	    echo 'Error occured ',mysql_error(),'<br />';
//	    echo '<a href="javascript:history.back(-1);">Try Again</a>';
//    }
//}
?>
