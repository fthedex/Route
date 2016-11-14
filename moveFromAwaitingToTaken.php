<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/14/2016
 * Time: 3:30 PM
 */

require 'connection.php';

$userId = $_GET['userId'];
$checkedBus = $_GET['busId'];

$db = Database::getConnection();



$deleteQuery ="DELETE FROM studentsawaitinglist WHERE studentID=$userId";

mysqli_query($db, $deleteQuery) or die (mysqli_error($db));

$insertQuery = "INSERT INTO takenstudentslist VALUES($checkedBus,$userId)";

mysqli_query($db, $insertQuery) or die (mysqli_error($db));
