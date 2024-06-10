<style>
/*-----layout style start-----*/
    .layout {
        width: 23%;
        height: 100%;
        -webkit-box-shadow: 1px 1px 3px #ccc;
        -moz-box-shadow: 1px 1px 3px #ccc;
        box-shadow: 1px 1px 3px #ccc;
    }

    .cnt-dark .layout {
        border-color: #777;
        -webkit-box-shadow: 1px 1px 3px #6f6f6f;
        -moz-box-shadow: 1px 1px 3px #6f6f6f;
        box-shadow: 1px 1px 3px #6f6f6f;
    }

    .cnt-light .layout > ul {
        background-color: #fff;
        -webkit-box-shadow: 1px 1px 3px #ccc;
        -moz-box-shadow: 1px 1px 3px #ccc;
        box-shadow: 1px 1px 3px #ccc;
    }

    .cnt-dark .layout > ul {
        background-color: #454545;
    }

    .layout li {
        font-size: 0.875rem;
    }

    .layout li:not(:last-child) {
        border-bottom: 1px dotted #ccc;
    }

    .layout li:nth-child(2n+1) {
        background-color: lightcyan;
    }

    .cnt-dark .layout li:nth-child(2n+1) {
        background-color: #283737;
    }

    .layout li:hover {
        background-color: #92bce0 !important;
    }

    .layout a {
        display: block;
        padding: 7px;
    }

    .layout li.active {
        background-color: #28565e;
        color: #edd8de;
    }

/*-----admin_main style start-----*/
    .admin_main {
        width: 75%;
        padding: 10px;
    }
    
    .cnt-light .admin_main {
        background-color: #fff;
        -webkit-box-shadow: 1px 1px 3px #ccc;
        -moz-box-shadow: 1px 1px 3px #ccc;
        box-shadow: 1px 1px 3px #ccc;
    }

    .cnt-dark .admin_main {
        background-color: #454545;
        -webkit-box-shadow: 1px 1px 3px #6f6f6f;
        -moz-box-shadow: 1px 1px 3px #6f6f6f;
        box-shadow: 1px 1px 3px #6f6f6f;
    }

    .admin_main h4 {
        color: #28565e;
        background-color: #f7f7f7;
        padding: 5px 15px;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        margin-top: 0;
    }

    .cnt-dark .admin_main h4 {
        background: #ADA996; /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    .admin_main h4 a {
        font-size: 1.375rem;
    }
</style>

<div class="flex-j-between"><!--start of flex-->
    <div class="layout">
        <ul>
            <li class="<?php if ($active == 'setting') {
                echo 'active';
            } ?>">
                <a href="adminsetting">
                    تنظیمات سایت
                </a>
            </li>
            <li class="<?php if ($active == 'slider') {
                echo 'active';
            } ?>">
                <a href="adminslider">
                    مدیریت اسلایدر
                </a>
            </li>
            <li class="<?php if ($active == 'content') {
                echo 'active';
            } ?>">
                <a href="admincontent">
                    مدیریت محتوا
                </a>
            </li>
            <li class="<?php if ($active == 'comment') {
                echo 'active';
            } ?>">
                <a href="admincomment">
                    مدیریت نظرات
                </a>
            </li>
            <li class="<?php if ($active == 'gallery') {
                echo 'active';
            } ?>">
                <a href="admingallery">
                    مدیریت گالری تصاویر
                </a>
            </li>
            <li class="<?php if ($active == 'modiran') {
                echo 'active';
            } ?>">
                <a href="adminmodiran">
                    معرفی مدیران
                </a>
            </li>
            <li class="<?php if ($active == 'sahamdar') {
                echo 'active';
            } ?>">
                <a href="adminsahamdar">
                    لیست سهامداران
                </a>
            </li>
            <li class="<?php if ($active == 'files') {
                echo 'active';
            } ?>">
                <a href="adminsahamdar/rfiles">
                    فایل های سهامداران
                </a>
            </li>
            <li class="<?php if ($active == 'users') {
                echo 'active';
            } ?>">
                <a href="adminusers">
                    مدیریت کاربران
                </a>
            </li>

            <?php
            $userid = model::userLevel()['id'];
            ?>

            <li class="<?php if ($active == 'password') {
                echo 'active';
            } ?>">
                <a href="adminpass/index/<?= $userid; ?>">
                    تغییر رمز
                </a>
            </li>
        </ul>
    </div>

    <script>
        var currentPage = 1;

        //-----pagination-----//
        function dopaging(x) {
            pageUl.html('');
            var pageNumber = x;
            var i = 1;

            var start_i = currentPage - 1;
            if (start_i < 1) {
                start_i = 1;
            }
            var end_i = currentPage + 1;
            if (end_i > pageNumber - 1) {
                end_i = pageNumber - 1;
            }

            var active = '';
            for (i = start_i; i <= end_i; i++) {
                if (i == currentPage) {
                    active = 'active';
                } else {
                    active = '';
                }
                pageUl.append('<li onclick="pagination(this, ' + i + ')" class="' + active + '">' + i + '</li>');
            }
            if (i <= pageNumber - 1) {
                pageUl.append('...... ');
            }
            if (currentPage == pageNumber) {
                active = 'active';
            } else {
                active = '';
            }
            pageUl.append('<li onclick="pagination(this, ' + pageNumber + ')" class="' + active + '">' + pageNumber + '</li>');
        }

        function pagination(tag, i) {
            var liTag = $(tag);
            pageUl.find('li').removeClass('active');
            liTag.addClass('active');

            doSearch(i);
        }

        //-----submitadmin-----//
        function submitadmin(action) {
            var form = $('form');
            form.attr('action', action).submit();
        }
    </script>