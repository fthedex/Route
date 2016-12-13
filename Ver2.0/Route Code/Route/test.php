<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Waypoints in directions</title>
    <style>
        #right-panel {
            font-family: 'Roboto','sans-serif';
            line-height: 30px;
            padding-left: 10px;
        }

        #right-panel select, #right-panel input {
            font-size: 15px;
        }

        #right-panel select {
            width: 100%;
        }

        #right-panel i {
            font-size: 12px;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
            float: left;
            width: 70%;
            height: 100%;
        }
        #right-panel {
            margin: 20px;
            border-width: 2px;
            width: 20%;
            height: 400px;
            float: left;
            text-align: left;
            padding-top: 0;
        }
        #directions-panel {
            margin-top: 10px;
            background-color: #FFEE77;
            padding: 10px;
        }
    </style>
</head>
<body>
<div id="map"></div>
<div id="right-panel">
    <div>

        <input type="submit" id="submit">
    </div>
    <div id="directions-panel"></div>
</div>
<script>
    function initMap() {
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: {lat: 31.3265, lng: 35.3266}
        });
        directionsDisplay.setMap(map);

        document.getElementById('submit').addEventListener('click', function() {
            calculateAndDisplayRoute(directionsService, directionsDisplay);
        });
    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {


        var waypts = [];
        waypts.push({
            location: new google.maps.LatLng(31.9774332,35.8456162),
            stopover: true
        });

        waypts.push({
            location: new google.maps.LatLng(31.9805839,35.8400952),
            stopover: true
        });

        waypts.push({
            location: new google.maps.LatLng(31.9744539,35.867201),
            stopover: true
        });




        directionsService.route({
            origin: new google.maps.LatLng(31.9774332,35.8456162),
            destination: new google.maps.LatLng(31.9744539,35.867201),
            waypoints: waypts,
            optimizeWaypoints: true,
            travelMode: 'DRIVING'
        }, function(response, status) {
            if (status === 'OK') {
                directionsDisplay.setDirections(response);

            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }
</script>

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcacGx1xEtAaYseE0M9Q3VAy5xx3bVtl0&callback=initMap">
</script>
</body>
</html>