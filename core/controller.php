<?php

class controller
{
    function __construct()
    {
    }

    function view($viewUrl, $data = [], $header = '', $footer = '')
    {
        if ($header == '') {
            require('header.php');
        }
        require('viewes/' . $viewUrl . '.php');
        if ($footer == '') {
            require('footer.php');
        }
    }

    function model($modelUrl)
    {
        require('models/model_' . $modelUrl . '.php');
        $classname = 'model_' . $modelUrl;
        $this->model = new $classname;
    }
}

?>