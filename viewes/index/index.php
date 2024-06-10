<style>

    .content-row li {
        width: 23%;
    }

    .part {
        max-height: 430px;
    }

    .cnt-image {
        height: 210px;
        margin-bottom: 12px;
    }

    .cnt-image .cover-img-icon {
        height: 100%;
    }

    .cnt-image .cover-img-icon img {
        height: 100%;
        object-fit: cover;
    }

    .intro-comp {
        height: 220px;
    }

    .intro-comp .right {
        width: 62%;
        height: 100%;
    }

    .intro-comp .content {
        height: 77%;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .intro-comp h4 {
        margin-top: 8px;
        color: red;
        padding-right: 5px;
    }

    .intro-comp p {
        text-indent: 3.125rem;
        line-height: 2rem;
        font-size: 0.875rem;
    }

    .intro-comp .left {
        width: 35%;
        height: 100%;
    }

    .intro-comp .left img {
        object-fit: contain;
        border-radius: 3px;
        height: 100%;
    }

    .intro-comp img {
        /*display: none;*/
    }

    .intro-comp li.active img {
        display: block;
    }

    .links .part {
        width: 22%;
        text-align: center;
    }

    .links a {
        display: block;
    }

    .links a:hover {
        transform: scale(1.05);
    }

    .links img {
        width: 100%;
        height: 70px;
    }

    #codal img {
        background-image: url(public/header-bg.png);
    }

    /* -----responsive design----- */
    @media screen and (max-width: 980px) {

        .intro-comp .right {
            width: 54%;
        }

        .intro-comp .left {
            width: 43%;
        }

        #slider .prev,
        #slider .next {
            top: 42%;
        }
    }

    @media screen and (max-width: 748px) {

        .part {
            max-height: none;
        }

        .intro-comp {
            height: auto;
            flex-direction: column-reverse;
        }

        .intro-comp .right {
            width: 100%;
        }

        .intro-comp .left {
            width: 100%;
        }

        .content-row li:nth-child(4) {
            display: none;
        }

        .content-row li {
            width: 30%;
        }

        #slider .prev,
        #slider .next {
            top: 40%;
        }
    }

    @media screen and (max-width: 580px) {

        .content-row ul {
            flex-direction: column;
        }

        .content-row li {
            width: 70%;
            margin: 0 auto 25px;
        }



        #slider .prev,
        #slider .next {
            top: 35%;
        }
    }
</style>

<!-- Notifications -->
<?php
$notif = $data['imp'];
if ($notif != '') {
    require('notification.php');
}
?>


<!-- lastNews -->
<?php require('lastNews.php'); ?>


<!-- moarefi -->
<?php
$history = $data['intro'];
if ($history != '') {
    require('moarefi.php');
}
?>

<!-- gallery -->
<?php
$gallery = $data['gallery'];
if (sizeof($gallery) != 0) {
    require('gallery.php');
}
?>
