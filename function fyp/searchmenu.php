<?php
session_start();//mesti di atas
include "headerpublic.template.php";
if (isset($_GET['keyword'])){
	$key=$_GET['keyword'];
}else{
	$key="";
}
$sql="SELECT id,menuname,price,ingredient
	FROM menu
	WHERE menuname LIKE '%$key%' ";
include "dbconnect.php";
$rs=mysqli_query($conn, $sql);
if(mysqli_num_rows($rs)==0){
	echo "No record found";
}else{//paparan rekod
?>

   <table class="table">
	<tr>
		<td>id</td>
		<td>menuname</td>
		<td>price</td>
		<td>ingredient</td>
	</tr>
	<?php
	
		while($record=mysqli_fetch_array($rs)){
			echo "<tr><td>";
			$id=$record['id'];
			if(isset($_SESSION['accesslevel']) &&
				$_SESSION['accesslevel']=='guest'){
				echo "<a href='testcart.php?id=$id'>
				<i class='fa fa-eye'></i></a> ";
			}//end display for admin
			echo $record['id'];
			echo "</td>";
			echo "<td>".$record['menuname']."</td>";
			echo "<td>" .'RM'.$record['price']."</td>";
			echo "<td>".$record['ingredient']."</td>";
			echo "</tr>";
		}

	?>
</table>
<?php
}
		include "footer.template.php";
?>

       

  