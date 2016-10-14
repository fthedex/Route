<?php
/**
 * Created by PhpStorm.
 * User: Khalil
 * Date: 14/10/2016
 * Time: 02:15 م
 */
function getDataRow($userInfoName,$userInfoPassword){

    $row = null;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "routedb";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT username, password FROM userinfo WHERE username='$userInfoName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

           return $row;
        }
    } else {
        echo "0 results";


    }
 return $row;
    $conn->close();
}

$data = getDataRow("admin","admin");
echo $data['username'] . "<br>" . $data['password'];