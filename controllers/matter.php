<?php

class matter extends controller
{

    function __construct()
    {
    }

    function index($idnews)
    {
        $newsInfo = $this->model->newsInfo($idnews);
        $scores = $this->model->scores();
        $Newnews = $this->model->getNewnews($idnews);
        $comment = $this->model->getcomment($idnews);

        $numcomment = $comment['numcomments'];
        $comment = $comment['comments'];

        $subject = $newsInfo['subject'];
        $similar = $this->model->getsimilar($subject, $idnews);

        $data = ['newsInfo' => $newsInfo, 'similar' => $similar, 'Newnews' => $Newnews,
            'comment' => $comment, 'numcomment' => $numcomment, 'scores' => $scores];

        $this->view('matter/index', $data);
    }

    function setscore()
    {
        $this->model->setScore($_POST);
    }

    function Newnews($idnews)
    {
        $Newnews = $this->model->getNewnews($idnews);
        $data = ['Newnews' => $Newnews];
        $this->view('matter/tab1', $data, 1, 1);
    }

    function topView($idnews)
    {
        $Topview = $this->model->getTopview($idnews);
        $data = ['Topview' => $Topview];
        $this->view('matter/tab2', $data, 1, 1);
    }

    function topTalk($idnews)
    {
        $Toptalk = $this->model->getToptalk($idnews);
        $data = ['Toptalk' => $Toptalk];
        $this->view('matter/tab3', $data, 1, 1);
    }

    function comment($idnews, $idparent = 0)
    {
        model::sessionInit();
        $user = model::sessionGet('user');
        if ($user != false) {

            if ($_POST['comment_matn'] != '' and $_POST['comment_name'] != '') {

                $this->model->setcomment($_POST, $idnews, $idparent);

            }

            header('location:' . URL . 'matter/index/' . $idnews . '#comment_part');
        } else {

            header('location:' . URL . 'sahamdar');
        }
    }

    function sendanswer($id)
    {
        $this->view('matter/index/');
    }
}

?>