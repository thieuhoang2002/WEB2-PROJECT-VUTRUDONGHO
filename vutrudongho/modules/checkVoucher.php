<?php
    include 'connectDatabase.php';

    if(isset($_GET['VoucherID'])){

        $voucherID = $_GET['VoucherID'];
        if($conn = connectDatabase()){
            $result = mysqli_query($conn,"select * from voucher where VoucherID='$voucherID'");
            if(mysqli_num_rows($result) >0){
                $voucher = mysqli_fetch_array($result);
            }
            else{
                echo 0;
                return;
            }
        }

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        if($voucher['Status'] == "1"){
            $now = date('Y-m-d');
            if( strtotime($voucher['DateFrom']) < strtotime($now) && strtotime($now) < strtotime($voucher['DateTo'])){
                echo $voucher['VoucherName'] . "," . $voucher['Discount'] . "," . $voucher['Unit'];
                return;
            }
        }

        echo 0;
        return;
    }

?>