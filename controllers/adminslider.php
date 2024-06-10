<?php

class adminslider extends controller
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
            if ($_FILES['image']['name'] != '') {
                $msg = $this->model->addslider($_POST, $_FILES);
            } else {
                $msg = 'لطفا تصویر اسلایدر را انتخاب کنید...';
            }
        }
        $slider = $this->model->getSlider();
        $data = ['slider' => $slider, 'msg' => $msg];
        $this->view('admin/slider/index', $data);
    }

    function delete()
    {
        if (isset($_POST['id'])) {
            $this->model->delete($_POST);
        }
        header('location:' . URL . 'adminslider');
    }

}

?>