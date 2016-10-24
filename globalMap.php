<!--
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 10/24/2016
 * Time: 4:43 PM
 */ -->

<!DOCTYPE html>
<html>
<head>
    <title>Route</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="icon" href="newpic.png">

    <script   src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        #map {
            height: 100%;
        }


    </style>

    <script>



        function getOnlineBusesAJAX(){            //Communicating with database using AJAX.

            $.ajax({
                method: 'GET',
                data: {}
            })
                .done(function (data) {
                    $('#ajaxJSON').html(data);      //when ajax completes it assigns the data to a hidden element in the document
                                                    //because we get the innerHTML of that element when ever we need the locations


                });

        }


        function getOnlineBuses() {

            getOnlineBusesAJAX();          //Every time this method is called it updates the Element containing buses

            var onlineBuses = document.getElementById('ajaxJSON').innerHTML;   //we assign the buses so we can parse the text into an array(JSON

            var busesArray =  JSON.parse(onlineBuses);     //Parsing TEXT into a JSON(Normal Array)


            return busesArray;  //returning the array
        }



    </script>
</head>
<body>

<p style="display:none;" id="ajaxJSON">[["BUS0","-1","-1"]]</p>  <!-- The Element that our buses will be stored at! BUS0 is a default value -->

<div id="map"></div> <!-- Map Div -->

<script>
    var MainMap;  //the main map of buses
    var markers = {}; //hash of buses that will be put on the map



    var BusesLocations = getOnlineBuses(); //Assigning current buses in database to BusesLocations


    function addMarker(location,title) {  //Adding a bus to the map , and to markers hash
        var marker = new google.maps.Marker({
            position: location,
            map: MainMap,
            title: title,
            icon: "bus2ico.png",


        });
        markers[title]=marker;

    }

    function setMapOnAll(map) {   //method so we can set the markers hash to a map ( could be used to delete markers if we use null map)
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    function setMapOnOne(map,key) {    //links a bus to a map
        markers[key].setMap(map);
    }

    function clearMarkers() {  //clears all markers (buses) by putting null and using the method mentioned before
        setMapOnAll(null);
    }

    function clearOneMarker(key) {  //deleting a bus on the map by passing the ID of that bus
        setMapOnOne(null,key);
    }

    function showMarkers() {   //showing all buses in markers hash
        setMapOnAll(MainMap);
    }

    function deleteMarkers() {    //deleting all buses on the map
        clearMarkers();
        markers = {};
    }

    function addMarkersFirstLoad(){ //adding all buses on load , just getting from database using ajax and putting every bus on the map
//BusesLocations is already initialized top with database buses

        for(var i=0;i<BusesLocations.length;i++){  //HASH[0] = [["BUS1",""LNG##,"LAT##"]] , HASH[1] = [["BUS2",""LNG##,"LAT##"]]

//looping through the buses in database

            var Loc = {lat: parseFloat(BusesLocations[i][2]), lng: parseFloat(BusesLocations[i][1])} //bus position
            var title = BusesLocations[i][0]; //title will be bus ID

            addMarker(Loc,title); //adding to buses global array (hash)

        }
    }

    function addMarkersTimerLoad(){ //this method is for the timer to be called every # seconds

        var inTrack = {};  //any thing gets added or updated means still in track , will be used to remove anything that is not in track

        for(var i=0;i<BusesLocations.length;i++){
            var key = BusesLocations[i][0]; //BUS ID
            inTrack[key]=true; //ASSIGN THAT THIS BUS(KEY) IS TAKEN (
            if(markers[key]==undefined){ //if this bus isn't already in the map (buses global array) then put it

                var Loc = {lat: parseFloat(BusesLocations[i][2]), lng: parseFloat(BusesLocations[i][1])} //bus position
                var title = BusesLocations[i][0]; //bus title (busID)
                addMarker(Loc,title); //adding it to buses array

            }
            else //if its already in the map , update the location only
            {
                markers[key].setPosition({lat: parseFloat(BusesLocations[i][2]), lng: parseFloat(BusesLocations[i][1])});
                //set position updates the location of a marker(bus) on the map.
            }

        }



        //removing buses not in track

        var keys = Object.keys(markers); //we here get all markers on the map (keys)

        for(var j=0;j<keys.length;j++){ //looping through all markers

            if(inTrack[keys[j]]!=true){ //if one bus(marker) isn't in track , as we said before , it must be removed
                clearOneMarker(keys[j]); //we use method clear marker from the map(still in memory)
                delete markers[keys[j]]; //simply delete that value from hash , (memory)
            }
        }

    }


    function initMap() {

        MainMap = new google.maps.Map(document.getElementById('map'), {  //our main map attributes
            center: {lat: 31.9566, lng: 35.9457}, //map center
            zoom: 8, //zoom value
            styles: [{"featureType":"water","stylers":[{"color":"#19a0d8"}]},{"featureType":"administrative","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"},{"weight":6}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#e85113"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efe9e4"},{"lightness":-40}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#efe9e4"},{"lightness":-20}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"lightness":100}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"lightness":-100}]},{"featureType":"road.highway","elementType":"labels.icon"},{"featureType":"landscape","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"landscape","stylers":[{"lightness":20},{"color":"#efe9e4"}]},{"featureType":"landscape.man_made","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"lightness":100}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"lightness":-100}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"hue":"#11ff00"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"lightness":100}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"hue":"#4cff00"},{"saturation":58}]},{"featureType":"poi","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#f0e4d3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#efe9e4"},{"lightness":-25}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#efe9e4"},{"lightness":-10}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"simplified"}]}]
            //styles of the map
        });

        //add every bus in database , AJAX is called before no need to call it again here
        addMarkersFirstLoad();

        setTimeout(function(){  }, 1300); //we wait # seconds because we just got the data
        setInterval(function(){ //database AJAX communication every # seconds



            BusesLocations= getOnlineBuses(); //re-assigning (updating) the old values from the database
            addMarkersTimerLoad(); //update markers of the map with the new BusesLocations Array.


        }, 1300);







    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2IY7bt6uTYoxCkbiru1lex6VDFQblc4c&callback=initMap"
        async defer></script>
</body>
</html>