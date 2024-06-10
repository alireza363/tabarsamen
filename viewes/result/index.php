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

    .resLink {
        color: #3434ff;
        font-size: 1rem;
        display: block;
        text-decoration-line: underline;
        margin-bottom: 10px;
    }

    .resNo {
        margin: 35px 0;
        font-size: 1.15rem;
    }
</style>

<div class="part in-padding b-color">
    <div class="title-part">
        نتایج جستجو ...
    </div>

    <div class="intro">

        <?php
        $res_srch = $data['result_srch'];

        if(sizeof($res_srch)!= 0) {
            foreach ($res_srch as $row) {
                ?>

                <a class="resLink" href="matter/index/<?= $row['id']; ?>"><?= $row['title']; ?></a>

                <?php
            }
        }else {
            ?>

            <p class="resNo">نتیجه ای یافت نشد..!</p>

            <?php
        }
        ?>

    </div>

</div>
