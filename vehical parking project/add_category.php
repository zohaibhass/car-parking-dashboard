<?php
session_start();
require "layouts/main.php";

?>

<div><h4 class="text-center mt-5">Add a vehicle category</h4></div>

<form action="save_category.php" method="POST" class="row g-1 mt-5 ms-5 mb-5 me-5 border p-3">
    <?php 
    if(isset($_SESSION['msg']['type'])):
        ?>
        <div class="alert alert-<?php echo $_SESSION['msg']['type'] ?>">
        <h6 style="text-transform: capitalize;"><?php echo $_SESSION['msg']['message'] ?></h6>
        </div>
        <?php
        unset($_SESSION['msg']);
        endif;
        ?>
<div class="col-12">
    <label hidden for="text" class="form-label">category_id</label>
    <input hidden name="category_id" type="text" class="form-control" id="text">
  </div>
  <div class="col-12">
    <label for="text" class="form-label">category_name</label>
    <input name="category_name" type="text" class="form-control" id="text">
  </div>
  <div class="col-12">
    <label for="text" class="form-label">category description</label>
    <textarea name="category_description" type="text" class="form-control" id="text"> </textarea>
  <div class="col-12">

  </div>
  <div class="col-12 p-2">
    <button name="submit" type="submit" class="btn btn-primary">Add</button>
  </div>
</form>