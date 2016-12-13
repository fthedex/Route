<?php


require 'connection.php';
$db = Database::getConnection();


if($db->connect_errno)
{
	echo "Failed to connect to MYSQL: (". $db->connect_errno .")" . $db->connect_error;
}

$sql = "CALL createBus(?, ?, ?, @out);";

$Var1 = $_POST['busmodel'];

$VarDate = new DateTime($_POST['busmodelyear']);
$VarY = $VarDate -> format('Y');
$VarM = $VarDate -> format('m');
$VarD = $VarDate -> format('d');
$Var2 = $VarD . '-' . $VarM . '-' . $VarY;

$Var3 = $_POST['capacity'];


if (!($stmt = $db->prepare($sql))) 
{
    echo "Prepare failed: (" . $db->errno . ") " . $db->error;
}

$stmt->bind_param('ssi', $Var1, $Var2, $Var3);

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


