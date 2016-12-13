<?php

require 'connection.php';
$db = Database::getConnection();


if($db->connect_errno)
{
	echo "Failed to connect to MYSQL: (". $db->connect_errno .")" . $db->connect_error;
}

$sql = "CALL createStudentAwaiting(?, ?, ?, ?, @out);";

$Var1 = $_POST['busid'];
$Var2 = $_POST['studentid'];
$Var3 = $_POST['long'];
$Var4 = $_POST['lati'];


if (!($stmt = $db->prepare($sql))) 
{
    echo "Prepare failed: (" . $db->errno . ") " . $db->error;
}

$stmt->bind_param('iidd', $Var1, $Var2, $Var3, $Var4);

if (!$stmt->execute()) 
{
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    $sql = "select @out AS Result";
	if ($result = mysqli_query($db, $sql)) 
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
	if ($result = mysqli_query($db, $sql)) 
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


