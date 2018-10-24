<?php
include './config.php';
class db{
    public static  $conection = null;   
    public function __construct () {
        if (!self::$conection) {
            self::$conection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
            self::$conection->query('SET NAMES UTF8');
        }
    }
    public function query($sql)
    {
        $data = mysqli_query(self::$conection, $sql);
        return $data;
    }

    public function select($sql) {
        $data = $this->query($sql);
        $rows = [];
            while ($row = mysqli_fetch_assoc($data)) {
            $rows[] = $row;
        }
        return $rows;
    }
}