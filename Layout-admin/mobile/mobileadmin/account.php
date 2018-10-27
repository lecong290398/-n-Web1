<?php
include 'db.php';

class users extends db {

    public function checkLogin($username, $password) {

        $sql = 'SELECT * FROM account WHERE (`UserName` = "'.$username.'") AND (`PassWord` = md5("'.$password.'"))';

        $user = $this->select($sql);

        if ($user) {
            return 1; //login okie
        } else {
            return 0; //login error
        }
    }
}
