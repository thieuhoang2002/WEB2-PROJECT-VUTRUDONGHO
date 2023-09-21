<?php
include './sidebar.php';
include './container-header.php';
include 'modules/connectDatabase.php';

    $dateFrom = isset($_GET['date-from']) ? $_GET['date-from'] : "" ;
    $dateTo = isset($_GET['date-to']) ? $_GET['date-to'] : "" ;

    if($conn = connectDatabase()){  
        $today = date("Y-m-d");
        $revenue = $conn->query("select sum(orderTotal) as total from `order` where oderDate like'$today %'");
        $countOrder = $conn->query("select count(OrderID) as count from `order` where oderDate like'$today %'");
        $import = $conn->query("select sum(Total) as total from `inventoryreceivingvoucher` where Date ='$today'");
        $countImport = $conn->query("select count(InID) as count from `inventoryreceivingvoucher` where Date ='$today'");

        $revenue = $revenue->fetch_row();
        $countOrder = $countOrder->fetch_row();
        $import = $import->fetch_row();
        $countImport = $countImport->fetch_row();

        $revenue        = $revenue == null ? 0 : $revenue[0];
        $countOrder     = $countOrder == null ? 0 : $countOrder[0];
        $import         = $import == null ? 0 : $import[0];
        $countImport    = $countImport == null ? 0 : $countImport[0];
    }
?>
<head>
    <link rel="stylesheet" href="assets/CSS/sale.css">
</head>
<script>
    eventForSideBar(1);
    setValueHeader("Doanh Thu");
</script>

<div class="revenue_content">
    <div class="revenue_left_content">
        <div class="filter_content">
            <form action="" method="get">
                <div class="calender_revenue" id="calender_revenue">
                    <input name="date-from" type="date" class="date-picker__date-from">
                    <span class="material-symbols-outlined">arrow_forward</span>
                    <input name="date-to" type="date" class="date-picker__date-to">
                    <button type="submit" name="submit" class="date-picker__filter">Lọc</button>
                </div>
            </form>
            <div class="date_revenue">
                <button class="button_filter button_filter_clicked" onclick="renderChart('date','',''); clicked(this)">Ngày</button>
                <button class="button_filter" onclick="renderChart('month','',''); clicked(this)">Tháng</button>
                <button class="button_filter" onclick="renderChart('year','',''); clicked(this)">Năm</button>
            </div>
        </div>
        <div class="revenue_chart">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <div class="revenue_right_content">
        <div class="revenue_card" style="background-image: linear-gradient(#6750A4,#422393);">
            <h1>Doanh thu hôm nay</h1>
            <p><?php echo number_format($revenue) ?> VNĐ</p>
        </div>
        <div class="revenue_card" style="background-image: linear-gradient(#E67099,#CE1C5A);">
            <h1>Đơn hàng hôm nay</h1>
            <p><?php echo $countOrder ?> đơn hàng</p>
        </div>
        <div class="revenue_card" style="background-image: linear-gradient(#4C9D62,#32964E);">
            <h1>Nhập hàng hôm nay</h1>
            <p><?php echo number_format($import) ?> VNĐ</p>
        </div>
        <div class="revenue_card" style="background-image: linear-gradient(#394E78,#5585E0);">
            <h1>Phiếu nhập hôm nay</h1>
            <p><?php echo $countImport ?> phiếu nhập</p>
        </div>
        <div class="order_today">

        </div>

        </div>
    </div>
</div>

<!-- <div style="width: 800px; height: 500px">
    <canvas id="myChart"></canvas>
</div> -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/JS/sale.js"></script>
<script>
    var myChart; 
    renderChart("date",'<?php echo $dateFrom; ?>','<?php echo $dateTo; ?>');
</script>

<?php include './container-footer.php' ?>