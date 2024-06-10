<div class="part in-padding b-color">
    <div class="title-part">
        اطلاعیه
    </div>

    <div class="intro-comp flex-j-between">
        <div class="right">
            <div class="content">
                <h4><?= $notif['title']; ?></h4>
                <?= $notif['matn']; ?>
            </div>
            <div class="left-btn">
                <a class="btn" href="matter/index/<?= $notif['id']; ?>">
                    <i class="fa fa-info-circle"></i>
                    اطلاعات بیشتر...
                </a>
            </div>
        </div>
        <div class="left">
            <?php
            if (file_exists('public/image/content/' . $notif['id'] . '/thumbnail.jpg')) {
                ?>
                <img src="public/image/content/<?= $notif['id']; ?>/thumbnail.jpg" alt="">
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