
<div id="mali">
    <div id="mali_print">

        <table id="printMali" class="admin table_data" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th>ردیف</th>
                <th>تاریخ</th>
                <th>شرح</th>
                <th>بدهکار (ریال)</th>
                <th>بستانکار (ریال)</th>
            </tr>
            </thead>
            <tbody>
            <!--                        json-->
            </tbody>
        </table>

    </div>

    <div class="row">
        <div class="left-btn">
            <span class="btn" onclick="printdiv()">چاپ</span>
        </div>
    </div>
</div>

<script>
    function printdiv() {
        var printContents = document.getElementById('mali_print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>