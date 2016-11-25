<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/25/2016
 * Time: 8:38 PM
 */

require "connection.php";

$bus = $_GET["userId"];

$db = Database::getConnection();


$sql = "SELECT driver.driverNumber , driver.driverFN,driver.driverLN FROM driver INNER JOIN bus ON driver.driverBusID = bus.busID AND driver.driverBusID = $bus;";

if (!$result = mysqli_query($db, $sql)) {
    printf("Errormessage: %s\n", mysqli_error($db));
}

$resultVal = "";


if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {


        $resultVal .= $row["driverNumber"] . ",".$row["driverFN"]." ". $row["driverLN"];



    }

}

echo $resultVal;