<ul>

    <?php
    $Newnews = $data['Newnews'];
    foreach ($Newnews as $item1) {
        ?>

        <li class="grid-news">
            <div class="cnt-image full-child">
                <a class="cover-img-icon full-child" href="matter/index/<?= $item1['id']; ?>">
                    <?php
                    if (file_exists('public/image/content/' . $item1['id'] . '/thumbnail.jpg')) {
                        ?>
                        <img src="public/image/content/<?= $item1['id']; ?>/thumbnail.jpg" alt="">
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
                <a class="hover" href="matter/index/<?= $item1['id']; ?>">
                    <?= $item1['title']; ?>
                </a>
                <div class="date">
                    <i class="fa fa-clock-o"></i>
                    <?= model::jalaliDate('j F Y', $item1['date_write']); ?>
                </div>
            </div>
        </li>

        <?php
    }
    ?>
</ul>
