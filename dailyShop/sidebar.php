<!-----Script set to call different functions------>
<script>
  function submitform()
{
  $("#showform").submit();

}               /*----Store the selected tag value in the input hidden field--------*/
                function setTagId($tagid)
                  { 
                    $("#tagid").val($tagid);
                
                    $("#tagfilter").submit();
                  }

                  /*----Store the selected Category value in the input hidden field--------*/
                  function setCatId($tagid)
                  {
                   
                    $("#catid").val($tagid);                    
            
                    $("#tagfilter").submit();
                  }

                  /*----Store the selected Page value in the input hidden field--------*/
                  function setPage($page)
                  {
                    
                    $("#page").val($page);
                    $("#tagfilter").submit();
                  }

                  /*----Store the selected Limit value in the input hidden field--------*/
                  function setLimit($limit)
                  {
                    
                    $("#limit").val($limit);
                    $("#tagfilter").submit();
                  }

                  /*----Store the selected price value in the input hidden field--------*/  
                  function setprice()
                  { 
                    
                    $("#lowerprice").val($("#skip-value-lower").html());
                    $("#upperprice").val($("#skip-value-upper").html());
                    $("#tagfilter").submit();
                  }
                  
                  /*----Store the selected color value in the input hidden field--------*/
                  function setcolor($colo)
                  { 
                    console.log("color set successful");
                    $("#colorId").val($colo);
                    $("#tagfilter").submit();
                  }
              </script>
              

              <!-----All Filter wrapped up in a form-------------->
              <form action="product.php" method="post" id="tagfilter">
<div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
          <aside class="aa-sidebar">
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Category</h3>


              <!-------Query to show total number of available category-------->
                <?php 
                $display="select *from category";
                $displayquery=mysqli_query($conn, $display);
                while ($result=mysqli_fetch_array($displayquery)) {
                ?>

              <!-------------------Function Called on click-------------------->
               <a onclick="setCatId(<?php echo $result['category_id'];?>)" 
              <?php if(isset($_POST['catid']))
              {
              if($result['category_id']==$_POST['catid'])
              {

                /*-----CSS applied on the selected option--------*/
                echo 'style="color:#ff6666"';
              }
              }
              ?>
              ><?php echo $result['category_name'];?></a><p></p>
              
              <?php } ?>
              <input type="hidden"  name="catid" id="catid" value="<?php echo empty($_POST['catid'])?'':$_POST['catid']?>">
              </ul>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Tags</h3>
              <div class="tag-cloud">
              

              <!-------Query to show total number of available Tags-------->
                <?php 
                $display= "select * from tags ";
                $displayquery=mysqli_query($conn, $display);
                while ($result=mysqli_fetch_array($displayquery)) {
                ?>

                
              <!-------------------Function Called on click-------------------->
                <a onclick="setTagId(<?php echo $result['tag_id'];?>)" 
              <?php if(isset($_POST['tagid']))
              {
              if($result['tag_id']==$_POST['tagid'])
              {
                /*-----CSS applied on the selected option--------*/
                echo 'style="background-color:#ff6666"';
              }
              }
              ?>
              ><?php echo $result['tag_name'];?></a>
              
              <?php } ?>
                
                <!-----tagid,page,limit set to pass the value on the other page------->
                
                <input type="hidden"  name="tagid" id="tagid" value="<?php echo empty($_POST['tagid'])?'':$_POST['tagid']?>">
                <input type="hidden" name="page" id="page" value="<?php echo !empty($_POST['page'])?$_POST['page']:"1"?>">
                <input type="hidden" name="limit" id="limit" value="<?php echo !empty($_POST['limit'])?$_POST['limit']:"9"?>">
              </div>
            </div>

            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>  

              <!-- price range -->
              <div class="aa-sidebar-price-range">
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <span id="skip-value-lower" class="example-val" >0.00</span>
                  <span id="skip-value-upper" class="example-val" >100.00</span>
                  <input type="hidden" name="lowerprice" id="lowerprice" value="<?php echo empty($_POST['lowerprice'])?'':$_POST['lowerprice']?>">
                  <input type="hidden" name="upperprice" id="upperprice" value="<?php echo empty($_POST['upperprice'])?'':$_POST['upperprice']?>">
                 <button class="aa-filter-btn" onclick="setprice()" name="pricefilter">Filter</button>
               </div>              

            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <div class="aa-color-tag">

              <!-------Query to show total number of available colors-------->
              <?php 
              $i=0;
                $display= "select * from colors ";
                $displayquery=mysqli_query($conn, $display);
                while ($result=mysqli_fetch_array($displayquery)) {
                  $i++;
                ?>
                <a class="aa-color-<?php echo $result['color']; ?>" onclick="setcolor('<?php echo $result['color']; ?>')"></a>
                 
                <?php }
                
                ?>   
                <input type="hidden" name="colorId" id="colorId" value="<?php echo empty($_POST['colorId'])?'':$_POST['colorId']?>">
                                        
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Recently Views</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Top Rated Products</h3>
              <div class="aa-recently-views">
                <ul>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                  <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-1.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>
                   <li>
                    <a href="#" class="aa-cartbox-img"><img alt="img" src="img/woman-small-2.jpg"></a>
                    <div class="aa-cartbox-info">
                      <h4><a href="#">Product Name</a></h4>
                      <p>1 x $250</p>
                    </div>                    
                  </li>                                      
                </ul>
              </div>                            
            </div>
          </aside>
        </div>
              </form>