<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 10/24/2016
 * Time: 7:06 PM
 */



if($_SERVER["REQUEST_METHOD"]=="POST"){
    require 'connection.php';
    createBus();
}


function createBus()
{
    global $connect;

    $busID = $_POST["busId"];
    $lng = $_POST["busLng"];
    $lat = $_POST["busLat"];

    $query = "Insert into updatebuslocation(busId,busLng,busLat) values ('$busID','$lng','$lat');";



    mysqli_query($connect, $query) or die (mysqli_error($connect));


}


