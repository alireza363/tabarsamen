<!-- navbar -->
<nav id="nav">
    <div class="container flex-j-between">
        <div class="rt">
            <span class="date">
                <i class="fa fa-calendar"></i>
                <?= model::jalaliDate('l j F Y') ?>
            </span>
            <span class="socials">
                <a href="mailto:<?= $option['email']; ?>">
                    <i class="fa fa-envelope"></i>
                </a>
                <a href="https://www.instagram.com/<?= $option['instagram']; ?>/">
                    <i class="fa fa-instagram"></i>
                </a>
                <i class="change-bg-icon fa fa-moon-o"></i>
            </span>
            <form id="searching1" action="search/index/1" method="post">
                <input type="text" name="inputSrch1" placeholder="جستجو برای">
                <i class="fa fa-search" onclick="searching(1)"></i>
            </form>
        </div>

        <div class="lt flex-child-midle">
           <span title="ارتباط با واحد سهام">
               <?= $option['tel']; ?>
               <i class="fa fa-phone"></i>
           </span>
        </div>
    </div>
</nav>

<script>
    function searching(i) {

        $('#searching' + i).submit();
    }
</script>