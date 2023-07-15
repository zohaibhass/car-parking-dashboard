<?php
if(isset($_POST['submit'])){


include "config.php";
$_category_id= mysqli_real_escape_string($conn, $_POST['category_id']);
$_category_name= mysqli_real_escape_string($conn,$_POST['category_name']);
$_category_desc=mysqli_real_escape_string($conn,$_POST['category_description']);

$sql="UPDATE category
SET c_name ='{$_category_name}',c_description ='{$_category_desc}'
WHERE cid= {$_category_id}";
if(mysqli_query($conn,$sql)){

    header ("location:http://localhost/vehical parking project/category.php" );

}

}
?>



<?php

require "layouts/main.php";

?>

<div><h4 class="text-center mt-5">Edit vehicle category</h4></div>
<?php


include "config.php";
$edit_id=$_GET['eid'];
$sql="SELECT * FROM category WHERE cid={$edit_id}";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){

    while ($row=mysqli_fetch_assoc($result)) {
      


?>

<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="row g-1 mt-5 ms-5 mb-5 me-5 border p-3">
<div class="col-12">
    <label hidden for="text" class="form-label">category_id</label>
    <input hidden name="category_id" type="text" class="form-control" id="text" value="<?php echo $row['cid'] ?>">
  </div>
  <div class="col-12">
    <label for="text" class="form-label">category_name</label>
    <input name="category_name" type="text" class="form-control" id="text" value="<?php echo $row['c_name'] ?>">
  </div>
  <div class="col-12">
    <label for="text" class="form-label">category_description</label>
    <textarea name="category_description" type="text" class="form-control" id="text"><?php echo $row['c_description'] ?> </textarea>
  <div class="col-12">

  </div>
  <div class="col-12 p-2">
    <button name="submit" type="submit" class="btn btn-primary" >save</button>
  </div>
</form>
<?php     }
} ?>