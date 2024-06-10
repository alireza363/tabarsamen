<div class="part in-padding b-color">
    <div class="title-part">
        آخرین اخبار شرکت
    </div>

    <div class="content-row">
        <ul class="flex-j-between">

            <?php
            $lastNews = $data['news'];
            foreach ($lastNews as $row) {
                ?>

                <li>
                    <div class="cnt-image full-child">
                        <a class="cover-img-icon full-child" href="matter/index/<?= $row['id']; ?>">
                            <?php
                            if (file_exists('public/image/content/' . $row['id'] . '/thumbnail.jpg')) {
                                ?>
                                <img src="public/image/content/<?= $row['id']; ?>/thumbnail.jpg" alt="">
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
                        <a class="hover" href="matter/index/<?= $row['id']; ?>">
                            <?= $row['title']; ?>
                        </a>
                        <div class="date">
                            <i class="fa fa-clock-o"></i>
                            <?= model::jalaliDate('j F Y', $row['date_write']); ?>
                        </div>
                    </div>
                </li>

                <?php
            }
            ?>
        </ul>
    </div>

    <div class="left-btn">
        <a class="btn" href="content">
            <i class="fa fa-archive"></i>
            آرشیو اخبار
        </a>
    </div>
</div>