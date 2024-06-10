<?php

class changepass extends controller
{

    function __construct()
    {
//        $level = model::userLevel();
//        if ($level != 1 and $level != 2) {
//            header('location:' . URL . 'adminlogin');
//        }
    }

    function index($id)
    {
        $msg = '';
        if (isset($_POST['oldpass']) and $_POST['oldpass'] != '') {

            $this->model->changepass($id, $_POST);

            $msg = 'عملیات ناموفق';

        }
        $this->view('changepass/index', [$id, $msg]);
    }

}

?>