<?php

$active = 'comment';
require('viewes/admin/layout.php');
?>

<style>
    textarea {
        padding-top: 7px;
    }
</style>

<div class="admin_main">
    <h4>مدیریت نظرات</h4>

    <form class="form_srch" action="" method="post">

        <input type="hidden" name="stp" value="comment">

        <div class="row left-btn">
            <select id="selectAction" name="action">
                <option value="0">انتخاب نوع عملیات</option>
                <option value="1">انتشار</option>
                <option value="2">عدم انتشار</option>
                <option value="3">حذف</option>
            </select>
            <button class="btn" onclick="submitFormMulti()">اجرای عملیات</button>
        </div>

        <table class="admin table_data" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th>تاریخ</th>
                <th>کد محتوا</th>
                <th>نظردهنده</th>
                <th>متن کامل نظر</th>
                <th>تعداد لایک</th>
                <th>تعداد دیسلایک</th>
                <th>وضعیت</th>
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

    //-----submitFormMulti
    function submitFormMulti() {
        var Form = $('form');
        var actionSelected = $('#selectAction').find('option:selected').val();
        var action = '';
        if (actionSelected == 1) {
            action = 'admincomment/confirm';
        }
        if (actionSelected == 2) {
            action = 'admincomment/unconfirm';
        }
        if (actionSelected == 3) {
            action = 'admincomment/delete';
        }
        Form.attr('action', action);
        Form.submit();
    }

    //-----search
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

            tbody_tbl.html('');
            $.each(msg[0], function (index, value) {

                var item = '<tr><td>' + value['date_comment'] + '</td><td>' + value['idnews'] + '</td><td><input name="title' + value['id'] + '" type="text" value="' + value['name_family'] + '"></td><td><textarea name="matn' + value['id'] + '">' + value['matn_comment'] + '</textarea></td><td>' + value['like_count'] + '</td><td>' + value['dislike_count'] + '</td><td>' + value['confirm'] + '</td><td><div class="check_part"><span class="check_box_span"></span><input type="checkbox" class="check_box_input" name="id[]" value="' + value['id'] + '"></div></td></tr>';

                tbody_tbl.append(item);
            });

            dopaging(msg[1]);

        }, 'json');
    }

    doSearch();
</script>

</div><!--end of flex-->