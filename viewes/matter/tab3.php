<ul>

    <?php
    $Toptalk = $data['Toptalk'];
    foreach ($Toptalk as $item3) {
        ?>

        <li class="grid-news">
            <div class="cnt-image full-child">
                <a class="cover-img-icon" href="matter/index/<?= $item3['id']; ?>">
                    <?php
                    if (file_exists('public/image/content/' . $item3['id'] . '/thumbnail.jpg')) {
                        ?>
                        <img src="public/image/content/<?= $item3['id']; ?>/thumbnail.jpg" alt="">
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
                <a class="hover" href="matter/index/<?= $item3['id']; ?>"><?= $item3['title'] ?></a>
                <div class="date">
                    <i class="fa fa-clock-o"></i>
                    <?= model::jalaliDate('j F Y', $item3['date_write']); ?>
                </div>
            </div>
        </li>

        <?php
    }
    ?>

</ul>
