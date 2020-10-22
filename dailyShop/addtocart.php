<!-------Page used for adding product to cart---->
<?php 
include('config.php');
session_start();

if(empty($_SESSION['cartproduct']))
{
$_SESSION['cartproduct']=array();
}
  /*------To Add the product from the cart-------*/
  if(isset($_GET['id']))
  {
    
     /*----Checking whether product already present in the session or not----*/
    $cartid=$_GET['id'];
   
    if(in_array($cartid,$_SESSION['cartproduct']))
    {
      $sql="UPDATE products SET product_quantity=product_quantity+1 WHERE product_id=".$cartid;
      echo $sql;
      $conn->query($sql);
    }
    else {
     
     /*---Pushing selected product id inside the session-----*/

    array_push($_SESSION['cartproduct'], $cartid);
    
   
    }
  }
  header("location:product.php");
  
?>