<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/14/2016
 * Time: 3:30 PM
 */

require 'connection.php';

$studentId = $_GET['userId'];


$db = Database::getConnection();


$getDriverBusQuery = "SELECT busID from studentsawaitinglist WHERE studentID=$studentId";


$result = mysqli_query($db, $getDriverBusQuery) or die (mysqli_error($db));
$studentBusId=null;
if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {


        $studentBusId=$row['busID'];
    }

}

$deleteQuery ="DELETE FROM studentsawaitinglist WHERE studentID=$studentId";

mysqli_query($db, $deleteQuery) or die (mysqli_error($db));

$insertQuery = "INSERT INTO takenstudentslist VALUES($studentBusId,$studentId)";

mysqli_query($db, $insertQuery) or die (mysqli_error($db));
