<?php
require  "dbconnect.php";
$orderid=$_GET['orderid'];
$sql="delete from orders
 where orderid='$orderid' ";
$q=mysqli_query($conn,$sql);
if ($q==true){
echo "The record for $orderid has been deleted";
header('Location: viewuserorder.php');
exit();
}
else{
echo "Fail to delete record for $orderid";
echo mysqli_error($conn);
}
?>
