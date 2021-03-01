
<?php
include "checksession.php";
//insertactivity.php
include ("headeradmin.template.php");
?>
<?php
$target_dir = "adminimage/";
//rename file image
$menuimage=date('d-m-Y')."-".basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir .$menuimage;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 10000000) {//bytes
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

//updateactivity.php
if(isset($_POST['menuname']) &&
	isset($_POST['price'])){

	//simpan ke database
	include "dbconnect.php";
	
	//fetch data
	$id=$_POST['id'];
	$menuname=$_POST['menuname'];
	$price=$_POST['price'];
	$ingredient=$_POST['ingredient'];
	

	//sql insert
	$sql="UPDATE menu
		SET
		menuname='$menuname', 
		price='$price', 
		ingredient='$ingredient',
		menuimage='$menuimage'
		WHERE id='$id'";
		//data dari borang html
		//echo $sql;

	$rs=mysqli_query($conn,$sql);
	if($rs==true){
		echo"<a href=searchactivity.php>";
		
	}else{
		//header ("Location: searchactivity.php?msg=Cannot save Record ");
		echo "Cannot save record";
	}
	
//echo "Mysql error:".mysqli_error($conn);
}

//end isset
?>
<?php
include "footer.template.php"
?>