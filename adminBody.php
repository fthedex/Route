<?php
echo "


<div class='loginBody container-fluid padding20'>
    <br><br><br>
    <div id='globalMap'style='align: center; border: 2px white solid; height: 500px;'>
        <script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'>

        </script>
        <div style='overflow:hidden;height:100%;width:100%; align: center;'>
            <iframe src='globalMap.php' style='overflow:hidden;height:100%;width:100%;'>

	
	    </iframe>
            </div>

    </div>

    <div id='formsDiv'  style='border: 2px white solid; align: center; padding: 15px; margin: 15px;'>

        <div id='studentForm' class='forms' style='border: 2px white solid;' width='40%'>
            <h2 align='center'> Student form </h2>
            <form name='studentForm' method='post' enctype='multipart/form-data'>
                First name:<br>
                <input required type='text' name='firstname' id='firstname'>
                <br>
                Last name:<br>
                <input required type='text' name='lastname' id='lastname'>
                <br>
                Gender: <br>
                <input type='radio' name='gender' id='gender' value='M'> Male
                <br>
                <input type='radio' name='gender' id='gender' value='F'> Female
                <br>
                Date of Birth: <br>
                <input type='date' name='dob' id='dob'>
                <br>
                Grade: <br>
                <input required type='number' name='grade' id='grade' min='1' max='12'>
                <br>
                Student Bus: <br>
                <input required type='text' name='studentbus' id='studentbus'>
                <br><br>
                <input type='submit' value='Submit' id='studentSubmit' class='submitStudentForm'>
            </form>
        </div>

        <br><br>

        <div id='parentForm' class='forms' style='border: 2px white solid;' width='40%'>
            <h2 align='center'> Parent form </h2>
            <form name='parentForm' method='post' enctype='multipart/form-data'>
                First name:<br>
                <input required type='text' name='pfirstname' id='pfirstname'>
                <br>
                Last name:<br>
                <input required type='text' name='plastname' id='plastname'>
                <br>
                Gender: <br>
                <input type='radio' name='pgender' id='pgender' value='M'> Male
                <br>
                <input type='radio' name='pgender' id='pgender' value='F'> Female
                <br>
                Date of Birth: <br>
                <input type='date' name='pdob' id='pdob'>
                <br>
                Mobile Number: <br>
                <input required type='text' name='pnumber' id='pnumber' minlength='10'>
                <br>
                Address: <br>
                <input required type='text' name='paddress' id='paddress'>
                <br><br>
                <input type='submit' value='Submit' id='parentSubmit' class='submitParentForm'>
            </form>
        </div>

        <br><br>

	<div id='driverForm' class='forms' style='border: 2px white solid;' width='40%'>
            <h2 align='center'> Driver Form </h2>
            <form name='driverForm' method='post' enctype='multipart/form-data'>
                First name:<br>
                <input required type='text' name='dfirstname' id='dfirstname'>
                <br>
                Last name:<br>
                <input required type='text' name='dlastname' id='dlastname'>
                <br>
                Gender: <br>
                <input type='radio' name='dgender' id='dgender' value='M'> Male
                <br>
                <input type='radio' name='dgender' id='dgender' value='F'> Female
                <br>
                Date of Birth: <br>
                <input type='date' name='ddob' id='ddob'>
                <br>
                Mobile Number: <br>
                <input required type='text' name='dnumber' id='dnumber' minlength='10'>
                <br>
                Address: <br>
                <input required type='text' name='daddress' id='daddress'>
                <br>
                Bus: <br>
                <input required type='text' name='dbus' id='dbus'>
                <br><br>
                <input type='submit' value='Submit' id='driverSubmit' class='submitDriverForm'>
            </form>
        </div>

        <br><br>

	<div id='busForm' class='forms' style='border: 2px white solid;' width='40%'>
            <h2 align='center'> Bus Form</h2>
            <form  name='busForm' method='post' enctype='multipart/form-data'>
                Bus Model: <br>
                <input required type='text' name='busmodel' maxlength='25' id='busmodel'>
                <br>
                Bus Model Year: <br>
                <input required type='date' name='busmodelyear' id='busmodelyear'>
                <br>
                Bus Capacity: <br>
                <input required type='number' name='capacity' id='capacity' min='1' max='50'>
                <br><br>
                <input type='submit' value='Submit' id='busSubmit' class='submitBusForm'>
            </form>
        </div>

        <br><br>
	
	<div id='studentAwaitingForm' class='forms' style='border: 2px white solid;' width='40%'>
            <h2 align='center'> Students Awaiting List Form</h2>
            <form  name='studentAwaitingForm' method='post' enctype='multipart/form-data'>
                BusID: <br>
                <input required type='text' name='a_busid' maxlength='25' id='a_busid'>
                <br>
                StudentID: <br>
                <input required type='text' name='a_studentid' id='a_studentid'>
                <br>
                Student Longitude: <br>
                <input required type='text' name='a_studentlong' id='a_studentlong'>
		<br>
                Student Latitude: <br>
                <input required type='text' name='a_studentlati' id='a_studentlati'>
                <br><br>
                <input type='submit' value='Submit' id='studentAwaitingSubmit' class='submitStudentAwaitingForm'>
            </form>
        </div>

        <br><br>

	<div id='takenStudentForm' class='forms' style='border: 2px white solid;' width='40%'>
            <h2 align='center'> Taken Students List Form</h2>
            <form  name='takenStudentForm' method='post' enctype='multipart/form-data'>
                BusID: <br>
                <input required type='text' name='t_busid' maxlength='25' id='t_busid'>
                <br>
                StudentID: <br>
                <input required type='text' name='t_studentid' id='t_studentid'>
                <br><br>
                <input type='submit' value='Submit' id='takenStudentSubmit' class='submitTakenStudentForm'>
            </form>
        </div>

        <br><br>

        <div id='accountForm' class='forms' style='border: 2px white solid;' width='40%'>
            <h2 align='center'> Account Form</h2>
            <form name='accountForm' method='post' enctype='multipart/form-data'>
                Account ID: <br>
                <input required type='text' name='accountid' id='accountid'>
                <br>
                Account Type: <br>
                <input required type='number' name='type' id='type' maxlength='1' max='4' min='1'>
                <br>
                Account Password: <br>
                <input required type='password' name='accountpassword' id='accountpassword' minlength='6'>
                <br><br>
                <input type='submit' value='Submit' id='accountSubmit' class='submitAccountForm'>
            </form>
        </div>
    </div>
</div>

";

?>
