<?php
session_start();
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

    ?>

</head>
<body>
<?php


if(isset($_SESSION['routeUsername'])&&isset($_SESSION['routePassword'])){

    header("location:ControlPanel.php");
    exit();
}
else{
 // if cookie is set but session destroyed , u gotta check if cookie is right and redirect him!

    if(isset($_COOKIE['routeUsername'])&&isset($_COOKIE['routePassword'])){ //means he is logging-in for the first time
        $username = $_COOKIE['routeUsername'];
        $password = $_COOKIE['routePassword'];
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
            header("location:Login.php");
            exit();
        }

    }

}



?>


<nav id="pageNav" style="z-index: 99;position:fixed;width:100%;padding-top:10px;margin: 0px;border-radius: 0px;border:none;background-color: rgb(10, 36, 64);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);min-height: 90px;" class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button style="background-color:  rgb(10, 36, 64);" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a  style="color:rgb(8,134,202);margin-right:50px;margin-bottom: 12px;"
                class="navbar-brand webSiteNameFont" href="/Route">Route</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li style="min-height: 64px;" ><a class="shadowDagger" style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:7px;" href="/Route">HOME</a></li>

                <li style="min-height: 64px;"  ><a class="shadowDagger"  style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:7px;" href="/Route">CONTACT</a></li>
                <li style="min-height: 64px;" ><a class="shadowDagger" style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:7px;" href="ControlPanel.php">CONTROL PANEL</a></li>

                <li style="min-height: 64px;" ><a class="shadowDagger" style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:7px;" href="/Route">ABOUT US</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a onmouseover="this.style.color='#00bd0a'" onmouseleave="this.style.color='white'"style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:5px;" href="Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </div>

</nav>

<br><br><br> <br>

<div class="loginBody container-fluid padding20">
<br><br><br>
    <form action="config.php" method="post">
    <div class="loginContainer padding10 textAlignCenter">

        <p style="display:inline-block;" class="webSiteNameFont">Route<br></p>
        <p class="pGlobalFont">Account Authentication:<br></p><hr>
        <label  class="pGlobalFont floatLeft" for="username">USERNAME:</label>
        <?php

        if(count($_GET)>1){   //if in the parameters we have more than one which will be exactly two
            if($_GET['err']==2){  //if his information are valid then keep the username for him and give him another try
echo "<input required type='text' id='username' name='username' minlength='5' maxlength='14' value=".$_GET['user'].">";
            }}
        else{
            echo "<input required type='text' id='username' name='username' minlength='5' maxlength='14'>";
        }

        ?>

<br>
        <label  class="pGlobalFont floatLeft" for="username">PASSWORD:</label>
        <input required type="password" id="password" name="password" minlength="5" maxlength="30">

        <br>
        <?php

        if(count($_GET)>0){
        if($_GET['err']==2){ //if his information are invalid give him an error message
            echo "<p style='color:red;' class='pGlobalFont'>Invalid Information</p>";
        }}
        ?>
        <input type="submit" value="Login">
    </div>
    </form>
    
</div>


</body>


</html>