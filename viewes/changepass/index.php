<style>
    .cnt-light .part {
        background-color: #fffbef;
    }

    #Specif {
        width: 100%;
        margin: 15px 0;
    }

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

    #Specif .value {
        display: inline-block;
        width: 400px;
    }

    .value {
        font-size: 0.875rem;
    }

    .btn.mali {
        background-color: #ef9c1a8a;
    }

    .btn.edit {
        background-color: #81c4698a;
    }

    .p-20 {
        padding: 20px;
    }

</style>

<?php

$userid = $data[0];
$msg = $data[1];

?>

<div class="part in-padding b-color">
    <div class="title-part">
        تغییر رمز
    </div>

    <div id="Specif">

        <form action="changepass/index/<?= $data[0]; ?>" method="post">

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
                <a class="btn btn_inv" class="btn2" href="panel">انصراف</a>
            </div>

        </form>

    </div>

</div>

<style>
    @media screen and (max-width: 1240px) {
        #Specif .value {
            width: 380px !important;
        }
    }

    @media screen and (max-width: 1100px) {
        #Specif .value {
            width: 300px !important;
        }
    }

    @media screen and (max-width: 748px) {
        #Specif .flex {
            display: block;
        }
    }

    @media screen and (max-width: 512px) {
        #Specif .title {
            width: 90px !important;
        }
    }
</style>

