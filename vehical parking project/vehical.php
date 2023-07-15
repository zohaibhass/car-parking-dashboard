<?php

require "layouts/main.php";


?>

<a href="add_vehical.php"><input class="   mt-2 ms-3  btn btn-dark" type="submit" value="Add a new vehicle"></a>

<?php

include "config.php";
$sql = "SELECT vid,vehicle_name,owner_name,vehicle_reg_no,category,c_name,c_description,vehicle_img FROM vehicals LEFT JOIN category ON vehicals.category=category.cid";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {

?>

        <div class=" mt-2 ms-3 me-3 card mb-3 p-2" style="max-width: 100%;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="<?php echo $row['vehicle_img'] ?>" class="img-fluid rounded-start mt-2" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body row">
                        <div class="col-12 col-md-10">
                            <h6 class="card-text">vehicle_name</h6>
                            <span href="#"><?php echo $row['vehicle_name'] ?></span>
                            <h6 class="card-text">owner_name</h6>
                            <span href="#"><?php echo $row['owner_name'] ?></span>
                            <h6 class="card-text">Reg no</h6>
                            <span href="#"><?php echo $row['vehicle_reg_no'] ?></span>
                            <h6 class="card-text">category</h6>
                            <span href="#"><?php echo $row['c_name'] ?></span>
                            <p class="card-text"><?php echo $row['c_description'] ?></p>
                        </div>
                        <div class="col-6 col-md-2 text-right">

                            <a href="edit_vehicle.php?v_id=<?php echo $row['vid'] ?>"><i class="bi bi-pencil-square" ></i></a>
                            <a href="delete_vehicle.php?pid=<?php echo $row['vid'] ?>" class="bg-danger rounded ml-3" style="margin-left:10px"><i class="p-3 text-light bi bi-trash-fill"></i></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

<?php     }
} ?>