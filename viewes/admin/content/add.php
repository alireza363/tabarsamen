<style>
    .image_data {
        width: 220px;
        height: 150px;
        margin: 0 auto;
        border: 1px solid #eee;
    }

    #label_imp {
        font-size: 0.6rem;
        margin-right: 12px;
        width: auto;
        vertical-align: middle;
        cursor: pointer;
    }

    #photos li {
        width: 20%;
        display: inline-block;
        border: 1px solid #eee;
        margin: 5px;
    }

    .plus_btn {
        vertical-align: middle;
        margin: 0;
    }
</style>

<?php
require('viewes/admin/layout.php');
$contentInfo = $data['contentInfo'];
?>

<div class="admin_main">
    <h4>
        <?php
        if (!isset($contentInfo['id'])) {
            ?>
            افزودن محتوای جدید
            <?php
        } else {
            ?>
            ویرایش محتوا
            <?php
        }
        ?>
    </h4>

    <form action="" enctype="multipart/form-data" method="post">

        <div class="padding">
            <div class="flex">
                <div class="right">
                    <div class="row">
                        <label for="cty_content">دسته محتوا :</label>
                        <select class="input" id="cty_content" name="category">
                            <option value="0">انتخاب کنید...</option>
                            <?php
                            $type = @$contentInfo['type_content'];
                            $news = '';
                            $notif = '';
                            $written = '';
                            if ($type == 1) {   //----its kabar
                                $notif = '';
                                $written = '';
                                $news = 'selected';
                            } elseif ($type == 2) {   //----its etela'ieh
                                $news = '';
                                $written = '';
                                $notif = 'selected';
                            } elseif ($type == 3) {   //----its neveshteh
                                $news = '';
                                $notif = '';
                                $written = 'selected';
                            }
                            ?>
                            <option value="1" <?= $news; ?>>خبر</option>
                            <option value="2" <?= $notif; ?>>اطلاعیه</option>
                            <option value="3" <?= $written; ?>>نوشته</option>
                        </select>

                        <?php
                        if (isset($contentInfo['id'])) {
                            ?>
                            <label for="imp_content" id="label_imp">اطلاعیه صفحه نخست :</label>
                            <input type="checkbox" id="imp_content" name="important" <?php
                            if (@$contentInfo['imp'] == 1) {
                                echo 'checked';
                            } elseif ($notif == '') {
                                echo 'disabled';
                            }
                            ?>>

                            <?php
                        }
                        ?>
                    </div>
                    <?php
                    if ($written != '') {
                        ?>
                        <div class="row">
                            <label for="intro_content">محتوای نوشته :</label>
                            <select name="introduction" id="intro_content">
                                <option value="0">متفرقه</option>
                                <?php
                                $intro = @$contentInfo['intro'];
                                $tabar = '';
                                $razman = '';
                                $gostar = '';
                                if ($intro == 1) {   //----its tabar
                                    $razman = '';
                                    $gostar = '';
                                    $tabar = 'selected';
                                } elseif ($intro == 2) {   //----its razmandegan
                                    $tabar = '';
                                    $gostar = '';
                                    $razman = 'selected';
                                } elseif ($intro == 3) {   //----its kargozari
                                    $tabar = '';
                                    $razman = '';
                                    $gostar = 'selected';
                                }
                                ?>
                                <option value="1" <?= $tabar; ?>>معرفی تبار ثامن</option>
                                <option value="2" <?= $razman; ?>>معرفی رزمندگان خراسان</option>
                                <option value="3" <?= $gostar; ?>>معرفی شعبه کارگزاری</option>
                            </select>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="row">
                        <label for="select2">موضوع :</label>
                        <select class="input" name="subject" id="select2">
                            <option value="0">انتخاب کنید...</option>
                            <?php
                            $subject = @$contentInfo['subject'];
                            $allsubject = $data['allsubject'];
                            foreach ($allsubject as $item) {
                                if ($subject == $item['id']) {
                                    $selected = 'selected';
                                } else {
                                    $selected = '';
                                }
                                ?>

                                <option value="<?= $item['id']; ?>" <?= $selected; ?>><?= $item['subject_title']; ?></option>

                                <?php
                            }
                            ?>
                        </select>
                        <a class="notelink" href="admincontent/allsubject">مشاهده و ویرایش موضوعات پیشفرض</a>
                    </div>
                    <div class="row">
                        <label for="title1">عنوان :</label>
                        <input class="txt input" type="text" name="title" id="title1"
                               value="<?= @$contentInfo['title']; ?>">
                    </div>
                    <div class="row">
                        <label for="image1">تصویر اصلی :</label>
                        <input class="input" type="file" name="image" id="image1">
                        <?php
                        if ($data['msg'] != '') {
                            ?>
                            <span class="msg"><?= $data['msg']; ?></span>
                            <?php
                        }
                        ?>
                        <span class="info_msg">--> فرمت تصویر فقط jpg</span>
                    </div>
                </div>
                <div class="left image_data"
                     style="
                     <?php if (isset($contentInfo['id'])) { ?>
                             background: url('public/image/content/<?= $contentInfo['id']; ?>/thumbnail.jpg');
                             background-size: contain;background-repeat: no-repeat;
                     <?php } ?>
                             ">
                </div>
            </div>

            <div class="row mb_10">
                <label for="editor1">متن کامل :</label>
            </div>
            <div class="row">
                <textarea name="matn" id="editor1"><?= @$contentInfo['matn']; ?></textarea>
            </div>

            <div class="right mb_10">
                <label for="image2">تصاویر و ویدئوها :</label>
                <input type="file" id="image2" class="input" name="photo">
                <img class="plus_btn" src="public/image/icon/plus.gif"
                     onclick="addPhoto(<?= @$contentInfo['id']; ?>, <?= @$contentInfo['intro']; ?>)">
            </div>
            <table class="admin table_Photo" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th>کد</th>
                    <th>تصویر</th>
                    <th>آدرس</th>
                    <th>حذف</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $photo = $data['photo'];
                if (sizeof($photo) > 0) {
                    foreach ($photo as $row) {
                        ?>
                        <tr>
                            <td><?= $row['id']; ?></td>
                            <td><img src="<?= $row['address']; ?>" style="width: 80px;" alt=""></td>
                            <td><?= $row['address']; ?></td>
                            <td><img src="public/image/icon/del_p.png" alt=""
                                     style="width: 15px;cursor: pointer;margin-top: 9px"
                                     onclick="delImg(<?= @$contentInfo['id']; ?>, <?= $row['id']; ?>)"></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>

                    <tr>
                        <td colspan="3">بدون تصویر</td>
                    </tr>

                    <?php
                }
                ?>
                </tbody>
            </table>
            <div class="left">
                <div class="left-btn">
                    <button type="button" class="btn"
                            onclick="<?php
                            if (isset($contentInfo['id']) and isset($contentInfo['intro'])) {
                                echo 'RunForm('.$contentInfo["id"].','. $contentInfo["intro"].')';
                            } else {
                                echo 'RunForm()';
                            }
                            ?>
                                    ">اجرای عملیات
                    </button>
                </div>
            </div>

            <div class="row">
                <ul id="photos">
                    <!--  li'ha ba ajax ezafeh mishavad -->
                </ul>
            </div>

        </div>

    </form>
</div>

<script>
    var Form = $('form');

    //-----RunForm function
    function RunForm(x = '', y = '') {
        var action = 'admincontent/addcontent/' + x + '/' + y;
        Form.attr('action', action);
        Form.submit();
    }

    //-----addImg function
    function addPhoto(id, intro) {
        var action = 'admincontent/addPhoto/' + id + '/' + intro;
        Form.attr('action', action);
        Form.submit();
    }

    //-----deleteImg function
    var tdy_tbl = $('.table_Photo tbody');

    function delImg(parent, id) {
        var url = 'admincontent/delPhoto/' + parent + '/' + id;
        var data = {};
        $.post(url, data, function (msg) {

            console.log(msg);

            tdy_tbl.html('');
            $.each(msg, function (index, value) {

                var item = '<tr><td>' + value['id'] + '</td><td><img src="' + value['address'] + '" style="width: 80px;" alt=""></td><td>' + value['address'] + '</td><td><img src="public/image/icon/del_p.png" alt="" style="width: 15px;cursor: pointer;margin-top: 9px" onclick="delImg(' + parent + ', ' + value['id'] + ')"></td></tr>';

                tdy_tbl.append(item);
            });
        }, 'json');
    }
</script>

</div><!--end of flex-->
