<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);

session_start();

//login
if (isset($_POST['submit'])){

    //user real escape string to prevent SQL injection
    $username = mysql_real_escape_string($_POST['username']);
    $password = mysql_real_escape_string($_POST['password']);

    //check if username and password is blank
    if (!$_POST['username'] | !$_POST['password'])
    {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
				window.alert('You did not complete all of the required fields')
				window.location.href='index.php'
				</SCRIPT>");
        exit();
    }

    //SQL checking in database
    $checksql = mysql_query("SELECT * FROM users WHERE email='$username' AND password = '$password' limit 1");
    //if user exist, session logged in and session their username and user ID for future use
    if($row = mysql_fetch_array($checksql))
    {
        //Check successful!
        $_SESSION['firstName'] = $row['firstName'];
        $_SESSION['lastName'] = $row['lastName'];
        $_SESSION['userID'] = $row['userID'];
        echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.location.href='home.php'
            </SCRIPT>");
        exit();
    }else{
        exit('Login Failed, Invalid User Name or Password! Click here to <a href="javascript:history.back(-1);"> retry </a>');
    }
}

//illegal session
if (!isset($_SESSION['userID']))
{
    //$_SESSION['userID'] = $_SESSION['userID'];
    echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.location.href='index.php'
            </SCRIPT>");
    exit();
}

//mysql_connect("localhost:8889","root","root") or die("mysql connection is failure.");
//mysql_select_db("TransportMe") or die("Database does not exist");
//
//if (isset($_POST['submit'])){
//
//    //user real escape string to prevent SQL injection
//    $username=mysql_real_escape_string($_POST['username']);
//    $password=mysql_real_escape_string($_POST['password']);
//
//    //check if username and password is blank
//    if (!$_POST['username'] | !$_POST['password'])
//    {
//        echo ("<SCRIPT LANGUAGE='JavaScript'>
//				window.alert('You did not complete all of the required fields')
//				window.location.href='index.php'
//				</SCRIPT>");
//        exit();
//    }
//
//    //since user and password is not blank, find user info using the email and password entered by user
//    $sql= mysql_query("SELECT * FROM `users` WHERE `email`='$username' AND `password` = '$password'");
//
//    $row = mysql_fetch_array($sql);
//
//    //if user exist, session logged in and session their username and user ID for future use
//    if(mysql_num_rows($sql) > 0)
//    {
//        $_SESSION['logged-in'] = true;
//        $_SESSION['firstName'] = $row['firstName'];
//        $_SESSION['lastName'] = $row['lastName'];
//        $_SESSION['userID'] = $row['userID'];
//        echo ("<SCRIPT LANGUAGE='JavaScript'>
//				window.location.href='home.php'
//				</SCRIPT>");
//        exit();
//    }
//    //if no rows are returned, username and password combination is wrong
//    else
//    {
//        echo ("<SCRIPT LANGUAGE='JavaScript'>
//				window.alert('Wrong username password combination. Please re-enter.')
//				window.location.href='index.php'
//				</SCRIPT>");
//        exit();
//    }
//}
//else{
//}
?>
