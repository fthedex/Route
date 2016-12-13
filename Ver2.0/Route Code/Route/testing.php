<?php

require "connection.php";
// Create connection
$conn = Database::getConnection();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	
} 
echo "Connected successfully";

$conn->close();
?>
