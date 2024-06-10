<?php

class model_adminmodiran extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function getboss()
    {
        $sql = 'select tbl_user_modir.*, tbl_post.post_title
                from tbl_user_modir
                LEFT JOIN tbl_post
                ON tbl_user_modir.post=tbl_post.id';
        $result = self::doselect($sql);

        return $result;
    }

    function getInfo($id)
    {
        $sql = 'select * from tbl_user_modir WHERE id=?';
        $resutl = self::doselect($sql, [$id], 1);

        return $resutl;
    }

    function getpost()
    {
        $sql = 'select * from tbl_post';
        $result = self::doselect($sql);

        return $result;
    }

    function addmodir($data, $id, $file)
    {
        $name = $data['name'];
        $post = $data['post'];
        $tel = $data['tel'];
        $email = $data['email'];

        $size = 100 * 1024; //maximum is 100kb
        $format = ['jpg', 'png']; //format'haye ghabele ghabool
        $File = $this->getFile($file, $format, $size);

        $fileName = $File['name'];
        $exp = pathinfo($fileName, PATHINFO_EXTENSION);

        if ($id == '') {
            if ($file['name'] != '') {
                $sql = 'insert into tbl_user_modir (name_family, post, tel, email, exp) VALUES (?,?,?,?,?)';
                $values = [$name, $post, $tel, $email, $exp];
            } else {
                $sql = 'insert into tbl_user_modir (name_family, post, tel, email) VALUES (?,?,?,?)';
                $values = [$name, $post, $tel, $email];
            }
            $this->doquery($sql, $values);
            $id = self::$conn->lastInsertId();
        } else {
            if ($file['name'] != '') {
                $sql = 'update tbl_user_modir set name_family=?, post=?, tel=?, email=?, exp=? WHERE id=?';
                $values = [$name, $post, $tel, $email, $exp, $id];
            } else {
                $sql = 'update tbl_user_modir set name_family=?, post=?, tel=?, email=? WHERE id=?';
                $values = [$name, $post, $tel, $email, $id];
            }
            $this->doquery($sql, $values);
        }

        if ($File['upload'] == 1) {

            $fileTmp = $File['temp'];

            $target = 'public/image/modiran/m' . $id . '.' . $exp;
            move_uploaded_file($fileTmp, $target);
        }

        return $File['msg'];
    }

    function savepost($data)
    {
        $result = $this->getpost();
        foreach ($result as $item) {
            $value = $data['post' . $item['id']];
            $idVal = $item['id'];

            if ($value != '') {
                $sql = 'update tbl_post set post_title=? WHERE id=?';
                $this->doquery($sql, [$value, $idVal]);
            } else {
                $sql = 'delete from tbl_post WHERE id=?';
                $this->doquery($sql, [$idVal]);
            }
        }

        if (isset($idVal)) {
            $idVal++;
        } else {
            $idVal = 1;
        }

        while (isset($data['post' . $idVal])) {
            $value = $data['post' . $idVal];
            if ($value != '') {
                $sql = 'insert into tbl_post (post_title) VALUES (?)';
                $this->doquery($sql, [$value]);
            }
            $idVal++;
        }
    }

    function delete_md($ides)
    {
        $target = 'public/image/modiran/m';
        foreach ($ides as $id) {
            $fileJPG = $target . $id . '.jpg';
            $filePNG = $target . $id . '.png';
            if (file_exists($fileJPG)) {
                unlink($target . $id . '.jpg');
            }
            if (file_exists($filePNG)) {
                unlink($target . $id . '.png');
            }
        }

        $ides = implode(',', $ides);
        $sql = 'delete from tbl_user_modir WHERE id IN (' . $ides . ')';
        $this->doquery($sql);
    }

}

?>