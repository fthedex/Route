<?php

require 'connection.php';
$db = Database::getConnection();


if($db->connect_errno)
{
	echo "Failed to connect to MYSQL: (". $db->connect_errno .")" . $db->connect_error;
}

function get_random_string($valid_chars, $length)
{
    $random_string = "";
    $num_valid_chars = strlen($valid_chars);
    for ($i = 0; $i < $length; $i++)
    {
        $random_pick = mt_rand(1, $num_valid_chars);
        $random_char = $valid_chars[$random_pick-1];
        $random_string .= $random_char;
    }
    return $random_string;
}


$Var1 = $_POST['accountid'];
$Var2 = $_POST['type'];
$Var3 = $_POST['accountpassword'];

$salt = get_random_string('abcdefghijklmnopqrstuvwxyz123456789', 5);
$hashed = hash("sha256", $salt . $Var3);

$sql = "CALL createAccountInfo(?, ?, '$hashed', '$salt', @out);";

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
?>


