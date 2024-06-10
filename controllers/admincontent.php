<?php

class admincontent extends controller
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
        $result = $this->model->getAll();

        $content = $result['content'];
        $id_intro = $result['intro'];
        $id_imp = $result['imp'];

        $data = [$content, $id_intro, $id_imp];

        $this->view('admin/content/index', $data);
    }

    function addcontent($id = '', $type = 0)
    {
        $msg = '';
        if (isset($_POST['category']) and $_POST['category'] != 0) {
            $msg = $this->model->addedit($_POST, $id, $type, $_FILES['image']);
        }

        $contentInfo = [];
        if ($id != '') {
            $contentInfo = $this->model->getInfo($id);
        }

        $allsubject = $this->model->getsub();
        $photo = $this->model->getmulti($id);

        $data = ['contentInfo' => $contentInfo, 'allsubject' => $allsubject, 'msg' => $msg, 'photo' => $photo];

        $this->view('admin/content/add', $data);
    }

    function allsubject()
    {
        if (isset($_POST['submited'])) {
            $this->model->savesub($_POST);
        }
        $subjects = $this->model->getsub();

        $data = ['subjects' => $subjects];
        $this->view('admin/content/subjects', $data);
    }

    function delcontent()
    {
        if (isset($_POST['id'])) {
            $this->model->delete_cnt($_POST['id']);
        }
        header('location:' . URL . 'admincontent');
    }

    function addPhoto($id, $intro)
    {
        $this->model->addmulti($_FILES['photo'], $id);
        $this->addcontent($id, $intro);
    }

    function delPhoto($parent, $id)
    {
        $this->model->delete_photo($parent, $id);
        $multi = $this->model->getmulti($parent);

        echo json_encode($multi);
    }

//*******************************
    function gallery($idproduct)
    {
        if ($_FILES and $_FILES['x']['name'] != '') {
            $this->model->addgallery($idproduct, $_FILES['x']);
        }

        $productInfo = $this->model->getInfo($idproduct);
        $gallery = $this->model->getgallery($idproduct);

        $data = ['productInfo' => $productInfo, 'gallery' => $gallery];
        $this->view('admin/product/gallery_', $data);
    }

    function delgallery($idproduct)
    {
        if (isset($_POST['id'])) {
            $this->model->deletegallery($_POST['id'], $idproduct);
        }
        header('location:' . URL . 'adminproduct/gallery/' . $idproduct);
    }

}