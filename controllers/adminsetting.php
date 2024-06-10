<?php

class adminsetting extends controller
{

    function __construct()
    {
        $level = model::userLevel()['level_user'];
        if ($level != 1) {
            header('location:' . URL . 'adminlogin');
        }
    }

    function index($num = '')
    {
        if ($num != '') {
            $this->model->saveSetting($_POST, $num);
        }

        $this->view('admin/setting/index');
    }

}

?>