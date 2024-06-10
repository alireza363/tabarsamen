<?php

$userid = $data[0];
$msg = $data[1];

$active = 'password';
require('viewes/admin/layout.php');
?>

<style>
    #Specif .title {
        display: inline-block;
        width: 140px;
        height: 28px;
        vertical-align: top;
    }

    .title {
        color: #208de6;
        font-size: 0.875rem;
    }

    .left-btn {
        margin-bottom: 0;
    }
</style>

<div class="admin_main">
    <h4>
        تغییر رمز
    </h4>

    <div id="Specif">
        <form action="adminpass/index/<?= $data[0]; ?>" method="post">

            <div class="row p-20">
                <span class="title">رمز قبلی :</span>
                <input type="password" class="txt" name="oldpass">
            </div>

            <div class="horizental"></div>

            <div class="p-20">
                <div class="row">
                    <span class="title">رمز جدید :</span>
                    <input type="password" class="txt" name="newpass" minlength="8">
                </div>

                <div class="row">
                    <span class="title">تکرار رمز جدید :</span>
                    <input type="password" class="txt" name="rptpass">
                </div>
            </div>

            <div>
                <p class="msg"><?= $msg; ?></p>
            </div>

            <div class="row left-btn">
                <button type="submit" class="btn">اجرای عملیات</button>
            </div>
        </form>
    </div>
</div>

</div><!--end of flex-->

