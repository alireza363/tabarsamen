<?php

class model_admincontent extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function getAll()
    {
        $sql = "select * from tbl_content ORDER BY id DESC";
        $result = self::doselect($sql);

        $id_imp = 0;
        $id_intro = [];
        foreach ($result as $item) {
            if ($item['imp'] == 1) {
                $id_imp = $item['id'];
            }
            if ($item['intro'] != 0) {
                $id_intro[$item['intro']] = $item['id'];
            }
        }

        return ['content' => $result, 'imp' => $id_imp, 'intro' => $id_intro];
    }

    function introCheck()
    {
        $num = '1,2,3';
        $sql = 'select * from tbl_content WHERE intro IN (' . $num . ')';
        $result = self::doselect($sql);

        return $result;
    }

    function addedit($data, $id, $type, $file = [])
    {
        $time = time();
        $category = $data['category'];
        if (isset($data['important']) and $category == 2) {
            $imp = 1;
        } else {
            $imp = 0;
        }
        $intro = '';
        if (isset($data['introduction']) and $data['introduction'] != 0) {
            $introcheck = $this->introCheck();
            foreach ($introcheck as $row) {
                if ($row['intro'] == $data['introduction']) {
                    $intro = $type;
                }
            }
            if ($intro == '') {
                $intro = $data['introduction'];
            }
        }
        $subject = $data['subject'];
        $title = $data['title'];
        $matn = $data['matn'];

        if ($id == '') {
            $score = serialize([1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0]);
            $sql = "insert into tbl_content (type_content, subject, date_write, title, matn, score) VALUES (?,?,?,?,?,?)";
            $values = [$category, $subject, $time, $title, $matn, $score];
            $this->doquery($sql, $values);
            $id = self::$conn->lastInsertId();
        } else {
            if ($imp == 1) {
                $sql = 'update tbl_content set imp=? WHERE id!=?';
                $this->doquery($sql, [0, $id]);
            }
            $sql = "update tbl_content set type_content=?, subject=?, date_update=?, title=?, matn=?, imp=?, intro=? WHERE id=?";
            $values = [$category, $subject, $time, $title, $matn, $imp, $intro, $id];
            $this->doquery($sql, $values);
        }

        $size = 2 * 1024 * 1024; //maximum is 2Mb
        $format = ['jpg']; //formate ghabele ghabool
        $File = $this->getFile($file, $format, $size);

        if ($File['upload'] == 1) {

            $fileName = $File['name'];
            $exp = pathinfo($fileName, PATHINFO_EXTENSION);

            $fileTmp = $File['temp'];

            $target = 'public/image/content/' . $id;
            if (!file_exists($target)) {
                mkdir($target);
            }

            $target = $target . '/thumbnail.jpg';
            move_uploaded_file($fileTmp, $target);
        }

        return $File['msg'];
    }

    function addmulti($file, $id)
    {
        $size = 50 * 1024 * 1024; //maximum is 50Mb
        $format = ['jpg', 'png', 'mp4']; //formate ghabele ghabool
        $File = $this->getFile($file, $format, $size);

        if ($File['upload'] == 1) {

            $fileName = $File['name'];
            $exp = pathinfo($fileName, PATHINFO_EXTENSION);

            $sql = 'insert into tbl_content_gallery (img_name, address, parent) VALUES (?, ?, ?)';
            $dir = 'public/image/content/' . $id;
            if (!file_exists($dir)) {
                mkdir($dir);
            }
            $img_name = $id . time() . '.' . $exp;
            $address = $dir . '/' . $img_name;
            $this->doquery($sql, [$img_name, $address, $id]);

            $fileTmp = $File['temp'];

            move_uploaded_file($fileTmp, $address);
        }

    }

    function getmulti($id)
    {
        $sql = 'select * from tbl_content_gallery WHERE parent=?';
        $result = self::doselect($sql, [$id]);

        return $result;
    }

    function getInfo($id)
    {
        $sql = "select * from tbl_content WHERE id= ?";
        $result = self::doselect($sql, [$id], 1);

        return $result;
    }

    function getsub()
    {
        $sql = "select * from tbl_subject";
        $result = self::doselect($sql);

        return $result;
    }

    function savesub($data)
    {
        $result = $this->getsub();
        foreach ($result as $item) {
            $value = $data['sub' . $item['id']];
            $idVal = $item['id'];

            if ($value != '') {
                $sql = 'update tbl_subject set subject_title=? WHERE id=?';
                $this->doquery($sql, [$value, $idVal]);
            } else {
                $sql = 'delete from tbl_subject WHERE id=?';
                $this->doquery($sql, [$idVal]);
            }
        }

        if (isset($idVal)) {
            $idVal++;
        } else {
            $idVal = 1;
        }

        while (isset($data['sub' . $idVal])) {
            $value = $data['sub' . $idVal];
            if ($value != '') {
                $sql = 'insert into tbl_subject (subject_title) VALUES (?)';
                $this->doquery($sql, [$value]);
            }
            $idVal++;
        }
    }

    function delete_photo($parentId, $id)
    {
        $target = 'public/image/content/';
        $sql = 'select * from tbl_content_gallery WHERE id=?';
        $photo = self::doselect($sql, [$id], 1);
        unlink($target . $parentId . '/' . $photo['img_name']);

        $sql = 'delete from tbl_content_gallery WHERE id=?';
        $this->doquery($sql, [$id]);
    }

    function delete_cnt($ides)
    {
        foreach ($ides as $id) {
            $target = 'public/image/content/';
            $sql = 'select * from tbl_content_gallery WHERE parent=?';
            $photoes = self::doselect($sql, [$id]);
            foreach ($photoes as $photo) {
                unlink($target . $id . '/' . $photo['img_name']);
            }

            $sql = 'delete from tbl_content_gallery WHERE parent=?';
            $this->doquery($sql, [$id]);

            unlink($target . $id . '/' . 'thumbnail.jpg');
            rmdir($target . $id);
        }

        $ides = join(',', $ides);

        $sql = 'delete from tbl_content WHERE id IN (' . $ides . ')';
        $this->doquery($sql);
    }

    function getgallery($idproduct)
    {
        $sql = 'select * from tbl_gallery WHERE idproduct=?';
        $result = self::doselect($sql, [$idproduct]);

        return $result;
    }

    function galleryInfo($id)
    {
        $sql = 'select * from tbl_gallery WHERE id=?';
        $result = self::doselect($sql, [$id], 1);

        return $result;
    }

    function addgallery($idproduct, $file)
    {
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];

        $uploadok = 1;
        if ($fileType != 'image/jpg' and $fileType != 'image/jpeg' and $fileSize > 2097152) {
            $uploadok = 0;
        }

        if ($uploadok == 1) {
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $target = 'public/images/product/' . $idproduct . '/gallery/';

            $newName = time();//random name

            $target600 = $target . 'large/' . $newName . '.' . $ext;
            move_uploaded_file($fileTmp, $target600);
            $this->create_thumbnail($target600, $target600, 600, 600);

            $target115 = $target . 'small/' . $newName . '.' . $ext;
            $this->create_thumbnail($target600, $target115, 115, 115);

            $sql = 'insert into tbl_gallery (img, idproduct) VALUES (?, ?)';
            $data = [$newName . '.' . $ext, $idproduct];
            $this->doquery($sql, $data);
        }
    }

    function deletegallery($ides, $idproduct)
    {
        $target = 'public/images/product/' . $idproduct . '/gallery/';

        foreach ($ides as $id) {
            $result = $this->galleryInfo($id);
            $imageName = $result['img'];
            unlink($target . 'large/' . $imageName);
            unlink($target . 'small/' . $imageName);
        }

        $ides = join(',', $ides);
        $sql = 'delete from tbl_gallery WHERE id IN (' . $ides . ')';
        $this->doquery($sql);
    }

}