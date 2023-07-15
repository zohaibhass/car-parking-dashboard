<?php 

if(isset($_POST['add'])){
 include "config.php";


 $vehicle_name=mysqli_real_escape_string($conn,$_POST['vehicle_name']);
 $parking_no="#".mysqli_real_escape_string($conn,rand(99999,9999999));
 $time=mysqli_real_escape_string($conn,$_POST['vehicle_time']);
 $status=mysqli_real_escape_string($conn,$_POST['status_name']);
 $sql="INSERT INTO parking (vid,parking_no,vehical_timing,status)
         VALUES ('{$vehicle_name}','{$parking_no}','{$time}','{$status}')";

         if(mysqli_query($conn,$sql)){
            header ("location:http://localhost/vehical parking project/manage_in_vehicle.php?type=".strtolower($status) );
         }
        }



?>