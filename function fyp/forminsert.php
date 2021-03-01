<?php
//forminsert.php
include "checksession.php";


include("headeradmin.template.php");
?>
<div class="container">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<div class="card card-signin my-1">
				<div class="card-body">
					<h5 class="card-title text-center">Add your menu details</h5>

					<form method="post" action="" enctype="multipart/form-data">
						<div class="form-group">

							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label align-content-center">Menu Name</label>
								<div class="col-md-6">
									<input type="text" class="form-control align-center" name="menuname" id="exampleFormControlInput1" placeholder="">
								</div>
							</div>
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Price</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="price" id="exampleFormControlInput1" placeholder="">
								</div>
							</div>
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Ingredient</label>
								<div class="col-md-6">
									<textarea type="text" class="form-control" name="ingredient" id="exampleFormControlInput1" placeholder=""></textarea>
								</div>
							</div>
							<hr>
							<h4>Upload profile picture image file only</h4>
							<input type="file" name="fileToUpload">
							<br>
							<br>

							<button type="submit" class="btn btn-success">Save Record</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
$target_dir = "adminimage/";
//rename file image
$menuimage = date('d-m-Y') . "-" . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $menuimage;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if ($check !== false) {
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
if ($_FILES["fileToUpload"]["size"] > 10000000) { //bytes
	echo "Sorry, your file is too large.";
	$uploadOk = 0;
}

// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}

if (isset($_POST['menuname']) && isset($_POST['price'])) {

	//simpan ke database
	include "dbconnect.php";

	//fettch data
	$menuname = $_POST['menuname'];
	$price = $_POST['price'];
	$ingredient = $_POST['ingredient'];

	//sql insert
	$sql = "INSERT INTO menu 
		(menuname, price, ingredient, menuimage )
		Values ('$menuname','$price', '$ingredient','$menuimage')";
	//data dari borang html


	$rs = mysqli_query($conn, $sql);
	if ($rs == true) {
		echo "Record saved";
	} else {
		echo "Cannot save record";
	}
}

include("footer.template.php");
?>