<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 10/24/2016
 * Time: 7:07 PM
 */

if($_SERVER["REQUEST_METHOD"]=="POST"){
    require 'connection.php';
    removeBus();
}


function removeBus()
{
    $db = Database::getConnection();

    $busID = $_POST["busId"];


    $query ="DELETE FROM updateBusLocation WHERE busId=$busID";

    mysqli_query($db, $query) or die (mysqli_error($db));


}

