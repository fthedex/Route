
<?php

echo "<script>

var centerStudentBus = true;

function alertUserCheck(){
    if(document.getElementById('centeringOnOff').checked) {
    centerStudentBus=true;
    
    //turn on centering
} else {
    centerStudentBus = false;
}
    
}

        function getOnlineBusesAJAX(){            //Communicating with database using AJAX.

            $.ajax({
                method: 'GET',
                url: 'getBusesStudentsService.php?userId=".$globalUser->getUsername()."'".",  //Web service that gets every bus in database (busId,busLng,busLat)
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