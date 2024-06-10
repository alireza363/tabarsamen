<?php
if (isset($data['slider'])) {
    $slider = $data['slider'];
    $num = sizeof($slider);
    ?>
    <div id="slider">

        <span class="prev"></span>
        <span class="next"></span>

        <div id="slider_img">
            <?php
            foreach ($slider as $item) {
                ?>

                <a href="<?= $item['slider_link']; ?>" class="item">
                    <img src="public/image/slider/<?= $item['slider']; ?>">
                </a>

                <?php
            }
            ?>
        </div>

        <div id="slider_navigator">
            <ul>
                <?php
                for ($i = 0; $i < $num; $i++) {
                    ?>
                    <li class=""><a></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>

    </div>
    <?php
}
?>