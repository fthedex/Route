
<?php

function getDatePhp(){
    date_default_timezone_set('Asia/Amman'); // CDT

    $current_date = date('H:i:s');


    return $current_date;
}

//2- get the students are awiting for this guy as list options
function getAwaitingAsOptions($user)
{


    $db = Database::getConnection();


    $sql = "SELECT studentID FROM studentsAwaitingList,driver WHERE studentsAwaitingList.busID = driver.driverBusID AND driver.driverID =$user";

    if (!$result = mysqli_query($db, $sql)) {
        printf("Errormessage: %s\n", mysqli_error($db));
    }

    $resultVal = "";


    if ($result->num_rows > 0) {
        // output data of each row
        $i = 0;
        while ($row = $result->fetch_assoc()) {


            $resultVal .= ("<option value = " . $row["studentID"] . ">" . $row["studentID"] . "</option><br>");
            // echo "<option value = ''>".$resultArr[$i][0]=$row["studentLong"]."</option>";
            //  echo "<option value = ''>".$resultArr[$i][0]=$row["studentLati"]."</option>";


            $i++;
        }

    }

    return $resultVal;
} //id


//3- get the awaiting students as locations , will be used for the first time only to initilize the P with the locations!
function getAwaitingLocations($user){ //id,long,lat

    $resultArr = array(array());


    $db = Database::getConnection();


    $sql ="SELECT studentID,studentLong,studentLati FROM studentsAwaitingList,driver WHERE studentsAwaitingList.busID = driver.driverBusID AND driver.driverID =$user";

    if (!$result = mysqli_query($db, $sql)) {
        printf("Errormessage: %s\n", mysqli_error($db));
    }




    if ($result->num_rows > 0) {
        // output data of each row
        $i=0;
        while($row = $result->fetch_assoc()) {


            $resultArr[$i][0]=$row["studentID"];
            $resultArr[$i][1]=$row["studentLong"];
            $resultArr[$i][2]=$row["studentLati"];




            $i++;
        }

    }
    return json_encode($resultArr);
}


echo "<script>


var centerDriverBus = true; //user's choice , the default is true , (will be centering on page load) 

function alertUserCheck(){      //change centering BOOL to user's choice!
    if(document.getElementById('centeringOnOff').checked) {
    centerDriverBus=true;
    
    //turn on centering
} else {
    centerDriverBus = false;
}
    
}

    function removeSelectedElementFromDB(){
        
ajaxFromAwaitingToTaken();

    }

    window.onload = function() {
        checkCount();      //check if there are no element in the student check list
    };
    function removeFromMap(){
        //removes selected value of the awaiting list from the map
        var e = document.getElementById('studentsList');

        var key = e.options[e.selectedIndex].value;
        delNotBugged(key);

    }

    function checkCount(){ //checks if there is something in the list , if no , remove the button and tell the user no mroe students
        var e = document.getElementById('studentsList');
        if(e.length==0){
            $('#studentsList')
                .append($('<option></option>')
                    .attr('value','NA')
                    .text('NO MORE STUDENTS :)'));


            $('#checkButton').remove();
        }
    }

    function removeFromList(){  //removes value from the list element
        var e = document.getElementById('studentsList');



        if(e.options[e.selectedIndex].value=='NA')
            return;

        e.remove(e.selectedIndex);
        if(e.length==0){     //if its empty after a deletion , just remove the button and tell him its done bro , get out
            $('#studentsList')
                .append($('<option></option>')
                    .attr('value','NA')
                    .text('NO MORE STUDENTS :)'));


            $('#checkButton').remove();
        }
    }


    function getDate(){            //AJAX FOR DATE UPDATION EVERY ONE SECOND

        $.ajax({
            method: 'GET',
            url: 'getDate.php',  //PHP FILE TO GET YOU DATE
            data: {}
        })
            .done(function (data) {
                $('#date').html('Time:'+data);


            });

    }
    
    function ajaxFromAwaitingToTaken(){
           var e = document.getElementById('studentsList');
          var driverInfo = getOnlineBuses();
          var studentBusId = driverInfo[0][0];
       
         
           
           
         var studentId = e.options[e.selectedIndex].value;

        if(studentId=='NA')
            return;
              $.ajax({
            method: 'GET',
            url: 'moveFromAwaitingToTaken.php?userId='+studentId+'&busId='+studentBusId,  //PHP FILE TO GET YOU DATE
            data: {}
        })
            .done(function (data) {
                alert('student is now assigned to your bus :)');


            });
            
            

        
    }


    function getStudentsLocations(){


        var onlineStudents = document.getElementById('studentsHiddenLocations').innerHTML;   //we assign the buses so we can parse the text into an array(JSON

        var onlineStudentsArray =  JSON.parse(onlineStudents);     //Parsing TEXT into a JSON(Normal Array)

        return onlineStudentsArray;  //returning the array

    }

    function getOnlineBusesAJAX(){            //Communicating with database using AJAX.

        $.ajax({
            method: 'GET',
            url: 'getLocationMyBus.php?userId=".$globalUser->getUsername()."'".",  //Web service that gets every bus in database (busId,busLng,busLat)
            data: {}
        })
            .done(function (data) {
                $('#ajaxJSON').html(data);      //when ajax completes it assigns the data to a hidden element in the document
                document.getElementById('ajaxJSON').innerHTML=data;                               //because we get the innerHTML of that element when ever we need the locations


            });

    }


    function getOnlineBuses(){

        getOnlineBusesAJAX();          //Every time this method is called it updates the Element containing buses

        var onlineBuses = document.getElementById('ajaxJSON').innerHTML;   //we assign the buses so we can parse the text into an array(JSON

        var busesArray =  JSON.parse(onlineBuses);     //Parsing TEXT into a JSON(Normal Array)


        return busesArray;  //returning the array

    }







    setInterval(getDate, 1000);



</script>";


?>