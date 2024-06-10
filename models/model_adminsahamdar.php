<?php

class model_adminsahamdar extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function getIdes()
    {
        $sql = 'select id from tbl_sahamdar';
        $result = self::doselect($sql);

        return $result;
    }

    function getInfo($id)
    {
        $sql = 'select * from tbl_sahamdar WHERE id=?';
        $result = self::doselect($sql, [$id], 1);

        return $result;
    }

    function getfiles($id)
    {
        $sql = 'select * from tbl_sahamdar_file WHERE parent=?';
        $result = self::doselect($sql, [$id]);

        return $result;
    }

    function delFile($filenames)
    {
        $target = 'public/sahamdar/';

        foreach ($filenames as $filename) {
            $dir = explode('_', $filename)[0];
            if (file_exists($target . $dir . '/' . $filename)) {
                unlink($target . $dir . '/' . $filename);
            }
            $sql = 'delete from tbl_sahamdar_file WHERE filename=?';
            $this->doquery($sql,[$filename]);
        }
        $files = $this->getfiles($dir);
        if (sizeof($files) == 0) {
            rmdir($target . $dir);
        }
    }

}