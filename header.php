<!DOCTYPE html>
<html lang="fa">

<head>
    <base href="<?= URL ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>شرکت سرمایه گذاری تبار ثامن</title>

    <meta name="description" content="تبار ثامن" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="public/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/style-all.css">

    <script src="public/jquery-3.6.0.min.js"></script>
    <script src="public/ckeditor/ckeditor.js"></script>

    <script>
        $(document).ready(function () {

            // header fixed
            var win = $(window), head = $("header"),
                sidebar = $(".sidebar > div"), to_top = $("#to-top");

            win.scroll(function () {
                var scroll_top = win.scrollTop();

                if (scroll_top > 80) {
                    if (!head.hasClass("fix-header")) {
                        head.addClass("fix-header");
                    }
                } else {
                    if (head.hasClass("fix-header")) {
                        head.removeClass("fix-header");
                    }
                }

                // sidebar fixed
                var height_site = $("main").height();
                if (scroll_top > 100 && scroll_top < height_site - 470) {
                    if (!sidebar.hasClass("fix-tab")) {
                        sidebar.addClass("fix-tab");
                    }
                } else {
                    if (sidebar.hasClass("fix-tab")) {
                        sidebar.removeClass("fix-tab");
                    }
                }

                if (scroll_top > height_site - 470) {
                    if (!sidebar.hasClass("fix-bottom")) {
                        sidebar.addClass("fix-bottom");
                    }
                } else {
                    if (sidebar.hasClass("fix-bottom")) {
                        sidebar.removeClass("fix-bottom");
                    }
                }

                // totop button
                if (scroll_top > 125) {
                    if (!to_top.hasClass("notop")) {
                        to_top.addClass("notop").animate({bottom: "15px"}, 400);
                    }
                } else {
                    if (to_top.hasClass("notop")) {
                        to_top.removeClass("notop").animate({bottom: "-60px"}, 400);
                    }
                }

            });

            to_top.click(function () {
                $("html").animate({scrollTop: 0}, 400);
            });

            //introImages slide
            var IntroComp = $("#intro-comp");

            setInterval(function () {
                var IntroAct = IntroComp.find(".active");
                var Index = IntroAct.index();
                IntroAct.fadeOut().removeClass("active").next().fadeIn().addClass("active");
                if (Index == IntroComp.find("li:last-child()").index()) {
                    IntroComp.find("li:first-child()").fadeIn().addClass("active");
                }
            }, 4500);

            // change light/dark site
            var content = $("#content-site");
            var bg = $(".change-bg-icon");
            var slider = $('#slider');
            bg.click(function () {
                if (bg.hasClass("fa-moon-o")) {
                    bg.removeClass("fa-moon-o").addClass("fa-sun-o");
                    content.removeClass("cnt-light").addClass("cnt-dark");
                    slider.css({'background': '#27292d'});
                } else {
                    bg.removeClass("fa-sun-o").addClass("fa-moon-o");
                    content.removeClass("cnt-dark").addClass("cnt-light");
                    slider.css({'background': 'none'});
                }
            });

            // scoring rate
            var star = $(".star").find(".star");
            star.hover(function () {
                if (!$(this).hasClass("selected")) {
                    var index = $(this).index();
                    while (index >= 0) {
                        if (!star.eq(index).hasClass("selected")) {
                            star.eq(index).find("i").css({color: "#ffd700"});
                        }
                        index--;
                    }
                }
            }, function () {
                if (!$(this).hasClass("selected")) {
                    var index = $(this).index();
                    while (index >= 0) {
                        if (!star.eq(index).hasClass("selected")) {
                            star.eq(index).find("i").css({color: "#e2d9d9"});
                        }
                        index--;
                    }
                }
            });

            // fix-menu open/close
            var fixmenu = $("#fix-menu");
            $("#bars i").click(function () {
                fixmenu.animate({right: "0"});
            });
            fixmenu.find(".fa-close").click(function () {
                fixmenu.animate({right: "-355px"});
            });
            var item_fixmenu = fixmenu.find("li a");
            item_fixmenu.click(function () {
                $(this).parent('li').find('> .menu-sm > li').slideToggle();
            });

            //-----ckeditor_plugin
            CKEDITOR.replace('editor1', {
                extraPlugins: 'imageuploader'
            });

            //-----pagination
            function pagination(tag, i) {
                var liTag = $(tag);
                $('.pagination').find('ul li').removeClass('active');
                liTag.addClass('active');
            }
        })
    </script>

