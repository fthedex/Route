<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 10/22/2016
 * Time: 10:23 AM
 */

$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$country = $_POST['governorate'];               //$_POST INFORMATION FROM THE USER , CONTACT FORM!
$company = $_POST['company'];
$information = $_POST['realInformation'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "routedb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
///Insert the data into a database table!
$sql = "INSERT INTO userscontactform (firstName, lastName, governorate,company,userInformation)
VALUES ('$firstName', '$lastName','$country' ,'$company','$information')";

if ($conn->query($sql) === TRUE) {
    echo "Message Sent , thank you for contacting us , you will be now redirected to the home page";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



$conn->close();
?>
<html>
<script>

//redirect the user after telling him that his info was either submited or not!

    setTimeout(function(){
        window.location = "index.php";

    }, 3000);


</script>
</html>