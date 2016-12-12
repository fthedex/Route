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


$sql = "CALL createParent(?, ?, ?, ?, ?, ?, @out);";


$Var1 = $_POST['firstname'];
$Var2 = $_POST['lastname'];
$Var3 = $_POST['gender'];

$VarDate = new DateTime($_POST['dob']);
$VarY = $VarDate -> format('Y');
$VarM = $VarDate -> format('m');
$VarD = $VarDate -> format('d');
$Var4 = $VarD . '-' . $VarM . '-' . $VarY;

$Var5 = $_POST['number'];
$Var6 = $_POST['address'];


if (!($stmt = $mysqli->prepare($sql))) 
{
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}

$stmt->bind_param('ssssss', $Var1, $Var2, $Var3, $Var4, $Var5, $Var6);

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


