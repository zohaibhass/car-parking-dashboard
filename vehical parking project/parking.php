<?php

require "layouts/main.php";

?>

<h4 class="text-center mt-3">Add parking</h4>
<form action="save_parking.php" method="POST" enctype="multipart/form-data" class="col  g-5 mt-3 ms-5 mb-5 me-5 border p-3">
    <label for="category" class="form-label">enter_vehicle</label>

    <select name="vehicle_name" id="veh_name" class="form-select">
    <?php

    include "config.php";
    $sql = "SELECT * FROM vehicals";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) >= 1) {
    ?>

            <option selected>select vehicle</option>
            <?php while ($row = mysqli_fetch_assoc($result)) {

            ?>
                <option value="<?php echo $row['vid'] ?>"> <?php echo $row['vehicle_name']." (".$row['vid'].")"; ?></option>

            <?php     }
            ?>
    
    <?php } ?>
    </select>
    <div class="col-6">
        <label for="text" class=" form-label">parking_time</label>
        <input name="vehicle_time" type="datetime-local" class="form-control" id="text">
    </div>
    <label for="category" class="form-label">status</label>
    <select name="status_name" id="category" class="form-select">
        <option selected>select status</option>

        <option value="in">In</option>
        <option value="out">Out</option>

    </select>
    <div class=" mt-2 col-12">
        <button type="submit" name="add" class="btn btn-primary">Add</button>
    </div>

</form>

<?php

require "layouts/footer.php";
