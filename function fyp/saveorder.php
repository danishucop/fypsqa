<?php
include "checksessionuser.php";
include "dbconnect.php";

$statusorder = 'pending';

$orderuserid = $_SESSION['userid'];
// $sql="SELECT id,menuname,price,ingredient
//FROM menu WHERE id ";  
if (isset($_GET['ordermenu'])) {

     $ordmenu = $_GET['ordermenu'];
     $ordquanty = $_GET['quantity'];
     $ordprice = $_GET['orderprice'];
     $ordtotal = $_GET['totalorder'];
     $statusorder = 'pending';

     $sql = "INSERT INTO orders 
		(ordermenu,orderuserid, quantity, orderprice, totalorder,statusorder)
		Values ('$ordmenu','$orderuserid','$ordquanty', '$ordprice', '$ordtotal','$statusorder')";
     //data dari borang html


     $rs = mysqli_query($conn, $sql);
     if ($rs == true) {
          echo "Record saved";
          foreach ($_SESSION["shopping_cart"] as $keys => $values) {
               if ($values["item_id"] == $_GET["id"]) {
                    unset($_SESSION["shopping_cart"][$keys]);
                    echo '<script>window.location="testcart.php"</script>';
               }
          }
     } else {
          echo "Cannot save record";
     }
     echo "Mysql error:" . mysqli_error($conn);
}



?>
<a onclick="window.print()"><span class="fa fa-print"></span></a>

<div id="printableArea">
     <input type="button" onclick="printDiv('printableArea')" style="margin-top:5px;" value="print a receipt" />
     <script type="text/javascript">
          function printDiv(divName) {
               var printContents = document.getElementById(divName).innerHTML;
               var originalContents = document.body.innerHTML;

               document.body.innerHTML = printContents;

               window.print();

               document.body.innerHTML = originalContents;
          }
     </script>