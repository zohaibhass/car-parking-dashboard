<?php
include "config.php";

$in_id= $_GET['in_id'];

$sql="DELETE FROM parking WHERE pid={$in_id}";
$referrer = $_SERVER['HTTP_REFERER'];
$type= substr($referrer, strpos($referrer,"=")+1);

if(mysqli_query($conn,$sql)){


    header ("location:http://localhost/vehical parking project/manage_in_vehicle.php?type=".$type );

}else{
    echo "<p style='color:red; margin: 10px 0;'>can't delete</p>";
}

mysqli_close($conn);


