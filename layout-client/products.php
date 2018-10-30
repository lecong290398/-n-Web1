<?php
//tri
    include './db.php';
    class product extends db{
        public function getAll(){
            $sql = 'SELECT * FROM products';
            $data = $this->select($sql);
            return $data;
        }
        public function selectProduct($key){
             $sql = 'SELECT * FROM products WHERE `name` LIKE "%'.$key.'%"';
             $data = $this->select($sql);
             return $data;
        }
        public function selectProductById($key){
             $sql = 'SELECT * FROM `products` WHERE `ID` LIKE '.$key;
             $data = $this->select($sql);
             return $data;
        }
        public function getPage($p){
            $n = ($p - 1) * 5;
            $sql = 'SELECT * FROM products LIMIT '.$n.',5';
            $products = $this->select($sql);
            return $products;
        }
        public function getNum_row(){
            $sql = 'SELECT * FROM products';
            $data = $this->query($sql);
            $num = mysqli_num_rows($data);
            return $num;
        }
    }
