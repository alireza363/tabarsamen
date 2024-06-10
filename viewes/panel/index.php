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

    .btn.editBtn {
        background-color: #81c4698a;
    }

    .title {
        color: #208de6;
    }

    .flex .col {
        flex: 1;
        padding: 8px;
        font-size: 0.825rem;
    }

    .col .rowdiv {
        margin: 12px auto;
    }

    .col .rowdiv span:first-child {
        color: #208de6;
        margin-left: 12px;
        width: 110px;
        display: inline-block;
    }

    .col .rowdiv span:nth-child(2) {
        font-weight: bold;
        display: inline-block;
        width: 65%;
        vertical-align: top;
    }

    #Specif .edit {
        width: 230px;
        font-size: inherit;
        padding: 3px 5px;
        border-color: #4ea3e7;
        color: #4ea3e7;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        display: none;
    }

    .uploadImg {
        background-color: #99acbed1;
    }

    #Specif textarea.edit {
        vertical-align: top;
    }

    #mali {
        display: none;
    }

    #mandeh {
        background-color: #e0ffff;;
    }

</style>

<?php
$user = $data['sahamdar'];
?>

<div class="part in-padding b-color">
    <div class="title-part">
        مشخصات سهامدار
    </div>

    <div id="Specif">

        <div class="row">
            <span class="title" style="font-size: 1rem;">شماره سهامداری :</span>
            <span class="value" style="font-size: 1rem;font-weight: bold;"><?= $user['id']; ?></span>
        </div>

        <div class="horizental"></div>

        <?php
        require ('info_person.php');
        ?>

        <div class="row">
            <div class="left-btn">
                <span class="btn mali" onclick="showmali()">گردش مالی</span>
                <a class="btn uploadImg" href="uploadFile/index/<?= $user['id']; ?>">بارگزاری فایل</a>
                <button type="button" class="btn editBtn" onclick="editform(this, <?= $user['id']; ?>)">درخواست ویرایش</button>
                <a class="btn" href="changepass/index/<?= $user['id']; ?>">تغییر رمز</a>
            </div>
        </div>

        <div class="horizental"></div>

        <?php
        require ('mali.php');
        ?>

    </div>
</div>

<script>

    //-----edifform function-----//

    function editform(tag, id) {

        var Specif = $('#Specif').find('.flex');

        var tagBtn = $(tag);
        textBtn = tagBtn.text();

        if (textBtn === 'درخواست ویرایش') {

            tagBtn.text('ثبت تغییرات');
            Specif.find('.edit').show();
            Specif.find('.no_edit').hide();
        }

        if (textBtn === 'ثبت تغییرات') {

            tagBtn.text('درخواست ویرایش');

            var url = 'panel/editForm/' + id;
            var data = $('form').serializeArray();

            $.post(url, data, function (msg) {

                Specif.html('');

                var infoo = msg[0];
                var bank = msg[1];

                var item = '<div class="col"><div class="rowdiv"><span>نام و نام خانوادگی :</span><span>' + infoo['name'] + ' ' + infoo['family'] + '</span></div><div class="rowdiv"><span>نام پدر :</span><span>' + infoo['father'] + '</span></div><div class="rowdiv"><span>شماره شناسنامه :</span><span>' + infoo['sh_sh'] + '</span></div><div class="rowdiv"><span>کد ملی :</span><span>' + infoo['meli'] + '</span></div><div class="rowdiv"><span>محل تولد :</span><span>' + infoo['mah_t'] + '</span></div><div class="rowdiv"><span>تاریخ تولد :</span><span>' + infoo['date_tav'] + '</span></div></div><div class="col"><div class="rowdiv"><span>شماره همراه :</span><span class="no_edit">' + infoo['mobile'] + '</span><input class="edit" type="text" name="mobile" value="' + infoo['mobile'] + '"></div><div class="rowdiv"><span>تلفن ثابت :</span><span class="no_edit">' + infoo['telephone'] + '</span><input class="edit" type="text" name="telephone" value="' + infoo['telephone'] + '"></div><div class="rowdiv"><span>کد پستی :</span><span class="no_edit">' + infoo['post'] + '</span><input class="edit" type="text" name="post" value="' + infoo['post'] + '"></div><div class="rowdiv"><span>آدرس :</span><span class="no_edit">' + infoo['address'] + '</span><textarea name="address" class="edit" cols="33" rows="3">' + infoo['address'] + '</textarea></div></div><div class="col"><div class="rowdiv"><span>تعداد سهام :</span><span>' + infoo['tedad'] + '</span></div><div class="rowdiv"><span>شماره حساب بانکی :</span><span class="no_edit">' + infoo['Account_No'] + '</span><input class="edit" type="text" name="account_no" value="' + infoo['Account_No'] + '"></div><div class="rowdiv"><span>نام بانک :</span><span class="no_edit">' + infoo['bank_name'] + '</span><select class="edit" name="account_bankid"><option value="0"></option></select></div></div>';

                Specif.append(item);

                var selectTag = Specif.find('select');

                $.each(bank, function (index, value) {

                    var slted = '';
                    if (value['bank_id'] === infoo['Account_BankID']) {
                        slted = 'selected';
                    }

                    var options = '<option value="' + value['bank_id'] + '" ' + slted + '>' + value['bank_name'] + '</option>';

                    selectTag.append(options);

                });

            }, 'json');

            Specif.find('.edit').hide();
            Specif.find('.no_edit').show();
        }

    }


    //-----showmali function-----//

    function showmali() {

        var mali = $('#mali');
        var tbody = mali.find('table tbody');

        var mande;

        var url = 'panel/showmali';
        var data = {};

        var i = 1;

        $.post(url, data, function (msg) {

            tbody.html('');

            $.each(msg, function (index, value) {

                if (value['bed'] === null) {
                    value['bed'] = '';
                }
                if (value['bes'] === null) {
                    value['bes'] = '';
                }

                var item = '<tr><td>' + i + '</td><td>' + value['date'] + '</td><td>' + value['sharh'] + '</td><td>' + value['bed'] + '</td><td>' + value['bes'] + '</td></tr>';

                if (value['bes'] === '') {
                    value['bes'] = 0;
                }
                mande = '<tr style="font-weight: bold"><td colspan="3" style="text-align: left">مانده :</td><td colspan="2"> ' + value['bes'] + ' ریال</td></tr>';

                i++;

                tbody.append(item);

            });

            tbody.append(mande);

        }, 'json');

        mali.delay(800).slideToggle();
    }
</script>

<!----- responsive style  ----->
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

        .left-btn > * {
            margin-top: 9px;
        }
    }
</style>