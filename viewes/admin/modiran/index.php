<?php

$active = 'modiran';
require('viewes/admin/layout.php');
?>

<div class="admin_main">
    <h4>معرفی مدیران</h4>

    <form action="adminmodiran/delete" method="post">

        <table class="admin" cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th>تصویر</th>
                <th>نام و نام خانوادگی</th>
                <th>سمت</th>
                <th>تلفن</th>
                <th>ایمیل</th>
                <th>ویرایش</th>
                <th>انتخاب</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $modiran = $data['modiran'];
            foreach ($modiran as $modir) {
                ?>

                <tr>
                    <td style="width: 100px;">
                        <?php
                        if (file_exists('public/image/modiran/m' . $modir['id'] . '.' . $modir['exp'])) {
                            ?>
                            <img src="public/image/modiran/m<?= $modir['id']; ?>.<?= $modir['exp']; ?>" alt="">
                            <?php
                        } else {
                            ?>
                            <img src="public/image/modiran/m-default.jpg">
                            <?php
                        }
                        ?>
                    </td>
                    <td><?= $modir['name_family']; ?></td>
                    <td><?= $modir['post_title']; ?></td>
                    <td><?= $modir['tel']; ?></td>
                    <td><?= $modir['email']; ?></td>
                    <td>
                        <a href="adminmodiran/addmodir/<?= $modir['id']; ?>">
                            <img class="icon" width="20" src="public/image/icon/edit.gif" alt="">
                        </a>
                    </td>
                    <td>
                        <div class="check_part">
                            <span class="check_box_span"></span>
                            <input type="checkbox" class="check_box_input" name="id[]" value="<?= $modir['id']; ?>">
                        </div>
                    </td>
                </tr>

                <?php
            }
            ?>
            </tbody>
        </table>

        <div class="left-btn">
            <a class="btn" href="adminmodiran/addmodir">افزودن</a>
            <button class="btn btn_inv">حذف</button>
        </div>


    </form>
</div>

</div><!--end of flex-->