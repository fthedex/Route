<?php

require 'connection.php';
$db = Database::getConnection();


if($db->connect_errno)
{
	echo "Failed to connect to MYSQL: (". $db->connect_errno .")" . $db->connect_error;
}

$Var1 = 99990049;
$Var3 = 'password123';



$sql = "select accountSalt, accountPassword from accountinfo where accountInfoID = '$Var1'";
$result = mysqli_query($db, $sql);
$info = mysqli_fetch_row($result);
$salt = $info[0];
$pass = $info[1];

$hashed = hash("sha256", $salt . $Var3);

if($hashed == $pass)
{
	echo "You passed";
}
else
{
	echo "You failed";
}


?>

