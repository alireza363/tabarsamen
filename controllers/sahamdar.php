<?php

class sahamdar extends controller
{
    function __construct()
    {
        model::sessionInit();
        $user = model::sessionGet('user');
        if ($user == true) {
            header('location:' . URL . 'panel/');
        }
    }

    function index()
    {
        $res = '';
        if ($_POST) {
            $sahamdar_ok = $this->model->checksahamdar($_POST);
            if ($sahamdar_ok == 1) {
                header('location:' . URL . 'panel');
            } elseif ($sahamdar_ok == 'empty') {
                $res = 'لطفا شماره سهامداری و رمز عبور خود را وارد نمائید.';
            } else {
                $res = 'شماره سهامدار یا رمز عبور وارد شده صحیح نیست...';
            }
        }

        $this->view('sahamdar/index', [$res]);
    }

}

?>