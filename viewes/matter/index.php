<style>
    #mainpart {
        margin-bottom: 0;
        -webkit-border-radius: 2px 0 0 2px;
        -moz-border-radius: 2px 0 0 2px;
        border-radius: 2px 0 0 2px;
    }

    .cnt-image img {
        object-fit: cover;
    }


    @media screen and (max-width: 530px) {

        #similar .content-row > ul {
            flex-direction: column;
        }

    }
</style>

<?php
$newsInfo = $data['newsInfo'];
$comments = $data['comment'];
?>

<div class="flex-j-between">

    <div class="main-matter">

        <div id="mainpart" class="part in-padding b-color">
            <!-- navigator -->
            <?php require('navigator.php') ?>

            <h1 class="h28" style="color: #7385b3;"><?= $newsInfo['title']; ?></h1>

            <!-- info -->
            <?php require('info.php') ?>

            <!-- main content -->
            <?php require('main-content.php') ?>

            <!-- scoring -->
            <?php require('scoring.php') ?>
        </div>

        <!-- sharing -->
        <?php require('sharing.php') ?>

        <!-- similar -->
        <?php require('similar.php') ?>

        <!-- form comment -->
        <?php require('form-comment.php'); ?>

        <!-- question answer -->
        <?php require('question-answer.php') ?>

    </div><!-- end main-matter -->

    <!-- sidebar -->
    <div class="sidebar">
        <div>

            <!-- sidebar_tab -->
            <div class="part b-color tab">

                <!-- tab-head -->
                <div class="tab-head flex">
                    <span class="b-color tab-act"
                          onclick="openTab(this, 'Newnews')">تازه ترین</span>
                    <span class="b-color"
                          onclick="openTab(this, 'topView')">پربازدیدترین</span>
                    <span class="b-color"
                          onclick="openTab(this, 'topTalk')">پربحث ترین</span>
                </div>

                <!-- tab-content -->
                <div class="tab-cnt in-padding">

                    <section class="news">
                        <?php
                        require('tab1.php');
                        ?>
                    </section>
                    <section class="news"></section>
                    <section class="news"></section>

                </div>

            </div> <!-- end sidebar_tab -->

        </div>
    </div> <!-- end sidebar -->

</div> <!-- end container -->

<script>
    function openTab(tag, func) {
        var dis = $(tag);
        var index = dis.index();
        dis.addClass("tab-act").siblings("span").removeClass("tab-act");

        var tabchildItem = $(".tab-cnt").find("section");
        tabchildItem.hide().eq(index).show();

        var url = '<?= URL ?>matter/' + func + '/<?= $newsInfo['id']; ?>';
        var data = {};

        var section_selected = tabchildItem.eq(index);

        //Ajax codes...
        $.post(url, data, function (msg) {
            section_selected.html(msg);
        });//end Ajax codes
    }
</script>



