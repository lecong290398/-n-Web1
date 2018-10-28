<?php

include './mobile.php';

$mobile = new mobile();

$id = $_GET['id'];
if (isset($_POST['edit'])) {
    if (isset($_FILES['fileUpload'])) {
        $image = $_FILES['fileUpload']['name'];
        $file_tmp = $_FILES['fileUpload']['tmp_name'];
    } else {
        $image = "";
    }
    $name = $_POST['name'];
    $manu_id = $_POST['manufactures_ID'];
    $type_id = $_POST['producttype_ID'];
    $price = $_POST['price'];
    
    $desc = $_POST['description'];
    $feature = $_POST['feature'];
    $edit = $mobile->editProduct($name, $manu_id, $type_id, $price, $image, $desc, $feature, $id);
   

    if (isset($edit)) {
        move_uploaded_file($file_tmp, "public/images" . $image);
        header('location:index.php');
    }
}

