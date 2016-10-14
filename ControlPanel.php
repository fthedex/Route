
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
    <script src="Scripts/controlPanelEvents.js"></script>


</head>
<body>

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

                $conn->close();
                return true;
            }
            else{

                $conn->close();
                return false;

            }
        }
    } else {
        // 0 results


    }
    return false;
    $conn->close();

}
$logged_in=false;
if(isset($_SESSION['routeUsername'])&&isset($_SESSION['routePassword'])){
    $logged_in=true;


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
            $logged_in=true;

        }
        else{
//Invalid Info
            header("location:Login.php");
            exit();
        }

    }
    else{
        header("location:Login.php");
        exit();
    }

}
?>
<nav id="pageNav" style="padding-top:10px;margin: 0px;border-radius: 0px;border:none;background-color: rgb(10, 36, 64);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);min-height: 90px;" class="navbar navbar-inverse">
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
                if($logged_in){
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
<div id="panelItemsContainer" class="container-fluid padding20">

    <?php
    if($logged_in){
        
    }
    ?>
    <div class="controlPanelItem">
        <div id="innnerMap" class="centerElement">
            <span class="glyphicon glyphicon-map-marker"></span>
            <br>
            <p class="pGlobalFont">Route(Map)</p>
        </div>


    </div>


    <div id="showMapStudent" class="controlPanelItem">
        <div id="innerShowBusStudent" class="centerElement">
            <span class="glyphicon glyphicon-bed"></span>
            <br>
            <p class="pGlobalFont textAlignCenter">Your map</p>
        </div>
    </div>

    <div class="controlPanelItem">
        <div id="innerShowBusesFamily" class="centerElement">
            <span class="glyphicon glyphicon-bed"></span>
            <br>
            <p class="pGlobalFont textAlignCenter">Children maps</p>
        </div>
    </div>



</div>
    <div style="padding: 0px;" id="studentPanelBoard" class="container-fluid boxShadow"></div>


</div>

<?php
if(true)
    echo "<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBcacGx1xEtAaYseE0M9Q3VAy5xx3bVtl0&callback=initMapStudent'
        async defer></script>"
?>


</body>


</html>