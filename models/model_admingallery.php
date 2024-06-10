<?php

class model_admingallery extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function getgallery()
    {
        $sql = 'select * from tbl_gallery';
        $result = self::doselect($sql);

        return $result;
    }

    function addgallery($file)
    {
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];

        $uploadok = 1;
        if ($fileType != 'image/jpg' and $fileType != 'image/jpeg' and $fileType != 'image/png') {
            $uploadok = 0;
            $msg = 'نوع فایل قابل قبول نیست!';
        }

        if($fileSize > 2097152){
            $uploadok = 0;
            $msg = 'اندازه فایل بزرگ است!';
        }

        if ($uploadok == 1) {
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $target = 'public/image/gallery/';

            $sql = 'insert into tbl_gallery (img) VALUES (?)';
            $data = ['x' . '.' . $ext];
            $this->doquery($sql, $data);

            $newName = self::$conn->lastInsertId();

            $newtarget = $target . $newName . '.' . $ext;
            move_uploaded_file($fileTmp, $newtarget);
            $msg = 'بارگزاری فایل با موفقیت انجام شد.';
        }

        return $msg;
    }

    function deletegallery($ides)
    {
        $target = 'public/image/gallery/';

        foreach ($ides as $id) {
            if (file_exists($target . $id . '.jpg')) {
                unlink($target . $id . '.jpg');
            } elseif (file_exists($target . $id . '.png')) {
                unlink($target . $id . '.png');
            }
        }

        $ides = join(',', $ides);
        $sql = 'delete from tbl_gallery WHERE id IN (' . $ides . ')';
        $this->doquery($sql);
    }

}