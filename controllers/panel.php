<?php

class panel extends controller
{
    function __construct()
    {
        model::sessionInit();
        $user = model::sessionGet('user');
        if ($user == false) {
            header('location:' . URL . 'sahamdar');
        }
    }

    function index()
    {
//        $this->model->addId();
        $sahamdar = $this->model->getInfo();
        $banks = $this->model->getbanks();

//        $stat = $this->model->getStat();
//        $msg = $this->model->getMsg();
//        $order = $this->model->getOrd();
//        $folder = $this->model->getFolder();
//        $comment = $this->model->getComment();
//        $code = $this->model->getCode();

        $data = ['sahamdar' => $sahamdar, 'banks' => $banks];

        $this->view('panel/index', $data);
    }

    function editForm($id)
    {
        $this->model->Editform($_POST, $id);

        $sahamdarInfo = $this->model->getInfo($id);
        $banks = $this->model->getbanks();

        $result = [$sahamdarInfo, $banks];

        echo json_encode($result);
    }

    function showmali()
    {
        $mali = $this->model->showMali();

        echo json_encode($mali);
    }
}

?>