<?php

$active = 'sahamdar';
require('viewes/admin/layout.php');
?>

<style>
    .srch {
        width: 200px;
        position: relative;
        margin: 10px auto;
        display: inline-block;
    }

    .srch input {
        width: 100%;
        padding: 4px 8px;
    }

    .srch img.srchIcon {
        width: auto;
        height: auto;
        position: absolute;
        top: 8px;
        left: 5px;
        cursor: pointer;
    }

</style>

<div class="admin_main">
    <h4>لیست سهامداران</h4>

    <form class="form_srch" action="" method="post">

        <input type="hidden" name="stp" value="sahamdar">

        <div class="row">
            <div class="srch">
                <input type="text" name="keyWord" placeholder="جستجو ...">
                <img class="srchIcon" src="public/image/icon/search2.png" onclick="doSearch()">
            </div>

            <select class="s3" name="srchtyp">
                <option value="1">شماره سهامداری</option>
                <option value="2">شماره ملی</option>
                <option value="3">شماره موبایل</option>
                <option value="4">نام و نام خانوادگی</option>
            </select>
        </div>


        <table class="admin table_data" cellpadding="0" cellspacing="0">

            <thead>
            <tr>
                <th>شماره سهامداری</th>
                <th>نام و نام خانوادگی</th>
                <th>نام پدر</th>
                <th>کد ملی</th>
                <th>موبایل</th>
                <th>تعداد سهام</th>
                <th>فایل</th>
            </tr>
            </thead>

            <tbody>
            <!--        tr'ha ba json ezafeh mishavand...-->
            </tbody>

        </table>

<!--        <div class="left-btn">-->
<!--            <a class="btn" href="adminmodiran/addmodir">افزودن</a>-->
<!--            <button class="btn btn_inv">حذف</button>-->
<!--        </div>-->

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

            tbody_tbl.html('');
            $.each(msg[0], function (index, value) {

                var item = '<tr><td>' + value['id'] + '</td><td>' + value['name'] + ' ' + value['family'] + '</td><td>' + value['father'] + '</td><td>' + value['meli'] + '</td><td>' + value['mobile'] + '</td><td>' + value['tedad'] + '</td><td><a href="adminsahamdar/details/' + value['id'] + '"><img class="icon" src="public/image/icon/View.gif" alt=""></a></td></tr>';

                tbody_tbl.append(item);
            });

            dopaging(msg[1]);

        }, 'json');
    }

    doSearch();

</script>

</div><!--end of flex-->



