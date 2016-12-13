<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/24/2016
 * Time: 10:31 AM
 */

require "connection.php";

function getChildrenIdName($user)
{
    $db = Database::getConnection();


    $sql = "SELECT studentparent.studentID,student.studentFN,student.studentLN , takenstudentslist.busID FROM parent INNER JOIN studentparent ON parent.parentID = studentparent.parentID AND parent.parentID = $user INNER JOIN student ON student.studentID = studentparent.studentID INNER JOIN takenstudentslist ON 
takenstudentslist.studentID = studentparent.studentID";

    if (!$result = mysqli_query($db, $sql)) {
        printf("Errormessage: %s\n", mysqli_error($db));
    }

    $resultVal = "";


    if ($result->num_rows > 0) {
        // output data of each row

        while ($row = $result->fetch_assoc()) {


            $resultVal .= ("<option value =" . $row["busID"] . ">" . $row["studentID"] ." - ".$row["studentFN"]." ". $row["studentLN"]. "</option><br>");



        }

    }
    else{
        $resultVal = "<option value='NA'>None of your children in buses.</option>";
    }

    return $resultVal;
}

echo getChildrenIdName($_GET['userId']);