<?php
require('viewes/admin/layout.php');
?>

<style>
    #content {
        padding-right: 15px;
    }
</style>

<div class="admin_main">
    <h4>موضوعات پیشفرض</h4>

    <form action="admincontent/allsubject" method="post">

        <input type="hidden" name="submited">

        <div class="left-btn">
            <button class="btn">اجرای عملیات</button>
        </div>

        <div id="content">
            <?php
            $subjects = $data['subjects'];
            foreach ($subjects as $subject) {
                ?>

                <div data-i="<?= $subject['id']; ?>" class="row">
                    <label for="val<?= $subject['id']; ?>">موضوع : </label>
                    <input class="txt" type="text" name="sub<?= $subject['id']; ?>" id="val<?= $subject['id']; ?>"
                           value="<?= $subject['subject_title']; ?>">
                </div>

                <?php
            }
            ?>
        </div>

        <img class="plus_btn" src="public/image/icon/plus.gif" onclick="addNewsub()">

    </form>
</div>

<script>

    function addNewsub() {
        var id = $('form').find('.row:last-child').attr('data-i');
        if (id != undefined) {
            id++;
        } else {
            id = 1;
        }
        var rowval = '<div data-i="' + id + '" class="row"><label for="val' + id + '">موضوع : </label><input class="txt" type="text" name="sub' + id + '" id="val' + id + '" value=""></div>';
        $('#content').append(rowval);
    }

</script>

</div><!--end of flex-->

