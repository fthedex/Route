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
       echo "Welcome";
       header("location:ControlPanel.php");
       exit();

   }
   else{
       //Invalid Info
       echo "Please Enter Valid username and password!";
       header("location:Login.php?err=2&user=".$username);
       exit();
   }

}
else{  //if he is either logged in and has an active session or he came after his session got destroyed , we have to sync here

    if( !isset($_SESSION["routeUsername"])&&!isset($_SESSION['routePassword']) ){

        if(validInfoFromDb($_COOKIE['routeUsername'],$_COOKIE['routePassword'])){       //if his information valid then we can do our operations

            $_SESSION["routeUsername"] = $_COOKIE['routeUsername'];
            $_SESSION["routePassword"] = $_COOKIE['routePassword'];


        }
        else
        {
            echo "Please Login to the system again , cookies are not right.";   //cookie is incorrect
            header("location:Login.php?err=2&user=".$_COOKIE['routeUsername']);    // code 1= he is not found , 2 = wrong pass 3 = not found
            exit();
        }


    }
    else{  //user is online
        echo "user is online";
        header("location:ControlPanel.php");
        exit();
    }

} // bug when cookie and true user,pass is set and sessions is destroyed