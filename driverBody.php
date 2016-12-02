<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/14/2016
 * Time: 2:07 PM
 */

echo "<p style='display:none;' id='studentsHiddenLocations'>".getAwaitingLocations($globalUser->getUsername())."</p>
<script>
   var MainMap;  //the main map of buses
    var markers = {}; //hash of buses that will be put on the map
var studentsMarkers = {};
    var studentsLocations = getStudentsLocations(); //Assigning current buses in database to BusesLocations
    
    
    var BusesLocations = getOnlineBuses(); //Assigning current buses in database to BusesLocations


function alertstudentBusLocation(){

    var directionsService = new google.maps.DirectionsService;  //google maps routing libraries
    var directionsDisplay = new google.maps.DirectionsRenderer;
    
    directionsDisplay.setMap(MainMap);  //set routing map to MainMap

    var waypts = [];  //students markers to pass to route api

    var keysStudents = Object.keys(studentsMarkers); //hashes of students in order to put in way points
    var driverKey = Object.keys(markers);   //driver hash to put source of route
    
   
    
    busLng = markers[driverKey[0]].getPosition().lng();
    busLat = markers[driverKey[0]].getPosition().lat();


   for(var j=0;j<keysStudents.length;j++){ //looping through all markers
   
  var studentLng = studentsMarkers[keysStudents[j]].getPosition().lng();  //transferring from studentsMarkers to ways array 
  var studentLat = studentsMarkers[keysStudents[j]].getPosition().lat()   //transferring will be passed to route API
   
    waypts.push({
            location: new google.maps.LatLng(studentLat, studentLng),    //transferring
            stopover: true
        });
       

  
  }

  var studentsHashesSize = keysStudents.length;                 //to know the last students in the hashes (destination)
  var lastStudentLng =  studentsMarkers[keysStudents[studentsHashesSize-1]].getPosition().lng();
  var lastStudentLat =  studentsMarkers[keysStudents[studentsHashesSize-1]].getPosition().lat();

  //we need last student info because we need a destination for our route!
  
        directionsService.route({   //route settings 
            origin: new google.maps.LatLng(busLat, busLng), //will be the bus location
            destination: new google.maps.LatLng(lastStudentLat, lastStudentLng), //the last student
            waypoints: waypts, //all students
            optimizeWaypoints: true, //optimizing route
            travelMode: 'DRIVING' //traveling method which is driving in our scenario
        }, function(response, status) {
            if (status === 'OK') {
                directionsDisplay.setDirections(response);

            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
        
        
 }
    
     function addMarker(location,title) {  //Adding a bus to the map , and to markers hash
        var marker = new google.maps.Marker({
            position: location,
            map: MainMap,
            title: title,
            icon: \"studentMarker.png\",


        });
studentsMarkers[title]=marker;
    }
    
        function addMarkerBus(location,title) {  //Adding a bus to the map , and to markers hash
        var marker = new google.maps.Marker({
            position: location,
            map: MainMap,
            title: title,
            icon: \"bus2ico.png\",


        });
        markers[title]=marker;

    }
    
        function setMapOnAll(map) {   //method so we can set the markers hash to a map ( could be used to delete markers if we use null map)
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }
    
    function setMapCenter(methodLocation){
       MainMap.setCenter(methodLocation)
    
    }

    function setMapOnOne(map,key) {    //links a bus to a map
        markers[key].setMap(map);
    }
    
        function setMapOnOneStudent(map,key) {    //links a bus to a map
        studentsMarkers[key].setMap(map);
    }

    function clearMarkers() {  //clears all markers (buses) by putting null and using the method mentioned before
        setMapOnAll(null);
    }

    function clearOneMarker(key) {  //deleting a bus on the map by passing the ID of that bus
        setMapOnOne(null,key);
    }
    
    function clearOneMarkerStudent(key) {  //deleting a bus on the map by passing the ID of that bus
        setMapOnOneStudent(null,key);
    }

    function showMarkers() {   //showing all buses in markers hash
        setMapOnAll(MainMap);
    }

    function delNotBugged(key){
    
       studentsMarkers[key].setMap(null);
   

    }
    
    function deleteMarkers() {    //deleting all buses on the map
        clearMarkers();
        markers = {};
    }
    
        function addMarkersFirstLoad(){ //adding all buses on load , just getting from database using ajax and putting every bus on the map
//BusesLocations is already initialized top with database buses

        for(var i=0;i<studentsLocations.length;i++){  

//looping through the buses in database

            var Loc = {lat: parseFloat(studentsLocations[i][2]), lng: parseFloat(studentsLocations[i][1])} //bus position
            var title = studentsLocations[i][0]; //title will be bus ID

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
                addMarkerBus(Loc,title); //adding it to buses array
                if(centerDriverBus)
            setMapCenter({lat: parseFloat(BusesLocations[i][2]), lng: parseFloat(BusesLocations[i][1])});

            }
            else //if its already in the map , update the location only
            {
                markers[key].setPosition({lat: parseFloat(BusesLocations[i][2]), lng: parseFloat(BusesLocations[i][1])});
                if(centerDriverBus)
                setMapCenter({lat: parseFloat(BusesLocations[i][2]), lng: parseFloat(BusesLocations[i][1])});

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
    
        function initMapDriver() {

        MainMap = new google.maps.Map(document.getElementById('driverPanelBoard'), {  //our main map attributes
            center: {lat: 31.9566, lng: 35.9457}, //map center
            zoom: 6, //zoom value
            styles: [{\"featureType\":\"water\",\"stylers\":[{\"color\":\"#19a0d8\"}]},{\"featureType\":\"administrative\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"#ffffff\"},{\"weight\":6}]},{\"featureType\":\"administrative\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"#e85113\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#efe9e4\"},{\"lightness\":-40}]},{\"featureType\":\"road.arterial\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#efe9e4\"},{\"lightness\":-20}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"lightness\":100}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"lightness\":-100}]},{\"featureType\":\"road.highway\",\"elementType\":\"labels.icon\"},{\"featureType\":\"landscape\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"landscape\",\"stylers\":[{\"lightness\":20},{\"color\":\"#efe9e4\"}]},{\"featureType\":\"landscape.man_made\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"lightness\":100}]},{\"featureType\":\"water\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"lightness\":-100}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"hue\":\"#11ff00\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"lightness\":100}]},{\"featureType\":\"poi\",\"elementType\":\"labels.icon\",\"stylers\":[{\"hue\":\"#4cff00\"},{\"saturation\":58}]},{\"featureType\":\"poi\",\"elementType\":\"geometry\",\"stylers\":[{\"visibility\":\"on\"},{\"color\":\"#f0e4d3\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#efe9e4\"},{\"lightness\":-25}]},{\"featureType\":\"road.arterial\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#efe9e4\"},{\"lightness\":-10}]},{\"featureType\":\"poi\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"simplified\"}]}]
            //styles of the map
        });

        //add every bus in database , AJAX is called before no need to call it again here
        addMarkersFirstLoad();

        setInterval(function(){ //database AJAX communication every # seconds



            BusesLocations= getOnlineBuses(); //re-assigning (updating) the old values from the database
            addMarkersTimerLoad(); //update markers of the map with the new BusesLocations Array.




        }, 200);







    }
    
    
var interval = null;
interval = setInterval(updateDiv,200);           

function updateDiv(){              //keep checking for the students as well as the driver if they are loaded 
var driverKey = Object.keys(markers); 
var keysStudents = Object.keys(studentsMarkers);

if(markers[driverKey[0]]!=undefined && studentsMarkers[keysStudents[0]]!=undefined){//if yes: we can now draw the route

alertstudentBusLocation();
clearInterval(interval); //stop the interval because we did draw the route!
}
}

/*
setTimeout(function(){
clearInterval(interval);
alert('stopped interval!');
},5000);*/

</script>

        <div id='panelItemsContainer' class='container-fluid padding20'>


<div class='controlPanelItem'>
        <div class='textAlignCenter' id='innnerMap'>
            <span class='glyphicon glyphicon-map-marker'></span>
            <br>
            <p class='pGlobalFont'>Route(Map)</p>
        </div>


    </div>
    
    </div>
    
    <div class='container-fluid backColorGrey padding10'>
        <div class='container'>


            <div style='margin: 7px;min-height: 456px;' class='col-sm-6 backRgbaOnBlacks boxShadow'>
<br><br><br><br>
<div class='padding10 borderSmall'>
                <label class='pGlobalFont' for='studentsList'>Students: </label>

                <select class='boxShadow' id='studentsList' name='studentsList'>".getAwaitingAsOptions($globalUser->getUsername())."

</select>
                <div id='checkButton' onclick='removeSelectedElementFromDB();removeFromMap();removeFromList();' class='submitDiv'>Check</div>
              

                <div class='padding20 '>

                    <p id='date' style='color:red;margin-bottom: 23px;' class='pGlobalFont textAlignCenter textShadow'>Time:".getDatePhp()."
             
</p>

</div>

 




                </div>
                
           
                                 <div class='centeringContainer'>
   <div class=\"onoffswitch\">
    <input onchange='alertUserCheck();' type=\"checkbox\" name=\"onoffswitch\" class=\"onoffswitch-checkbox\" id=\"centeringOnOff\" checked>
    <label class=\"onoffswitch-label\" for=\"centeringOnOff\"></label>
</div>
</div>

<p class='centeringP'>Centering ON/OFF.</p>


            </div>
            
            


            <div style=\"margin: 7px;padding: 0px;\" id=\"driverPanelBoard\" class=\"col-sm-5 boxShadow\"> <!-- MAP Container-->
            

            </div>
            


        </div>

    </div>
    
    
    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBcacGx1xEtAaYseE0M9Q3VAy5xx3bVtl0&callback=initMapDriver'
        async defer></script>
";
