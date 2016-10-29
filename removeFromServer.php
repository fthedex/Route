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


    $query ="DELETE FROM updateBusLocation WHERE busId=$busID";

    mysqli_query($db, $query) or die (mysqli_error($db));




