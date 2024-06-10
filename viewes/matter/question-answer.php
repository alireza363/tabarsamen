<style>
    .answer {
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .cnt-dark .answer {
        border-top: 1px solid #303134;
    }

    .answer_form {
        margin-bottom: 30px;
        display: none;
    }

    .answer_form textarea,
    .answer_form input {
        width: 100%;
        padding: 5px;
        color: #2c2f34;
        margin-bottom: 15px;
    }

    .answer_form .input_part .rt,
    .answer_form .input_part .lt {
        width: 50%;
    }

    .answer_form label {
        display: block;
        font-size: 0.8125rem;
        margin-bottom: 3px;
        margin-right: 3px;
    }

    .answer_form span {
        color: #e81700;
        font-weight: bold;
    }

    .answer_form button {
        margin-top: 15px;
        background-color: #e81700;
        color: #fff;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        -ms-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
    }

    .answer_form button:hover {
        background-color: #b60000;
    }

    .close i {
        font-style: normal;
        font-size: 11px;
        color: #01426b;;
        cursor: pointer;
    }

    /*-----input_part style start-----*/
    .input_part {
        margin: 15px;
    }

    .input_part .input {
        background-color: transparent;
        width: 180px;
        padding: 3px 5px;
        border: 1px solid #ccc;
        margin-bottom: 5px;
    }

    .input_part label {
        width: 110px;
    }

    .input_part option {
        background-color: #fff;
        font-family: inherit;
    }
</style>

<div class="part in-padding b-color">

    <div class="title-part" id="pov">
        دیدگاه ها
    </div>

    <?php
    foreach ($comments as $comment) {
        ?>

        <div class="qs-ans flex">
            <div class="rt">
                <a class="crc-sm">
                    <img src="public/image/user_comment.png" alt="">
                </a>
            </div>
            <div class="lt">

                <a><?= $comment['name_family']; ?></a>
                <div class="date"><?= model::jalaliDate('j F Y , g:i a', $comment['date_comment']); ?></div>
                <p>
                    <?= $comment['matn_comment']; ?>
                </p>
                <button class="btn" onclick="sendanswer(this)">پاسخ</button>

                <div class="answer_form">

                    <form action="matter/comment/<?= $newsInfo['id']; ?>/<?= $comment['id']; ?>" method="post">
                        <div class="title-part flex-j-between">
                            <div>پاسخ به <?= $comment['name_family']; ?></div>
                            <div class="close" onclick="closeanswer(this)">
                                <i>لغو پاسخ</i>
                                <i class="fa fa-close"></i>
                            </div>
                        </div>

                        <label for="matn<?= $comment['id']; ?>">متن پاسخ
                            <span>*</span>
                        </label>
                        <textarea class="b-color" name="comment_matn" id="matn<?= $comment['id']; ?>" cols="30" rows="8"></textarea>

                        <div class="input_part flex-j-between">
                            <div class="rt">
                                <label for="name<?= $comment['id']; ?>">نام <span>*</span></label>
                                <input class="half b-color" id="name<?= $comment['id']; ?>" name="comment_name" type="text">
                            </div>
                            <div class="lt">
                                <label for="email<?= $comment['id']; ?>">ایمیل </label>
                                <input class="half b-color" id="email<?= $comment['id']; ?>" name="comment_email" type="email">
                            </div>
                        </div>

                        <button>فرستادن دیدگاه</button>
                    </form>

                </div>

                <?php
                if($comment['children'] != '') {
                    $children = $comment['children'];
                    foreach ($children as $child) {
                        ?>
                        <div class="answer flex">
                            <div class="rt">
                                <a class="crc-sm">
                                    <img src="public/image/user_comment.png" alt="">
                                </a>
                            </div>
                            <div class="lt">
                                <a><?= $child['name_family']; ?></a>
                                <div class="date"><?= model::jalaliDate('j F Y , g:i a', $child['date_comment']); ?></div>
                                <p>
                                    <?= $child['matn_comment']; ?>
                                </p>
                                <button class="btn" onclick="sendanswer(this)">پاسخ</button>

                                <div class="answer_form">

                                    <form action="matter/comment/<?= $newsInfo['id']; ?>/<?= $comment['id']; ?>" method="post">
                                        <div class="title-part flex-j-between">
                                            <div>پاسخ به <?= $child['name_family']; ?></div>
                                            <div class="close" onclick="closeanswer(this)">
                                                <i>لغو پاسخ</i>
                                                <i class="fa fa-close"></i>
                                            </div>
                                        </div>

                                        <label for="matn<?= $child['id']; ?>">متن پاسخ
                                            <span>*</span>
                                        </label>
                                        <textarea class="b-color" name="comment_matn" id="matn<?= $child['id']; ?>" cols="30"
                                                  rows="8"></textarea>

                                        <div class="input_part flex-j-between">
                                            <div class="rt">
                                                <label for="name<?= $child['id']; ?>">نام <span>*</span></label>
                                                <input class="half b-color" id="name<?= $child['id']; ?>" name="comment_name" type="text">
                                            </div>
                                            <div class="lt">
                                                <label for="email<?= $child['id']; ?>">ایمیل </label>
                                                <input class="half b-color" id="email<?= $child['id']; ?>" name="comment_email"
                                                       type="email">
                                            </div>
                                        </div>

                                        <button>فرستادن دیدگاه</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div><!-- end lt -->
        </div><!-- end qs-ans -->

        <?php
    }
    ?>

</div>

<script>
    function sendanswer(tag) {
        $(tag).siblings('.answer_form').slideDown();
    }

    function closeanswer(tag) {
        $(tag).parents('.answer_form').slideUp();
    }
</script>