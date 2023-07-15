<?php
session_start();

if (isset($_POST['change'])) {

    include "config.php";

    $anyFailed = false;
    unset($_POST['change']);
    
    foreach ($_POST as $key => $field) {

        if ($field == "") {
            continue;
        }
        $ins = insertIntoSettings($conn, $key, $field);
        if (!$ins) {
            $_SESSION['msgs'][] = ["code" => "danger", "msg"=> "There is an Error while saving a field. Try Again"];
            $anyFailed= true;
        }
    }

    foreach ($_FILES as $key => $field) {
        if ($field == "") {
            continue;
        }

        $filename = uploadFiles($field);

        if ($filename['code'] == "success") {
            $ins = insertIntoSettings($conn, $key, $field, $filename['data']);
            if (!$ins) {
                $_SESSION['msgs'][] = ["code" => "danger", "msg"=>$filename['data'][0]];
                $anyFailed= true;
            }
        } else {
            $_SESSION['msgs'][] = ["code" => "danger","msg"=> $filename['data'][0]];
            $anyFailed= true;
        }
    }
    // exit;

    if($anyFailed== false){
        $_SESSION['msgs'][] = ["code" => "success","msg"=>"Settings saved Successfully"];
    }
    header("location:http://localhost/vehical parking project/setting.php");
} else {
}




function insertIntoSettings($conn, $key, $field, $file_name = "")
{

    $sql1 = "SELECT meta_key,meta_value FROM settings WHERE meta_key='$key'";
    $exist = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($exist) > 0) {
        $sql = "UPDATE settings set meta_value='" . (($file_name != "" && $key == "site_logo") ? $file_name : $field) . "' where meta_key='$key'";
    } else {
        $sql = "INSERT INTO settings (meta_key,meta_value) VALUES('" . mysqli_real_escape_string($conn, $key) . "','" . mysqli_real_escape_string($conn, (($file_name != "" && $key == "site_logo") ? $file_name : $field)) . "')";
    }

    $insert = mysqli_query($conn, $sql);
    return $insert;
    // echo $sql . "<br>";
}




function uploadFiles($file)
{

    $error = [];
    $file_name = $file['name'];
    $temp_name = $file['tmp_name'];
    $file_size = $file['size'];
    $file_type = $file['type'];
    $exp = explode(".", $file_name);
    $file_ext = end($exp);
    $extensions = array("jepg","png","jpg");

    if (!in_array($file_ext, $extensions)) {
        $error[] = "this format is not allowed please insert a valid format";
    }

    if ($file_size > "2097152") {
        $error[] = "the size is large please enter image less than or equal to 2mb";
    }
    

    if (empty($error)) {
        move_uploaded_file($temp_name, "layouts/logo/" . $file_name);
        return [
            "code" => "success",
            "data" => $file_name
        ];
    } else {
        return [
            "code" => "error",
            "data" => $error
        ];
    }
}
