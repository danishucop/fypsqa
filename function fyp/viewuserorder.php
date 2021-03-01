<?php
session_start();
include "dbconnect.php";
include "headeradmin.template.php";
$sql = "SELECT * FROM orders";
$rs = mysqli_query($conn, $sql);

if (mysqli_error($conn)) {
	echo "Error" . mysqli_error($conn);
} else { //paparan rekod
?>




	<div class="portlet light bordered">
		<table class="table table-striped table-bordered table-hover table-checkable order-column table-auto-width" id="table_list">
			<thead>
				<tr>
					<td>Order Id</td>
					<td>Order User Id</td>
					<td>Order Name</td>
					<td>Order Price</td>
					<td>Quantity</td>
					<td>Total Order</td>
					<td>Action </td>
				</tr>
			</thead>
			<tbody>
				<?php

				while ($record = mysqli_fetch_array($rs)) {
					echo "<tr><td>";
					$orderid = $record['orderid'];

					echo $record['orderid'];
					echo "</td>";
					echo "<td>" . $record['orderuserid'] . "</td>";
					echo "<td>" . $record['ordermenu'] . "</td>";
					echo "<td>" . 'RM ' . $record['orderprice'] . "</td>";
					echo "<td>" . $record['quantity'] . "</td>";
					echo "<td>" . 'RM ' . $record['totalorder'] . "</td>";
					if (
						isset($_SESSION['accesslevel']) &&
						$_SESSION['accesslevel'] == 'admin'
					) {
						echo "<td>" . "<a href='newreceipt.php?orderid=$orderid'>
				<i class='fa fa-print'></i></a> " .
							"<a href='#'
				onclick='confirmdelete($orderid)'>
				<i class='fa fa-trash danger'  style='color:red'></i></a>" . "</td>";
					} //end display for adminn
					echo "</tr>";
				}
				?>

			</tbody>
		</table>
		<script>
			function confirmdelete(orderid) {
				var answer = confirm("Are u sure to delete?");
				if (answer == true) {
					//redirect
					window.location.href = "deleteuserorder.php?orderid=" + orderid;
				}
			}
		</script>
	<?php
}
include "footer.template.php";
	?>