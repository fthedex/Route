
<?php
session_start();
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
   <!-- <script src="Scripts/controlPanelEvents.js"></script> -->

    <?php
    if($globalUser->loggedIn()){
        if($globalUser->getUserType()=="1"){ //driver
            echo "<script>



function initMapDriver() {

    // Styles a map in night mode.

    var map = new google.maps.Map(document.getElementById('driverPanelBoard'), {
        center: {lat: 40.674, lng: -73.945},
        zoom: 12,
        styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
                featureType: 'administrative.locality',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
            },
            {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
            },
            {
                featureType: 'poi.park',
                elementType: 'geometry',
                stylers: [{color: '#263c3f'}]
            },
            {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{color: '#6b9a76'}]
            },
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#38414e'}]
            },
            {
                featureType: 'road',
                elementType: 'geometry.stroke',
                stylers: [{color: '#212a37'}]
            },
            {
                featureType: 'road',
                elementType: 'labels.text.fill',
                stylers: [{color: '#9ca5b3'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{color: '#746855'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{color: '#1f2835'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'labels.text.fill',
                stylers: [{color: '#f3d19c'}]
            },
            {
                featureType: 'transit',
                elementType: 'geometry',
                stylers: [{color: '#2f3948'}]
            },
            {
                featureType: 'transit.station',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
            },
            {
                featureType: 'water',
                elementType: 'geometry',
                stylers: [{color: '#17263c'}]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{color: '#515c6d'}]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.stroke',
                stylers: [{color: '#17263c'}]
            }
        ]
    });
}
</script>
";
        }
        else if($globalUser->getUserType()=="2"){ //parent
            echo "<script>



function initMapParents() {

    // Styles a map in night mode.

    var map = new google.maps.Map(document.getElementById('parentsPanelBoard'), {
        center: {lat: 40.674, lng: -73.945},
        zoom: 12,
        styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
                featureType: 'administrative.locality',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
            },
            {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
            },
            {
                featureType: 'poi.park',
                elementType: 'geometry',
                stylers: [{color: '#263c3f'}]
            },
            {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{color: '#6b9a76'}]
            },
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#38414e'}]
            },
            {
                featureType: 'road',
                elementType: 'geometry.stroke',
                stylers: [{color: '#212a37'}]
            },
            {
                featureType: 'road',
                elementType: 'labels.text.fill',
                stylers: [{color: '#9ca5b3'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{color: '#746855'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{color: '#1f2835'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'labels.text.fill',
                stylers: [{color: '#f3d19c'}]
            },
            {
                featureType: 'transit',
                elementType: 'geometry',
                stylers: [{color: '#2f3948'}]
            },
            {
                featureType: 'transit.station',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
            },
            {
                featureType: 'water',
                elementType: 'geometry',
                stylers: [{color: '#17263c'}]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{color: '#515c6d'}]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.stroke',
                stylers: [{color: '#17263c'}]
            }
        ]
    });
}
</script>
";
        }
        else  //student
        {

            echo "<script>



function initMapStudent() {

    // Styles a map in night mode.

    var map = new google.maps.Map(document.getElementById('studentPanelBoard'), {
        center: {lat: 40.674, lng: -73.945},
        zoom: 12,
        styles: [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
                featureType: 'administrative.locality',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
            },
            {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
            },
            {
                featureType: 'poi.park',
                elementType: 'geometry',
                stylers: [{color: '#263c3f'}]
            },
            {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{color: '#6b9a76'}]
            },
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#38414e'}]
            },
            {
                featureType: 'road',
                elementType: 'geometry.stroke',
                stylers: [{color: '#212a37'}]
            },
            {
                featureType: 'road',
                elementType: 'labels.text.fill',
                stylers: [{color: '#9ca5b3'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{color: '#746855'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{color: '#1f2835'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'labels.text.fill',
                stylers: [{color: '#f3d19c'}]
            },
            {
                featureType: 'transit',
                elementType: 'geometry',
                stylers: [{color: '#2f3948'}]
            },
            {
                featureType: 'transit.station',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
            },
            {
                featureType: 'water',
                elementType: 'geometry',
                stylers: [{color: '#17263c'}]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{color: '#515c6d'}]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.stroke',
                stylers: [{color: '#17263c'}]
            }
        ]
    });
}
</script>
";

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
<div id="panelItemsContainer" class="container-fluid padding20">

    <?php
    if($globalUser->loggedIn())
        if($globalUser->getUserType()=="1"){
        // driver
            echo "<div style='margin-left:37%;' class='controlPanelItem'>
        <div id='innnerMap' class='centerElement'>
            <span class='glyphicon glyphicon-map-marker'></span>
            <br>
            <p class='pGlobalFont'>Route(Map)</p>
        </div>


    </div>";
        }
        else if($globalUser->getUserType()=="2"){
            echo "<div style='margin-left:37%;' class='controlPanelItem'>
        <div id='innerShowBusesFamily' class='centerElement'>
            <span class='glyphicon glyphicon-bed'></span>
            <br>
            <p class='pGlobalFont textAlignCenter'>Children maps</p>
        </div>
    </div>";

        }
        else{
            echo " <div style='margin-left:37%;' id='showMapStudent' class='controlPanelItem'>
        <div id='innerShowBusStudent' class='centerElement'>
            <span class='glyphicon glyphicon-bed'></span>
            <br>
            <p class='pGlobalFont textAlignCenter'>Your map</p>
        </div>
    </div>";
        }

    ?>





</div>



    <?php
    if($globalUser->loggedIn()){

       if($globalUser->getUserType()=="1"){  //driver

           echo "<div class='container-fluid backColorGrey padding10'>
        <div class='container'>


            <div style='margin: 7px;' class='col-sm-6 backRgbaOnBlacks boxShadow'>
<br>
                <label class='pGlobalFont' for='studentsList'>Students: </label>

                <select class='boxShadow' id='studentsList' name='studentsList'>
                    <option value='australia'>Mohammed Khalil</option>
                    <option value='canada'>Mohammed Ayyad</option>

                </select>
<br><br><br><br>


                <div class='submitDiv'>Check</div>
                <br>
<br><br>
                <div class='padding20 '>
<p  class='pGlobalFont textAlignCenter'>Students Taken: 25</p>
                    <p class='pGlobalFont textAlignCenter'>Students Left: 40</p>
                    <p style='color:red;margin-bottom: 23px;' class='pGlobalFont textAlignCenter textShadow'>Time: 11:45 PM</p>






                </div>

            </div>

            <div style=\"margin: 7px;padding: 0px;\" id=\"driverPanelBoard\" class=\"col-sm-5 boxShadow\"> <!-- MAP Container-->



            </div>


        </div>

    </div>";
        } //End of driver Permissions , NEEDS CODING!

    }



    ?>


</div>

<?php
if($globalUser->loggedIn()) {
    if ($globalUser->getUserType() == "1")  //driver
        echo "<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBcacGx1xEtAaYseE0M9Q3VAy5xx3bVtl0&callback=initMapDriver'
        async defer></script>";
    else if ($globalUser->getUserType() == "2") { //parent
        echo "<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBcacGx1xEtAaYseE0M9Q3VAy5xx3bVtl0&callback=initMapParents'
        async defer></script>";
    } else {
        echo "<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBcacGx1xEtAaYseE0M9Q3VAy5xx3bVtl0&callback=initMapStudent'
        async defer></script>";
    }
}
?>


</body>


</html>