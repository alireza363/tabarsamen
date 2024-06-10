<style>
    .moarefi .content {
        width: 80%;
        padding: 30px;
    }
    .moarefi img {
        /*width: 45%;*/
    }
</style>
<div class="part in-padding b-color">
    <div class="title-part">
        معرفی شرکت
    </div>

    <div class="intro-comp moarefi flex-j-between">
        <div class="right">
            <div class="content">
                <?= $history['matn']; ?>
            </div>
            <div class="left-btn">
                <a class="btn" href="history">
                    <i class="fa fa-info-circle"></i>
                    ادامه مطلب ...
                </a>
            </div>
        </div>
        <div class="left">
            <?php
            if (file_exists('public/image/content/' . $history['id'] . '/thumbnail.jpg')) {
                ?>
                <img src="public/image/content/<?= $history['id']; ?>/thumbnail.jpg" alt="">
                <?php
            } else {
                ?>
                <img src="public/image/content/notif.jpg">
                <?php
            }
            ?>
        </div>
    </div>
</div>