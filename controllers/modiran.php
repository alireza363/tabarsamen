<?php

class modiran extends controller
{
    function __construct()
    {
    }

    function index()
    {
        $modiran = $this->model->getmodir();

        $data = ['modiran' => $modiran];
        $this->view('modiran/index', $data);
    }

}

?>