<?php

class model_sahamdar extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function checksahamdar($data)
    {
        $username = $data['username'];
        $password = $data['password'];

        if (!empty($username) and !empty($password)) {

            $sql = 'select * from tbl_sahamdar WHERE id=?';
            $values = [$username];
            $result = self::doselect($sql, $values, 1);

            if ($result != '') {

                $pass = $result['password'];
                if ($pass == '') {

                    if ($password == $result['meli']) {

                        parent::sessionInit();
                        parent::sessionSet('user', $result['id']);
                        return true;

                    } else {
                        return false;
                    }

                } elseif(password_verify($password, $pass)) {
//                    $password = crypt($password, 'g75kn7V4uvt8y');

                        parent::sessionInit();
                        parent::sessionSet('user', $result['id']);
                        return true;
                } else {
                    return false;
                }

            } else {
                return false;
            }

        } else {
            return 'empty';
        }

    }

}

?>