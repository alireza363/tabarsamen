<?php

class admincomment extends controller
{

    function __construct()
    {
        $level = model::userLevel()['level_user'];
        if ($level != 1 and $level != 2) {
            header('location:' . URL . 'adminlogin');
        }
    }

    function index()
    {
        $this->view('admin/comment/index');
    }

    function confirm()
    {
        if(isset($_POST['id'])) {
            $this->model->confirm($_POST);
        }
        header('location:' . URL . 'admincomment');
    }

    function unconfirm()
    {
        if(isset($_POST['id'])) {
            $this->model->unconfirm($_POST['id']);
        }
        header('location:' . URL . 'admincomment');
    }

    function delete()
    {
        if(isset($_POST['id'])) {
            $this->model->deleteComment($_POST['id']);
        }
        header('location:' . URL . 'admincomment');
    }
}

?>