<?php
include "config.php";

$category_id= $_GET['cid'];

$sql="DELETE FROM category WHERE cid={$category_id}";

if(mysqli_query($conn,$sql)){


    header ("location:http://localhost/vehical parking project/category.php" );

}else{
    echo "<p style='color:red; margin: 10px 0;'>can't delete</p>";
}

mysqli_close($conn);



?>