<?php

    $con=mysqli_connect("localhost", "root", "") or die(mysql_error()); //connect to server
    mysqli_select_db($con,"stoplights") or die("Cannot connect to database"); //connect to database

    $sql1 = "SELECT `status` FROM `stoplights` WHERE `stoplight_id`=".$_GET["id"];
    echo $sql1;
    $isworking =mysqli_fetch_assoc(mysqli_query($con,$sql1));

    if ($isworking['status']){
	    $sql = "INSERT INTO readings (r,y,g,stoplight_id) VALUES ('".$_GET["red"]."','".$_GET["yellow"]."','".$_GET["green"]."','".$_GET["id"]."')";
	    mysqli_query($con,$sql);
    }

?>