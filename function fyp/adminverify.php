<?php
session_start();
// verify.php

include "dbconnect.php";
$adminemail=$_POST['adminemail'];
$adminpass=md5($_POST['adminpass']);

$sql="SELECT adminid,adminname,adminpass,adminemail,adminhpnumber,adminaccesslevel,adminimagefile 
	  FROM admin
	  WHERE adminemail='$adminemail'
 	  AND adminpass='$adminpass'";
$rs=mysqli_query($conn,$sql);

if(mysqli_error($conn)){
echo "error".mysqli_error($conn);
}
 if(mysqli_num_rows($rs)==1){//jumpa user
 	$record=mysqli_fetch_array($rs);
 	//session data
 	$_SESSION['sessionid']=session_id();
 	$_SESSION['adminid']=$record['adminid'];
 	$_SESSION['adminname']=$record['adminname'];
 	$_SESSION['adminpass']=$record['adminpass'];
 	$_SESSION['adminemail']=$record['adminemail'];
 	$_SESSION['adminhpnumber']=$record['adminhpnumber'];
 	$_SESSION['adminaccesslevel']=$record['adminaccesslevel'];
 	$_SESSION['adminimagefile']=$record['adminimagefile'];

 	//go to dashboard
 	if($record['adminaccesslevel']=='admin'){
		header ("Location: dashadmin.php");
	}else if ($record['adminaccesslevel']=='guest'){
		header ("Location: dashpublic.php");
	}
	echo "1 user found";

	echo "Admin name ".$record['username'];

	exit();

}else{
	//redirect login.php
	header ("Location: adminlogin.php?msg=Login failed");
	echo "no user founded";
 }

?>