<?php

$host = "localhost";
$username = "root";
$password = "Muller@25";
$db = "routeDB";

$mysqli = new mysqli($host, $username, $password, $db);

if($mysqli->connect_errno)
{
	echo "Failed to connect to MYSQL: (". $mysqli->connect_errno .")" . $mysqli->connect_error;
}


$sql = "CALL createStudentTaken(?, ?, @out);";

$Var1 = $_POST['busid'];
$Var2 = $_POST['studentid'];

if (!($stmt = $mysqli->prepare($sql))) 
{
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

$stmt->bind_param('ii', $Var1, $Var2);

if (!$stmt->execute()) 
{
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    $sql = "select @out AS Result";
	if ($result = mysqli_query($mysqli, $sql)) 
	{
	    	while ($row = mysqli_fetch_row($result)) 
		{
	        	printf("%s \n", $row[0]);
	    	}
    	mysqli_free_result($result);
	}    
}
else
{
	$sql = "select @out AS Result";
	if ($result = mysqli_query($mysqli, $sql)) 
	{
	    	while ($row = mysqli_fetch_row($result)) 
		{
	        	printf("%s \n", $row[0]);
	    	}
    	mysqli_free_result($result);
	}
}


$stmt->close();
?>



