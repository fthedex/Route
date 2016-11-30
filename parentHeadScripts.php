
<?php


echo "<script>




var centerChildren = true; //user's choice , the default is true , (will be centering on page load) 
var pageLoaded = false;
function alertUserCheck(){      //change centering BOOL to user's choice!
    if(document.getElementById('centeringOnOff').checked) {
    centerChildren=true;
    
    //turn on centering
} else {
    centerChildren = false;
}
    
}

    
    $(window).load(function() {
         updateBusDriverInfo();
         pageLoaded =true;
});
    


        function updateBusDriverInfo(){

            var httpURL = 'getBusDriverInfo.php?userId='+getSelectedValueOfChildren();
         
                $.ajax({
                method: 'GET',
                url: httpURL,  //Web service that gets every bus in database (busId,busLng,busLat)
                data: {}
            })
                .done(function (data) {
            
              var phoneNameArray = data.split(',');
    
            $('#childBusIdP').html('BUS ID: '+getSelectedValueOfChildren());
            $('#childBusDriverPhoneNo').html('BUS PHONE NO: '+phoneNameArray[0]);
            $('#childBusDriverName').html('BUS DRIVER NAME: '+phoneNameArray[1]);

                });

       
        }
        
        function getSelectedValueOfChildren(){  //the value of the select element is the bus id for that child
        
            var e = document.getElementById('parentChildrenSelect');
            var emVal = e.options[e.selectedIndex].value;
            return emVal;
        }


        function assignSelectWithChildrenAJAX(){
            
             $.ajax({
                method: 'GET',
                url: 'getChildrenFromDbAsOptions.php?userId=".$globalUser->getUsername()."'".",  //Web service that gets every bus in database (busId,busLng,busLat)
                data: {}
            })
                .done(function (data) {
                    $('#parentChildrenSelect').html(data);      //when ajax completes it assigns the data to a hidden element in the document
                                                    //because we get the innerHTML of that element when ever we need the locations


                });

            
        }

        function getOnlineBusesAJAX(){            //Communicating with database using AJAX.

            $.ajax({
                method: 'GET',
                url: 'getStudentsBusesParentService.php?userId=".$globalUser->getUsername()."'".",  //Web service that gets every bus in database (busId,busLng,busLat)
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
";


?>