<style>

    .info span {
        margin-left: 10px;
    }

    .info i {
        margin-left: 3px;
    }
</style>

<div class="info">

    <div class="rt flex-a-center">
        <span><i class="fa fa-calendar"></i>
            <?php
            if ($newsInfo['date_update'] == 0) {
                echo model::jalaliDate('j F Y', $newsInfo['date_write']);
            } else {
                echo 'بروزرسانی شده در ' . model::jalaliDate('j F Y', $newsInfo['date_update']);
            }
            ?>
        </span>

        <?php
        $numcomment = $data['numcomment'];
        if ($numcomment > 0) {
            ?>

            <span><i class="fa fa-comments"></i><?= $numcomment; ?></span>

            <?php
        }
        ?>

        <span><i class="fa fa-eye"></i><?= $newsInfo['viewed']; ?></span>

    </div>

</div>
