<style>
    table td {
        width: 20%;
    }

    table td img {
        width: 70%;
    }

    #i_slider {
        max-width: 334px;
    }

    #slider {
        display: none;
    }
</style>

<?php
$active = 'slider';
require('viewes/admin/layout.php');
?>

<div class="admin_main">
    <h4>مدیریت اسلایدر</h4>

    <form action="" enctype="multipart/form-data" method="post">

        <div class="padding flex-j-between">
            <div class="right">
                <div class="row">
                    <label for="t_slider">عنوان :</label>
                    <input type="text" id="t_slider" class="txt" name="title">
                </div>
                <div class="row">
                    <label for="l_slider">آدرس لینک :</label>
                    <input type="text" id="l_slider" class="txt" name="link">
                </div>
            </div>
            <div class="left">
                <span class="btn" onclick="submitadmin('adminslider')">افزودن</span>
                <span class="btn btn_inv" onclick="submitadmin('adminslider/delete')">حذف</span>
            </div>
        </div>

        <div class="padding">
            <div class="row">
                <label for="i_slider">انتخاب تصویر :</label>
                <input type="file" id="i_slider" name="image">
                <?php
                if ($data['msg'] != '') {
                    ?>
                    <span class="msg"><?= $data['msg']; ?></span>
                    <?php
                }
                ?>
            </div>
        </div>

        <table class="admin table_data" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>عنوان</th>
                <th>تصویر</th>
                <th>آدرس لینک</th>
                <th>انتخاب</th>
            </tr>
            </thead>

            <tbody>
            <?php
            $slider = $data['slider'];
            $i = 1;
            foreach ($slider as $item) {
                ?>

                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $item['slider_name']; ?></td>
                    <td>
                        <img src="public/image/slider/<?= $item['slider']; ?>" alt="">
                    </td>
                    <td><a href="<?= $item['slider_link']; ?>" target="_blank"><?= $item['slider_link']; ?></a></td>
                    <td>
                        <div class="check_part">
                            <span class="check_box_span"></span>
                            <input type="checkbox" class="check_box_input" name="id[]" value="<?= $item['id']; ?>">
                        </div>
                    </td>
                </tr>

                <?php
                $i++;
            }
            ?>
            </tbody>

        </table>

    </form>
</div>

</div><!--end of flex-->