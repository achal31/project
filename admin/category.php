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
<li><a href="#tab2">Add Category</a></li>
</ul>

<div class="clear"></div>

</div> <!-- End .content-box-header -->

<div class="content-box-content">

<div class="tab-content default-tab" id="tab1"> <!-- This is the target div. id must match the href of this div's tab -->

<table>

<thead>
<tr>

<th>S.NO</th>
<th>Category Name</th>
<th>Action</th>
</tr>

</thead>


<!-------Query to show all the present Category in the table------->
<tbody>
<?php 
$display= "select * from category ";
$displayquery=mysqli_query($conn, $display);
$i=0;
while ($result=mysqli_fetch_array($displayquery)) {
    $i++;
    ?>
<tr>
    <form action="category.php" method="post">
    <td><?php echo $i ;?></td>
    <td><?php echo $result['category_name'];?><input type="hidden" value="<?php echo $result['category_id'];?>" name="id"></td>
    <td>
<!-- Icons -->
<input type="submit" name="categoryfeature" value="✎">
<input type="submit" name="categoryfeature" value="❌">
</td>
</form>
</tr>
<?php } ?>
</tbody>

</table>

</div> <!-- End #tab1 -->

<div class="tab-content" id="tab2">
    <?php 
    if (empty($_SESSION['feature'])) {
        echo '<script> $(document).ready(function(){
            $("#addcategory").css("display","block");
            $("#updatecategory").css("display","none");
            });
            </script>';
    }
    
     /*-----Condition to show the details of the Category that user want to update--------*/
    if (!empty($_SESSION['id'])) {
        $id=$_SESSION['id'];
        $display= "select * from category where category_id=$id";

        $displayquery=mysqli_query($conn, $display);
    
        while ($result=mysqli_fetch_array($displayquery)) {
           
            echo '<script>
            $(document).ready(function(){
            $("#category_name").val("'.$result["category_name"].'");
            $("#category_id").val("'.$result["category_id"].'");
            });
        </script>';
        } 
        session_destroy();
    }
    ?>

    <!----Form to add new Category in the table-------->

<form action="insertion.php" method="post">

<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->

<p>
    <label>Enter the Category</label>
    <input type="hidden" name="category_id"  id="category_id">
    <input type="text" name="category"  id="category_name">
</p>
<p>
<input class="button" type="submit" value="Save" name="actionc" id="categorytag"/>
</p>

</fieldset>

<div class="clear"></div><!-- End .clear -->

</form>

</div> <!-- End #tab2 -->        

</div> <!-- End .content-box-content -->

</div> <!-- End .content-box -->


<?php include ('footer.php'); ?>
