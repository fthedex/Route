<?php
require "connection.php";

$db = Database::getConnection();

if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM userinfo";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $username = $row['username'];
        $password = $row['password'];
        $fullName = $row['name'];
        $userType = $row['accType'];
        echo "USERNAME : $username<br> PASSWORD: $password<br>NAME:$fullName<br>TYPE:$userType<br>";

    }
} else {
    echo "0 results";
}
