<?php

require "layouts/main.php";

?>
<h4 class="text-center mt-3">Add a new setting</h4>
<form action="save_meta_setting.php" method="POST" enctype="multipart/form-data"  class="col  g-5 mt-3 ms-5 mb-5 me-5 border p-3">




  <div class="col-6">
    <label for="text" class="form-label">setting_name</label>
    <input name="setting_name" type="text" class="form-control" id="text">
  </div>
  <div class="col-6">
    
    <label for="category" class="form-label">add type</label>
    <select name="select_setting" id="category" class="form-select">
      <option value="text">Text</option>
      <option value="select">Select</option>
      <option value="file">File</option>
      <option value="radio">Radio</option>
    </select>
  </div>


  <div class="col-6 mt-4">
    
    <label for="category" class="form-label">add setting options (if required ) Comma Separated</label>
    <input name="setting_options" type="text" class="form-control" id="">
  </div>
  <div class=" mt-2 col-12">
    <button type="submit" name="add" class="btn btn-primary">Add</button>
  </div>
</form>
