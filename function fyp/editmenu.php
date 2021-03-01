<?php
include "checksession.php";
//editadmin.php
include "headeradmin.template.php";
include "dbconnect.php";
$id=$_GET['id'];
$sql="SELECT * FROM menu
		WHERE id='$id' ";
$rs=mysqli_query($conn, $sql);
if (mysqli_error($conn)==true){
		echo mysqli_error($conn);
	}//sql error
$record=mysqli_fetch_array($rs);
?>

<h2>Edit Menu</h2>
<form action="updatemenu.php" method="post"
	enctype="multipart/form-data">
	Menu id<input name="id" type="text" class="form-control"
	value="<?php echo $record['id'] ?>" readonly>
	Menu Name<input name="menuname" type="text" 
	class="form-control"
	value="<?php echo $record['menuname'] ?>" >
	Price<input name="price" type="text" 
	class="form-control"
	value="<?php echo $record['price'] ?>" >
	Ingredient<input name="ingredient" type="text" 
	class="form-control"
	value="<?php echo $record['ingredient'] ?>" >

	<hr>
	<h4>Upload profile picture image file  only</h4>
	<input type="file" name="fileToUpload">
	<br>
	<hr>
	<button class="btn btn-success">Save update menu</button>
</form>


<?php
include "footer.template.php";
//editadmin.php
?>