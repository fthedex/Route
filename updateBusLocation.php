<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 10/24/2016
 * Time: 7:07 PM
 */

    require 'connection.php';

    $db = Database::getConnection();

    $busID = $_GET["busId"];
    $lng = $_GET["busLng"];
    $lat = $_GET["busLat"];

    $query = "UPDATE updateBusLocation SET busLng=$lng,busLat=$lat WHERE busId=$busID";


    mysqli_query($db, $query) or die (mysqli_error($db));


