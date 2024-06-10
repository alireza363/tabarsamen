<?php

class model_adminlogin extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function checklogin($data)
    {
        $username = $data['username'];
        $password = $data['password'];

        if (!empty($username) and !empty($password)) {

//            $hashed_password = crypt($password, 'g75kn7V4uvt8y');
            $sql = 'select * from tbl_users WHERE user_admin=?';
            $result = self::doselect($sql, [$username], 1);

            if (password_verify($password, $result['password'])) {

                parent::sessionInit();
                parent::sessionSet('user', $result['id']);
                return 'its true';

            } else {
                return 'its false';
            }

        } else {
            return 'its empty';
        }
    }
}

?>