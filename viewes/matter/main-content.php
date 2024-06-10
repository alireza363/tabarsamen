<style>
    .subject {
        margin: 25px 0;
    }

    .subject img,
    .subject video {
        max-width: 100%;
        width: auto;
        display: block;
        margin: 0 auto;
        text-align: center;
    }
</style>


<div class="img-subject">
    <img src="public/image/content/<?= $newsInfo['id']; ?>/thumbnail.jpg" alt="">
</div>

<div class="subject">
    <?= $newsInfo['matn']; ?>
</div>