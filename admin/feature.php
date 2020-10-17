<?php
include 'config.php';

/*---Handle Tag Page Edit And Delete Feature----------*/

if (isset($_POST['tagfeature'])) {

    /*---Tag page Delete functionality------*/
    if ($_POST['tagfeature']=="❌") {
        $id=$_POST['id'];
        echo $id;
      
        $sql="DELETE from product_tag WHERE tag_id='".$id."'"; 
        ($conn->query($sql));
        $sql="DELETE FROM tags WHERE tag_id='".$id."'";
        ($conn->query($sql));
    }

    /*---Tag page Edit Functionality-----*/
    if ($_POST['tagfeature']=="✎") {
        $_SESSION['id']=$_POST['id'];
        $_SESSION['feature']='update';
        echo '<script> $(document).ready(function(){
              $("#tab2").css("display","block");
              $("#tab1").css("display","none");
             
              });
              </script>';    
    }
}


/*---Handle Category Page Edit And Delete Feature----------*/

if (isset($_POST['categoryfeature'])) {

    /*---Category page Delete functionality------*/
    if ($_POST['categoryfeature']=="❌") {
        $id=$_POST['id'];
        echo $id;
        
        $sql="DELETE FROM category WHERE category_id='".$id."'";
        ($conn->query($sql));
    }

    /*---Category page Edit Functionality-----*/
    if ($_POST['categoryfeature']=="✎") {
        $_SESSION['id']=$_POST['id'];
        $_SESSION['feature']='update';
        echo '<script> $(document).ready(function(){
              $("#tab2").css("display","block");
              $("#tab1").css("display","none");
             
              });
              </script>';    
    }
}


/*---Handle Products Page Edit And Delete Feature----------*/

if (isset($_POST['productfeature'])) {

    /*---Product page Delete functionality------*/
    if ($_POST['productfeature']=="❌") {
        $id=$_POST['id'];   
        $sql="DELETE from product_tag WHERE product_id='".$id."'";
        ($conn->query($sql));      
        $sql="DELETE FROM products WHERE product_id='".$id."'";
        ($conn->query($sql));
    }

    /*---Product page Edit Functionality-----*/
    if ($_POST['productfeature']=="✎") {
        $_SESSION['id']=$_POST['id'];
        $_SESSION['feature']='update';
        echo '<script> $(document).ready(function(){
              $("#tab2").css("display","block");
              $("#tab1").css("display","none");
             
              });
              </script>';    
    }
}
?>