<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 10/24/2016
 * Time: 7:06 PM
 */



if($_SERVER["REQUEST_METHOD"]=="POST"){
    require 'connection.php';
    addBus();
}


function addBus()
{
    $db = Database::getConnection();

    $busID = $_POST["busId"];
    $lng = $_POST["busLng"];
    $lat = $_POST["busLat"];

    $query = "Insert into updatebuslocation(busId,busLng,busLat) values ('$busID','$lng','$lat');";



    mysqli_query($db, $query) or die (mysqli_error($db));


}


