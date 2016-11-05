<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/5/2016
 * Time: 11:17 AM
 */

require "connection.php";
require "validation.php";

$userParm = $_POST['username'];
$passParm = $_POST['password'];

if(validInfoFromDb($userParm,$passParm)){
    echo "TRUE";
}
else
    echo "FALSE";
