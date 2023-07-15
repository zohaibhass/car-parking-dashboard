<?php 

function getcolor($key){

    include "config.php";
    $sql="SELECT meta_value from settings where meta_key='$key' limit 1";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)>0){

        $assoc=mysqli_fetch_assoc($res);
         
        return $assoc['meta_value'];
    }
    return false;

};


function getvehicledetail($det){
    include "config.php";
    $sql1="SELECT * from vehicals where vid=$det limit 1";
    $res1=mysqli_query($conn,$sql1);
    if(mysqli_num_rows($res1)>0){
        $row=mysqli_fetch_assoc($res1);

        return $row;

    }

    return false;

}

?>