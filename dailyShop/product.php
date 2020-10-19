<?php include('header.php'); ?> 
<?php include('config.php'); ?>
  <!-- catg header banner section -->
  <section id="aa-catg-head-banner">
   <img src="img/fashion/fashion-header-bg-8.jpg" alt="fashion img">
   <div class="aa-catg-head-banner-area">
     <div class="container">
      <div class="aa-catg-head-banner-content">
        <h2>Fashion</h2>
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>         
          <li class="active">Women</li>
        </ol>
      </div>
     </div>
   </div>
  </section>
  <!-- / catg header banner section -->

  <!-- product category -->
  <section id="aa-product-category">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
          <div class="aa-product-catg-content">
            <div class="aa-product-catg-head">
              <div class="aa-product-catg-head-left">
                <form action="" class="aa-sort-form">
                  <label for="">Sort by</label>
                  <select name="">
                    <option value="1" selected="Default">Default</option>
                    <option value="2">Name</option>
                    <option value="3">Price</option>
                    <option value="4">Date</option>
                  </select>
                </form>


                <!---------------------Filter for Pagination--------------------->
                <form action="product.php" class="aa-show-form" id="showform">
                  <label for="show">Show</label>
                  <select name="totalproduct" onchange="setLimit(this.value)">
                    <option value="3" selected="3">3</option>
                    <option value="6">6</option>
                    <option value="9">9</option>
                  </select>
                </form>
              </div>
              <div class="aa-product-catg-head-right">
                <a id="grid-catg" href="#"><span class="fa fa-th"></span></a>
                <a id="list-catg" href="#"><span class="fa fa-list"></span></a>
              </div>
            </div>

            <div class="aa-product-catg-body">
              <ul class="aa-product-catg">
                
                <?php
                  $total=0; 

                /*-----countquery use to Count total product as per excuted query-------*/
                 $countQuery = "";    

                 $display = "";
                 if (!empty($_POST['limit']))
                 {
                   $limit=$_POST['limit'];
                 }
                 else {
                   /*------Setting By default limit---------*/
                   $limit=3;
                 }
                                 
                   if (!empty($_POST['page'])) { 
                     $page=$_POST['page'];              
                   }
                   else {
                     /*------Setting By default Page number---------*/
                   $limit=3;
                     $page=1;
                   }
                  $offset=($page-1)*$limit;
                   

                  /*------------Condition to Execute Product filter on bases of Tag---------------*/
                 if (!empty($_POST['tagid'])) {
                   $tagid=$_POST['tagid'];
                    
                   $display="select * from products p join category c on p.product_category=c.category_id join product_tag pt on p.product_id=pt.product_id and pt.tag_id = ".$tagid." LIMIT ".$offset." , ".$limit."  ";
                   $countQuery = "select count(p.product_id) from products p join category c on p.product_category=c.category_id join product_tag pt on p.product_id=pt.product_id and pt.tag_id = ".$tagid;
                }

                
                  /*------------Condition to Execute Product filter on bases of Category---------------*/
                else if(!empty($_POST['catid']))
                {
                $catid=$_POST['catid'];
               
                   $display="select * from products WHERE product_category=".$catid." LIMIT ".$offset." , ".$limit."  ";;
                   $countQuery = "select count(product_id) from products WHERE product_category=".$catid."";
                }

                
                  /*------------Condition to Execute Product filter on bases of Color---------------*/
                else if(!empty($_POST['color']))
                {
                  $color=$_POST['color'];
                   $display="select * from products  where product_color='".$color."' LIMIT ".$offset." , ".$limit."  ";
                   $countQuery="select count(product_id) from products where product_color='".$color."'";
                }

                /*------------Condition to Show product first time on page---------------*/
                else{
                  $display="select * from products  LIMIT ".$offset." , ".$limit."  ";
                  $countQuery="select count(product_id) from products";
               
                }
               
                if($display!="")
                {
                  $displaycount=mysqli_query($conn, $countQuery);
                  $total=mysqli_fetch_array($displaycount)[0];

                  
                  $displayquery=mysqli_query($conn, $display);
                  
                while ($result=mysqli_fetch_array($displayquery)) 
                {
                  
            ?> 


                  <!----  Showing All the product in the list form--------->
                <li>
                  <figure>

                  <!------View detail Page and Add to cart page connected----------->

                    <a class="aa-product-img" href="product-detail.php?id=<?php echo $result['product_id'] ?>"><img src="<?php echo $result['product_image'];?>" width="250" height="300"></a>
                    <a class="aa-add-card-btn"href="cart.php?id=<?php echo $result['product_id'] ?>"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                    <figcaption>
                      <h4 class="aa-product-title"><a href="#"><?php echo $result['product_name'];?></a></h4>
                      <span class="aa-product-price"><?php echo $result['product_price'];?>.50
                       </span><span class="aa-product-price"><del>$<?php echo (int)($result['product_price']+($result['product_price']/2));?></del></span>
                    </figcaption>
                  </figure>                       
                  <div class="aa-product-hvr-content">
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="fa fa-heart-o"></span></a>
                    <a href="#" data-toggle="tooltip" data-placement="top" title="Compare"><span class="fa fa-exchange"></span></a>
                    <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target=<?php echo '#quick-view-modal'.$result['product_id'] ?>><span class="fa fa-search"></span></a>                            
                  </div>
                  <!-- product badge -->
                  <span class="aa-badge aa-sale" href="#">SALE!</span>
                </li>
                <!-- start single product item -->
                <?php }
            } ?>  
                 
              </ul>
              
              <!-- Query to display the quick view mode for the product--> 
              <?php 
              
              if($display!=""){
                $displayquery=mysqli_query($conn, $display);
              while ($result=mysqli_fetch_array($displayquery)) {    
              ?>
              <div class="modal fade" id=<?php echo 'quick-view-modal'.$result['product_id'] ?> tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">                      
                    <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <div class="row">
                        <!-- Modal view slider -->
                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                          <div class="aa-product-view-slider">    

                            <div class="simpleLens-gallery-container" id="demo-1">
                              <div class="simpleLens-container">
                                  <div class="simpleLens-big-image-container">
                                      <a class="simpleLens-lens-image" data-lens-image=<?php echo $result['product_image'];?>>
                                          <img src=<?php echo $result['product_image'];?> class="simpleLens-big-image">
                                      </a>
                                  </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- Modal view content -->
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="aa-product-view-content">
                            <h3><?php echo $result['product_name'];?></h3>
                            <div class="aa-price-block">
                              <span class="aa-product-view-price"><?php echo $result['product_price'] ?></span>
                              <p class="aa-product-avilability">Avilability: <span>In stock</span></p>
                            </div>
                            <p><?php echo $result['product_dis'];?></p>
                            <div class="aa-prod-quantity">
                              <form action="">
                                <select name="" id="">
                                  <option value="0" selected="1">1</option>
                                  <option value="1">2</option>
                                  <option value="2">3</option>
                                  <option value="3">4</option>
                                  <option value="4">5</option>
                                  <option value="5">6</option>
                                </select>
                              </form>
                              <p class="aa-prod-category">


                              <!------Query to shpw the category of the product----------------->
                              <?php 
                                          $sqlcat="select * from category where category_id=".$result['product_category']; 
                                          $displaycat=mysqli_query($conn, $sqlcat); 
                                  while ($resultc=mysqli_fetch_array($displaycat)) 
                                  
                                  {
                                    
                                  ?>
                                Category: <a href="#"><?php echo $resultc['category_name'] ?></a>
                                  <?php } ?>
                              </p>
                            </div>
                            <div class="aa-prod-view-bottom">
                              <a href="cart.php?id=<?php echo $result['product_id'] ?>" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                              <a href="product-detail.php?id=<?php echo $result['product_id'] ?>"" class="aa-add-to-cart-btn">View Details</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>                        
                  </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
              </div>
              <?php
              }
            }
               ?>
              <!-- / quick view modal -->   
            </div>
            <div class="aa-product-catg-pagination">
              <nav>

              <!------Condition Set for Pagination---------->
                <?php
                if($total>0)
                { 
                  echo "$total";
                  $total_page=ceil($total/$limit);
                  echo '<ul class="pagination">';
                  echo '<li>
                  <a href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>';
                  for($i=1;$i<=$total_page;$i++)
                  {
            echo '<li><a onclick="setPage('.$i.')"  >'.$i.'</a></li>';
                  } 
                  echo ' <li>
                <a href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>';
                  echo '</ul>';
                }
                
                ?>
                
                  
                  
              </nav>
            </div>
          </div>
        </div>
        <?php include('sidebar.php'); ?>        
      </div>
    </div>
  </section>
  <!-- / product category -->


  <?php include('footer.php'); ?>
