<?php

class model_uploadFile extends model
{

    function __construct()
    {
        parent::__construct();
        $this->user = self::sessionGet('user');
    }

    function uploadFile($id, $des, $file)
    {
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];

        $msg = '';
        $uploadok = 1;
        if ($fileSize > 5242880) {
            $uploadok = 0;
            $msg = 'اندازه فایل بزرگتر از 5Mb است...';
        }

        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        if ($fileType != 'image/jpeg' and $fileType != 'image/jpg' and $fileType != 'image/png' and $ext != 'xlsx' and $ext != 'pdf' and $ext != 'docx' and $ext != 'txt') {
            $uploadok = 0;
            $msg = 'نوع فایل قابل قبول نیست...';
        }

        if ($uploadok == 1) {
            $newName = $id . '_' . time() . '.' . $ext;//random name
            if (!file_exists('public/sahamdar/' . $id)) {
                mkdir('public/sahamdar/' . $id);
            }
            $target = 'public/sahamdar/' . $id . '/' . $newName;

            move_uploaded_file($fileTmp, $target);

            $sql = 'insert into tbl_sahamdar_file (filename, ext, description, parent) VALUES (?,?,?,?)';
            $data = [$newName, $ext, $des, $id];
            $this->doquery($sql, $data);

            $msg = 'فایل با موفقیت بارگزاری شد..';
        }

        return $msg;
    }

}

?>