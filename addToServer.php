<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 10/24/2016
 * Time: 7:06 PM
 */

    require 'connection.php';

    $db = Database::getConnection();

    $busID = $_GET["busId"];
    $lng = $_GET["busLng"];
    $lat = $_GET["busLat"];

    echo $busID;
    echo $lng;
    echo $lat;


    $query = "Insert into updatebuslocation(busID,busLong,busLati) values ('$busID','$lng','$lat');";



    mysqli_query($db, $query) or die (mysqli_error($db));





