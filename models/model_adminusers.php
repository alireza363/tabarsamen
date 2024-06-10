<?php

class model_adminusers extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function getusers()
    {
        $sql = 'select * from tbl_users';
        $result = self::doselect($sql);

        return $result;
    }

    function getuser($id)
    {
        $sql = 'select * from tbl_users WHERE id=?';
        $result = self::doselect($sql, [$id], 1);

        return $result;
    }

    function editUser($id, $data)
    {
        $admin = $data['title' . $id];
        $level = $data['level' . $id];

        $sql = 'select * from tbl_users WHERE user_admin=?';
        $result = self::doselect($sql, [$admin]);

        if(sizeof($result) == 0){
            $sql = 'update tbl_users set user_admin=?, level_user=? WHERE id=?';
            $values = [$admin, $level, $id];
            $this->doquery($sql, $values);
        }
    }

    function addUser($data)
    {
        $userAdmin = $data['user_admin'];
        $password = $data['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
//        $hashed_password = crypt($password, 'g75kn7V4uvt8y');
        $level = $data['level_user'];

        $sql = 'insert into tbl_users(user_admin, password, level_user) VALUES(?, ?, ?)';
        $values = [$userAdmin, $hashed_password, $level];
        $this->doquery($sql, $values);
    }

    function delete_md($ides)
    {
        $ides = implode(',', $ides);
        $sql = 'delete from tbl_users WHERE id IN(' . $ides . ')';
        $this->doquery($sql);
    }


}