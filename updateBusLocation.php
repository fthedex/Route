<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 10/24/2016
 * Time: 7:07 PM
 */

if($_SERVER["REQUEST_METHOD"]=="POST"){
    require 'connection.php';
    updateBus();
}

function updateBus()
{
    $db = Database::getConnection();

    $busID = $_POST["busId"];
    $lng = $_POST["busLng"];
    $lat = $_POST["busLat"];

    $query = "UPDATE updateBusLocation SET busLng=$lng,busLat=$lat WHERE busId=$busID";


    mysqli_query($db, $query) or die (mysqli_error($db));


}