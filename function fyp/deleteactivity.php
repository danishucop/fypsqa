

<?php
require  "dbconnect.php";
$id=$_GET['id'];
$sql="delete from menu
 where id='$id' ";
$q=mysqli_query($conn,$sql);
if ($q==true){
echo "The record for $id has been deleted";
header('Location: searchadmin.php');
exit();
}
else{
echo "Fail to delete record for $id";
echo mysqli_error($conn);
}
?>
