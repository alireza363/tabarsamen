<?php
$active = 'content';
require('viewes/admin/layout.php');
?>

<style>
    table.admin {
        margin-top: 12px;
    }

    table.admin th.img {
        width: 150px;
    }

    table.admin th.title {
        width: 250px;
    }

    table.admin tbody tr {
        height: 100px;
    }

    table.admin tr.active {
        font-weight: bold;
        color: #0f74a8;
    }

    .imp {
        font-size: 0.75rem;
        color: green;
        background: yellow;
        border-radius: 4px;
        padding: 1px 5px;
        margin-right: 10px;
        border-top: 1px solid #cfea15;
        border-bottom: 1px solid #cfea15;
        cursor: pointer;
    }

    .right {
        width: 600px;
        text-align: right;
    }
</style>

<div class="admin_main">
    <h4>مدیریت محتوا</h4>

    <form class="form_srch" action="admincontent/delcontent" method="post">

        <div class="left-btn flex-j-between">
            <div class="right">
                <?php
                $id_intro = $data[1];
                if (isset($id_intro['1'])) {
                    ?>
                    <span class="imp">
                        <a href="admincontent/addcontent/<?= $id_intro['1']; ?>">
                کد معرفی شرکت : <?= $id_intro['1']; ?>
                        </a>
                    </span>
                    <?php
                }
                if (isset($id_intro['2'])) {
                    ?>
                    <span class="imp">
                        <a href="admincontent/addcontent/<?= $id_intro['2']; ?>">
                کد معرفی رزمندگان : <?= $id_intro['2']; ?>
                        </a>
                    </span>
                    <?php
                }
                if (isset($id_intro['3'])) {
                    ?>
                    <span class="imp">
                        <a href="admincontent/addcontent/<?= $id_intro['3']; ?>">
                کد معرفی کارگزاری : <?= $id_intro['3']; ?>
                        </a>
                    </span>
                    <?php
                }
                $id_imp = $data[2];
                if ($id_imp != 0) {
                    ?>
                    <span class="imp" style="cursor: auto">
                کد اطلاعیه صفحه نخست : <?= $id_imp; ?>
                    </span>
                    <?php
                }
                ?>
            </div>
            <div class="left">
                <a class="btn" href="admincontent/addcontent">افزودن</a>
                <button class="btn btn_inv">حذف</button>
            </div>
        </div>

        <input type="hidden" name="stp" value="content">

        <table class="admin table_data" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th>کد</th>
                <th>دسته</th>
                <th>تاریخ انتشار</th>
                <th>تاریخ بروزرسانی</th>
                <th class="img">تصویر</th>
                <th class="title">عنوان</th>
                <th>تعداد بازدید</th>
                <th>امتیاز</th>
                <th>ویرایش</th>
                <th>انتخاب</th>
            </tr>
            </thead>

            <tbody>
            <!--        tr'ha ba json ezafeh mishavand...-->
            </tbody>
        </table>

        <div class="partPg flex">
            <span class="pageto prevTo" onclick="doSearch(currentPage - 10)"><<</span>
            <span class="pageto prevTo" onclick="doSearch(currentPage - 1)"><</span>
            <ul>
                <li class="active" onclick="pagination(this, 1)">1</li>
            </ul>
            <span class="pageto nextTo" onclick="doSearch(currentPage + 1)">></span>
            <span class="pageto nextTo" onclick="doSearch(currentPage + 10)">>></span>
        </div>

    </form>
</div>

<script>
    var tbody_tbl = $('.table_data tbody');
    var pageUl = $('.partPg ul');

    function doSearch(page) {

        var data = $('.form_srch').serializeArray();    //ettela'ate form ra yekja daryaft mikonad....

        if (typeof (page) != 'undefined') {
            currentPage = page;
        } else {
            currentPage = 1;
        }
        if (currentPage < 1) {
            currentPage = 1;
        }
        var lastPage = pageUl.find('li:last-child').text();
        if (currentPage > lastPage) {
            currentPage = lastPage;
        }

        data.push({'name': 'currentPage', 'value': currentPage});

        var url = 'search/dosearch';
        $.post(url, data, function (msg) {

            var trclass;

            tbody_tbl.html('');
            $.each(msg[0], function (index, value) {

                if (value['imp'] == 1) {
                    trclass = 'active';
                } else {
                    trclass = '';
                }

                var item = '<tr class="' + trclass + '"><td>' + value['id'] + '</td><td>' + value['type_content'] + '</td><td>' + value['date_write'] + '</td><td>' + value['date_update'] + '</td><td><img class="table_img" src="public/image/content/' + value['id'] + '/thumbnail.jpg" alt="no image"></td><td>' + value['title'] + '</td><td>' + value['viewed'] + '</td><td>' + value['score'] + '</td><td><a href="admincontent/addcontent/' + value['id'] + '"><img class="icon" src="public/image/icon/Edit.gif" alt=""></a></td><td><div class="check_part"><span class="check_box_span"></span><input type="checkbox" class="check_box_input" name="id[]" value="' + value['id'] + '"></div></td></tr>';

                tbody_tbl.append(item);
            });

            dopaging(msg[1]);

        }, 'json');
    }

    doSearch();
</script>

</div><!--end of flex-->