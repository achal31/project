<!--------This page is used to Add and Update product,tag,category values,in the table--------->
<?php 
include 'config.php';

/*---Handle Tag Page Action Add/Update Product to database functionality----*/

if (isset($_POST['action'])) {
    if (empty($_POST['tag_id'])) {


        /*---Handle Tag Page Action Add Product to database functionality----*/
        $tag=$_POST['tag'];
        $sql = "SELECT * FROM tags WHERE tag_name='".$tag."'";
        $input_detail = $conn->query($sql);
        
        /*---Query to check whether name already exist-----*/
        if ($input_detail->num_rows ==0) {

            /*---Data Insertion query-------*/
            $sql='INSERT INTO tags(tag_name)VALUES("'.$tag.'")';
            if ($conn->query($sql) === true) {
                header("location:tags.php");
            } else {
                echo'<script>alert("Unexpected error occur")</script>';
            }
        } else {
            echo'<script>alert("Tag Name already exists")</script>';
        }
    } else {

        /*---Handle Tag Page Action Update Product to database functionality----*/
        $tag=$_POST['tag'];

         /*---Query to check whether name already exist-----*/
        $sql = "SELECT * FROM tags WHERE tag_name='".$tag."' 
            and tag_id<>".$_POST['tag_id']."";
        $input_detail = $conn->query($sql);
        if ($input_detail->num_rows ==0) {

            /*----Update query-----*/
            $sql='UPDATE tags set tag_name="'.$tag.'" 
            where tag_id='.$_POST['tag_id'];
            if ($conn->query($sql) === true) {
                header("location:tags.php");
            } else {
                echo'<script>alert("Unexpected error occur")</script>';
            }
        } else {
            echo'<script>alert("Tag Name already exists")</script>';
        }
    }
}




/*---Handle Category Page Action Add/Update Product to database functionality----*/

if (isset($_POST['actionc'])) {

    if (empty($_POST['category_id'])) {

        /*---Handle Category Page Action Add Product to database functionality----*/
        $tag=$_POST['category'];

        /*---Query to check whether name already exist-----*/
        $sql = "SELECT * FROM category WHERE category_name='".$tag."'";
        $input_detail = $conn->query($sql);
        if ($input_detail->num_rows ==0) {

            /*---Data Insertion query-------*/
            $sql='INSERT INTO category(category_name)VALUES("'.$tag.'")';
            if ($conn->query($sql) === true) {
                header("location:category.php");
            } else {
                echo'<script>alert("Unexpected error occur")</script>';
            }
        } else {
            echo'<script>alert("Tag Name already exists")</script>';
        }
    } else {

        /*---Handle Category Page Action Update Product to database functionality----*/
        $tag=$_POST['category'];

        /*---Query to check whether name already exist-----*/
        $sql = "SELECT * FROM category WHERE category_name='".$tag."' 
            and category_id<>".$_POST['category_id']."";
        $input_detail = $conn->query($sql);
        if ($input_detail->num_rows ==0) {

            /*----Update query-----*/
            $sql='UPDATE category set category_name="'.$tag.'" 
            where category_id='.$_POST['category_id'];
            if ($conn->query($sql) === true) {
                header("location:category.php");
            } else {
                echo'<script>alert("Unexpected error occur")</script>';
            }
        } else {
            echo'<script>alert("category Name already exists")</script>';
        }
    }
}




/*---Handle Product Page Action Add/Update Product to database functionality----*/

if (isset($_POST['addproduct'])) {
    if (empty($_POST['productid'])) {


        /*---Handle Product Page Action Add Product to database functionality----*/


        /*---Assisgning all values in variables---*/
        $productname=$_POST['productname'];
        $productprice=$_POST['productprice'];
        $productcolor=$_POST['productcolor'];
        $productdescription=$_POST['description'];
        $productcategory=$_POST['category'];
        echo"$productcategory";
        $producttag=$_POST['tag'];
        
        
        /*---Storing Image address----*/
        $file = $_FILES['file'];
        $filename=$file['name'];
        $filetemp=$file['tmp_name'];

        $fileext=explode('.', $filename);
        $filecheck=strtolower(end($fileext));
        
        /*---Images with given extension are allowed----*/
        $fileextstored=array('png','jpg','jpeg');

        if (in_array($filecheck, $fileextstored)) {

            $destinationfile='upload/'.$filename;

            
            /*----Moving image to the upload folder---*/
            move_uploaded_file($filetemp, $destinationfile);
        
        
        
            /*---Inserting values in the table-----*/
            $sql='INSERT INTO products 
            (product_name,product_price,product_image,product_color,product_dis,product_category)
            VALUES("'.$productname.'", "'.$productprice.'", 
            "'.$destinationfile.'","'.$productcolor.'","'.$productdescription.'","'.$productcategory.'")';
            if ($conn->query($sql) === true) {
                $last_id = $conn->insert_id;
                $chkk="";
                foreach ($producttag as $chk) {
                    $chkk=$chk;
                    $sql='INSERT INTO product_tag
                (product_id,tag_id)
                VALUES("'.$last_id.'", "'.$chkk.'")';
                    $conn->query($sql);
                   }
                header("location:products.php");
               
            } else {
                echo'<script>alert("Unexpected error occur")</script>';
            }
        } else {
            echo'<script>alert("Please make sure to insert Image")</script>';
        }
    } else {

    
        /*---Handle Product Page Action Update Product to database functionality----*/

        $productname=$_POST['productname'];
        $productprice=$_POST['productprice'];
        $productcolor=$_POST['productcolor'];
        $productdescription=$_POST['description'];
        
        /*---Storing Image address----*/
        $file = $_FILES['file'];
        $filename=$file['name'];
        $filetemp=$file['tmp_name'];

        $fileext=explode('.', $filename);
        $filecheck=strtolower(end($fileext));
        
        /*---Images with given extension are allowed----*/
        $fileextstored=array('png','jpg','jpeg');

        if (in_array($filecheck, $fileextstored)) {

            $destinationfile='upload/'.$filename;

            /*----Moving image to the upload folder---*/
            move_uploaded_file($filetemp, $destinationfile);
    
            /*----Update query--------*/

            $sql='UPDATE products set product_name="'.$productname.'" ,product_price="'.$productprice.'",
            product_image="'.$destinationfile.'",product_color="'.$productcolor.'",product_dis="'.$productdescription.'"
            where product_id='.$_POST['productid'];
            if ($conn->query($sql) === true) {
                header("location:products.php");
            } else {
                echo'<script>alert("Unexpected error occur")</script>';
            }
        } else {
            echo'<script>alert("category Name already exists")</script>';
        }
    }
}
?>
    