<?php
require('viewes/admin/layout.php');
?>

<style>

    #content {
        padding-right: 15px;
    }

    .plus_btn {
        width: 24px;
        height: 24px;
        margin-top: 10px;
        margin-right: 5px;
        cursor: pointer;
        border-radius: 5px;
    }
</style>

<div class="admin_main">
    <h4>سِمت های پیشفرض</h4>

    <form action="adminmodiran/postmodir" method="post">

        <input type="hidden" name="submited">

        <div class="left-btn">
            <button class="btn">اجرای عملیات</button>
        </div>

        <div id="content">

            <?php
            $postes = $data['postes'];
            foreach ($postes as $post) {
                ?>

                <div data-i="<?= $post['id']; ?>" class="row">
                    <label for="val<?= $post['id']; ?>">عنوان سِمت : </label>
                    <input class="txt" type="text" name="post<?= $post['id']; ?>" id="val<?= $post['id']; ?>"
                           value="<?= $post['post_title']; ?>">
                </div>

                <?php
            }
            ?>

        </div>

        <img class="plus_btn" src="public/image/icon/plus.gif" onclick="addNewPost()">

    </form>
</div>

<script>
    function addNewPost() {
        var id = $('form').find('.row:last-child').attr('data-i');
        if (id != undefined) {
            id++;
        } else {
            id = 1;
        }
        var rowval = '<div data-i="' + id + '" class="row"><label for="val' + id + '">مقدار ویژگی : </label><input class="txt" type="text" name="post' + id + '" id="val' + id + '" value=""></div>';
        $('#content').append(rowval);
    }
</script>

</div><!--end of flex-->

