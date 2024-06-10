<?php

class model_search extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function getsahamdar($keyword, $srchtpy)
    {
        $searchBy = '';
        if ($keyword != '') {
            if ($srchtpy == 1) {
                $searchBy = $searchBy . 'WHERE id like "%' . $keyword . '%"';
            }
            if ($srchtpy == 2) {
                $searchBy = $searchBy . 'WHERE meli like "%' . $keyword . '%"';
            }
            if ($srchtpy == 3) {
                $searchBy = $searchBy . 'WHERE mobile like "%' . $keyword . '%"';
            }
            if ($srchtpy == 4) {
                $searchBy = $searchBy . 'WHERE name like "%' . $keyword . '%" or family like "%' . $keyword . '%"';
            }
        }

        $sql = 'select * from tbl_sahamdar ' . $searchBy;
        $result = self::doselect($sql);

        return $result;
    }


    function getcomment()
    {
        $sql = 'select * from tbl_comment ORDER BY id DESC ';
        $result = self::doselect($sql);

        foreach ($result as $key => $item) {
            $result[$key]['date_comment'] = self::jalaliDate('j F Y', $item['date_comment']);
            if ($item['confirm'] == 0) {
                $x = 'عدم تایید';
            } else {
                $x = 'تایید شده';
            }
            $result[$key]['confirm'] = $x;
        }

        return $result;
    }

    function getcontent()
    {
        $sql = 'select * from tbl_content ORDER BY id DESC';
        $result = self::doselect($sql);

        foreach ($result as $key => $item) {
            if ($item['type_content'] == 1) {
                $x = 'اخبار';
            }
            if ($item['type_content'] == 2) {
                $x = 'اطلاعیه';
            }
            if ($item['type_content'] == 3) {
                $x = 'نوشته';
            }
            $result[$key]['type_content'] = $x;

            $result[$key]['date_write'] = self::jalaliDate('j F Y', $item['date_write']);

            if ($item['date_update'] == 0) {
                $x = 'بدون بروزرسانی';
            } else {
                $x = self::jalaliDate('j F Y', $item['date_update']);
            }
            $result[$key]['date_update'] = $x;

            $scores = unserialize($item['score']);
            $num_score = 0;
            $sum_score = 0;
            foreach ($scores as $key1 => $score) {
                $num_score = $num_score + $score;
                $sum_score = $score * $key1 + $sum_score;
            }
            if ($num_score == 0) {
                $x = 'بدون امتیاز';
            } else {
                $avg_score = floor($sum_score / $num_score);
                if ($avg_score == 1) {
                    $x = 'بد';
                }
                if ($avg_score == 2) {
                    $x = 'متوسط';
                }
                if ($avg_score == 3) {
                    $x = 'خوب';
                }
                if ($avg_score == 4) {
                    $x = 'عالی';
                }
                if ($avg_score == 5) {
                    $x = 'بسیار عالی';
                }
            }
            $result[$key]['score'] = $x;
        }

        return $result;
    }

    function doSearch($data)
    {
        $stp = $data['stp'];

        if ($stp == 'sahamdar') {
            $keyword = $data['keyWord'];
            $srchtpy = $data['srchtyp'];
            $result = $this->getsahamdar($keyword, $srchtpy);

        } elseif ($stp == 'comment') {
            $result = $this->getcomment();

        } elseif ($stp == 'content') {
            $result = $this->getcontent();

        }

        $current_page = $data['currentPage'];
        $offset = ($current_page - 1) * 20;

        $page_number = sizeof($result) / 20;
        $page_number = ceil($page_number);

        $result = array_slice($result, $offset, 20);

        return [$result, $page_number];
    }

    function pager($currentPage)
    {
        $sql = "select * from tbl_content WHERE type_content<=? ORDER BY id DESC";
        $result = self::doselect($sql, [2]);

        foreach ($result as $key => $item) {
            $result[$key]['date_write'] = self::jalaliDate('j F Y', $item['date_write']);
            if ($item['type_content'] == 1) {
                $x = 'اخبار';
            } elseif ($item['type_content'] == 2) {
                $x = 'اطلاعیه';
            };

            $result[$key]['type_content'] = $x;

            if (file_exists('public/image/content/' . $item['id'] . '/thumbnail.jpg')) {
                $result[$key]['file_exists'] = 1;
            } else {
                $result[$key]['file_exists'] = 0;
            }
        }

        $offset = ($currentPage - 1) * 6;

        $page_number = sizeof($result) / 6;
        $page_number = ceil($page_number);

        $result = array_slice($result, $offset, 6);

        return [$result, $page_number];
    }

    function dosearch2($keyword)
    {
        $sql = 'select * from tbl_content WHERE title like "%' . $keyword . '%"';
        $result = self::doselect($sql);

        return $result;
    }
}

?>