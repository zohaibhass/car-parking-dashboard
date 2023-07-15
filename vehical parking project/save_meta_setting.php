<?php
$requireOption= [
    "checkbox",
    "radio",
    "select"
];


include "config.php";
$meta_key=mysqli_real_escape_string($conn,$_POST['setting_name']);
$meta_value=mysqli_real_escape_string($conn,$_POST['select_setting']);
$meta_options= mysqli_real_escape_string($conn,$_POST['setting_options']);

$sql="INSERT INTO settings 
        (meta_key,meta_value) values ('{$meta_key}','')";

        if(mysqli_query($conn,$sql)){
            $id= mysqli_insert_id($conn);
            // die($id;)
            $sql=[];
            $sql[]="insert into meta_settings(meta_key,meta_value,setting_id) values ('type', '$meta_value', '$id')";
            
            if(in_array($meta_value, $requireOption)){
                $sql[]="insert into meta_settings(meta_key,meta_value,setting_id) values ('options', '$meta_options', '$id')";
                // addOptionsToMeta();
            }
           
            $passed= true;
            foreach($sql as $s){
                if(mysqli_query($conn,$s)){
                //    $passed= true;
                }
                else{
                    $passed = false;
                }
            }


            if($passed){
              $_SESSION['mgs']="Successfull";
            }
            else{
                $_SESSION['mgs']="Failed";
            }

            header ("location:http://localhost/vehical parking project/add_setting.php" );
        }


   


    function addOptionsToMeta(){

    }
?>

