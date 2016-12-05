<?php
require "connection.php";

$resultArr = array(array());


$db = Database::getConnection();


$sql ="SELECT * FROM updatebuslocation";

$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $i=0;
    while($row = $result->fetch_assoc()) {


        $resultArr[$i][0]=$row["busID"];
        $resultArr[$i][1]=$row["busLong"];
        $resultArr[$i][2]=$row["busLati"];
        $i++;
    }

}

echo json_encode($resultArr);


