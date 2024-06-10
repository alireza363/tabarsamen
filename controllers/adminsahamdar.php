<?php

class adminsahamdar extends controller
{
    function __construct()
    {
        $level = model::userLevel()['level_user'];
        if ($level != 1 and $level != 2) {
            header('location:' . URL . 'adminlogin');
        }
    }

    function index()
    {
        $this->view('admin/sahamdar/index');
    }

    function rfiles()
    {
        $sahamdarIdes = $this->model->getIdes();
        $data = ['sahamdar' => $sahamdarIdes];

        $this->view('admin/sahamdar/rfiles', $data);
    }

    function details($id)
    {
        $sahamdar = $this->model->getInfo($id);
        $files = $this->model->getfiles($id);
        $data = ['sahamdar' => $sahamdar, 'files' => $files];

        $this->view('admin/sahamdar/details', $data);
    }

    function downloadFile($id)
    {
        $file_names = $_POST['filename'];
        $archive_file_name = $id . '.zip';
        $file_path = 'public/sahamdar/' . $id . '/';

        //create the object
        $zip = new ZipArchive();
        //create the file and throw the error if unsuccessful
        if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE) !== TRUE) {
            exit("cannot open <$archive_file_name>\n");
        }
        //add each files of $file_name array to archive
        foreach ($file_names as $files) {
            $zip->addFile($file_path . $files, $files);
        }
        $zip->close();

        header("Content-type: application/zip");
        header("Content-Disposition: attachment; filename=$archive_file_name");
        header("Pragma: no-cache");
        header("Expires: 0");

        readfile("$archive_file_name");
        exit;
    }

    function deleteFile($id)
    {
        $this->model->delFile($_POST['filename']);

        header('location:' . URL . 'adminsahamdar/details/' . $id);
    }
}

?>