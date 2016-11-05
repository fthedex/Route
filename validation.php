<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/5/2016
 * Time: 11:37 AM
 */

function validInfoFromDb($userInfoName,$userInfoPassword){



    $db = Database::getConnection();


    $sql = "SELECT username, password FROM userinfo WHERE username='$userInfoName'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {

            if($row['password']==$userInfoPassword){

                return true;
            }
            else{

                return false;

            }
        }
    } else {
 //not found


    }
    return false;


}
