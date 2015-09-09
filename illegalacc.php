<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);

session_start();

if (!isset($_SESSION['userID']))
{
    //$_SESSION['userID'] = $_SESSION['userID'];
    echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.location.href='index.php'
            </SCRIPT>");
    exit();
}

?>
