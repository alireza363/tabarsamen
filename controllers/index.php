<?php

class index extends controller
{

    function __construct()
    {
    }

    function index()
    {
        $slider = $this->model->getslider();
        $imp = $this->model->getimp();
        $news = $this->model->getNews();
        $intro = $this->model->getIntro();
        $gallery = $this->model->getGallery();

        $data = ['slider' => $slider, 'imp' => $imp, 'news' => $news, 'intro' => $intro, 'gallery' => $gallery];
        $this->view('index/index', $data);
    }

}

?>