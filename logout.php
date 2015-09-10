<?php
session_start();

if (!isset($_SESSION['userID']))
{
    //$_SESSION['userID'] = $_SESSION['userID'];
    header("Location: index.php");
}
else if(isset($_SESSION['userID'])!=""){
    if($_SESSION['isDriver'] == 0){
        header("Location: home_pass.php");
    }else{
        header("Location: home_driver.php");
    }
}

$_SESSION = array();
if(isset($_COOKIE[session_name()]))
{
  setCookie(session_name(),'',time()-3600,'/');
}
session_destroy();
    header("Location: index.php");
 //echo "<script>window.location.href='index.php'</script>";
?>
