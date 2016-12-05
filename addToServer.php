<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 10/24/2016
 * Time: 7:06 PM
 */

    require 'connection.php';

    $db = Database::getConnection();

    $driverId = $_GET["busId"];
    $lng = $_GET["busLng"];
    $lat = $_GET["busLat"];

    $userBusQuery = "SELECT driver.driverBusID FROM driver WHERE driver.driverID = $driverId";

$result =  mysqli_query($db, $userBusQuery) or die (mysqli_error($db));  // we first know what bus to add then we pass it to another query in order to insert it into updateBusLoaction table;
$driverBus = null;
if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {


        $driverBus=$row["driverBusID"];


    }

}

if($driverBus!=null) {
    $addToServerQuery = "Insert into updatebuslocation(busID,busLong,busLati) values ('$driverBus','$lng','$lat')";

    mysqli_query($db, $addToServerQuery) or die (mysqli_error($db));
}




