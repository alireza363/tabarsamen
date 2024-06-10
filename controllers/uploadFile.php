<?php

class uploadFile extends controller
{

    function __construct()
    {
        $level = model::userLevel();
        if ($level != 0) {
            header('location:' . URL . 'sahamdar');
        }
    }

    function index($id)
    {
        $msg = '';
        if (isset($_FILES['upFile'])) {
            if ($_FILES['upFile']['name'] != '' and $_POST['description'] != '') {
                $msg = $this->model->uploadFile($id, $_POST['description'], $_FILES['upFile']);
            } else {
                $msg = 'لطفا همه موارد را تکمیل فرمایید...';
            }
        }

        $this->view('uploadFile/index', [$id, $msg]);
    }

}

?>