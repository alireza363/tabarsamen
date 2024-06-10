<style>
    .image_data {
        width: 200px;
        margin: 0 auto;
        border: 1px solid #eee;
    }

    .msg_pm {
        font-size: 0.85rem;
        font-weight: bold;
        color: red;
        padding: 7px 20px;
    }
</style>

<?php
require('viewes/admin/layout.php');
if ($data['modirInfo'] != '') {
    $modirInfo = $data['modirInfo'];
}
?>

<div class="admin_main">
    <h4>معرفی مدیران</h4>

    <form action="" method="post" enctype="multipart/form-data">

        <?php
        $msg = $data['msg'];
        if ($msg != '') {
            ?>

            <div class="msg_pm"><?= $msg; ?></div>

            <?php
        }
        ?>

        <div class="flex">

            <div class="padding">
                <div class="row">
                    <label for="name1">نام و نام خانوادگی :</label>
                    <input class="txt" id="name1" type="text" name="name" value="<?= @$modirInfo['name_family']; ?>">
                </div>

                <div class="row">
                    <label for="pst">سمت :</label>
                    <select id="pst" class="txt" name="post">
                        <option>نامشخص</option>
                        <?php
                        $postes = $data['postes'];
                        $modirpost = $modirInfo['post'];
                        foreach ($postes as $post) {
                            if ($modirpost == $post['id']) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }
                            ?>

                            <option value="<?= $post['id']; ?>" <?= $selected; ?>><?= $post['post_title']; ?></option>

                            <?php
                        }
                        ?>
                    </select>
                    <a class="notelink" href="adminmodiran/postmodir">مشاهده و ویرایش سمت های پیشفرض</a>
                </div>

                <div class="row">
                    <label for="tel1">تلفن :</label>
                    <input class="txt" id="tel1" type="text" name="tel" value="<?= @$modirInfo['tel']; ?>">
                </div>

                <div class="row">
                    <label for="eml1">ایمیل :</label>
                    <input class="txt" id="eml1" type="text" name="email" value="<?= @$modirInfo['email']; ?>">
                </div>
            </div>

            <div class="padding">
                <div class="row">
                    <label for="img1">تصویر :</label>
                    <input type="file" id="img1" name="image" value="">
                </div>
                <div class="left-btn">
                    <?php
                    if (@$modirInfo['exp'] == 'jpg' or @$modirInfo['exp'] == 'png') {
                        ?>

                        <img class="image_data"
                             src="public/image/modiran/m<?= $modirInfo['id']; ?>.<?= $modirInfo['exp']; ?>" alt="">

                        <?php
                    } else {
                        ?>

                        <img class="image_data" src="public/image/modiran/m-default.jpg" alt="">

                        <?php
                    }
                    ?>
                </div>
            </div>

        </div>

        <div class="left-btn">
            <button class="btn">اجرای عملیات</button>
        </div>

    </form>
</div>

</div><!--end of flex-->