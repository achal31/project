<?php include('header.php'); ?>
<?php include('config.php'); ?>
<!-- product category -->
<?php 
if(isset($_GET['id']))
{
  $productid=$_GET['id'];
}
?>
<section id="aa-product-details">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-product-details-area">
                    <div class="aa-product-details-content">
                        <div class="row">
                            <!-- Modal view slider -->
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <div class="aa-product-view-slider">
                                    <div id="demo-1" class="simpleLens-gallery-container">
                                        <div class="simpleLens-container">
                                            <div class="simpleLens-big-image-container">
                                            <?php 
                                  $display="SELECT * FROM products where product_id=".$productid; 
                                  $displayquery=mysqli_query($conn, $display); 
                                  while ($result=mysqli_fetch_array($displayquery)) 
                                  
                                  {
                                    
                                  ?>
                                                <a data-lens-image="<?php echo $result["product_image"] ?>" class="simpleLens-lens-image"><img src="<?php echo $result["product_image"] ?>" class="simpleLens-big-image" width="349.99px" height="300px"></a>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
                            <!-- Modal view content -->
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <div class="aa-product-view-content">
                               
                                    <h3><?php echo $result['product_name']; ?></h3>
                                  
                                    <div class="aa-price-block">
                                        <span class="aa-product-view-price"><?php echo $result['product_price']; ?></span>
                                        <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                                    </div>

                                    <p><?php echo $result['product_dis']; ?></p>
                                    
                                    <h4>Size</h4>
                                    <div class="aa-prod-view-size">
                                        <a href="#">S</a>
                                        <a href="#">M</a>
                                        <a href="#">L</a>
                                        <a href="#">XL</a>
                                    </div>
                                    <h4>Color</h4>
                                    <div class="aa-color-tag">
                                        <a href="#" class="aa-color-<?php echo $result['product_color']; ?>"></a>
                                      
                                    </div>
                                    
                                    <div class="aa-prod-quantity">
                                        <form action="">
                                            <select id="" name="">
                          <option selected="1" value="0">1</option>
                          <option value="1">2</option>
                          <option value="2">3</option>
                          <option value="3">4</option>
                          <option value="4">5</option>
                          <option value="5">6</option>
                        </select>
                                        </form>
                                        <p class="aa-prod-category">
                                          <?php 
                                          $sqlcat="select * from category where category_id=".$result['product_category']; 
                                          $displaycat=mysqli_query($conn, $sqlcat); 
                                  while ($resultc=mysqli_fetch_array($displaycat)) 
                                  
                                  {
                                    
                                  ?>
                                            Category: <a href="#"><?php echo $resultc['category_name'];?></a>
                                  

                                        </p>
                                    </div>
                                    <div class="aa-prod-view-bottom">
                                        <a class="aa-add-to-cart-btn" href="#">Add To Cart</a>
                                        <a class="aa-add-to-cart-btn" href="#">Wishlist</a>
                                        <a class="aa-add-to-cart-btn" href="#">Compare</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="aa-product-details-bottom">
                        <ul class="nav nav-tabs" id="myTab2">
                            <li><a href="#description" data-toggle="tab">Description</a></li>
                            <li><a href="#review" data-toggle="tab">Reviews</a></li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="description">
                                <p><?php echo $result['product_dis']; ?></p>
                            </div>
                            
                            <div class="tab-pane fade " id="review">
                                <div class="aa-product-review-area">
                                    <h4>2 Reviews for <?php echo $result['product_name']; ?> </h4>
                                    <?php } } ?>
                                    <ul class="aa-review-nav">
                                        <li>
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                                                    <div class="aa-product-rating">
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star-o"></span>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="media">
                                                <div class="media-left">
                                                    <a href="#">
                                                        <img class="media-object" src="img/testimonial-img-3.jpg" alt="girl image">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><strong>Marla Jobs</strong> - <span>March 26, 2016</span></h4>
                                                    <div class="aa-product-rating">
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star"></span>
                                                        <span class="fa fa-star-o"></span>
                                                    </div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <h4>Add a review</h4>
                                    <div class="aa-your-rating">
                                        <p>Your Rating</p>
                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                        <a href="#"><span class="fa fa-star-o"></span></a>
                                    </div>
                                    <!-- review form -->
                                    <form action="" class="aa-review-form">
                                        <div class="form-group">
                                            <label for="message">Your Review</label>
                                            <textarea class="form-control" rows="3" id="message"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" placeholder="example@gmail.com">
                                        </div>

                                        <button type="submit" class="btn btn-default aa-review-submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                                  
                        <?php include('footer.php'); ?>