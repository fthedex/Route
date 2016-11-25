<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 11/24/2016
 * Time: 10:31 AM
 */

function getChildrenIdName($user)
{


    $db = Database::getConnection();


    $sql = "SELECT takenstudentslist.busID , takenstudentslist.studentID FROM takenstudentslist,studentparent WHERE studentparent.studentID = takenstudentslist.studentID AND studentparent.parentID = $user";

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

echo getChildrenIdName($_GET['userId']);