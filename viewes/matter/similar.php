<style>/* -----similar----- */
    #similar .content-row li {
        width: 31%;
    }

    #similar .cnt-image {
        width: 100%;
        height: 224px;
        margin-bottom: 10px;
    }

    #similar .cnt-image img {
        width: 100%;
        height: 224px;
        max-height: 100%;
    }

</style>

<?php
$similar = $data['similar'];
if (sizeof($similar) != 0) {
    ?>

    <div id="similar" class="part in-padding b-color">

        <div class="title-part">
            موضوعات مشابه
        </div>

        <div class="content-row">
            <ul class="flex-j-between">

                <?php
                foreach ($similar as $item) {
                    ?>

                    <li>
                        <div class="cnt-image full-child">
                            <a class="cover-img-icon full-child" href="matter/index/<?= $item['id']; ?>">
                                <?php
                                if (file_exists('public/image/content/' . $item['id'] . '/thumbnail.jpg')) {
                                    ?>
                                    <img src="public/image/content/<?= $item['id']; ?>/thumbnail.jpg" alt="">
                                    <?php
                                } else {
                                    ?>
                                    <img src="public/image/content/no_images.png">
                                    <?php
                                }
                                ?>
                            </a>
                        </div>
                        <div class="cnt-title">
                            <a class="hover" href="matter/index/<?= $item['id']; ?>" style="text-align: justify;">
                                <?= $item['title']; ?>
                            </a>
                            <div class="date">
                                <i class="fa fa-calendar"></i>
                                <?= model::jalaliDate('j F Y', $item['date_write']); ?>
                            </div>
                        </div>
                    </li>

                    <?php
                }
                ?>
            </ul>
        </div>

    </div>

    <?php
}
?>