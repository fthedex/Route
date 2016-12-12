<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/7/2016
 * Time: 8:27 AM
 */

function getDataRow($userInfoName){

    $row = null;


    $db = Database::getConnection();



    $sql = "SELECT * FROM accountinfo WHERE accountInfoID='$userInfoName'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();


    } else {
        echo "0 results";


    }

    return $row;

}

