<?php

class contactus extends controller
{
    function __construct()
    {
    }

    function index()
    {
        $this->view('contactus/index');
    }

    function sendEmail()
    {
        $this->model->SendEmail($_POST, $_FILES);
    }

}

?>