<form action="" method="post">
    <div class="flex">

        <div class="col">
            <div class="rowdiv">
                <span>نام و نام خانوادگی :</span>
                <span><?= $user['name'] . ' ' . $user['family']; ?></span>
            </div>
            <div class="rowdiv">
                <span>نام پدر :</span>
                <span><?= $user['father']; ?></span>
            </div>
            <div class="rowdiv">
                <span>شماره شناسنامه :</span>
                <span><?= $user['sh_sh']; ?></span>
            </div>
            <div class="rowdiv">
                <span>کد ملی :</span>
                <span><?= $user['meli']; ?></span>
            </div>
            <div class="rowdiv">
                <span>محل تولد :</span>
                <span><?= $user['mah_t']; ?></span>
            </div>
            <div class="rowdiv">
                <span>تاریخ تولد :</span>
                <span><?= $user['date_tav']; ?></span>
            </div>
        </div>

        <div class="col">
            <div class="rowdiv">
                <span>شماره همراه :</span>
                <span class="no_edit"><?= $user['mobile']; ?></span>
                <input class="edit" type="text" name="mobile" value="<?= $user['mobile']; ?>">
            </div>
            <div class="rowdiv">
                <span>تلفن ثابت :</span>
                <span class="no_edit"><?= $user['telephone']; ?></span>
                <input class="edit" type="text" name="telephone" value="<?= $user['telephone']; ?>">
            </div>
            <div class="rowdiv">
                <span>کد پستی :</span>
                <span class="no_edit"><?= $user['post']; ?></span>
                <input class="edit" type="text" name="post" value="<?= $user['post']; ?>">
            </div>
            <div class="rowdiv">
                <span>آدرس :</span>
                <span class="no_edit"><?= $user['address']; ?></span>
                <textarea name="address" class="edit" cols="24" rows="3"><?= $user['address']; ?></textarea>
            </div>
        </div>

        <div class="col">
            <div class="rowdiv">
                <span>تعداد سهام :</span>
                <span><?= $user['tedad']; ?></span>
            </div>
            <div class="rowdiv">
                <span>شماره حساب بانکی :</span>
                <span class="no_edit"><?= $user['Account_No']; ?></span>
                <input class="edit" type="text" name="account_no" value="<?= $user['Account_No']; ?>">
            </div>
            <div class="rowdiv">
                <span>نام بانک :</span>
                <span class="no_edit"><?= $user['bank_name']; ?></span>
                <select class="edit" name="account_bankid">
                    <option value="0"></option>
                    <?php
                    $banks = $data['banks'];
                    foreach ($banks as $bank) {
                        if ($bank['bank_id'] == $user['Account_BankID']) {
                            $selected = 'selected';
                        } else {
                            $selected = '';
                        }
                        ?>

                        <option value="<?= $bank['bank_id']; ?>" <?= $selected; ?>><?= $bank['bank_name']; ?></option>

                        <?php
                    }
                    ?>
                </select>
            </div>
            <!--                    <div class="rowdiv">-->
            <!--                        <span>مانده :</span>-->
            <!--                        <span>--><? //= number_format($user['s_2']) . ' ریال'; ?><!--</span>-->
            <!--                    </div>-->
        </div>

    </div>
</form>