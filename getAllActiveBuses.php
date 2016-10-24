<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "routedb";
$resultArr = array(array());
// Create connection
$conn = mysqli_connect($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    echo "ERR";
}





$sql ="SELECT * FROM updateBusLocation";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $i=0;
    while($row = $result->fetch_assoc()) {


        $resultArr[$i][0]=$row["busId"];
        $resultArr[$i][1]=$row["busLng"];
        $resultArr[$i][2]=$row["busLat"];
        $i++;
    }

}
$conn->close();
echo json_encode($resultArr);

?>
