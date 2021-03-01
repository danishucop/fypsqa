<?php
session_start();
if (isset($_SESSION['sessionid']) && $_SESSION['accesslevel']=='guest'){

}else{
	header("Location: login.php?msg= Guest must login first");

}
?>