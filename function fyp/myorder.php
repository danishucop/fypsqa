<?php
session_start();
include "headerpublic.template.php";
include "dbconnect.php";

$userid=$_SESSION['userid'];

$sql="SELECT orderid,ordermenu,quantity,orderprice,totalorder	
FROM orders WHERE orderuserid=$userid";
$rs=mysqli_query($conn, $sql);
if (mysqli_error($conn)) {
		echo "Error".mysqli_error($conn);
}else{//paparan rekod
?>

	
	

<table class="table">
	<tr>
		<td>Order Id</td>
		<td>Order Name</td>
		<td>Order Price(1 qty)</td>
		<td>Quantity</td>
		<td>Total Order</td>
	</tr>
	<?php
	
		while($record=mysqli_fetch_array($rs)){
			echo "<tr><td>";
			$orderid=$record['orderid'];
			if(isset($_SESSION['accesslevel']) &&
				$_SESSION['accesslevel']=='guest'){
				echo "<a href='receipt.php?orderid=$orderid'>
				<i class='fa fa-print'></i></a> ";
			}//end display for admin
			//end display for admin
			echo $record['orderid'];
			echo "</td>";
			echo "<td>".$record['ordermenu']."</td>";
			echo "<td>"."RM" .$record['orderprice']."</td>";
			echo "<td>".$record['quantity']."</td>";
			echo "<td>"."RM".$record['totalorder']."</td>";
			echo "</tr>";
		}
	?>

</table>
<script>
				
	function confirmdelete(id){
		var answer=confirm("Are u sure to delete?");
		if (answer==true){
		//redirect
		window.location.href = "deleteactivity.php?id="+id;
		}
	}
</script>
<?php
}
include "footer.template.php";
?>