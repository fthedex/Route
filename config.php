<?php
session_start();

/**
 * Created by PhpStorm.
 * User: Khalil
 * Date: 11/10/2016
 * Time: 08:37 ص
 */

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

if(!isset($_COOKIE['routeUsername'])&&!isset($_COOKIE['routePassword'])){ //means he is logging-in for the first time
    $username = $_POST['username'];
    $password = $_POST['password'];
   if(validInfoFromDb($username,$password)){       //if his information valid then we can do our operations
       setcookie('routeUsername', $username, time() + (86400 * 30), "/"); // 86400 = 1 day
       setcookie('routePassword', $password, time() + (86400 * 30), "/"); // 86400 = 1 day , this is bad but for testing

       $_SESSION["routeUsername"] = $username;
       $_SESSION["routePassword"] = $password;


   }
   else{
       echo "Please login in order to continue!";
       header("location:Login.php");
       exit();
   }

}
else{  //if he is either logged in and has an active session or he came after his session got destroyed , we have to sync here

    if( !isset($_SESSION["routeUsername"])&&!isset($_SESSION['routePassword']) ){

        if(validInfoFromDb($username,$password)){       //if his information valid then we can do our operations

            $_SESSION["routeUsername"] = $username;
            $_SESSION["routePassword"] = $password;


        }
        else
        {
            echo "Please Login to the system.";   //cookie is incorrect
            header("location:Login.php");
            exit();
        }

        header("location:main_login.html");
        exit();
    }
    else{  //user is online
        echo "user is online";
    }

}