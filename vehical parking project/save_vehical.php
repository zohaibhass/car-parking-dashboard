<?php


include "config.php";
if(isset($_FILES['fileToUpload'])){

    $errors= array();

    $file_name= $_FILES['fileToUpload'] ['name'];
    $file_size= $_FILES['fileToUpload'] ['size'];
    $file_tmp= $_FILES['fileToUpload'] ['tmp_name'];
    $file_type= $_FILES['fileToUpload'] ['type'];
    $exp=explode(".", $file_type);
    $file_ext= end($exp);
    $extensions= array("jepg","jpg","png");

    if(in_array($file_ext,$extensions) === false ){

        $errors[]="this format is not allowed please upload jepg,jpg or png image";
}

if( $file_size > "2097152"){
    $errors[]=" file size is large please upload size of file 2mb or below";
}
if(empty($errors) == 0) {
    move_uploaded_file( $file_tmp,"layouts/images/".$file_name);
}  
else{
    print_r($errors);

    die();
}
  
}

if(isset($_POST['add'])){

include "config.php";
$v_name=mysqli_real_escape_string($conn,$_POST['vehical_name']);
$o_name=mysqli_real_escape_string($conn,$_POST['owner_name']);
$reg_no=mysqli_real_escape_string($conn,$_POST['v_reg_no']);
$vehicle_img=mysqli_real_escape_string($conn,"layouts/images/".$file_name);
$vehical_category=mysqli_real_escape_string($conn,$_POST['category_name']);

$sql="INSERT INTO vehicals (vehicle_name,owner_name,vehicle_reg_no,vehicle_img,category)
         VALUES('{$v_name}','{$o_name}','{$reg_no}','{$vehicle_img}','{$vehical_category}')";


if(mysqli_query($conn,$sql)){

    header ("location:http://localhost/vehical parking project/vehical.php" );
 
}  }       





?>