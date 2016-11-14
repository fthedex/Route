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
        require 'gettersDb.php';
        require 'validation.php';
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
            if(validInfoFromDb($tempUser,$tempPassword)){

                $data = getDataRow($tempUser);

               $this->username = $_SESSION['routeUsername']=$data['accountInfoID'];
               $this->passwordHash = $_SESSION['routePassword']=$data['accountPassword'];
               $this->fullName = $_SESSION['routeFullName'] = "NA";
               $this->userType = $_SESSION['routeUserType']  = $data['accountType'];
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




