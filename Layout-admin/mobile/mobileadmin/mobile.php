<?php

include './db.php';

class mobile extends db {

    public function getAllProduct($page, $per_page) {
        $first_link = ($page - 1) * $per_page;
        $sql = "SELECT * FROM products, producttype, manufactures WHERE products.manufactures_ID = manufactures.Manu_ID AND manufactures.Type_ID = producttype.Type_ID ORDER BY products.ID DESC LIMIT $first_link,$per_page";
        $data = $this->select($sql);
        return $data;
    }

    public function count($tab) {
        $sql = "SELECT * FROM $tab";

        $data = $this->query($sql);
        return $data->num_rows;
    }

    public function countSearch($key) {
        $sql = "SELECT * FROM products WHERE name LIKE '%" . $key . "%'";
        $data = $this->query($sql);
        return $data->num_rows;
    }

    public function search($key, $page, $per_page) {
        $first_link = ($page - 1) * $per_page;
        $sql = "SELECT * FROM products, producttype, manufactures WHERE products.manufactures_ID = manufactures.Manu_ID AND manufactures.Type_ID = producttype.Type_ID AND name LIKE '%" . $key . "%' LIMIT $first_link,$per_page";
        $data = $this->select($sql);
        return $data;
    }

    public function deleteProducts($id) {
        $sql = 'DELETE FROM `products` WHERE `ID` = ' . $id;
        $result = self::$conection->query($sql);
        return $result;
    }

    public function create_links($base_url, $total_rows, $page, $per_page) {
        $total_links = ceil($total_rows / $per_page);
        $link = "";
        for ($j = 1; $j <= $total_links; $j++) {
            if ($j == $page) {
                $link = $link . "<li class='active'><a href='" . $base_url . "page=$j'> $j </a></li>";
            } else {
                $link = $link . "<li><a href='" . $base_url . "page=$j'> $j </a></li>";
            }
        }
        return $link;
    }

    public function getAllProducttype() {
        $sql = 'SELECT * FROM producttype';
        $data = $this->select($sql);
        return $data;
    }

    public function getAllManufactures() {
        $sql = "SELECT * FROM manufactures";
        $data = $this->select($sql);
        return $data;
    }
    
    public function addProduct($name, $manu_id, $type_id, $price, $image, $desc, $feature) {
        $sql = "INSERT INTO products(name, manufactures_ID, producttype_ID, price, image, description, feature, date) VALUES ('$name', '$manu_id', '$type_id', '$price', '$image', '$desc', $feature, now())";
        $data = $this->query($sql);
        return $data;
    }
    
    public function editProduct($name, $manu_id, $type_id, $price, $image, $desc, $feature, $id) {
        if ($image == "") {
            $sql = "UPDATE products SET name = '$name', manufactures_ID = '$manu_id', producttype_ID = '$type_id', price = '$price', description = '$desc', feature = '$feature', date = now() WHERE ID = $id";
        } else {
            $sql = "UPDATE products SET name = '$name', manufactures_ID = '$manu_id', producttype_ID = '$type_id', price = '$price', image = '$image', description = '$desc', feature = '$feature', date = now() WHERE ID = $id";
        }
        $data = $this->query($sql);
        return $data;
    }

    public function getTypeByID($id) {
        $sql = "SELECT * FROM products, producttype, manufactures WHERE products.manufactures_ID = manufactures.Manu_ID AND manufactures.Type_ID = producttype.Type_ID AND products.ID = $id";
        $data = $this->query($sql);
        $row = $data->fetch_assoc();
        return $row;
    }

    public function getProductByID($id) {
        $sql = "SELECT * FROM products WHERE ID = $id";
        $data = $this->query($sql);
        $row = $data->fetch_assoc();
        return $row;
    }
    

}
