<?php

class search extends controller
{

    function __construct()
    {
    }

    function index($i)
    {
        $result_srch = [];
        if ($_POST['inputSrch' . $i] != '') {
            $result_srch = $this->model->dosearch2($_POST['inputSrch' . $i]);
        }
        $data = ['result_srch' => $result_srch];

        $this->view('result/index', $data);
    }

    function dosearch()
    {
        $result = $this->model->doSearch($_POST);
        echo json_encode($result);
    }

    function pager($currentPage)
    {
        $result = $this->model->pager($currentPage);
        echo json_encode($result);
    }
}

?>