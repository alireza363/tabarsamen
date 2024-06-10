<?php

class content extends controller
{

    function __construct()
    {
    }

    function index()
    {
        $content = $this->model->getAll();

        $data = ['content' => $content];

        $this->view('content/index', $data);
    }

}