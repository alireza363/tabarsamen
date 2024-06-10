<?php

class model_index extends model
{
    function __construct()
    {
        parent::__construct();
    }


    function getslider()
    {
        $sql = 'select * from tbl_slider';
        $result = self::doselect($sql);

        return $result;
    }

    function getNews()
    {
        $sql = 'select * from tbl_content WHERE type_content=? ORDER BY id DESC limit 4';
        $result = self::doselect($sql, [1]);

        return $result;
    }

    function getimp()
    {
        $sql = 'select * from tbl_content WHERE imp=?';
        $result = self::doselect($sql, [1], 1);

        return $result;
    }

    function getIntro()
    {
        $sql = 'select * from tbl_content WHERE intro=?';
        $result = self::doselect($sql, [1], 1);

        return $result;
    }

    function getGallery() {
        $sql = 'select * from tbl_gallery';
        $result = self::doselect($sql);

        return $result;
    }
}