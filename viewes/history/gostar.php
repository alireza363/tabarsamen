<style>
    .row {
        margin-bottom: 8px;
    }

    div img {
        border: ;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        font-size: 12px;
        width: 400px;
    }

    h4 {
        margin-top: 20px;
    }

    p {
        text-indent: 3rem;
    }

    p span {
        display: block;
        padding: 12px;
        border: 1px solid #000;
        width: 84%;
        margin: 15px auto;
        text-indent: 0;
    }

    p.img span {
        border: none;
    }

    span img {
        width: 100%;
    }
</style>

<div class="part in-padding b-color">
    <div class="title-part">
        معرفی شعبه
    </div>

    <?php
    $histo = $data['histo'];
    ?>

    <div class="intro">

        <?= @$histo['matn']; ?>

    </div>

</div>
