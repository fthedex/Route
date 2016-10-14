<?php
session_start();  //starting session module on the server , sessions won't work without this

/**
 * Created by PhpStorm.
 * User: Khalil
 * Date: 11/10/2016
 * Time: 08:37 ص
 */
// this function recieves 2 parms , the userInfoName which is the user to be validated with its password(userInfoPassword
//if they are valid and this acccount has the same password as the one sent to this function it will return true, other wise will return false
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

//TAKE IN MIND THE SCENARIO IS ONLY FIRED WHEN YOU DO SUBMIT AND LOGIN , HOW EVER THIS CONFIG FILE WILL NOT BE USED FOR EVERYPAGE

//if he does not have a cookie , it means he is logging-in for the first time or he deleted his browsing history including his cookies
if(!isset($_COOKIE['routeUsername'])&&!isset($_COOKIE['routePassword'])){ //means he is logging-in for the first time
    $username = $_POST['username'];        //$_POST ['username'] is the log in textbox in the login page
    $password = $_POST['password'];//$_POST ['username'] is the Passwordbox in the login page
   if(validInfoFromDb($username,$password)){       //if his information valid then we can do our operations
       // 1- set cookies for him with the $username and the $password
       // 2- log him into the system and connect him to the server by sessions.
       setcookie('routeUsername', $username, time() + (86400 * 30), "/"); // 86400 = 1 day     *Setting Cookies For him
       setcookie('routePassword', $password, time() + (86400 * 30), "/"); // 86400 = 1 day , this is bad but for testing

       $_SESSION["routeUsername"] = $username;           //linking him to the server , sessions must be used
       $_SESSION["routePassword"] = $password;           //because they are stored on the server and he has no access to them
       header("location:ControlPanel.php");   //redirect him to the control panel.
       exit();  //exit of this configuration page

   }
   else{
       //Invalid Info , we redirect him again to the log-in page with the err code 2 which means his information are invalid
       // and with the username so the system puts it again in the username textBox so the user does not have to write it again
      // echo "Please Enter Valid username and password!";
       header("location:Login.php?err=2&user=".$username);  //redirecting , using Get method!
       exit(); //exiting out of the page
   }

}

//Note that we won't be checking if he has a cookie , because it is literally impossible , why ?
// because anyone sees the login screen is going to be logging-in for the firs time , because the logout button
//will destroy the sessions as well as the cookies