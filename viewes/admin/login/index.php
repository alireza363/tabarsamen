<div class="window_center">

    <h4>ورود به پنل مدیریت</h4>

    <form action="adminlogin" method="post">

        <div class="row">
            <label for="user">نام کاربری :</label>
            <input class="input" name="username" id="user" type="text">
        </div>

        <div class="row">
            <label for="pass">پسورد :</label>
            <input class="input" name="password" id="pass" type="password" minlength="8">
        </div>

        <div class="msg">
            <p style="color: red;font-size: 13px;"><?= $data['message']; ?></p>
        </div>

        <div class="left-btn">
            <button class="btn">ورود</button>
        </div>

    </form>

</div>

</div><!--end of flex-->
