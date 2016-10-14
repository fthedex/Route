<?php

/**
 * Created by PhpStorm.
 * User: Khalil
 * Date: 14/10/2016
 * Time: 11:43 ص
 */
class user
{

    var $username;
    var $passwordHash;
    var $fullName;
    var $userType;
    var $logged_in;

    function __construct()
    {

        if(isset($_SESSION['routeUsername'])){
            $this->logged_in=true;
            $this->username=$_SESSION['routeUsername']['username'];
            $this->passwordHash = $_SESSION['routeUsername']['password'];
            $this->fullName = $_SESSION['routeUsername']['name'];
            $this->userType = $_SESSION['routeUsername']['type'];

        }
        else if(isset($_COOKIE['routeUsername'])){
            $tempUser = $_COOKIE['routeUsername']['username'];
            $tempPassword = $_COOKIE['routeUsername']['password'];

            if($this->validInfoFromDb($tempUser,$tempPassword)){
               $this->username = $_SESSION['routeUsername']['username']=$_COOKIE['routeUsername']['username'];
               $this->passwordHash = $_SESSION['routeUsername']['password']=$_COOKIE['routeUsername']['password'];
               $this->fullName = $_SESSION['routeUsername']['name'] = $_COOKIE['routeUsername']['name'];
               $this->userType = $_SESSION['routeUsername']['type']  = $_COOKIE['routeUsername']['type'];
               $this->logged_in=true;

            }
            else
                $this->logged_in=false;  //invalid info

        }
        else
        {
            $this->logged_in=false; //he does not have any sessions , cookies..
        }

    }

    function validInfoFromDb($userInfoName,$userInfoPassword){


        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "routedb";

// Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT username, password FROM userinfo WHERE username='$userInfoName'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {

                if($row['password']==$userInfoPassword){
                    echo "TRUE";
                    $conn->close();
                    return true;
                }
                else{
                    echo "FALSE";
                    $conn->close();
                    return false;

                }
            }
        } else {
            echo "0 results";


        }
        return false;
        $conn->close();

    }

    function getUsername(){
        return $this->username;
    }

    function getPasswordHash(){
        return $this->passwordHash;
    }

    function fullName(){
        return $this->fullName;
    }

    function getUserType(){
        return $this->userType;
    }

    function loggedIn(){
        return $this->logged_in;
    }

}