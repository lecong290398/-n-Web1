<?php

include './db.php';

class mobile extends db {

    public function getMobile() {
        $sql = 'SELECT products.ID, products.image,products.description , products.price , products.name, manufactures.Manu_name , producttype.Type_name FROM products INNER JOIN manufactures ON products.manufactures_ID = manufactures.Manu_ID INNER JOIN producttype ON products.producttype_ID = producttype.Type_ID';
        $data = $this->select($sql);
        return $data;
    }
    public function  deleteMobile($id)
    {
        $sql = 'DELETE FROM `products` WHERE `ID` = '. $id;
        $this->query($sql);
    }
    public function findMoblie($key) {
        $sql =  'SELECT * FROM `products` WHERE `ID` = '.$key;
        $data = $this->select($sql);
        return $data[0];
    }
    public function getManufacture()
    {
        $sql = 'SELECT * FROM manufactures';
        $data = $this->select($sql);
        return $data;
    }
    public function getProtype()
    {
        $sql = 'SELECT * FROM producttype';
        $data = $this->select($sql);
        return $data;
    }
}
