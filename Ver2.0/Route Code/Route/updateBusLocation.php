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
    $lng = $_GET["busLng"];
    $lat = $_GET["busLat"];


    $query = "UPDATE updatebuslocation,driver set updatebuslocation.busLong=$lng , updatebuslocation.busLati=$lat WHERE driver.driverID = $driverId AND driver.driverBusID = updatebuslocation.busID;";


    mysqli_query($db, $query) or die (mysqli_error($db));


