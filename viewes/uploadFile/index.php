<style>
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

</style>

<div class="part in-padding b-color">
    <div class="title-part">
        بارگزاری فایل
    </div>

    <div id="Specif">

        <form action="uploadFile/index/<?= $data[0]; ?>" enctype="multipart/form-data" method="post" class="p-20">

            <div class="row">
                <span class="title">انتخاب فایل :</span>
                <input type="file" class="txt" name="upFile">
            </div>

            <div class="row">
                <span class="title">شرح فایل :</span>
                <textarea cols="30" class="txt" name="description" minlength="10" maxlength="60"></textarea>
            </div>

            <div class="row">
                <p class="info_msg">پسوندهای مجاز: تصاویر، txt, word, excel و pdf</p>
                <p class="msg"><?= $data[1]; ?></p>
            </div>

            <div class="row left-btn">
                <button type="submit" class="btn">ارسال فایل</button>
                <a class="btn btn_inv btn2" href="panel">بازگشت</a>
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

