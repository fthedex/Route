
<?php
require "user.php";
$globalUser = new user;
if($globalUser->loggedIn()==false){
    header("location:Login.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Route</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="Styles/Khalil.css">


    <?php
    if($globalUser->loggedIn()){
        if($globalUser->getUserType()=="1"){ //driver , we echo his map function , should accept markers (dynamic) soon to be developped

            include("driverHeadScripts.php");
        }
        else if($globalUser->getUserType()=="2"){ //parent
            include("parentHeadScripts.php");

        } //same for the parent
        else  //student
        {
            include("studentHeadScripts.php");

        }
    }
    ?>


</head>
<body>

<nav id="pageNav" style="padding-top:10px;margin: 0px;border-radius: 0px;border:none;background-color: rgb(10, 36, 64);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);min-height: 90px;" class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button style="background-color:  rgb(10, 36, 64);" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div style="margin-right:70px;margin-left:20px;width:40px;padding:0px;" class="boxShadowTransparent">
                <img class="fullWidth" src="logoCropped.png" />
            </div>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li style="min-height: 60px;" ><a class="shadowDagger" style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:7px;" href="/Route">HOME</a></li>

                <li style="min-height: 60px;"  ><a class="shadowDagger"  style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:7px;" href="/Route">CONTACT</a></li>
                <li style="min-height: 60px;" ><a class="shadowDagger" style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:7px;" href="ControlPanel.php">CONTROL PANEL</a></li>

                <li style="min-height: 60px;" ><a class="shadowDagger" style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:7px;" href="/Route">ABOUT US</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if($globalUser->loggedIn()){
                    echo "<li><p  style=\"color: yellow; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin:18px 12px 12px 12px;\" ><span class=\"glyphicon glyphicon-user\"></span> ".strtoupper($_SESSION['routeUsername'])."</p></li>";


                    echo "<li><a onmouseover=\"this.style.color='red'\" onmouseleave=\"this.style.color='white'\"style=\"color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:5px;\" href=\"logout.php\"><span class=\"glyphicon glyphicon-log-out\"></span> Logout</a></li>";
                }
                else
                    echo "<li><a onmouseover=\"this.style.color='#00bd0a'\" onmouseleave=\"this.style.color='white'\"style=\"color: white; font-family: 'Lobster', cursive; font-family: 'Anton', sans-serif;font-size:24px;margin-top:5px;\" href=\"Login.php\"><span class=\"glyphicon glyphicon-log-in\"></span> Login</a></li>";
                ?>
                <!--<li><a onmouseover="this.style.color='#00bd0a'" onmouseleave="this.style.color='white'"style="color: white; font-family: 'Lobster', cursive;
font-family: 'Anton', sans-serif;font-size:24px;margin-top:5px;" href="Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> -->
            </ul>
        </div>
    </div>

</nav>



<div style="padding:0px;" class="loginBody container-fluid">


    <?php

    echo "<p style='display:none;' id='ajaxJSON'>[[\"99\",\"-1\",\"-1\"]]</p>";
    if($globalUser->getUserType()=="3"){
        include("studentBody.php");
    }
    else if($globalUser->getUserType()=="1"){
        include("driverBody.php");

    }
    else if($globalUser->getUserType()=="2"){
        include("parentBody.php");

    }

    ?>




</div>


</body>


</html>