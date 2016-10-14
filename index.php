
<?php
session_start();
require "user.php";
$globalUser = new user;

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



</head>

<body>



<form>
<div>

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
                    if($globalUser->logged_in){
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

    <br><br><br> <br>

  <!--  <img class="fullWidth" src="Images/blueNotBlured2.png" /> -->

    <div class="parallexWithImage">

    </div>

    <div class="container-fluid contactDiv">
        <div class="col-sm-6">
            <p class="pHeader">ABOUT US<br><hr></p>
<p class="pGlobalFont">The School Bus Tracking System is a new system that replaces the current manual process for determining the bus route, spending a human resource or more just for writing down the address of every student and the route for that address, <br><br>however it may not be 100% accurate and may cause problems regarding the process. The system will automatically determine the route for that bus depending on the information given by the students and their families, choosing the best way that the bus driver will use in order to reach the students in a faster, <br><br>more accurate way, no help from the HR department is  needed.
    It is also visualized, anyone can see where the buses are, the students are monitored and the families are in contact, in addition to this students will be tracked as soon as they get into the bus, that means they are fully monitored by families and authorized employees. more features could be added in the next releases.<br><br> For more information please contact one of the following emails:<br>1- Fthedex@gmail.com<br>2- mohammedayyad25@gmail.com<br></p>
        </div>
        <div class="col-sm-6">
            <p class="pHeader">CONTACT US<br><hr></p>
            <p class="pGlobalFont">You can also contact us by submitting the following form.</p>
            <form action="action_page.php">
        <div class="col-sm-6">
            <label class="pGlobalFont" for="fname">First Name:</label>
            <input type="text" id="fname" name="firstname">

        </div>
            <div class="col-sm-6">

                <label class="pGlobalFont" for="lname">Last Name:</label>
                <input type="text" id="lname" name="lastname">

            </div>

                <div class="col-sm-12">
                <label class="pGlobalFont" for="country">Governorate: </label>
                <select id="country" name="country">
                    <option value="australia">Amman</option>
                    <option value="canada">Aqaba</option>
                    <option value="usa">Irbid</option>
                </select>
                    <label class="pGlobalFont" for="company">Company:</label>
                    <input type="text" id="company" name="company">

                    <label class="pGlobalFont" for="information">More Information:</label>
                    <textarea id="information" rows="4" cols="50"></textarea>

                <input type="submit" value="Submit">
                    </div>


            </form>
<!--

-->

        </div>
        </div>

    </div>


    </form>
<div class="parallexWithImage">

</div>
</body>
</html>