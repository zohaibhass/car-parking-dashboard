<?php
include "config.php";

$vehicle_id= $_GET['pid'];

$sql="DELETE FROM vehicals WHERE vid={$vehicle_id}";

if(mysqli_query($conn,$sql)){


    header ("location:http://localhost/vehical parking project/vehical.php" );

}else{
    echo "<p style='color:red; margin: 10px 0;'>can't delete</p>";
}

mysqli_close($conn);



?>