<?php 
if (isset($_POST['registerbtn'])) {
	include 'dbconnect.php';

	$username=$_POST['txt_username'];
	$email=$_POST['txt_email'];
	$hpnumber=$_POST['txt_hpnumber'];
	$password=md5($_POST['txt_password']);
	$repeatpassword=md5($_POST['txt_repeatpassword']);

	// chech if the password are macthing if not return to register page
	if ($password!=$repeatpassword) {
		header('Location: index.php?error=notmatch');
	}
	$sql= "INSERT INTO users (username,password,email,hpnumber,accesslevel) 
		   VALUES ('$username','$password','$email','$hpnumber','guest')";
	$rs=mysqli_query($conn,$sql);
	if (mysqli_error($conn)) {
		echo "Error".mysqli_error($conn);
		exit();
	}
	else
		header('Location: ../login.php?success=registered');

}			

 ?>