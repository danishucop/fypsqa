<?php
session_start();
include "dbconnect.php";
include "headeradmin.template.php";
$sql="SELECT userid,username,email,hpnumber,accesslevel
	FROM users WHERE accesslevel LIKE 'guest'";
$rs=mysqli_query($conn, $sql);
if (mysqli_error($conn)) {
		echo "Error".mysqli_error($conn);
}else{//paparan rekod
?>

	
	

<table class="table">
	<tr>
		<td>User Id</td>
		<td>User Name</td>
		<td>User Email</td>
		<td>Phone Number</td>
	</tr>
	<?php
	
		while($record=mysqli_fetch_array($rs)){
			echo "<tr><td>";
			$userid=$record['userid'];
			if(isset($_SESSION['accesslevel']) &&
				$_SESSION['accesslevel']=='admin'){
				echo "<a href='#'
				onclick='confirmdelete($userid)'>
				<i class='fa fa-trash danger'  style='color:red'></i></a> ";
			}//end display for admin
			//end display for admin
			echo $record['userid'];
			echo "</td>";
			echo "<td>".$record['username']."</td>";
			echo "<td>" .$record['email']."</td>";
			echo "<td>".$record['hpnumber']."</td>";
			echo "</tr>";
		}
	?>

</table>
<script>
				
	function confirmdelete(userid){
		var answer=confirm("Are u sure to delete?");
		if (answer==true){
		//redirect
		window.location.href = "deleteuser.php?userid="+userid;
		}
	}
</script>
<?php
}
include "footer.template.php";
?>