<style>
    .scoring {
        position: relative;
    }

    .scoring .msg_score {
        display: none;
        position: absolute;
        bottom: -32px;
        text-align: center;
        width: 95%;
        padding: 27px;
        color: #3ed13e;
        font-size: 0.875rem;
        font-weight: bold;
        right: 20px;
    }
</style>

<div class="scoring">

    <div class="star">

        <?php
        $scores = unserialize($newsInfo['score']);
        $num_score = 0;
        $sum_score = 0;
        foreach ($scores as $key => $score) {
            $num_score = $num_score + $score;
            $sum_score = $score * $key + $sum_score;
        }
        if ($num_score == 0) {
            $avg_sum = 0;
        } else {
            $avg_sum = floor($sum_score / $num_score);
        }
        $stars = $data['scores'];
        foreach ($stars as $star) {
            if ($star['id'] <= $avg_sum) {
                ?>

                <span data-i="<?= $star['id'] ?>" class="star tooltip selected" onclick="scoring(this)">
                    <span class="tooltiptext"><?= $star['score_name'] ?></span>
                    <i class="fa fa-star"></i>
                </span>

                <?php
            } else {
                ?>

                <span data-i="<?= $star['id'] ?>" class="star tooltip" onclick="scoring(this)">
                    <span class="tooltiptext"><?= $star['score_name'] ?></span>
                    <i class="fa fa-star"></i>
                </span>

                <?php
            }
        }
        ?>

    </div>

    <?php
    if ($num_score != 0) {
        ?>

        <p id="score-p">
            میانگین امتیاز
            <b><?= $avg_sum; ?></b>
            از مجموع
            <b><?= $num_score; ?></b>
            رای
        </p>

        <?php
    } else {
        ?>

        <p id="score-p">
            به این محتوا هنوز امتیازی داده نشده است
        </p>

        <?php
    }
    ?>

    <p class="msg_score"></p>

</div>

<script>
    function scoring(tag) {
        var newsId = <?= $newsInfo['id']; ?>;
        var scoreId = $(tag).attr('data-i');

        var data = {'newsId': newsId, 'scoreId': scoreId};
        var url = 'matter/setscore';
        $.post(url, data, function (msg) {
            $('.msg_score').text(msg).fadeIn().delay(2500).fadeOut();
        });
    }
</script>