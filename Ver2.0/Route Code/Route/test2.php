<?php

require "connection.php";

$db = Database::getConnection();


$sql ="describe updatebuslocation";

//$result = $db->query($sql);

if (!$result = mysqli_query($db, $sql)) {
    printf("Errormessage: %s\n", mysqli_error($db));
}

if ($result->num_rows > 0) {
    // output data of each row

    while($row = $result->fetch_assoc()) {

echo json_encode($row);
    }

}