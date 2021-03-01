
<?php
include "checksessionuser.php";
include "headerpublic.template.php"; 
include "dbconnect.php";
 $sql="SELECT id,menuname,price,ingredient
  FROM menu WHERE id";  
$rs=mysqli_query($conn,$sql);
 if(isset($_POST["addorder"]))  
 { 
        
       
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                     'item_menuname'               =>     $_POST["hidden_menuname"],  
                     'item_price'          =>     $_POST["hidden_price"],
                     'item_quantity'          =>     $_POST["quantity"]  
                );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }  
  
 
 ?>  

 <?php   
                          if(!empty($_SESSION["shopping_cart"]))  
                          {  
                               $total = 0;  
                               foreach($_SESSION["shopping_cart"] as $keys => $values)  
                               {  
                          ?> 
                          <!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>
 
                          <div class="w3-container" id="printableArea">
                          <h2>Your Receipt Order</h2>

                          <div class="col-25">
    <div class="container">
      <h4>Cart <span class="quantity" style="color:black"><i class="fa fa-shopping-cart"></i>
                           <form method="post" action="saveorder.php"> 
                            <br>
                         Menu Name :<input name='ordermenu' value='<?php echo $values["item_menuname"];?>'class="form-control-plaintext" readonly> 
                          <br>
                         Quantity Order :<input name='quantity' value='<?php echo $values["item_quantity"];?>'class="form-control-plaintext" readonly>
                          <br>  
                           Price Order : RM <input name='orderprice' value='<?php echo $values["item_price"];?>' class="form-control-plaintext" readonly>  
                          <p>Total :  <span class="total" style="color:black"><b>RM<input name='totalorder' value='<?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?>' class="form-control-plaintext" readonly></b></span></p>
    </div>
                          
                          
                          <?php  
                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                               }  
                          ?>
                          
            
            
                           

                                

                               <input type="submit" style="margin-top:5px;" name=btnsubmit class="btn btn-success" value="Save">
                               <a href="dashpublic.php" style="margin-top:5px;" class="btn btn-success">Cancel</a>
                               <a onclick="window.print()"><span class="fa fa-print"></span></a>
                    
<div id="printableArea">
<input type="button" onclick="printDiv('printableArea')" value="print order!" />
<script type="text/javascript">
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
</div>
                          </form>
                          <?php  
                       
                          }  
                          ?>  
                          
                     </table>  
                </div>  
           </div>  
           <br />  
      </body>  
 </html>
