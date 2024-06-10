<?php

$active = 'gallery';
require('viewes/admin/layout.php');
?>

<style>
    .setPhoto {
        margin-top: 30px;
        margin-right: 20px;
    }

    .ulPhotos {
        margin-top: 20px;
    }

    .ulPhotos li {
        display: inline-block;
        width: 160px;
        margin: 8px;
    }

    .ulPhotos img {
        border: 3px solid #ccc;
        border-radius: 3px;
    }
</style>

<div class="admin_main">
    <h4>مدیریت گالری تصاویر</h4>

    <form action="admingallery" enctype="multipart/form-data" method="post">

        <div class="flex-j-between">
            <div class="setPhoto">
                <div class="row">
                    <label for="img1">تصویر :</label>
                    <input type="file" id="img1" name="image" value="">

                    <span class="msg"><?= $data['msg']; ?></span>
                </div>
            </div>

            <div class="left-btn">
                <button class="btn">افزودن</button>
                <span class="btn btn_inv" onclick="delPhoto()">حذف</span>
            </div>
        </div>

        <ul class="ulPhotos">
            <?php
            $gallery = $data['gallery'];
            foreach ($gallery as $ax) {
                ?>

                <li>

                    <img src="public/image/gallery/<?= $ax['id']; ?>.jpg" alt="">

                    <div class="check_part">
                        <span class="check_box_span"></span>
                        <input type="checkbox" class="check_box_input" name="id[]" value="<?= $ax['id']; ?>">
                    </div>

                </li>

                <?php
            }
            ?>
        </ul>

    </form>
</div>

<script>
    var ul_Photos = $('.ulPhotos');

    function delPhoto() {
        var url = 'admingallery/delete';
        var data = $('form').serializeArray();    //ettela'ate form ra yekja daryaft mikonad....

        $.post(url, data, function (msg) {

            ul_Photos.html('');
            $.each(msg, function (index, value) {

                var item = '<li><img src="public/image/gallery/' + value['id'] + '.jpg" alt=""><div class="check_part"><span class="check_box_span"></span><input type="checkbox" class="check_box_input" name="id[]" value="' + value['id'] + '"></div></li>';

                ul_Photos.append(item);
            });

        }, 'json');
    }
</script>

</div><!--end of flex-->

