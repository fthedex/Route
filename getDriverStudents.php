<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/9/2016
 * Time: 10:56 AM
 */





    $resultArr = array(array());

$user = $globalUser->getUsername();

    $db = Database::getConnection();

$res = "";

    $sql ="SELECT studentID FROM studentsAwaitingList,driver WHERE studentsAwaitingList.busID = driver.driverBusID AND driver.driverID =$user";

    if (!$result = mysqli_query($db, $sql)) {
        printf("Errormessage: %s\n", mysqli_error($db));
    }




    if ($result->num_rows > 0) {
        // output data of each row
        $i=0;
        while($row = $result->fetch_assoc()) {


            echo ("<option value = 'studentId'>".$resultArr[$i][0]=$row["studentID"]."</option><br>");
           // echo "<option value = ''>".$resultArr[$i][0]=$row["studentLong"]."</option>";
          //  echo "<option value = ''>".$resultArr[$i][0]=$row["studentLati"]."</option>";



            $i++;
        }

    }