</head>
<body>

<?php
$model = new model;
$menu = $model->getMenu();

$option = model::getsettings();
?>

<!-- fix buttons -->
<div id="socials-fix">
    <a class="top" href="mailto:<?= $option['email']; ?>"><i class="fa fa-envelope"></i></a>
    <a class="btm" href="https://www.instagram.com/<?= $option['instagram']; ?>/"><i class="fa fa-instagram"></i></a>
</div>

<span id="to-top">
    <i class="fa fa-angle-up"></i>
</span>

<div id="fix-menu">
    <div class="close-menu"><i class="fa fa-close"></i></div>
    <div class="search flex-j-center">
        <form id="searching2" action="search/index/2" class="flex-j-between" method="post">
            <input type="text" name="inputSrch2" placeholder="جستجو ...">
            <span><i class="fa fa-search" onclick="searching(2)"></i></span>
        </form>
    </div>
    <div class="menu">
        <ul>
            <?php
            foreach ($menu as $item) {
                ?>

                <li class="menu-item">
                    <a
                        <?php
                        if ($item['cate_link'] != '') {
                            ?>
                            href="<?= $item['cate_link']; ?>"
                            <?php
                        }
                        ?>
                            class="flex-a-center">
                        <?= $item['cate_name']; ?>
                    </a>

                    <?php
                    if (isset($item['children'])) {
                        ?>
                        <i class="arrow fa fa-caret-down"></i>

                        <ul class="menu-sm">
                            <?php
                            $children1 = $item['children'];
                            foreach ($children1 as $child1) {
                                ?>

                                <li>
                                    <a
                                        <?php
                                        if ($child1['cate_link'] != '') {
                                            ?>
                                            href="<?= $child1['cate_link']; ?>"
                                            <?php
                                        }
                                        ?>
                                    >
                                        <?php
                                        echo $child1['cate_name'];
                                        if (isset($child1['children'])){
                                        ?>
                                        <i class="arrow fa fa-caret-left"></i>
                                    </a>
                                    <ul class="menu-sm">

                                        <?php
                                        $children2 = $child1['children'];
                                        foreach ($children2 as $child2) {
                                            ?>

                                            <li>
                                                <a
                                                    <?php
                                                    if ($child2['cate_link'] != '') {
                                                        ?>
                                                        href="<?= $child2['cate_link']; ?>"
                                                        <?php
                                                    }
                                                    ?>
                                                >
                                                    <?= $child2['cate_name']; ?>
                                                </a>
                                            </li>

                                            <?php
                                        }
                                        ?>

                                    </ul>
                                    <?php
                                    } else {
                                        ?>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </li>

                                <?php
                            }
                            ?>
                        </ul>

                        <?php
                    }
                    ?>
                </li>

                <?php
            }
            ?>

        </ul>
    </div>
    <div class="socials-btn flex-j-center">
        <a class="social-btn insta" href="https://www.instagram.com/<?= $option['instagram']; ?>/"><i
                    class="fa fa-instagram"></i></a>
        <a class="social-btn tgrm" href="mailto:tabar@gmail.com"><i class="fa fa-envelope"></i></a>
    </div>
</div>

<!-- all site -->
<div id="site">

    <!-- header -->
    <div id="top-header"></div>

    <header id="header">

        <div class="container grid-header">

            <!-- logo -->
            <div class="logo flex-a-center">
                <a href="">
                    <img src="public/tabar-logo.png" alt="" title="شرکت سرمایه گذاری تبار ثامن (سهامی عام)">
                </a>
            </div>

            <!-- responsive header -->
            <div id="bars">
                <div class="flex-aj-center">
                    <i class="fa fa-bars"></i>
                </div>
            </div>
            <div id="icons">
                <div class="flex-aj-center" title="ارتباط با واحد سهام" style="font-size: 0.6125rem;">
                    <?= $option['tel']; ?>
                    <i class="fa fa-phone"></i>
                </div>
            </div>

            <!-- menu1 -->
            <ul class="top_menu flex">
                <?php
                foreach ($menu as $item) {
                    ?>

                    <li class="menu-item">
                        <a
                            <?php
                            if ($item['cate_link'] != '') {
                                ?>
                                href="<?= $item['cate_link']; ?>"
                                <?php
                            }
                            ?>
                                class="flex-a-center">
                            <?= $item['cate_name']; ?>
                        </a>

                        <?php
                        if (isset($item['children'])) {
                            ?>
                            <i class="arrow fa fa-caret-down"></i>

                            <ul class="menu-sm">
                                <?php
                                $children1 = $item['children'];
                                foreach ($children1 as $child1) {
                                    ?>

                                    <li>
                                        <a class="hover"
                                            <?php
                                            if ($child1['cate_link'] != '') {
                                                ?>
                                                href="<?= $child1['cate_link']; ?>"
                                                <?php
                                            }
                                            ?>
                                        >
                                            <?php
                                            echo $child1['cate_name'];
                                            if (isset($child1['children'])){
                                            ?>
                                            <i class="arrow fa fa-caret-left"></i>
                                        </a>
                                        <ul class="menu-sm">

                                            <?php
                                            $children2 = $child1['children'];
                                            foreach ($children2 as $child2) {
                                                ?>

                                                <li>
                                                    <a class="hover"
                                                        <?php
                                                        if ($child2['cate_link'] != '') {
                                                            ?>
                                                            href="<?= $child2['cate_link']; ?>"
                                                            <?php
                                                        }
                                                        ?>
                                                       target="_blank">
                                                        <?= $child2['cate_name']; ?>
                                                    </a>
                                                </li>

                                                <?php
                                            }
                                            ?>

                                        </ul>
                                        <?php
                                        } else {
                                            ?>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </li>

                                    <?php
                                }
                                ?>
                            </ul>

                            <?php
                        }
                        ?>
                    </li>

                    <?php
                }
                ?>
            </ul>

        </div>

    </header>

    <?php
//-----navbar-----//
    require ('navbar.php');

//-----slider-----//
    require ('slider.php');
    ?>

    <script>
        // slider
        var slideTag = $('#slider');
        var slideItems = slideTag.find('.item');
        var numItems = slideItems.length;
        var nextSlide = 1;
        var sliderNavigator = slideTag.find('#slider_navigator ul li');
        var timeOut = 20000;

        function slider() {
            if (nextSlide > numItems) {
                nextSlide = 1;
            }
            if (nextSlide < 1) {
                nextSlide = numItems;
            }
            slideItems.hide();
            slideItems.eq(nextSlide - 1).fadeIn(100);
            sliderNavigator.removeClass('active');
            sliderNavigator.eq(nextSlide - 1).addClass('active');
            nextSlide++;
        }

        slider();
        var sliderInterval = setInterval(slider, timeOut);

        slideTag.mouseleave(function () {
            clearInterval(sliderInterval);
            sliderInterval = setInterval(slider, timeOut);
        });

        function goTonext() {
            slider();
        }

        slideTag.find('.next').click(function () {
            clearInterval(sliderInterval);
            goTonext();
        });

        function goToprev() {
            nextSlide = nextSlide - 2;
            slider();
        }

        slideTag.find('.prev').click(function () {
            clearInterval(sliderInterval);
            goToprev();
        });

        function goToSlide(index) {
            nextSlide = index;
            slider();
        }

        sliderNavigator.mouseenter(function () {
            clearInterval(sliderInterval);
            var index = $(this).index();
            goToSlide(index + 1);
        });
    </script>

    <!-- content site -->
    <div id="content-site" class="cnt-light">
        <main class="container" style="padding-top: 30px;">
