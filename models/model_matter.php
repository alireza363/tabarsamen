<?php

class model_matter extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function newsInfo($id)
    {
        $sql = 'select * from tbl_content WHERE id=?';
        $result = self::doselect($sql, [$id], 1);

        $this->visitPage($id, $result['viewed']);

        return $result;
    }

    function getNewnews($id)
    {
        $sql = 'select * from tbl_content WHERE id!=? AND type_content<=? ORDER BY id DESC limit 5';
        $result = self::doselect($sql, [$id, 2]);

        return $result;
    }

    function visitPage($idcontent, $viewed)
    {
        @self::sessionInit();
        $visitor = self::sessionGet('visitor');
        if ($visitor == false) {
            $value = time() . rand(10000, 100000);//random value
            self::sessionSet('visitor', $value);

//            $sql = 'insert into tbl_visitor_content (visitor, idcontent) VALUES (?,?)';
//            $values = [$value, $idcontent];
//            $this->doquery($sql, $values);

            $viewed = $viewed + 1;
            $sql = 'update tbl_content set viewed=? WHERE id=?';
            $values = [$viewed, $idcontent];
            $this->doquery($sql, $values);

        }
//        else {
//            $sql = 'select * from tbl_visitor_content WHERE visitor=? AND idcontent=?';
//            $values = [$visitor, $idcontent];
//            $visitPage = self::doselect($sql, $values);
//            if (!isset($visitPage[0])) {
//                $viewed = $viewed + 1;
//                $sql = 'update tbl_content set viewed=? WHERE id=?';
//                $values = [$viewed, $idcontent];
//                $this->doquery($sql, $values);
//
//                $sql = 'insert into tbl_visitor_content (visitor, idcontent) VALUES (?,?)';
//                $values = [$visitor, $idcontent];
//                $this->doquery($sql, $values);
//
//            }
//        }
    }

    function scores()
    {
        $sql = 'select * from tbl_score';
        $result = self::doselect($sql);

        return $result;
    }


    function getChild($idparent)
    {
        $sql = "select * from tbl_comment WHERE idparent = ? AND confirm=?";
        $result = self::doselect($sql, [$idparent, 1]);

        return $result;
    }

    function getcomment($id)
    {
        $sql = 'select * from tbl_comment WHERE idnews=? AND idparent=0 AND confirm=?';
        $result = self::doselect($sql, [$id, 1]);
        $numcomment = sizeof($result);

        foreach ($result as $key => $item) {
            $idItem = $item['id'];
            $result[$key]['children'] = [];

            $children = $this->getChild($idItem);
            $numcomment = $numcomment + sizeof($children);

            $result[$key]['children'] = $children;
        }

        return ['comments' => $result, 'numcomments' => $numcomment];
    }

    function getsimilar($subject, $id)
    {
        $sql = 'select * from tbl_content WHERE subject=? and id!=? limit 3';
        $result = self::doselect($sql, [$subject, $id]);

        return $result;
    }

    function setScore($data)
    {
        $newsId = $data['newsId'];
        $scoreId = $data['scoreId'];

        $sql = 'select * from tbl_content WHERE id=?';
        $newsInfo = self::doselect($sql, [$newsId], 1);
        $scores = $newsInfo['score'];

        $visitor = self::getcookie('visitScore', (60 * 24 * 10));// 10 rooz
        $sql = 'select * from tbl_visitor_score WHERE visitor=? AND idcontent=?';
        $values = [$visitor, $newsId];
        $scorePage = self::doselect($sql, $values, 1);
        $x = 'امتیاز شما قبلا ثبت شده است.';
        if ($scorePage == '') {

            $sql = 'insert into tbl_visitor_score (visitor, idcontent) VALUES (?,?)';
            $this->doquery($sql, $values);

            $scores = unserialize($scores);
            foreach ($scores as $key => $score) {
                if ($scoreId == $key) {
                    $scores[$key]++;
                }
            }

            $scores = serialize($scores);
            $sql = 'update tbl_content set score=? WHERE id=?';
            $this->doquery($sql, [$scores, $newsId]);
            $x = 'امتیاز شما با موفقیت ثبت گردید.';
        }

        echo $x;
    }

    function getTopview($id)
    {
        $sql = 'select * from tbl_content WHERE id!=? AND type_content<=? ORDER BY viewed DESC limit 5';
        $result = self::doselect($sql, [$id, 2]);

        return $result;
    }

    function getToptalk($id)
    {
        $sql = 'select * from tbl_content WHERE id!=? AND type_content<=? ORDER BY id DESC limit 5';
        $result = self::doselect($sql, [$id, 2]);

        return $result;
    }

    function setcomment($data, $idnews, $idparent)
    {
        $time = time();
        $comment_name = $data['comment_name'];
        $comment_matn = $data['comment_matn'];

        $visitor = self::getcookie('visitcomment', (60 * 24 * 3));// 3 rooz
        $sql = 'select * from tbl_comment WHERE user_comment=? AND idnews=?';
        $values = [$visitor, $idnews];
        $scorePage = self::doselect($sql, $values, 1);

        if ($scorePage != '') {
            $comment_name = $scorePage['name_family'];
        }

        $sql = 'insert into tbl_comment (idnews, idparent, date_comment, name_family, user_comment, matn_comment) VALUES (?,?,?,?,?,?)';
        $values = [$idnews, $idparent, $time, $comment_name, $visitor, $comment_matn];
        $this->doquery($sql, $values);
    }

    function saveComment($data, $idproduct)
    {
        $comment_param_val = [];

        $comment_params = $this->getScore($idproduct);
        foreach ($comment_params as $item) {
            $paramId = $item['id'];
            $paramVal = $data['param' . $paramId];
            $comment_param_val[$paramId] = $paramVal;
        }
        $comment_param_val = serialize($comment_param_val);

        $title = $data['title'];
        $positive = $data['psv'];
        $negative = $data['ngv'];
        $matn = $data['matn'];

        self::sessionInit();
        $userId = self::sessionGet('user');

        $sql = 'select * from tbl_comment WHERE idproduct=? AND userId=?';
        $values = [$idproduct, $userId];
        $comment = self::doselect($sql, $values, 1);

        if (isset($comment['id'])) {

            $sql = 'update tbl_comment set title_comment=?, matn_comment=?, positive=?, negative=?, param_score=? WHERE id=?';
            $values = [$title, $matn, $positive, $negative, $comment_param_val, $comment['id']];

        }//update
        else {

            $sql = 'insert into tbl_comment (title_comment, matn_comment, positive, negative, idproduct, param_score, userId) VALUES (?,?,?,?,?,?,?)';
            $values = [$title, $matn, $positive, $negative, $idproduct, $comment_param_val, $userId];

        }//insert

        $this->doquery($sql, $values);

        header('location:' . URL . 'addComment/index/' . $idproduct);
    }


}