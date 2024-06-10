<?php

class model_admincomment extends model
{

    function __construct()
    {
        parent::__construct();
    }

    function confirm($data)
    {
        foreach ($data['id'] as $id) {
            $title = $data['title' . $id];
            $matn = $data['matn' . $id];

            $sql = 'update tbl_comment set name_family=?, matn_comment=? WHERE id=?';
            $values = [$title, $matn, $id];
            $this->doquery($sql, $values);
        }

        $ides = implode(',', $data['id']);
        $sql = 'update tbl_comment set confirm=? WHERE id IN (' . $ides . ')';
        $this->doquery($sql, [1]);
    }

    function unconfirm($data)
    {
        $ides = implode(',', $data);
        $sql = 'update tbl_comment set confirm=? WHERE id IN (' . $ides . ')';
        $this->doquery($sql, [0]);
    }

    function deleteComment($data)
    {
        $ides = implode(',', $data);

        $sql = 'delete from tbl_comment WHERE id IN (' . $ides . ')';
        $this->doquery($sql);
    }

}

?>