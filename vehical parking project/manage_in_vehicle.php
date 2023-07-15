<?php

require "layouts/main.php";
$page_type= $_GET['type'] ?? "in";
?>

<div class=" mt-5 ms-2 me-2">

<h4>latest <?php echo $page_type=="in" ? $page_type."comming" : $page_type."going";  ?> vehicals</h4>

<?php

include "config.php";

$sql = "SELECT p.* , v.* FROM parking as p  inner join vehicals as v on p.vid= v.vid where p.status='$page_type' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

?>

    <table class="table table-dark table-striped table-responsive">
        <thead>
            <tr>
                <td>pid</td>
                <td>Vehicle_name</td>
                <td>time</td>
                <td>Parking_no</td>
                <td>action</td>


            </tr>
        </thead>
        <tbody>
            <?php

            while ($row = mysqli_fetch_assoc($result)) {

            ?>


                <tr>
                    <td><?php echo $row['pid'] ?></td>
                    <td><?php echo $row['vehicle_name'] ?></td>
                    <td><?php echo $row['vehical_timing'] ?></td>
                    <td><?php echo $row['parking_no'] ?></td>
                    <td class="button" name="delete"><a type="button" href="delete_invehicle.php?in_id=<?php echo $row['pid'] ?>"><i class="bi bi-trash-fill"></i></a></td>


                </tr>


        <?php }
        } ?>
        </tbody>


    </table>
</div>

<?php

require "layouts/footer.php";
