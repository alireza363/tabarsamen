<?php

$active = 'files';
?>

<style>

    #content {
        padding-right: 15px;
    }

    a.dirImg{
        display: inline-block;
        text-align: center;
        padding: 8px 12px;
    }

    .dirImg img {
        width: 100px;
        vertical-align: middle;
        margin: 5px 8px;
    }

    .dirImg p {
        font-size: 0.75rem;
        text-align: center;
        color: #988dd5;
    }
</style>

<?php
require('viewes/admin/layout.php');
$sahamdar = $data['sahamdar'];
?>

<div class="admin_main">
    <h4>فایلهای سهامداران</h4>

    <div id="content">

        <?php
        foreach ($sahamdar as $row) {
            if(is_dir('public/sahamdar/' . $row['id'])) {
                ?>

                <a class="dirImg" href="adminsahamdar/details/<?= $row['id'] ?>">
                    <img src="public/image/icon/dir.png" alt="">
                    <p><?= $row['id'] ?></p>
                </a>

                <?php
            }
        }
        ?>

    </div>
</div>

</div><!--end of flex-->
