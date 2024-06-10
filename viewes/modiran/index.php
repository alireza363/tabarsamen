<style>
    div.modir {
        width: 250px;
        display: inline-block;
        border: 1px solid #ccc;
        margin: 10px;
    }

    div.modir h5 {
        background: #ccc;
        border-bottom: 1px solid #ccc;
        padding: 4px 0;
        color: #424242;
    }

    div.modir span {
        display: block;
        padding: 2px 0;
        font-size: 0.75rem;
    }

    div.img {
        width: 200px;
        height: 272px;
        margin: 3px auto;
        border: 1px solid #ccc ;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        font-size: 12px;
    }
</style>

<?php
$modiran = $data['modiran'];
?>

<div class="part in-padding b-color">
    <div class="title-part">
        هیأت مدیره و مدیرعامل
    </div>

    <div style="text-align: center;">

        <?php
        $modiran = $data['modiran'];
        foreach ($modiran as $modir) {
            ?>

            <div class="modir">
                <h5><?= $modir['post_title']; ?></h5>
                <div class="img">
                    <?php
                    if (file_exists('public/image/modiran/m' . $modir['id'] . '.' . $modir['exp'])) {
                        ?>
                        <img src="public/image/modiran/m<?= $modir['id']; ?>.<?= $modir['exp']; ?>" alt="">
                        <?php
                    } else {
                        ?>
                        <img src="public/image/modiran/m-default.jpg">
                        <?php
                    }
                    ?>
                </div>
                <span style="color: red;"><?= $modir['name_family']; ?></span>
                <span>تلفن : <?= $modir['tel']; ?></span>
                <span>ایمیل : <?= $modir['email']; ?></span>
            </div>

            <?php
        }
        ?>

    </div>


</div>
