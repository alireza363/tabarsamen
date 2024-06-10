<?php
require('viewes/admin/layout.php');
$sahamdar = $data['sahamdar'];
?>

<style>

    table td:nth-child(2) {
        direction: ltr;
    }

</style>

<div class="admin_main">
    <h4><?= $sahamdar['name'] . ' ' . $sahamdar['family']; ?></h4>

    <form action="" enctype="multipart/form-data" method="post">

        <div class="row left-btn">
            <select id="selectAction" name="action">
                <option value="0">انتخاب نوع عملیات</option>
                <option value="1">دانلود</option>
                <option value="2">حذف</option>
            </select>
            <button class="btn" onclick="submitMulti(<?= $sahamdar['id']; ?>)">اجرای عملیات</button>
        </div>

        <table class="admin table_data" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th>تصویر</th>
                <th>نام فایل</th>
                <th>نوع فایل</th>
                <th>توضیحات</th>
                <th>انتخاب</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $files = $data['files'];
            foreach ($files as $file) {
                ?>

                <tr>
                    <td>
                        <img src="public/image/slider/<?= $file['filename']; ?>" alt="">
                    </td>
                    <td><?= $file['filename']; ?></td>
                    <td><?= $file['ext']; ?></td>
                    <td><?= $file['description']; ?></td>
                    <td>
                        <div class="check_part">
                            <span class="check_box_span"></span>
                            <input type="checkbox" class="check_box_input" name="filename[]"
                                   value="<?= $file['filename']; ?>">
                        </div>
                    </td>
                </tr>

                <?php
            }
            ?>
            </tbody>

        </table>
    </form>
</div>

<script>
    //-----submitFormMulti
    function submitMulti(id) {
        var Form = $('form');
        var actionSelected = $('#selectAction').find('option:selected').val();
        var action = '';
        if (actionSelected == 1) {
            action = 'adminsahamdar/downloadFile/' + id;
        }
        if (actionSelected == 2) {
            if (confirm('آیا برای حذف اطمینان دارید؟')) {
                action = 'adminsahamdar/deleteFile/' + id;
            }
        }
        Form.attr('action', action);
        Form.submit();
    }
</script>

</div><!--end of flex-->
