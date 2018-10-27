<?php

require "config.php";

class db {

    public static $conection = null;

    public function __construct() {
        if (!self::$conection) {
            self::$conection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            self::$conection->query('SET NAMES UTF8');
        }
    }

    public function getAllProduct($page, $per_page) {
        $first_link = ($page - 1) * $per_page;
        $sql = "SELECT * FROM products, producttype, manufactures WHERE products.manufactures_ID = manufactures.Manu_ID AND manufactures.Type_ID = producttype.Type_ID ORDER BY products.ID DESC LIMIT $first_link,$per_page";
        $result = self::$conection->query($sql);
        $arr = array();
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr;
    }

    public function count($tab) {
        $sql = "SELECT * FROM $tab";

        $data = self::$conection->query($sql);

        return $data->num_rows;
    }
    
    public function countSearch($key) {
        $sql = "SELECT * FROM products WHERE name LIKE '%" . $key . "%'";
        $result = self::$conection->query($sql);
        return $result->num_rows;
    }
    
    public function search($key, $page, $per_page) {
        $first_link = ($page - 1) * $per_page;
        $sql = "SELECT * FROM products, producttype, manufactures WHERE products.manufactures_ID = manufactures.Manu_ID AND manufactures.Type_ID = producttype.Type_ID AND name LIKE '%" . $key . "%' LIMIT $first_link,$per_page";
        $result = self::$conection->query($sql);
        $arr = array();
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr;
    }
    
     public function deleteProducts($id)
    {
        $sql = 'DELETE FROM `products` WHERE `ID` = '.$id;
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
        $data = self::$connection->query($sql);
        $arr = array();
        while ($row = $data->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr;
    }

    public function getAllManufactures($id) {
        $sql = "SELECT * FROM manufactures WHERE Type_ID = $id";
        $result = self::$connection->query($sql);
        $arr = array();
        while ($row = $result->fetch_assoc()) {
            $arr[] = $row;
        }
        return $arr;
    }

    public function getProducttypeByID($id) {
        $sql = "SELECT * FROM products, producttype, manufactures WHERE products.manufactures_ID = manufactures.Manu_ID AND manufactures.Type_ID = producttype.Type_ID AND products.ID = $id";
        $result = self::$connection->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

    public function getProductByID($id) {
        $sql = "SELECT * FROM products WHERE ID = $id";
        $result = self::$connection->query($sql);
        $row = $result->fetch_assoc();
        return $row;
    }

}
