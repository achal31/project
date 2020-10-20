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
                      { $total=$total+$result['product_price']; 
                      ?>
                      <tr>
                        <td><a class="remove" href="cart.php?removeid=<?php echo $result['product_id'] ?>"><fa class="fa fa-close"></fa></a></td>
                        <td><a href="#"><img src="<?php echo $result['product_image'];?>" alt="img"></a></td>
                        <td><a class="aa-cart-title" href="#"><?php echo $result['product_name'];?></a></td>
                        <td>$<?php echo $result['product_price'];?></td>
                        <td><input class="aa-cart-quantity" type="number" value="1" onchange="calprice(this.value, <?php echo $result['product_price'];?>, <?php echo $result['product_id'] ?>)"></td>
                        <td><label id="total<?php echo $result['product_id'] ?>"><?php echo $result['product_price'];?></label></td>
                        
                      </tr>
                      <?php }}?>
                      </tbody>
                  </table>
                </div>
                <script>
                  //--------Function to calculate the total price to the cart--------//
                          function calprice($qty, $price, $id)
                          {
                            $("#total"+$id).html(($qty*$price));
                            $sum = 0 ;
                            $("label[id^='total']").each(function () {
                              console.log(this.innerHTML);
                              $sum = $sum + Number(this.innerHTML);
                            });
                            $(".subtotal").html($sum);
                          }
                        </script>
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