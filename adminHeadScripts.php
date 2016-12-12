<?php
echo "
<meta charset='UTF-8'>
    <title>Admin Page | Route</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <link rel='stylesheet' type='text/css' href='KhalilEdit.css'>



    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js'>
    </script>
    <!-- Account Info code-->
    <script type='text/javascript' >
        $(function() {
            $('.submitAccountForm').click(function() {
                var accountid = $('#accountid').val();
                var type = $('#type').val();
                var accountpassword = $('#accountpassword').val();
                if(accountid=='' || type=='' || accountpassword=='')
                {
                    alert('Empty Fields!');
                }
                else
                {
                    $.ajax({
                        type: 'POST',
                        url: 'testing.php',
                        data: {accountid, type, accountpassword},
                        success: function(data)
			{
                            alert(data);
                        },
			error: function(data)
			{
			    alert(data);
			}
                    });
                }
                return false;
            });
        });
   </script>

   <!-- Student Code-->
   <script type='text/javascript'>
	$(function() {
            $('.submitStudentForm').click(function() {
                var firstname = $('#firstname').val();
		var lastname = $('#lastname').val();
		var gender = $(input[name='gender']:checked).val();
		var dob = new Date($(input[name='dob']).val());
		var grade = $('#grade').val();
		var studentbus = $('#studentbus').val();
                if(firstname=='' || lastname=='' || grade=='' || studentbus=='')
                {
                    alert('Empty Fields!');
                }
                else
                {
                    $.ajax({
                        type: 'POST',
                        url: 'studentForm.php',
                        data: {firstname, lastname, gender, dob, grade, studentbus},
                        success: function(data)
			{
                            alert(data);
                        },
			error: function(data)
			{
			    alert(data);
			}
                    });
                }
                return false;
            });
        });
   </script>
   <!-- Parent Code-->
   <script type='text/javascript'>
	$(function() {
            $('.submitParentForm').click(function() {
                var firstname = $('#pfirstname').val();
		var lastname = $('#plastname').val();
		var gender = $(input[name='pgender']:checked).val();
		var dob = new Date($(input[name='pdob']).val());
		var number = $('#pnumber').val();
		var address = $('#paddress').val();
                if(firstname=='' || lastname=='' || number=='' || address=='')
                {
                    alert('Empty Fields!');
                }
                else
                {
                    $.ajax({
                        type: 'POST',
                        url: 'parentForm.php',
                        data: {firstname, lastname, gender, dob, number, address},
                        success: function(data)
			{
                            alert(data);
                        },
			error: function(data)
			{
			    alert(data);
			}
                    });
                }
                return false;
            });
        });
   </script>

   <!-- Bus Code-->
   <script type='text/javascript'>
		$(function() {
            $('.submitBusForm').click(function() {
                var busmodel = $('#busmodel').val();
		var busmodelyear = new Date($(input[name='busmodelyear']).val());
		var capacity = $('#capacity').val();
                if(busmodel=='' || busmodelyear=='' || capacity=='')
                {
                    alert('Empty Fields!');
                }
                else
                {
                    $.ajax({
                        type: 'POST',
                        url: 'busForm.php',
                        data: {busmodel, busmodelyear, capacity},
                        success: function(data)
			{
                            alert(data);
                        },
			error: function(data)
			{
			    alert(data);
			}
                    });
                }
                return false;
            });
        });
	</script>

	<!-- Driver code-->
	<script type='text/javascript'>
	$(function() {
            $('.submitDriverForm').click(function() {
                var firstname = $('#dfirstname').val();
		var lastname = $('#dlastname').val();
		var gender = $(input[type='radio']:checked).val();
		var dob = new Date($(input[name='ddob']).val());
		var number = $('#dnumber').val();
		var address = $('#daddress').val();
		var bus = $('#dbus').val();

		if(firstname=='' || lastname=='' || number=='' || address=='' || bus=='')
                {
                    alert('Empty Fields!');
                }
                else
                {
                    $.ajax({
                        type: 'POST',
                        url: 'driverForm.php',
                        data: {firstname, lastname, gender, dob, number, address, bus},
                        success: function(data)
			{
                            alert(data);
                        },
			error: function(data)
			{
			    alert(data);
			}
                    });
                }
                return false;
            });
        });
   </script>


	<!-- students awaiting code-->
	<script type='text/javascript'>
	$(function() {
            $('.submitStudentAwaitingForm').click(function() {
                var busid = $('#a_busid').val();
		var studentid = $('#a_studentid').val();
		var long = $('#a_studentlong').val();
		var lati = $('#a_studentlati').val();
		if(busid=='' || studentid=='' || long=='' || lati=='')
                {
                    alert('Empty Fields!');
                }
                else
                {
                    $.ajax({
                        type: 'POST',
                        url: 'studentsAwaitingForm.php',
                        data: {busid, studentid, long, lati},
                        success: function(data)
			{
                            alert(data);
                        },
			error: function(data)
			{
			    alert(data);
			}
                    });
                }
                return false;
            });
        });
   </script>

	<!-- students taken code-->
	<script type='text/javascript'>
	$(function() {
            $('.submitTakenStudentForm').click(function() {
                var busid = $('#t_busid').val();
		var studentid = $('#t_studentid').val();
		if(busid=='' || studentid=='')
                {
                    alert('Empty Fields!');
                }
                else
                {
                    $.ajax({
                        type: 'POST',
                        url: 'studentsTakenForm.php',
                        data: {busid, studentid},
                        success: function(data)
			{
                            alert(data);
                        },
			error: function(data)
			{
			    alert(data);
			}
                    });
                }
                return false;
            });
        });
   </script>
";



?>
