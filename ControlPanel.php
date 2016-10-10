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
<nav id="pageNav" style="padding-top:10px;margin: 0px;border-radius: 0px;border:none;background-color: rgb(10, 36, 64);box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);min-height: 90px;" class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button style="background-color:  rgb(10, 36, 64);" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a  style="color:rgb(8,134,202);margin-right:50px;margin-bottom: 12px;"
                class="navbar-brand webSiteNameFont" href="#">Route</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li style="min-height: 60px;" ><a class="shadowDagger" style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:7px;" href="#">HOME</a></li>

                <li style="min-height: 60px;"  ><a class="shadowDagger"  style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:7px;" href="#">CONTACT</a></li>
                <li style="min-height: 60px;" ><a class="shadowDagger" style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:7px;" href="#">CONTROL PANEL</a></li>

                <li style="min-height: 60px;" ><a class="shadowDagger" style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:7px;" href="#">ABOUT US</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a onmouseover="this.style.color='#00bd0a'" onmouseleave="this.style.color='white'"style="color: white; font-family: 'Lobster', cursive;
    font-family: 'Anton', sans-serif;font-size:24px;margin-top:5px;" href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </div>

</nav>

<div style="padding:0px;" class="loginBody container-fluid">
<div id="panelItemsContainer" class="container-fluid padding20">


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
    <div style="padding: 0px;" id="panelBoard" class="container-fluid boxShadowTransparent"></div>


</div>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2IY7bt6uTYoxCkbiru1lex6VDFQblc4c&callback=initMapStudent"
        async defer></script>

</body>


</html>