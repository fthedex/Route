<?php
require 'connection.php';
$db = Database::getConnection();


if($db->connect_errno)
{
	echo "Failed to connect to MYSQL: (". $db->connect_errno .")" . $db->connect_error;
}

$sql = "CALL createDriver(?, ?, ?, ?, ?, ?, ?, @out);";

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
$Var7 = $_POST['bus'];


if (!($stmt = $db->prepare($sql))) 
{
    echo "Prepare failed: (" . $db->errno . ") " . $db->error;
}

$stmt->bind_param('sssssis', $Var1, $Var2, $Var3, $Var4, $Var5, $Var7, $Var6);

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

