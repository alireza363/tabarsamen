<style>
    #contact_info {
        width: 48%;
        padding-top: 20px;
        text-align: center;
        font-size: 0.8125rem;
    }

    #contact_info > div {
        margin-bottom: 12px;
    }

    #contact_info label {
        font-weight: bold;
    }

    #contact_info iframe {
        width: 100%;
        height: 220px;
        margin-top: 20px;
        border: 1px solid #e9e9e9;
        border-radius: 5px;
    }
</style>

<div class="part in-padding b-color">
    <div class="title-part">
        ارسال نظرات، پیشنهادها و انتقادها
    </div>

    <div class="flex-j-between">
        <form action="contactus/sendEmail" method="post" enctype="multipart/form-data">

            <div class="row">
                <label for="root1">نام:</label>
                <input type="text" class="txt" id="root1" name="name">
            </div>
            <div class="row">
                <label for="tel1">پست الکترونیکی :</label>
                <input type="text" class="txt" id="tel1" name="email">
            </div>
            <div class="row">
                <label for="eml1">موضوع :</label>
                <input type="text" class="txt" id="eml1" name="subject">
            </div>
            <div class="row">
                <label for="eml1">ضمیمه :</label>
                <input style="border: none;" type="file" id="eml1" name="image">
            </div>
            <div class="row">
                <label for="ins1" style="display: block;margin-bottom: 3px;">متن :</label>
                <textarea name="matn" id="ins1" cols="60" rows="7"></textarea>
            </div>

            <div class="left-btn">
                <button class="btn">ارسال</button>
            </div>

        </form>

        <div id="contact_info">
            <div>
                <label for="root1">شماره های تماس:</label>
                <span><?= $option['tel']; ?></span>
            </div>

            <div>
                <label for="root1">سامانه پیامک:</label>
                <span><?= $option['message']; ?></span>
            </div>
            <div>
                <label for="root1">پست الکترونیک:</label>
                <span><?= $option['email']; ?></span>
            </div>
            <div>
                <label for="root1">آدرس:</label>
                <span><?= $option['address']; ?></span>
            </div>
            <div class="row-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d506.4334777104241!2d59.59770423235075!3d36.296498071303404!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x36a3591d55a841e6!2z2LTYsdqp2Kog2KrYqNin2LHYq9in2YXZhg!5e0!3m2!1sen!2sus!4v1659974059010!5m2!1sen!2sus"
                        width="600" height="450" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

    </div>


</div>

<style>
    @media screen and (max-width: 1000px) {
        .flex-j-between {
            display: block;
        }

        .row input.txt,
        .row select.txt,
        .row input[type=file] {
            width: 45%;
        }

        .row textarea {
            width: 95%;
        }

        #contact_info {
            width: 100%;
        }
    }

    @media screen and (max-width: 600px) {
        .row input.txt,
        .row select.txt,
        .row input[type=file] {
            width: 95%;
        }
    }
</style>