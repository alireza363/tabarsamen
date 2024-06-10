<?php

class model_modiran extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function getmodir()
    {
        $sql = 'select tbl_user_modir.*, tbl_post.post_title
                from tbl_user_modir
                LEFT JOIN tbl_post
                ON tbl_user_modir.post=tbl_post.id';
        $result = self::doselect($sql);

        return $result;
    }

}

?>