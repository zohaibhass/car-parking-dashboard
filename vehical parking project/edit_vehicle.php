<?php

include "config.php";
if (isset($_FILES['fileToUpload'])) {

    $errors = array();

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $exp = explode(".", $file_type);
    $file_ext = end($exp);
    $extensions = array("jepg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {

        $errors[] = "this format is not allowed please upload jepg,jpg or png image";
    }

    if ($file_size > "2097152") {
        $errors[] = " file size is large please upload size of file 2mb or below";
    }
    if (empty($errors) == 0) {
        move_uploaded_file($file_tmp, "layouts/images/" . $file_name);
    } else {
        print_r($errors);

        die();
    }
}



if (isset($_POST['submit'])) {


    include "config.php";
    $_vehicals_id = mysqli_real_escape_string($conn, $_POST['vehicle_id']);
    $_vehicle_name = mysqli_real_escape_string($conn, $_POST['vehicle_name']);
    $_owner_name = mysqli_real_escape_string($conn, $_POST['owner_name']);
    $vehicle_img = mysqli_real_escape_string($conn, "layouts/images/" . $file_name);
    $_category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $_description = mysqli_real_escape_string($conn, $_POST['category_description']);
    $sql = "UPDATE vehicals
            SET vehicle_name='{$_vehicle_name}',owner_name ='{$_owner_name}',vehicle_img ='{$file_name}'c_name ='{$_category_name}',
            c_description ='{$_description}'  WHERE vid= {$_vehicals_id}";
    if (mysqli_query($conn, $sql)) {

        header("location:http://localhost/vehical parking project/vehical.php");
    }
}
?>



<?php

require "layouts/main.php";

?>

<div>
    <h4 class="text-center mt-5">Edit vehicle</h4>
</div>
<?php


include "config.php";
$edit_id = $_GET['v_id'];
$sql = "SELECT * FROM vehicals JOIN category ON vehicals.category=category.cid WHERE vid={$edit_id}";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {



?>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data" class="row g-1 mt-5 ms-5 mb-5 me-5 border p-3">
            <div class="col-12">
                <label hidden for="text" class="form-label">vehicle_id</label>
                <input hidden name="vehicle_id" type="text" class="form-control" id="text" value="<?php echo $row['vid'] ?>">
            </div>
            <div class="col-12">
                <label for="text" class="form-label">vehicle_name</label>
                <input name="vehicle_name" type="text" class="form-control" id="text" value="<?php echo $row['vehicle_name'] ?>">
            </div>
            <div class="col-12">
                <label for="text" class="form-label">vehicle_reg_no</label>
                <input name="owner_name" type="text" class="form-control" id="text" value="<?php echo $row['vehicle_reg_no'] ?>">
            </div>

            <div class="col-12">
                <label for="inputimg" class="form-label">vehical image</label>
                <input name="fileToUpload" type="file" class="form-control" id="inputimg" placeholder="">
            </div>

            <div class="col-12">
                <?php
                include "config.php";
                $sql = "SELECT * FROM category";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {

                ?>
                    <label for="category" class="form-label">vehical category</label>
                    <select name="category_name" id="category" class="form-select">

                        <?php

                        while ($row = mysqli_fetch_assoc($result)) {

                            if ($_GET['v_id'] == $row['cid']) {

                                $active = "selected";
                            } else {
                                $active = "";
                            }

                        ?>
                            <option $active value="<?php echo $row['cid']; ?>"><?php echo $row['c_name'] ?></option>

                        <?php } ?>
                    </select>

                <?php } ?>
            </div>

            <div class="col-12 p-2">
                <button name="submit" type="submit" class="btn btn-primary">save</button>
            </div>
        </form>
<?php     }
} ?>