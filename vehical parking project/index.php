<?php

require "layouts/main.php";

?>

<!-- start-cards -->


<div class="container  ">
    <div class="row  mt-4">
<?php
include "config.php";
$sql=" SELECT count(*) as in_park FROM parking where vehical_timing > CURDATE() - INTERVAL 1 day and status='in'";

$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)>0){
    $in_park= mysqli_fetch_assoc($result);

}




?>

        <div class="col-md-3 col-6 m-auto">
            <div class="card bg-dark text-white">
                <img src="layouts\images\gradient4.png" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <div class="card-title">todays incomming vehicals</div>

                    <p class="text-center card-text"><?php echo $in_park['in_park']; ?></p>
                </div>
            </div>
        </div>
        <?php ?>
        <div class="col-md-3 col-6 m-auto">
            <?php  
            
            include "config.php";
            $sql="SELECT count(*) as out_park FROM parking where CURDATE() > CURDATE() - interval 1 day and status='out'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
                $park_out=mysqli_fetch_assoc($result);
            }


            ?>
            <div class="card bg-dark text-white h-30">
                <img src="layouts\images\gradientt3.png" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <div class=" ms-3 me-2 card-title">todays outgoing vehicals</div>

                    <p class=" text-center"><?php echo $park_out['out_park'] ?></p>

                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 m-auto">
     <?php
     include "config.php";
     $sql="SELECT count(*) as max_count, v.vehicle_name FROM parking as p inner join vehicals as v on v.vid= p.vid group by p.vid order by max_count desc limit 1";
     $result=mysqli_query($conn,$sql);
     if(mysqli_num_rows($result)>0){
        $most_visted=mysqli_fetch_assoc($result);
 
     }

     
     
     ?>

            <div class="card bg-dark text-white">
                <img src="layouts\images\gradientt3.png" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <div class="ms-3 me-2 card-title">vehicle with most entries</div>

                    <p class=" text-center card-text"><?php echo $most_visted['vehicle_name'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-6 m-auto">

        <?php
        include "config.php";
        $sql="SELECT  COUNT(*) AS max_count,vehicals.vehicle_name,parking.status FROM parking  inner join vehicals on vehicals.vid=parking.vid where parking.status='out' GROUP BY parking.vid order by max_count desc limit 1";
        $result=mysqli_query($conn,$sql);
        $all_in_out="";
        if(mysqli_num_rows($result)>0){

            $all_in_out=mysqli_fetch_assoc($result);
            
        }
        ?>
            <div class="card bg-dark text-white">
                <img src="layouts\images\gradient4.png" class="card-img" alt="...">
                <div class="card-img-overlay">
                    <div class="ms-3 me-2 card-title">most outgoing vehicle</div>
                    <p class=" text-center card-text"><?php echo $all_in_out['vehicle_name']  ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- end-cards -->

    <!-- start-tables -->

    <div class=" mt-5 ms-2 me-2">

        <h4>latest incomming vehicals</h4>

        <?php

        include "config.php";

        $sql = "SELECT vid,vehicle_name,owner_name,vehicle_reg_no,category,c_name FROM vehicals JOIN category ON vehicals.category=category.cid ";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {





        ?>

            <table class="table table-dark table-striped table-responsive">
                <thead>
                    <tr>
                        <td>Vid</td>
                        <td>Vehicle_name</td>
                        <td>Owner_name</td>
                        <td>vehicle_reg_no</td>
                        <td>category</td>

                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($row = mysqli_fetch_assoc($result)) {

                    ?>


                        <tr>
                            <td><?php echo $row['vid'] ?></td>
                            <td><?php echo $row['vehicle_name'] ?></td>
                            <td><?php echo $row['owner_name'] ?></td>
                            <td><?php echo $row['vehicle_reg_no'] ?></td>
                            <td><?php echo $row['c_name'] ?></td>

                        </tr>


                <?php }
                } ?>
                </tbody>


            </table>
    </div>

    <?php

    require "layouts/footer.php";
