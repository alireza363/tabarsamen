<?php

class model_adminpass extends model
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

//        $hashed_oldpass = password_hash($oldpass, PASSWORD_DEFAULT);
        $hashed_oldpass = crypt($oldpass, 'g75kn7V4uvt8y');
        $sql = 'select * from tbl_users WHERE id=?';
        $values = [$id];
        $result = self::doselect($sql, $values, 1);

        if(password_verify($oldpass, $result['password'])){

            if(!empty($newpass)) {
                if ($newpass == $rptpass) {
                    $hashed_password = password_hash($newpass, PASSWORD_DEFAULT);
//                $hashed_password = crypt($newpass, 'g75kn7V4uvt8y');

                    $sql = 'update tbl_users set password=? WHERE id=?';
                    $values = [$hashed_password, $id];
                    $this->doquery($sql, $values);

                    header('location:' . URL );
                }
            }

        }

    }

}

?>