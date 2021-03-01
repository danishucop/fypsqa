<?php
session_start();
// verify.php

include "dbconnect.php";
$email=$_POST['email'];
$password=md5($_POST['password']);

$sql="SELECT userid,username,password,email,hpnumber,accesslevel,imagefile 
	  FROM users
	  WHERE email='$email'
 	  AND password='$password'";
$rs=mysqli_query($conn,$sql);

if(mysqli_error($conn)){
echo "error".mysqli_error($conn);
}
 if(mysqli_num_rows($rs)==1){//jumpa user
 	$record=mysqli_fetch_array($rs);
 	//session data
 	$_SESSION['sessionid']=session_id();
 	$_SESSION['userid']=$record['userid'];
 	$_SESSION['username']=$record['username'];
 	$_SESSION['password']=$record['password'];
 	$_SESSION['email']=$record['email'];
 	$_SESSION['hpnumber']=$record['hpnumber'];
 	$_SESSION['accesslevel']=$record['accesslevel'];
 	$_SESSION['imagefile']=$record['imagefile'];

 	//go to dashboard
 	if($record['accesslevel']=='admin'){
		header ("Location: dashadmin.php");
	}else if ($record['accesslevel']=='guest'){
		header ("Location: dashpublic.php");
	}
	echo "1 user found";

	echo "Admin name ".$record['username'];

	exit();

}else{
	//redirect login.php
	header ("Location: login.php?msg=Login failed");
	echo "no user founded";
 }

?>