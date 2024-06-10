<?php

class model_changepass extends model
{

    function __construct()
    {
        parent::__construct();
        $this->user = self::sessionGet('user');
    }

    function changepass($id, $data)
    {
        $oldpass = $data['oldpass'];
        $newpass = $data['newpass'];
        $rptpass = $data['rptpass'];

        $sql = 'select * from tbl_sahamdar WHERE id=?';
        $values = [$id];
        $result = self::doselect($sql, $values, 1);

        if ($result != '' and !empty($newpass)) {

            $pass = $result['password'];
            $meli = $result['meli'];

            if ($pass != '') {

//                $oldpass = crypt($oldpass, 'g75kn7V4uvt8y');
                if (password_verify($oldpass, $pass)) {
                    if ($newpass == $rptpass) {
                        $hashed_password = password_hash($newpass, PASSWORD_DEFAULT);
//                        $hashed_password = crypt($newpass, 'g75kn7V4uvt8y');

                        $sql = 'update tbl_sahamdar set password=? WHERE id=?';
                        $values = [$hashed_password, $id];
                        $this->doquery($sql, $values);

                        header('location:' . URL . '/panel');
                    }
                }

            } else {

                if ($oldpass == $meli) {
                    if ($newpass == $rptpass) {
                        $hashed_password = password_hash($newpass, PASSWORD_DEFAULT);
//                        $hashed_password = crypt($newpass, 'g75kn7V4uvt8y');

                        $sql = 'update tbl_sahamdar set password=? WHERE id=?';
                        $values = [$hashed_password, $id];
                        $this->doquery($sql, $values);

                        header('location:' . URL . '/panel');
                    }
                }

            }

        }

    }

}

?>