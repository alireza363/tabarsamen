<?php

class adminlogin extends controller
{
    function __construct()
    {
    }

    function index()
    {
        $result = '';

        if (isset($_POST['username'])) {

            $result = $this->model->checklogin($_POST);

            if ($result == 'its true') {
                header('location:' . URL . 'admincontent');
            } else {
                $result = 'نام کاربری و یا پسورد نادرست است.';
            }
        }
        $data = ['message' => $result];
        $this->view('admin/login/index', $data);
    }

}

?>