<?php

class history extends controller
{
    function __construct()
    {
    }

    function index()
    {
        $histo = $this->model->gethisto();

        $data = ['histo' => $histo];

        $this->view('history/index', $data);
    }

    function razman()
    {
        $histo = $this->model->getrazman();

        $data = ['histo' => $histo];

        $this->view('history/razman', $data);
    }

    function gostar()
    {
        $histo = $this->model->getgostar();

        $data = ['histo' => $histo];

        $this->view('history/gostar', $data);
    }

}

?>