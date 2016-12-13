<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 10/24/2016
 * Time: 7:07 PM
 */


    require 'connection.php';

    $db = Database::getConnection();

    $driverId = $_GET["busId"];



$userBusQuery = "SELECT driver.driverBusID FROM driver WHERE driver.driverID = $driverId";

$result = mysqli_query($db, $userBusQuery) or die (mysqli_error($db));
$driverBus = null;
if($result->num_rows>0){

    while($row = $result->fetch_assoc()){

        $driverBus = $row['driverBusID'];
    }


}

if($result!=null) {

    $query = "DELETE FROM updatebuslocation WHERE busID=$driverBus";

    mysqli_query($db, $query) or die (mysqli_error($db));
}