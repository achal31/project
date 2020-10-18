<?php
session_start();
include ('header.php');
include ('sidebar.php');
include 'config.php';
include 'feature.php';
include 'insertion.php';
?>

<div id="main-content"> <!-- Main Content Section with everything -->

<noscript> <!-- Show a notification if the user has disabled javascript -->
<div class="notification error png_bg">
<div>
Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
</div>
</div>
</noscript>

<!-- Page Head -->
<h2>Welcome John</h2>
<p id="page-intro">What would you like to do?</p>

<div class="clear"></div> <!-- End .clear -->

<div class="content-box"><!-- Start Content Box -->

<div class="content-box-header">

<h3>Content box</h3>

<ul class="content-box-tabs">
<li><a href="#tab1" class="default-tab">Show List</a></li> <!-- href must be unique and match the id of target div -->
<li><a href="#tab2">Add Product</a></li>
</ul>

<div class="clear"></div>

</div> <!-- End .content-box-header -->

<div class="content-box-content">

<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->

<div class="notification attention png_bg">
<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
<div>
This is a Content Box. You can put whatever you want in it. By the way, you can close this notification with the top-right cross.
</div>
</div>

<table>

<thead>
<tr>
<tr>
<th>S.NO</th>
<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Color</th>
<th>Description</th>
<th>Action</th>
</tr>

</thead>
<tbody>
<?php 
$display= "select * from products ";
$displayquery=mysqli_query($conn, $display);
$i=0;
while ($result=mysqli_fetch_array($displayquery)) {
    $i++;
?>
<tr>
    <form action="products.php" method="post">
    <td><?php echo $i;?></td>
    <td><img src="<?php echo $result['product_image'];?>" width="150" height="80"></td>
    <td><?php echo $result['product_name'];?></td>
    <td><?php echo $result['product_price'];?></td>
    <td><?php echo $result['product_color'];?><input type="hidden" value="<?php echo $result['product_id'];?>" name="id"></td>
    <td><?php echo $result['product_dis'];?></td>
    <td><input type="submit" name="productfeature" value="✎" />
    <input type="submit" name="productfeature" value="❌" /></td>
    </form>
</tr>
<?php } ?>
</tbody>

</table>

</div> <!-- End #tab1 -->

<div class="tab-content" id="tab2">
<?php 
    if(empty($_SESSION['feature']))
    {
        echo '<script> $(document).ready(function(){
            $("#addtag").css("display","block");
            $("#updatetag").css("display","none");
            });
            </script>';
    }
    if(!empty($_SESSION['id']))
    {
        $id=$_SESSION['id'];
        $display= "select * from products where product_id=$id";

        $displayquery=mysqli_query($conn, $display);

        $sql="SELECT * from product_tag where product_id=$id";
        $sqlquery=mysqli_query($conn, $sql);
        while ($result=mysqli_fetch_array($sqlquery)) { 
            echo '<script>
            $(document).ready(function(){
            $("#producttag'.$result['tag_id'].'").attr("checked","checked");
             });
        </script>';
            
        }

        while ($result=mysqli_fetch_array($displayquery)) {
           
            echo '<script>
            $(document).ready(function(){
            $("#productname").val("'.$result["product_name"].'");
            $("#productid").val("'.$result["product_id"].'");
            $("#productprice").val("'.$result["product_price"].'");
            $("#productcolor").val("'.$result["product_color"].'");
            $("#productcategory").val("'.$result["product_category"].'");
            $("#description").val("'.$result["product_dis"].'");
            $("#filename").html("'.$result["product_image"].'");
            
             });
        </script>';
        } 
        session_destroy();
    }
    
    ?>
<form action="insertion.php" method="post" enctype="multipart/form-data">
<fieldset> <!-- Set c-lass to "column-left" or "column-right" on fieldsets to divide the form into columns -->


    <p>
        <label>Product Name</label>
        <input class="text-input small-input" type="text" id="productname" name="productname" />
        <input  type="hidden" id="productid" name="productid" />

    </p>

    <p>
        <label>Price</label>
        <input class="text-input small-input" type="number" id="productprice" name="productprice" /> 
    </p>

    <p>
        <label>Select Image File to Upload</label>
        <input type="file" name="file" id="productimage" require/>
    <label id="filename"></label>
    </p>


    <p>
        <label>Category</label>              
        <select name="category" class="small-input" id="productcategory">
        <?php 
         $display= "select * from category ";
         $displayquery=mysqli_query($conn, $display);
        while ($result=mysqli_fetch_array($displayquery)) {  
             ?>
            <option value="<?php echo $result['category_id'];?>"><?php echo $result['category_name'];?></option>
        <?php } ?>
        </select> 
        </p>


    <p>
        <label>Tags</label>
        <?php 
        $display= "select * from tags ";
        $displayquery=mysqli_query($conn, $display);
        while ($result=mysqli_fetch_array($displayquery)) {
        ?>
        <input type="checkbox" value="<?php echo $result['tag_id'];?>" name="tag[]" id="producttag<?php echo $result['tag_id'];?>" /> <?php echo $result['tag_name'];?> 
        <?php } ?>
    </p>


    
    <p>
        <label>Color</label>              
        <select name="productcolor" class="small-input" id="productcolor">
        <?php 
         $display= "select * from colors ";
         $displayquery=mysqli_query($conn, $display);
        while ($result=mysqli_fetch_array($displayquery)) {  
             ?>
            <option value="<?php echo $result['color'];?>"><?php echo $result['color'];?></option>
        <?php } ?>
        </select> 
        </p>
    
    <p>
        <label>Product Description</label>
        <textarea class="text-input textarea" id="description" name="description" cols="79" rows="15"></textarea>
    </p>

    <p>
        <input class="button" type="submit" value="Save Product" name="addproduct"/>
    </p>

        </fieldset>
    <div class="clear"></div><!-- End .clear -->
</form>
</div> <!-- End #tab2 -->        

</div> <!-- End .content-box-content -->

</div> <!-- End .content-box -->

<div class="content-box column-left">

<div class="content-box-header">

<h3>Content box left</h3>

</div> <!-- End .content-box-header -->

<div class="content-box-content">

<div class="tab-content default-tab">

<h4>Maecenas dignissim</h4>
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in porta lectus. Maecenas dignissim enim quis ipsum mattis aliquet. Maecenas id velit et elit gravida bibendum. Duis nec rutrum lorem. Donec egestas metus a risus euismod ultricies. Maecenas lacinia orci at neque commodo commodo.
</p>

</div> <!-- End #tab3 -->        

</div> <!-- End .content-box-content -->

</div> <!-- End .content-box -->
<div class="clear"></div>


<!-- Start Notifications -->
<!--
<div class="notification attention png_bg">
<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
<div>
Attention notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero. 
</div>
</div>

<div class="notification information png_bg">
<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
<div>
Information notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
</div>
</div>

<div class="notification success png_bg">
<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
<div>
Success notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
</div>
</div>

<div class="notification error png_bg">
<a href="#" class="close"><img src="resources/images/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
<div>
Error notification. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin vulputate, sapien quis fermentum luctus, libero.
</div>
</div>---->

<!-- End Notifications -->
<?php include ('footer.php'); ?>