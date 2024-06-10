<?php

class model_history extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function gethisto()
    {
        $sql = 'select * from tbl_content WHERE intro=?';
        $result = self::doselect($sql, [1], 1);

        return $result;
    }

    function getrazman()
    {
        $sql = 'select * from tbl_content WHERE intro=?';
        $result = self::doselect($sql, [2], 1);

        return $result;
    }

    function getgostar()
    {
        $sql = 'select * from tbl_content WHERE intro=?';
        $result = self::doselect($sql, [3], 1);

        return $result;
    }



}

?>