<?php
include 'db.php';

class account extends db {

    public function checkLogin($username, $password) {

        $sql = 'SELECT * FROM account WHERE (`UserName` = "'.$username.'") AND (`PassWord` = md5("'.$password.'"))';

        $account = $this->select($sql);

        if ($account) {
            return 1; //login okie
        } else {
            return 0; //login error
        }
    }
}
