<?php

/**
 * Created by PhpStorm.
 * User: Khalil
 * Date: 14/10/2016
 * Time: 11:43 ص
 */



class user
{

    public $username;
    public $passwordHash;
    public $fullName;
    public $userType;
    public $logged_in;

    function __construct()
    {

        require 'connection.php';
        session_start();


        if(isset($_SESSION['routeUsername'])&&isset($_SESSION['routePassword'])){  //is he logged in ?
            $this->logged_in=true;
            $this->username=$_SESSION['routeUsername'];      //initialize session server data to client data
            $this->passwordHash = $_SESSION['routePassword'];
            $this->fullName = $_SESSION['routeFullName'];
            $this->userType = $_SESSION['routeUserType'];





        }
        else if(isset($_COOKIE['routeUsername'])&&isset($_COOKIE['routePassword'])){   //if he has cookies but his session was destroyed , do this

            // 1- validate his cookies because it might be wrong!
            // 2- if his info are valid then you can connect the person to the server with his cookie values to the session and initilize the class values
            $tempUser = $_COOKIE['routeUsername'];
            $tempPassword = $_COOKIE['routePassword'];


            //if his data valid then we can simply put that into a user sessions if not he isnt logged in!
            if($this->validInfoFromDb($tempUser,$tempPassword)){

                $data = $this->getDataRow($tempUser);

               $this->username = $_SESSION['routeUsername']=$data['username'];
               $this->passwordHash = $_SESSION['routePassword']=$data['password'];
               $this->fullName = $_SESSION['routeFullName'] = $data['name'];
               $this->userType = $_SESSION['routeUserType']  = $data['accType'];
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
    //gets a data row for a specific user!
    function getDataRow($userInfoName){

        $row = null;
        $db = Database::getConnection();
        $sql = "SELECT * FROM userinfo WHERE username='$userInfoName'";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();

        } else {
            echo "0 results";


        }

        return $row;
    }
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
          //  echo "0 results";


        }
        return false;


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




