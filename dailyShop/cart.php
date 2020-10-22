<?php
/*-----Starting the session-------*/

include('header.php');
include('config.php'); 
?>
 
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Cart Page</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>                   
          <li class="active">Cart</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->
  <?php 

  
  /*------To Remove the product from the cart-------*/
  if(isset($_GET['removeid']))
  {
    $sql="UPDATE products SET product_quantity=1 WHERE product_id=".$_GET['removeid'];
  $conn->query($sql);
    /*-----Removing the product id from the session array-------*/
    $key=array_search($_GET['removeid'],$_SESSION['cartproduct']);
    unset($_SESSION['cartproduct'][$key]);
  }
  ?>

 <!-- Cart view section -->
 <section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $total=0;

                      /*-----Query to show all the product in cart that are been added------*/
                      foreach($_SESSION['cartproduct'] as $productid)
                      {
                       $sql="SELECT * from products WHERE product_id=".$productid;
                       $displayquery=mysqli_query($conn, $sql); 
                                  while ($result=mysqli_fetch_array($displayquery)) 
                      { $total=$total+$result['product_price']*$result['product_quantity']; 
                      ?>
                      <tr>
                        <td><a class="remove" href="cart.php?removeid=<?php echo $result['product_id'] ?>"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="javascript:void(0)"><img src="<?php echo $result['product_image'];?>" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="javascript:void(0)"><?php echo $result['product_name'];?></a></td>
                        <td>$<?php echo $result['product_price'];?></td>
                        <td><input class="aa-cart-quantity" type="number" value="<?php echo $result['product_quantity'];?>" onchange="calprice(<?php echo $result['product_quantity'];?>, <?php echo $result['product_price'];?>, <?php echo $result['product_id'] ?>)" disabled></td>
                        <td><label id="total<?php echo $result['product_id'] ?>"><?php echo $result['product_quantity']*$result['product_price'];?></label></td>
                        
                      </tr>
                      <?php }}?>
                      </tbody>
                  </table>
                </div>
                
             </form>

             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td><label class="subtotal">$<?php  
                     echo $total;?></label></td>
                   </tr>
                   <tr>
                     <th>Total</th>
                    
                     <td><label class="subtotal">$<?php  
                     echo $total;?></label></td>
                   </tr>
                   
                 </tbody>
               </table>
               <a href="checkout.php" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- / Cart view section -->


 <?php include('footer.php'); ?>