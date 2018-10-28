<?php

include './mobile.php';

$mobile = new mobile();

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $manu_id = $_POST['manufactures_ID'];
    $type_id = $_POST['producttype_ID'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $desc = $_POST['description'];
    $feature = $_POST['feature'];
    if (isset($_FILES['fileUpload'])) {
        $file_name = $_FILES['fileUpload']['name'];
        $image = $_FILES['fileUpload']['name'];
        $file_tmp = $_FILES['fileUpload']['tmp_name'];
    }
    echo $name;
    echo $manu_id;
    echo $type_id;
    echo $price;
    echo $image;
    echo $desc;
    echo $feature;
    
    $add = $mobile->addProduct($name, $manu_id, $type_id, $price, $image, $desc, $feature);
    var_dump($add);
    if (isset($add)) {
        move_uploaded_file($file_tmp, "public/images" . $file_name);
        header('location:index.php');
    }
}


