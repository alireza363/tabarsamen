<style>
    .content-row span.next,
    .content-row span.prev {
        position: absolute;
        top: 38%;
        opacity: 0.7;
        padding: 34px 0;
        height: 100px;
        z-index: 2;
        background-color: #d7dbdf;
        -webkit-transition: all 200ms;
        -moz-transition: all 200ms;
        -ms-transition: all 200ms;
        -o-transition: all 200ms;
        transition: all 200ms;
        cursor: pointer;
    }

    .content-row span.next {
        left: -9px;
        -webkit-border-radius: 0 150px 150px 0;
        -moz-border-radius: 0 150px 150px 0;
        border-radius: 0 150px 150px 0;
    }

    .content-row span.next:hover {
        left: 0;
        opacity: 1;
    }

    .content-row span.prev {
        right: -9px;
        -webkit-border-radius: 150px 0 0 150px;
        -moz-border-radius: 150px 0 0 150px;
        border-radius: 150px 0 0 150px;
    }

    .content-row span.prev:hover {
        right: 0;
        opacity: 1;
    }

    .content-row ul.gallery {
    }

    .content-row ul.gallery li {
        margin: 0 8px;
        border: 2px solid #eee;
        padding: 3px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: #ccc;
    }

    .content-row ul.gallery img {
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }

    .gly_out {
        position: relative;
        overflow: hidden;
    }

    .gly_in {
        overflow: hidden;
    }

    @media screen and (max-width: 580px) {

        .content-row ul.gallery {
            flex-direction: row;
        }

        .content-row ul.gallery li {
            width: 310px!important;
            margin-right: 20px;
        }
    }

    @media screen and (max-width: 380px) {

        .content-row ul.gallery li {
            width: 225px!important;
            margin-right: 5px;
        }
    }


</style>

<div class="part gly_out in-padding b-color">
    <div class="title-part">
        گالری تصاویر
    </div>

    <div class="content-row gly_in sliderscroll">
        <span class="next" onclick="sliderscroll('right')">
            <img src="public/image/icon/left-arrow.png" alt="">
        </span>
        <span class="prev" onclick="sliderscroll('left')">
            <img src="public/image/icon/right-arrow.png" alt="">
        </span>
        <ul class="flex gallery">

            <?php
            foreach ($gallery as $row) {
                ?>

                <li>

                    <img src="public/image/gallery/<?= $row['id']; ?>.jpg" alt="">

                </li>

                <?php
            }
            ?>
        </ul>
    </div>

</div>

<script>

    var sliderscrollTag = $('.sliderscroll');
    var sliderscrollWidth = sliderscrollTag.width();
    var sliderscrollUl = sliderscrollTag.find('ul.gallery');
    var sliderscrollItems = sliderscrollUl.find('li');
    var sliderscrollItemsNumbers = sliderscrollItems.length;
    sliderscrollItemsWidth = sliderscrollWidth / 3;
    sliderscrollUl.css('width', sliderscrollItemsNumbers * sliderscrollItemsWidth);
    var sliderscrollNumbers = Math.ceil(sliderscrollItemsNumbers / 3);

    //-----sliderscroll
    function sliderscroll(direction) {

        var maxMarginRight = -(sliderscrollNumbers - 1) * sliderscrollWidth;
        var marginRightNew;
        var marginRightOld = sliderscrollUl.css('margin-right');
        marginRightOld = parseFloat(marginRightOld);

        if (direction === 'left') {
            marginRightNew = marginRightOld - sliderscrollItemsWidth;
        }
        if (direction === 'right') {
            marginRightNew = marginRightOld + sliderscrollItemsWidth;
        }
        if (marginRightNew > 0 || marginRightNew < maxMarginRight) {
            marginRightNew = marginRightOld;
        }
        sliderscrollUl.animate({'marginRight': marginRightNew}, 1000);
    }

</script>
