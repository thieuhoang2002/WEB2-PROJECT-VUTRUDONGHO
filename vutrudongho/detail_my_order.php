<?php
require_once('lib_session.php');
?>
<?php
$userID = $_SESSION['current_userID'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vutrudongho";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$curr_idOrder = $_GET['id'];

$sql4 = sprintf("SELECT *
                 FROM `order`
                 JOIN `order_line` ON `order`.OrderID = `order_line`.OrderID
                 JOIN `product` ON `order_line`.ProductID = `product`.ProductID
                 WHERE `order`.UserID = '$userID' and `order`.OrderID = '$curr_idOrder'");
$result4 = mysqli_query($conn, $sql4);

$sql5 = sprintf("SELECT *
                 FROM `order`
                 WHERE `order`.UserID = '$userID' and `order`.OrderID = '$curr_idOrder'");
$result5 = mysqli_query($conn, $sql5);
$row5 = mysqli_fetch_array($result5);

$orderDate = $row5['OderDate'];
$shippingFee = $row5['ShippingFee'];
$orderDiscount = $row5['OrderDiscount'];
$orderDiscount_formatted = number_format($orderDiscount, 0, ',', '.');
$orderTotal = $row5['OrderTotal'];
$orderTotal_formatted = number_format($orderTotal, 0, ',', '.');
$address = $row5['Address'];
$paymentID = $row5['PaymentID'];
$phuongthucThanhToan = "";
if ($paymentID == "PA01") {
  $phuongthucThanhToan = "Thanh toán khi nhận hàng";
}
elseif($paymentID == "PA02"){
  $phuongthucThanhToan = "Internet Banking";
}
elseif($paymentID == "PA03"){
  $phuongthucThanhToan = "Thẻ tín dụng/Ghi nợ";
}
elseif($paymentID == "PA04"){
  $phuongthucThanhToan = "Ví điện tử MoMo";
}
elseif($paymentID == "PA05"){
  $phuongthucThanhToan = "Ví điện tử ZaloPay";
}
 else {
  $phuongthucThanhToan = "VNPAY-QR";
}
$voucherID = $row5['VoucherID'];
$orderStatus = $row5['OrderStatus'];
$trangThaiDonHang = "";
if ($orderStatus == "S01") {
  $trangThaiDonHang = "Chưa xác nhận";
} elseif ($orderStatus == "S02") {
  $trangThaiDonHang = "Đã xác nhận";
} elseif ($orderStatus == "S03") {
  $trangThaiDonHang = "Đang giao hàng";
} else {
  $trangThaiDonHang = "Đã giao hàng";
}

global $quantityTotal;
global $tongtien1mathang;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vũ Trụ Đồng Hồ</title>
  <link rel="shortcut icon" href="assets/Img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/detail_my_order.css">
  <link rel="stylesheet" href="assets/css/header.css">
  <link rel="stylesheet" href="assets/css/footer.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap&amp;_cacheOverride=1679484892371"
    data-tag="font">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
    data-tag="font">
</head>

<body>
  <!--Start: Header-->
  <div id="bar-header">
    <?php
    include("components/header.php");
    ?>
  </div>
  <!--End: Header-->
  <div id="main-user">
    <div id="imagelogo">
      <img id="img-logo" src="assets/img/hoangImg/logo/logo_text_400x100.png" alt="">
    </div>
    <div id="main-content">
      <div id="tab-bar-user">
        <p class="content-tab-bar-userr">Xin chào,
          <?php echo ("$_SESSION[current_fullName]"); ?>!
        </p>
        <ul id="primary3">
          <li style="margin-bottom: 16px;"><a href="user_information.php">Thông tin tài khoản</a></li>
          <li><a href="my_order.php">Quản lý đơn hàng</a></li>
        </ul>

      </div>
      <div id="content-user">
        <p class="styleTextMyOrder" style="margin-bottom: 16px;margin-top: 4px;margin-left: 4px;">Chi tiết đơn hàng: (<?php echo $_GET['id']; ?>)
        </p>

        <?php
        while ($row = mysqli_fetch_array($result4)) {
          $urlPicture = $row['ProductImg'];
          $productName = $row['ProductName'];
          $model = $row['Model'];
          $color = $row['Color'];
          $gender = $row['Gender'];
          $price = $row['PriceToSell'];
          $quantity = $row['Quantity'];
          $addressOrder = $row['Address'];
          echo '<div class="component_order"
          style="display: flex;flex-direction: column;width: 100%;height: fit-content;align-items: center;background-color: #fff;margin-bottom: 8px;padding-bottom: 8px;">
          <div class="main-component-order-title"
            style="display:flex;flex-direction: row;justify-content: space-between;align-items: center;width: 95%;margin-top: 4px;margin-bottom: 10px;">
            <p class="styleTextMyOrder2" style="width: 15%;">Hình</p>
            <p class="styleTextMyOrder2" style="width: 35%;">Tên sản phẩm</p>
            <p class="styleTextMyOrder2" style="width:13%;margin-left: 40px;">Loại</p>
            <p class="styleTextMyOrder2" style="width:9%;">Màu</p>
            <p class="styleTextMyOrder2" style="width:12%;">Giới tính</p>
            <p class="styleTextMyOrder2" style="width:13%;">Giá</p>
            <p class="styleTextMyOrder2" style="width: 7%;">Số lượng</p>
          </div>
          <div class="main-component-order"
            style="display:flex;flex-direction: row;justify-content: space-between;align-items: center;width: 95%;margin-top: 4px;">
            <div style="width: 15%;"><img src="assets/img/productImg/' . $urlPicture . '" width="75"
                alt="" /></div>
            <p class="styleTextMyOrder" style="width: 35%;text-align: justify;">' . $productName . '</p>
            <p class="styleTextMyOrder" style="width: 13%; margin-left: 40px;">' . $model . '</p>
            <p class="styleTextMyOrder" style="width: 9%;">' . $color . '</p>
            <p class="styleTextMyOrder" style="width: 12%;">' . $gender . '</p>
            <p class="styleTextMyOrder" style="width: 13%;">' . number_format($price, 0, ',', '.') . 'đ</p>
            <p class="styleTextMyOrder" style="width: 7%;">' . $quantity . '</p>
          </div>
        </div>
        ';
          // var_dump ($row);
          //var_dump($row5);
          $quantityTotal += $quantity;
          $tongtien1mathang += $price * $quantity;
        }
        ?>
        <div style="width:100%;height: fit-content;display: flex;flex-direction: column;">
          <div id="dateOrder_payment"
            style="width: 100%;height: fit-content;flex-direction: column;background-color: #fff;margin-top: 16px;margin-bottom: 16px;padding: 16px;">
            <p class="styleTextMyOrder">Đặt ngày <?php echo $orderDate;?></p>
            <p class="styleTextMyOrder">Hình thức thanh toán: <?php echo $phuongthucThanhToan;?></p>
          </div>
          <div style="width: 100%;height: fit-content;display: flex;flex-direction: row;margin-bottom: 20px;">
            <div id="name_address_phone"
              style="width: 50%;height: fit-content;display: flex;flex-direction: column;background-color: #fff;margin-right: 16px;padding: 16px;">
              <p class="styleTextMyOrder">Người nhận: <?php echo $_SESSION['current_fullName'];?></p>
              <p class="styleTextMyOrder">Địa chỉ: <?php echo str_replace('#', ', ', $addressOrder);?></p>
              <p class="styleTextMyOrder">Số điện thoại: <?php echo $_SESSION['current_numberPhone'];?></p>
            </div>
            <div id="total_detail_order" style="width: 50%;height:fit-content;display: flex;flex-direction: row;">
              <div id="title_total_detail_order"
                style="width: 60%;height: fit-content;display: flex;flex-direction: column;background-color: #fff;padding: 16px;">
                <p class="styleTextMyOrder">Tổng cộng</p>
                <p class="styleTextMyOrder">Tổng tiền (<?php echo $quantityTotal;?> sản phẩm): </p>
                <p class="styleTextMyOrder">Phí vận chuyển</p>
                <p class="styleTextMyOrder">Giảm giá</p>
                <hr style="width:100%">
                <p class="styleTextMyOrder">Tổng cộng</p>
              </div>
              <div id="value_total_detail_order"
                style="width: 40%;height: fit-content;display: flex;flex-direction: column;background-color: #fff;padding: 16px;text-align: right;">
                <p class="styleTextMyOrder">&nbsp;</p>
                <p class="styleTextMyOrder"><?php echo number_format($tongtien1mathang, 0, ',', '.');?> đ</p>
                <p class="styleTextMyOrder">+ <?php echo number_format($shippingFee, 0, ',', '.');?> đ</p>
                <p class="styleTextMyOrder" style="color: red;">- <?php echo $orderDiscount_formatted;?> đ</p>
                <hr style="width:100%">
                <p class="styleTextMyOrder"><?php echo $orderTotal_formatted;?> đ</p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
  <!--Start: Footer-->
  <div id="my-footer" style="margin-top: 50px;">
    <?php
    include("components/footer.php");
    ?>
  </div>
  <!--End: Footer-->
  <script>
    function changeColor() {
      var currentPage = parseInt(new URLSearchParams(window.location.search).get('page')); // Lấy trang hiện tại từ tham số truy vấn '?page'

      if (currentPage) {
        var currentElement = document.querySelector('.number-ptrang-' + currentPage); // Chọn phần tử tương ứng với trang hiện tại

        if (currentElement) {
          currentElement.style.backgroundColor = "orange"; // Thay đổi màu nền của phần tử thành màu cam
        }
      }
    }

  </script>
</body>

</html>