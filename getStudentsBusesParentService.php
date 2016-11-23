<?php
require "connection.php";

$resultArr = array(array());

$userId = $_GET['userId'];

$db = Database::getConnection();


$sql ="SELECT updateBusLocation.busID,updateBusLocation.busLong,updateBusLocation.busLati FROM updateBusLocation,takenstudentslist,studentparent WHERE updateBusLocation.busID = takenstudentslist.busID AND studentparent.studentID = takenstudentslist.studentID AND studentparent.parentID = $userId";

//$result = $db->query($sql);

if (!$result = mysqli_query($db, $sql)) {
    printf("Errormessage: %s\n", mysqli_error($db));
}



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


