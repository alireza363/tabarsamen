<style>
    .item_news {
        width: 48%;
        margin: 10px;
        display: inline-block;
        height: 225px;
        overflow: clip;
    }

    .partPg {
        margin: 12px 10px;
    }

    div.img_news {
        width: 45%;
        height: 210px;
        display: inline-block;
        padding-top: 35px;
        overflow: hidden;
    }

    div.img_news img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    div.content_news {
        width: 55%;
        height: 180px;
        overflow: hidden;
    }

    div.content_news h4,
    div.content_news p {
        line-height: 1.875rem;
        text-align: justify;
        text-justify: inter-character;
    }

    div.content_news h4 {
        margin-top: 0;
    }

    div.content_news h4 a {
        color: #1c6e8c;
        font-size: 0.875rem;
        font-weight: bold;
    }

    div.content_news p {
        text-indent: 2rem;
        font-size: 0.8125rem;
    }

    div.content_news .sub_text {
        display: block;
        font-size: 0.625rem;
        font-weight: normal;
        color: #bebebe;
        position: relative;
        top: 5px;
    }

    div.content_news .sub_text span {
        margin: 0 4px;
    }

    .cover-img-icon.full-child img {
        object-fit: cover;
    }
</style>


<div class="title-part">
    آرشیو اخبار و اطلاعیه ها
</div>

<div class="content">
    <!--        div'ha ba class item_news ba json ezafeh mishavand...-->
</div>

<div class="partPg flex">
    <span class="pageto prevTo" onclick="doSearch(currentPage - 1)"><</span>
    <ul>
        <li class="active" onclick="pagination(this, 1)">1</li>
    </ul>
    <span class="pageto nextTo" onclick="doSearch(currentPage + 1)">></span>
</div>

<style>
    @media screen and (max-width: 1180px) {
        .item_news {
            width: 47%;
        }
    }

    @media screen and (max-width: 1000px) {
        .item_news {
            display: block;
            width: 70%;
            margin: 20px auto;
        }
    }

    @media screen and (max-width: 748px) {
        .item_news {
            width: 85%;
        }
    }

    @media screen and (max-width: 512px) {
        .item_news {
            width: 95%;
        }
    }
</style>

<script>
    var currentPage = 1;
    var itemNews = $('.content');
    var pageUl = $('.partPg ul');

    function dopaging(x) {
        pageUl.html('');
        var pageNumber = x;
        var i = 1;

        var start_i = currentPage - 1;
        if (start_i < 1) {
            start_i = 1;
        }
        var end_i = currentPage + 1;
        if (end_i > pageNumber - 1) {
            end_i = pageNumber - 1;
        }

        var active = '';
        for (i = start_i; i <= end_i; i++) {
            if (i == currentPage) {
                active = 'active';
            } else {
                active = '';
            }
            pageUl.append('<li onclick="pagination(this, ' + i + ')" class="' + active + '">' + i + '</li>');
        }
        if (i <= pageNumber - 1) {
            pageUl.append('...... ');
        }
        if (currentPage == pageNumber) {
            active = 'active';
        } else {
            active = '';
        }
        pageUl.append('<li onclick="pagination(this, ' + pageNumber + ')" class="' + active + '">' + pageNumber + '</li>');
    }

    function doSearch(page) {

        if (typeof (page) != 'undefined') {
            currentPage = page;
        } else {
            currentPage = 1;
        }
        if (currentPage < 1) {
            currentPage = 1;
        }
        var lastPage = pageUl.find('li:last-child').text();
        if (currentPage > lastPage) {
            currentPage = lastPage;
        }

        var data = {};
        var url = 'search/pager/' + currentPage;
        $.post(url, data, function (msg) {

            itemNews.find('.item_news').remove();
            $.each(msg[0], function (index, value) {

                var item = '';

                if (value['file_exists'] == 1) {

                    item = '<div class="item_news part b-color"><div class="flex"><div class="img_news in-padding"><a href="matter/index/' + value['id'] + '"><img src="public/image/content/' + value['id'] + '/thumbnail.jpg" alt=""></a></div><div class="in-padding content_news"><h4 class="h28"><span class="sub_text"><span>' + value['date_write'] + '</span>/<span>' + value['type_content'] + '</span> /<span>' + value['viewed'] + ' بازدید</span></span><a href="matter/index/' + value['id'] + '">' + value['title'] + '</a></h4><p>' + value['matn'] + '</p></div></div></div>';
                } else {

                    item = '<div class="item_news part b-color"><div class="flex"><div class="img_news in-padding"><a href="matter/index/' + value['id'] + '"><img src="public/image/content/no_images.png" alt=""></a></div><div class="in-padding content_news"><h4 class="h28"><span class="sub_text"><span>' + value['date_write'] + '</span>/<span>' + value['type_content'] + '</span> /<span>' + value['viewed'] + ' بازدید</span></span><a href="matter/index/' + value['id'] + '">' + value['title'] + '</a></h4><p>' + value['matn'] + '</p></div></div></div>';

                }

                itemNews.append(item);
            });

            dopaging(msg[1]);

        }, 'json');
    }

    function pagination(tag, i) {
        var liTag = $(tag);
        pageUl.find('li').removeClass('active');
        liTag.addClass('active');

        doSearch(i);
    }

    doSearch();

</script>




