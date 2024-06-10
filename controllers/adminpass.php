<?php

class adminpass extends controller
{

    function __construct()
    {
        $level = model::userLevel()['level_user'];
        if ($level != 1 and $level != 2) {
            header('location:' . URL . 'adminlogin');
        }
    }

    function index($id)
    {
        $msg = '';
        if (isset($_POST['oldpass']) and $_POST['oldpass'] != '') {

            $this->model->changepass($id, $_POST);

            $msg = 'عملیات ناموفق';

        }
        $this->view('admin/changepass/index', [$id, $msg]);
    }

}

?>