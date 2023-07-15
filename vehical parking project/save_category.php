<?php
session_start();

if(isset($_POST['submit'])){
include "config.php";


$category_name=mysqli_real_escape_string($conn,$_POST['category_name']);
$category_desc=mysqli_real_escape_string($conn,$_POST['category_description']);

$sql="INSERT INTO category(c_name,c_description) VALUES ('{$category_name}','{$category_desc}') ";
if(mysqli_query($conn,$sql)){

    $_SESSION['msg']= [
        "type"=> "success",
        "message"=> "<code>". $category_name. "</code> Category add successfully "
    ];

   
}
else{
    $_SESSION['msg']= [
        "type"=> "warning",
        "message"=> "<code>". $category_name. "</code> Failed. Error: ".mysqli_error($conn)
    ];

   
}

header ("location:http://localhost/vehical parking project/add_category.php" );
}

?>