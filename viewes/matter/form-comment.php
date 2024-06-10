<style>
    /* -----form comment----- */
    #form-comment label {
        display: block;
        font-size: 0.8125rem;
        margin-bottom: 3px;
        margin-right: 3px;
    }

    #form-comment .notNull {
        color: #e81700;
        font-weight: bold;
    }

    #form-comment textarea,
    #form-comment input {
        width: 100%;
        padding: 5px;
        color: #2c2f34;
        margin-bottom: 15px;
    }

    .cnt-dark #form-comment textarea,
    .cnt-dark #form-comment input {
        color: #ccc;
    }

    #form-comment form .rt,
    #form-comment form .lt {
        width: 48%;;
    }

    #form-comment button {
        margin-top: 15px;
        background-color: #e81700;
        color: #fff;
        -webkit-transition: all 0.3s;
        -moz-transition: all 0.3s;
        -ms-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
    }

    #form-comment button:hover {
        background-color: #b60000;
    }

    /* -----responsive form----- */
    @media screen and (max-width: 465px) {

        #form-comment .input_NE {
            flex-direction: column;
        }

        #form-comment .input_NE > div {
            width: 100%;
        }
    }
</style>

<div id="form-comment" class="part in-padding b-color">

    <div class="title-part">
        دیدگاهتان را بنویسید
    </div>

    <div id="comment_part">
        <form action="matter/comment/<?= $newsInfo['id']; ?>" method="post">

            <label for="matn5">متن دیدگاه
                <span class="notNull">*</span>
            </label>
            <textarea class="b-color" name="comment_matn" id="matn5" cols="30" rows="8"></textarea>

            <div class="input_NE flex-j-between">
                <div class="rt">
                    <label for="name5">نام <span class="notNull">*</span></label>
                    <input class="half b-color" id="name5" name="comment_name" type="text">
                </div>
                <div class="lt">
                    <label for="email5">ایمیل </label>
                    <input class="half b-color" id="email5" name="comment_email" type="email">
                </div>
            </div>

            <button type="button" onclick="submitForm()">فرستادن دیدگاه</button>

            <span class="msg"></span>

        </form>
    </div>

</div>

<script>
    function submitForm() {
        var matn = $('textarea').val();
        var name = $('input#name5').val();
        var msg = $('.msg');

        if (matn !== '' && name !== '') {
            $('form').submit();
        } else {
            msg.text('لطفا قسمت های ستاره دار را تکمیل نمایید.');
        }
        msg.fadeIn().delay(7000).fadeOut();
    }
</script>