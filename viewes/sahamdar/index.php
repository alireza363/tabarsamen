<style>
    .window_center label {
        width: 30%;
    }

    .window_center input {
        width: 60%;
    }

    .window_center a {
        color: #6cc9df;
        font-size: 0.72rem;
    }

    .window_center .msg p {
        color: red;
        font-size: 0.72rem;
    }
</style>

<div class="window_center">

    <div class="part in-padding b-color" style="margin-bottom: 0;">
        <div class="title-part">
            ورود به سامانه سهامداران
        </div>

        <form action="sahamdar" method="post">

            <div class="row">
                <label for="user">شماره سهامداری :</label>
                <input class="input" name="username" id="user" type="text">
            </div>

            <div class="row">
                <label for="pass">رمز عبور :</label>
                <input class="input" name="password" id="pass" type="password" minlength="8">
            </div>

            <div class="row">
                <a href="">رمز عبور را فراموش کرده ام</a>
            </div>

            <div class="msg">
                <p><?= $data['0']; ?></p>
            </div>

            <div class="left-btn">
                <button class="btn">ورود</button>
            </div>

        </form>

    </div>

</div>

<style>
    @media screen and (max-width: 1180px) {
        .window_center {
            width: 380px;
        }
    }

    @media screen and (max-width: 450px) {
        .window_center {
            width: 100%;
            height: 65%;
            margin: auto;
            padding: 0;
            border: none;
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
        }

        .window_center .part {
            border: none;
        }

        .window_center label {
            display: block;
        }

        .window_center input {
            width: 90%;
            margin: auto;
            display: block;
        }

        .window_center .left-btn {
            text-align: center;
        }

        .window_center .left-btn .btn {
            width: 90%;
            font-size: 1.12rem;
        }
    }
</style>

