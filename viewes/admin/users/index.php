<?php

$active = 'users';
require('viewes/admin/layout.php');
?>

<style>

    input.txt {
        width: 100% !important;
        text-align: center;
    }

    button.btn {
        margin: 20px 0 0;
    }

</style>

<div class="admin_main">
    <h4>مدیریت کاربران</h4>

    <form action="adminusers/delete" method="post">

        <table class="admin" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th>کد</th>
                <th>نام کاربری</th>
                <th>سطح دسترسی</th>
                <th>ویرایش</th>
                <th>انتخاب</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $users = $data['users'];
            foreach ($users as $user) {
                ?>

                <tr>
                    <td><?= $user['id']; ?></td>
                    <td>
                        <input name="title<?= $user['id']; ?>" type="text" value="<?= $user['user_admin']; ?>">
                    </td>
                    <td>
                        <select name="level<?= $user['id']; ?>" style="border: none;">

                            <?php
                            $m = '';
                            $o = '';
                            if ($user['level_user'] == 1) {
                                $m = 'selected';
                            } elseif ($user['level_user'] == 2) {
                                $o = 'selected';
                            }
                            ?>
                            <option value="1" <?= $m; ?>>مدیر</option>
                            <option value="2" <?= $o; ?>>اپراتور</option>

                        </select>
                    </td>
                    <td>
                        <span class="btn btn_sm" onclick="changeTd(this)">تغییر</span>
                    </td>
                    <td>
                        <div class="check_part">
                            <span class="check_box_span"></span>
                            <input type="checkbox" class="check_box_input" name="id[]" value="<?= $user['id']; ?>">
                        </div>
                    </td>
                </tr>

                <?php
            }
            ?>
            </tbody>
        </table>

        <div class="left-btn buttonUser">
            <span class="btn" onclick="AddTD()">افزودن</span>
            <button class="btn btn_inv">حذف</button>
        </div>


    </form>
</div>

<script>
    function AddTD() {

        var tbody_tbl = $('table.admin tbody');
        var lastTd = tbody_tbl.find('tr:last-child() td:first-child()').text();
        lastTd++;

        var url = 'adminusers/adduser';
        var data = {'user_admin': 'admin' + lastTd, 'password': '12345678', 'level_user': '2'};
        $.post(url, data, function (msg) {

            tbody_tbl.html('');
            $.each(msg, function (index, value) {

                var m = '';
                var o = '';
                if (value['level_user'] == 1) {
                    m = 'selected';
                } else if (value['level_user'] == 2) {
                    o = 'selected';
                }

                var item = '<tr><td>' + value['id'] + '</td><td><input name="title' + value['id'] + '" type="text" value="' + value['user_admin'] + '"></td><td><select name="level' + value['id'] + '" style="border: none;"><option value="1" ' + m + '>مدیر</option><option value="2" ' + o + '>اپراتور</option></select></td><td><span class="btn btn_sm">تغییر</span></td><td><div class="check_part"><span class="check_box_span"></span><input type="checkbox" class="check_box_input" name="id[]" value="' + value['id'] + '"></div></td></tr>';


                tbody_tbl.append(item);
            });

        }, 'json');

    }

    function changeTd(tag) {

        var rowId = $(tag).parents('tr').find('td:first-child()').text();
        var data = $('form').serializeArray();
        var url = 'adminusers/edituser/' + rowId;
        $.post(url, data);
    }

</script>

</div><!--end of flex-->
