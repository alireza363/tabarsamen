<?php

class adminusers extends controller
{
    function __construct()
    {
        $level = model::userLevel()['level_user'];
        if ($level != 1) {
            header('location:' . URL . 'adminlogin');
        }
    }

    function index()
    {
        $users = $this->model->getusers();

        $data = ['users' => $users];

        $this->view('admin/users/index', $data);
    }

    function edituser($id)
    {
        $this->model->editUser($id, $_POST);
    }

    function adduser()
    {
        $this->model->addUser($_POST);
        $users = $this->model->getusers();

        echo json_encode($users);
    }

    function delete()
    {
        if (isset($_POST['id'])) {
            $this->model->delete_md($_POST['id']);
        }

        header('location:' . URL . 'adminusers');
    }

}

?>