<?php

$host = "localhost";
$username = "root";
$password = "";
$db = "test";

$mysqli = new mysqli($host, $username, $password, $db);

if($mysqli->connect_errno)
{
	echo "Failed to connect to MYSQL: (". $mysqli->connect_errno .")" . $mysqli->connect_error;
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


