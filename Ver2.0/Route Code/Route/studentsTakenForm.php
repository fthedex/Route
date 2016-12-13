<?php

require 'connection.php';
$db = Database::getConnection();


if($db->connect_errno)
{
	echo "Failed to connect to MYSQL: (". $db->connect_errno .")" . $db->connect_error;
}


$sql = "CALL createStudentTaken(?, ?, @out);";

$Var1 = $_POST['busid'];
$Var2 = $_POST['studentid'];

if (!($stmt = $db->prepare($sql))) 
{
    echo "Prepare failed: (" . $db->errno . ") " . $db->error;
}

$stmt->bind_param('ii', $Var1, $Var2);

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



