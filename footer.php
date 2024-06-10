</main>
</div> <!-- end content-site -->

<!-- footer -->
<footer id="footer">
    <div class="container">

        <div class="part in-padding b-color flex-j-between">
            <!-- description/tozihat -->
            <div class="rt">
                <div class="title">پیوندها</div>
                <div>
                    <ul>
                        <li>
                            <a href="https://jovainco.com/" target="_blank">
                                <img src="" alt="">
                                <span>شرکت کشت و صنعت جوین</span>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.codal.ir/ReportList.aspx?search&Symbol=%D9%88%D8%AA%D8%A8%D8%A7%D8%B1&LetterType=-1&Isic=569945&AuditorRef=-1&PageNumber=1&Audited&NotAudited&IsNotAudited=false&Childs&Mains&Publisher=false&CompanyState=2&Category=-1&CompanyType=1&Consolidatable&NotConsolidatable" target="_blank">
                                <img src="" alt="">
                                <span>سامانه اطلاع رسانی بورس و اوراق بهادار</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- emails&socials -->
            <div class="lt flex-j-between">
                <div class="rt">
                    <div class="title">ما را دنبال کنید</div>
                    <div>
                        <a class="social-btn insta" href="https://www.instagram.com/<?= $option['instagram']; ?>/" target="_blank"><i class="fa fa-instagram"></i></a>
                        <a class="social-btn tgrm" href="mailto:tabar@gmail.com"><i class="fa fa-envelope"></i></a>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <style>
        .footer_bottom {
            width: 100%;
            text-align: center;
            padding: 10px;
            font-size: 10px;
            background: #0F2027;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #2C5364, #203A43, #0F2027);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #2C5364, #203A43, #0F2027); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }

        .footer_bottom span {
            padding: 0 8px;
            text-align: center;
            color: #a8a5a5;
        }

        .footer_bottom span:not(:last-child){
            border-left: 1px solid #a8a5a5;
        }

        .footer_bottom span:hover a {
            color: #fff;
        }
    </style>

    <div class="footer_bottom">
        <span><a href="">صفحه نخست</a><i></i></span>
        <span><a href="contactus">ارتباط با ما</a><i></i></span>
<!--        <span><a href="">پیوندها</a><i></i></span>-->
    </div>
</footer>

</div><!-- end of site -->

</body>
</html>