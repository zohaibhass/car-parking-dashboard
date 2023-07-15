<?php

require "layouts/main.php";

?>

<h4 class="text-center mt-3">Add a new vehicle</h4>
<form action="save_vehical.php" method="POST" enctype="multipart/form-data"  class="col  g-5 mt-3 ms-5 mb-5 me-5 border p-3">
  <div class="col-6">
    <label for="text" class="form-label">vehical name</label>
    <input name="vehical_name" type="text" class="form-control" id="text">
  </div>
  <div class="col-6">
    <label for="text" class="form-label">owner name</label>
    <input name="owner_name" type="text" class="form-control" id="text">
  </div>
  <div class="col-6">
    <label for="inputno" class="form-label">vehical reg no</label>
    <input name="v_reg_no" type="text" class="form-control" id="inputno" placeholder="">
  </div>
  <div class="col-6">
    <label for="inputimg" class="form-label">vehical image</label>
    <input name="fileToUpload" type="file" class="form-control" id="inputimg" placeholder="">
  </div>
  <div class="col-6">
    <?php
    include "config.php";
    $sql="SELECT * FROM category";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
    
    ?>
    <label for="category" class="form-label">vehical category</label>
    <select name="category_name" id="category" class="form-select">
      <option selected>select a category</option>
      <?php

      while ($row=mysqli_fetch_assoc($result)){
      
      ?>
      <option value="<?php echo $row['cid']; ?>"><?php echo $row['c_name'] ?></option>

      <?php } ?>
    </select>

    <?php } ?>
  </div>
  <div class=" mt-2 col-12">
    <button type="submit" name="add" class="btn btn-primary">Add</button>
  </div>
</form>




        </table>

       

    </div>
