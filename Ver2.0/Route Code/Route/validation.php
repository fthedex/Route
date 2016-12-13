<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/5/2016
 * Time: 11:37 AM
 */

function validInfoFromDb($userInfoName,$userInfoPassword){



    $db = Database::getConnection();

    if($db->connect_errno)
{
	echo "Failed to connect to MYSQL: (". $db->connect_errno .")" . $db->connect_error;
}

    $sql = "select accountInfoID, accountType, accountSalt, accountPassword from accountinfo where accountInfoID ='$userInfoName'";
    //$result = $db->query($sql);

    $result = mysqli_query($db, $sql);
    $info = mysqli_fetch_row($result);

    $salt = $info[2];
    $pass = $info[3];
    
    $hashed = hash("sha256", $salt . $userInfoPassword);


	if($pass==$hashed){

                return true;
            }
            else{

                return false;

            }


}


