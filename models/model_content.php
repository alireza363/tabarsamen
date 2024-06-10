<?php

class model_content extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function getAll()
    {
        $sql = "select * from tbl_content WHERE type_content<=? ORDER BY id DESC";
        $result = self::doselect($sql, [2]);

        return $result;
    }

}