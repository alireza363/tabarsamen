<?php

class adminmodiran extends controller
{
    function __construct()
    {
        $level = model::userLevel()['level_user'];
        if ($level != 1) {
            header('location:' . URL . 'adminlogin');
        }
    }

    function index()
    {
        $modiran = $this->model->getboss();

        $data = ['modiran' => $modiran];

        $this->view('admin/modiran/index', $data);
    }

    function addmodir($id = '')
    {
        $msg = '';
        if (isset($_POST['post']) and $_POST['post'] != 'نامشخص' and $_POST['name'] != '') {
            $msg = $this->model->addmodir($_POST, $id, $_FILES['image']);
        }
        $postes = $this->model->getpost();

        $modirInfo = '';
        if ($id != '') {
            $modirInfo = $this->model->getInfo($id);
        }
        $data = ['modirInfo' => $modirInfo, 'postes' => $postes, 'msg' => $msg];
        $this->view('admin/modiran/addmodir', $data);
    }

    function delete()
    {
        if (isset($_POST['id'])) {
            $this->model->delete_md($_POST['id']);
        }

        header('location:' . URL . 'adminmodiran');
    }

    function postmodir()
    {
        if (isset($_POST['submited'])) {
            $this->model->savepost($_POST);
        }
        $postes = $this->model->getpost();

        $data = ['postes' => $postes];
        $this->view('admin/modiran/postmodir', $data);
    }

}

?>