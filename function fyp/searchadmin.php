<?php
session_start(); //mesti di atas
include "headeradmin.template.php";
//searchactivity.php
if (isset($_GET['katakunci'])) {
	$key = $_GET['katakunci'];
} else {
	$key = "";
}
$sql = "SELECT id,menuname,price,ingredient
	FROM menu
	WHERE menuname LIKE '%$key%' ";
include "dbconnect.php";
$rs = mysqli_query($conn, $sql);
if (mysqli_num_rows($rs) == 0) {
	echo "No record found";
} else { //paparan rekod
?>


	<div class="portlet light bordered">
		<table width="100%">
			<tr>
				<td>
					<a href="forminsert.php"><button type="button" class="btn btn-primary">ADD</button></a>
				</td>
			</tr>
		</table>
	</div>
	<br>
	<div class="portlet light bordered">
		<table class="table table-striped table-bordered table-hover table-checkable order-column table-auto-width" id="table_list">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Menu Name</th>
					<th scope="col">Price</th>
					<th scope="col">Ingredient</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php

				while ($record = mysqli_fetch_array($rs)) {
					echo "<tr><td>";
					$id = $record['id'];
					//end display for admin\
					echo $record['id'];
					echo "</td>";
					echo "<td>" . $record['menuname'] . "</td>";
					echo "<td>" . 'RM' . $record['price'] . "</td>";
					echo "<td>" . $record['ingredient'] . "</td>";
					if (
						isset($_SESSION['accesslevel']) &&
						$_SESSION['accesslevel'] == 'admin'
					) {
						echo "<td>" . "<a href='editmenu.php?id=$id'>
				<i type='button'  class='btn btn-primary fa fa-edit'></i></a> " .
							"<a href='#'
				onclick='confirmdelete($id)'><button type='button' class='btn btn-danger'>
				<i class= 'fa fa-trash danger'  style='color:white'></i></button></a> " . "</td>";
					}
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		<script>
			function confirmdelete(id) {
				var answer = confirm("Are u sure to delete?");
				if (answer == true) {
					//redirect
					window.location.href = "deleteactivity.php?id=" + id;
				}
			}
		</script>
	<?php
}
	?>

	<br>
	<?php
	include "footer.template.php";
	?>