<?php

$active = 'setting';
require('viewes/admin/layout.php');
?>

<div class="admin_main">
    <h4>تنظیمات سایت</h4>

    <form action="" method="post">

        <div class="padding">

            <div class="row">
                <label for="root1">مسیر اصلی سایت :</label>
                <input type="text" class="txt" id="root1" name="root" value="<?= $option['root']; ?>">
            </div>
            <div class="row">
                <label for="tel1">شماره تلفن های سایت :</label>
                <input type="text" class="txt" id="tel1" name="tel" value="<?= $option['tel']; ?>">
            </div>
            <div class="row">
                <label for="msg1">شماره سامانه پیامک :</label>
                <input type="text" class="txt" id="msg1" name="message" value="<?= $option['message']; ?>">
            </div>
            <div class="row">
                <label for="eml1">ایمیل سایت :</label>
                <input type="text" class="txt" id="eml1" name="email" value="<?= $option['email']; ?>">
            </div>
            <div class="row">
                <label for="ins1">اینستاگرام سایت :</label>
                <input type="text" class="txt" id="ins1" name="instagram" value="<?= $option['instagram']; ?>">
            </div>
            <div class="row">
                <label for="ads1">آدرس شرکت :</label>
                <input type="text" class="txt" id="ads1" name="address" value="<?= $option['address']; ?>">
            </div>

        </div>

        <div class="row left-btn">
            <button class="btn" onclick="submitForm2(1)">اجرای عملیات</button>
            <button class="btn btn_inv" class="btn2" onclick="submitForm2(2)">تنظیمات پیشفرض</button>
        </div>

    </form>
</div>

<script>

    function submitForm2(num) {
        var Form = $('form');
        var action = 'adminsetting/index/' + num;
        Form.attr('action', action);
        Form.submit();
    }

</script>

</div><!--end of flex-->