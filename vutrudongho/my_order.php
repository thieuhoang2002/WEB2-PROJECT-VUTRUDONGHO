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

// số lượng mục hiển thị trên mỗi trang
$limit = 3;

// truy vấn cơ sở dữ liệu để lấy số lượng tổng mục
$sql = sprintf("SELECT * FROM `order` where UserID = '$userID'");
$result = mysqli_query($conn, $sql);
$total_items = mysqli_num_rows($result);

// tính toán tổng số trang
$total_pages = ceil($total_items / $limit);

// xác định trang hiện tại
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// tính toán vị trí bắt đầu và số lượng mục cần lấy
$start = ($current_page - 1) * $limit;

// truy vấn cơ sở dữ liệu để lấy dữ liệu
$query = sprintf("select * from `order` where UserID = '$userID' ORDER BY OderDate DESC limit $start, $limit;");
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vũ Trụ Đồng Hồ</title>
  <link rel="shortcut icon" href="assets/Img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/my_order.css">
  <link rel="stylesheet" href="assets/css/header.css">
  <link rel="stylesheet" href="assets/css/footer.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap&amp;_cacheOverride=1679484892371"
    data-tag="font">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
    data-tag="font">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="sweetalert2.min.js"></script>
  <link rel="stylesheet" href="sweetalert2.min.css">
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
          <li><a href="my_order.php?page=1">Quản lý đơn hàng</a></li>
        </ul>

      </div>
      <div id="content-user">
        <p class="styleTextMyOrder" style="margin-bottom: 16px;margin-top: 4px;margin-left: 4px;">Tổng số đơn hàng (
          <?php echo $total_items; ?>)
        </p>
        <?php if ($total_items == 0) {
          echo '<p class="styleTextMyOrder">Bấm<a class="hoverTheA3" href="product.php">vào đây</a> để mua hàng.</p>';
        }
        ?>

        <?php
        // hiển thị dữ liệu
        while ($row = mysqli_fetch_array($result)) {
          $orderID = $row['OrderID'];
          $orderDate = $row['OderDate'];
          $shippingFee = $row['ShippingFee'];
          $orderDiscount = $row['OrderDiscount'];
          $orderTotal = $row['OrderTotal'];
          $address = $row['Address'];
          $paymentID = $row['PaymentID'];
          $phuongthucThanhToan = "";
          if ($paymentID == "PA01") {
            $phuongthucThanhToan = "Thanh toán khi nhận hàng";
          } elseif ($paymentID == "PA02") {
            $phuongthucThanhToan = "Internet Banking";
          } elseif ($paymentID == "PA03") {
            $phuongthucThanhToan = "Thẻ tín dụng/Ghi nợ";
          } elseif ($paymentID == "PA04") {
            $phuongthucThanhToan = "Ví điện tử MoMo";
          } elseif ($paymentID == "PA05") {
            $phuongthucThanhToan = "Ví điện tử ZaloPay";
          } else {
            $phuongthucThanhToan = "VNPAY-QR";
          }
          $voucherID = $row['VoucherID'];
          $orderStatus = $row['OrderStatus'];
          $trangThaiDonHang = "";
          if ($orderStatus == "S01") {
            $trangThaiDonHang = "Chưa xác nhận";
          } elseif ($orderStatus == "S02") {
            $trangThaiDonHang = "Đã xác nhận";
          } elseif ($orderStatus == "S03") {
            $trangThaiDonHang = "Đang giao hàng";
          } elseif ($orderStatus == "S04") {
            $trangThaiDonHang = "Đã giao hàng";
          } else {
            $trangThaiDonHang = "Đã hủy";
          }
          $userID = $row['UserID'];

          echo '
          <div class="component_order"
          style="display: flex;flex-direction: column;width: 100%;height: fit-content;align-items: center;background-color: #fff;margin-bottom: 8px;padding-bottom: 8px;">
          <div class="header-component-order"
            style="display: inline-flex;padding: 8px 8px 8px 8px;align-items: left;width: 100%;position:relative;">
            <a class="hoverTheA2" style="display:block;text-align: right;" href="detail_my_order.php?id=' . $orderID . '">Xem chi tiết</a>';
          if ($orderStatus != "S04" && $orderStatus != "S03" && $orderStatus != "S05") {
            echo '<form style="display:flex;flex-direction: row;" name="frmHuy" id="" action="modules/cancel_Order.php" method="POST" onsubmit="return checkHuy();">';
            echo '<label style="display:flex;flex-direction: row;margin-left: 20px;" class="hoverTheA22">Nhấn nút bên cạnh để hủy đơn hàng -></label> <input id="myInput" name="valueID" type="submit" value="' . $orderID . '" onclick="myFunction();" style="margin-left:4px;width:fit-content;display:block;text-align: right;">';
            echo '</form>';

          }


          echo '<p class="styleTextMyOrder" style="display:block;position: absolute;right:8px;">Mã đơn hàng: ' . $orderID . '</p>';
          echo '</div>
          <hr style="width: 100%;">
          <div class="main-component-order-title"
            style="display:flex;flex-direction: row;justify-content: space-between;align-items: center;width: 95%;margin-top: 4px;margin-bottom: 10px;">
            <p class="styleTextMyOrder2" style="width: 20%;">Thời gian</p>
            <p class="styleTextMyOrder2" style="width:14%;">Phí vận chuyển</p>
            <p class="styleTextMyOrder2" style="width:14%;">Giảm giá</p> 
            <p class="styleTextMyOrder2" style="width:14%;">Tổng tiền</p>
            <p class="styleTextMyOrder2" style="width:24%;">Hình thức thanh toán</p>
            <p class="styleTextMyOrder2" style="width: 14%;">Trạng thái</p>
          </div>
          <div class="main-component-order"
            style="display:flex;flex-direction: row;justify-content: space-between;align-items: center;width: 95%;margin-top: 4px;">
            <p class="styleTextMyOrder" style="width: 20%;">' . $orderDate . '</p>
            <p class="styleTextMyOrder" style="width: 14%;">' . number_format($shippingFee, 0, ',', '.') . ' đ</p>
            <p class="styleTextMyOrder" style="width: 14%;">' . number_format($orderDiscount, 0, ',', '.') . ' đ</p> 
            <p class="styleTextMyOrder" style="width: 14%;">' . number_format($orderTotal, 0, ',', '.') . ' đ</p>
            <p class="styleTextMyOrder" style="width: 24%;">' . $phuongthucThanhToan . '</p>
            <p id="statusDonHang" class="styleTextMyOrder" style="width: 14%;">' . $trangThaiDonHang . '</p>
          </div>
        </div>
          
          ';
          echo '<script>
          let coHieu = false;
           function myFunction() {
            let statusDonHang = document.getElementById("statusDonHang");
             if (confirm("Bạn thực sự muốn hủy đơn hàng này?") == true) {
              coHieu = true;
             }
             else{
              coHieu = false;
             }
           }
           function checkHuy(){
            if(coHieu == true){
              return true;
           }
           else{
            return false;
           }

          }
           </script>';
        }
        ?>
        <!-- <div class="component_order"
          style="display: flex;flex-direction: column;width: 100%;height: fit-content;align-items: center;background-color: #fff;margin-bottom: 8px;padding-bottom: 8px;">
          <div class="header-component-order"
            style="display: inline-flex;padding: 8px 8px 8px 8px;align-items: left;width: 100%;position:relative;">
            <a style="display:block;text-align: right;" href="">Xem chi tiết</a>
            <p style="display:block;position: absolute;right:8px;">Mã đơn hàng: OD00000001</p>
          </div>
          <hr style="width: 100%;">
          <div class="main-component-order-title"
            style="display:flex;flex-direction: row;justify-content: space-between;align-items: center;width: 95%;margin-top: 4px;margin-bottom: 10px;">
            <p style="width: 18%;">Thời gian</p>
            <p style="width: 10%;">Số lượng</p>
            <p style="width:14%;">Phí vận chuyển</p>
            <p style="width:12%;">Giảm giá</p> 
            <p style="width:12%;">Tổng tiền</p>
            <p style="width:22%;">Hình thức thanh toán</p>
            <p style="width: 12%;">Trạng thái</p>
          </div>
          <div class="main-component-order"
            style="display:flex;flex-direction: row;justify-content: space-between;align-items: center;width: 95%;margin-top: 4px;">
            <p style="width: 18%;">2023-05-01 20:13:19</p>
            <p style="width: 10%;">1</p>
            <p style="width: 14%;">15000 đ</p>
            <p style="width: 12%;">50000 đ</p> 
            <p style="width: 12%;">7105000 đ</p>
            <p style="width: 22%;">Thanh toán khi nhận hàng</p>
            <p style="width: 12%;">Đã giao hàng</p>
          </div>
        </div> -->


        <div
          style="width: 100%;height: 26px;position: absolute;bottom: 0;margin-bottom: 60px;display: flex;flex-direction:row;align-items: center;justify-content: center;">
          <div id="numberPhanTrang"
            style="width: fit-content;display: flex;flex-direction:row;align-items: center;justify-content: center;position: absolute;z-index: 999999;">
            <p style="padding: 4px;">
              <?php
              // hiển thị các liên kết phân trang
              for ($page = 1; $page <= $total_pages; $page++) {
                echo '<a class="number-ptrang-' . $page . '" style="text-decoration: none;padding: 4px 8px;background-color:#ccc;" href="?page=' . $page . '">' . $page . '</a> ';
              }
              ?>
            </p>
          </div>
        </div>


      </div>
    </div>
  </div>
  <!--Start: Footer-->
  <div id="my-footer" style="position: absolute;">
    <?php
    include("components/footer.php");
    ?>
  </div>
  <!--End: Footer-->
  <script>
    var currentPage = parseInt(new URLSearchParams(window.location.search).get('page'));
    var currentElement = document.querySelector('.number-ptrang-' + currentPage);
    currentElement.style.backgroundColor = 'purple';
    currentElement.style.color = '#fff';
  </script>
  <?php
  if (isset($_SESSION['cancelSuccess'])) {
    echo "<script>
      Swal.fire({
        title: 'Thông báo!',
        text: 'Hủy đơn hàng thành công!',
        icon: 'success',
        confirmButtonText: 'Xác nhận'
      })
      </script>";
    unset($_SESSION['cancelSuccess']);
  }
  ?>
</body>

</html>