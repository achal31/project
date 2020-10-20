<!-------Page used for adding product to cart---->
<?php 

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
      
    }
    else {
     
     /*---Pushing selected product id inside the session-----*/

    array_push($_SESSION['cartproduct'], $cartid);
    
   
    }
  }
  header("location:product.php");
  
?>