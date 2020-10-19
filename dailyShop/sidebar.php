<!-----Script set to call different functions------>
<script>
  function submitform()
{
  $("#showform").submit();
}
                function setTagId($tagid)
                  {
                    $("#tagid").val($tagid);
                    $("#tagfilter").submit();
                  }
                  function setCatId($tagid)
                  {
                    $("#catid").val($tagid);
                    $("#tagfilter").submit();
                  }
                  function setPage($page)
                  {
                    console.log("called setPage");
                    $("#page").val($page);
                    $("#tagfilter").submit();
                  }
                  function setLimit($limit)
                  {
                    console.log("called setPage");
                    $("#limit").val($limit);
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
                <input type="hidden" name="limit" id="limit" value="<?php echo !empty($_POST['limit'])?$_POST['limit']:"3"?>">
              </div>
            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Price</h3>              
              <!-- price range -->
              <div class="aa-sidebar-price-range">
               
                  <div id="skipstep" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                  </div>
                  <span id="skip-value-lower" class="example-val">30.00</span>
                 <span id="skip-value-upper" class="example-val">100.00</span>
                 <button class="aa-filter-btn" type="submit">Filter</button>
               
              </div>              

            </div>
            <!-- single sidebar -->
            <div class="aa-sidebar-widget">
              <h3>Shop By Color</h3>
              <div class="aa-color-tag">

              <!-------Query to show total number of available colors-------->
              <?php 
                $display= "select * from colors ";
                $displayquery=mysqli_query($conn, $display);
                while ($result=mysqli_fetch_array($displayquery)) {
                ?>
                <input class="aa-color-<?php echo $result['color']; ?>" type="submit" value="<?php echo $result['color']; ?>" name="color" style="color: transparent; width:30px;">            
                <?php } ?>                           
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