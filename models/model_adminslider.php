<?php

class model_adminslider extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function getSlider()
    {
        $sql = 'select * from tbl_slider ORDER BY id DESC';
        $result = self::doselect($sql);
        return $result;
    }


    function addslider($data, $files)
    {
        $title = $data['title'];
        $link = $data['link'];
        $file = $files['image'];

        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileType = $file['type'];
        $fileSize = $file['size'];

        $msg = '';
        $uploadok = 1;
        if ($fileType != 'image/jpeg' or $fileSize > 2097152) {
            $uploadok = 0;
            $msg = 'نوع یا اندازه تصویر قابل قبول نیست...';
        }

        if ($uploadok == 1) {
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $newName = time() . '.' . $ext;//random name
            $target = 'public/image/slider/' . $newName;

            move_uploaded_file($fileTmp, $target);

            $sql = 'insert into tbl_slider (slider_name, slider, slider_link) VALUES (?,?,?)';
            $data = [$title, $newName, $link];
            $this->doquery($sql, $data);
        }

        return $msg;
    }

    function delete($data)
    {
        $ides = $data['id'];
        $ides = implode(',', $ides);
        $sql = 'delete from tbl_slider WHERE id IN (' . $ides . ')';
        $this->doquery($sql);
    }

}

?>