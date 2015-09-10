<?php

//db connection
$conn = @mysql_connect("localhost:8889","root","root");
// Check connection
if (!conn){
    die("Failed to connect to MySQL: " . mysql_error());
}
mysql_select_db("TM", $conn);
?>
