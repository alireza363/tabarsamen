<?php

class admingallery extends controller
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
        $msg = '';
        if (isset($_FILES['image'])) {
            $msg = $this->model->addgallery($_FILES['image']);
        }

        $gallery = $this->model->getgallery();

        $data = ['gallery' => $gallery, 'msg' => $msg];

        $this->view('admin/gallery/index', $data);
    }

    function delete()
    {
        if (isset($_POST['id'])) {
            $this->model->deletegallery($_POST['id']);
        }

        $gallery = $this->model->getgallery();

        echo json_encode($gallery);
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