<?php
// Kết nối cơ sở dữ liệu
include './connectdb.php';

// Kiểm tra kết nối
if (!$con) {
    die('Kết nối không thành công: ' . mysqli_connect_error());
}

// Lấy tham số id từ request GET
$id = $_GET['OrderID'];

// Truy vấn dữ liệu từ cơ sở dữ liệu với id tương ứng
$sql = "select o.OrderID, o.UserID, u.FullName, o.OderDate, o.PaymentID, p.PaymentName, o.OrderStatus, s.StatusName, o.Address, o.ShippingFee, o.OrderTotal, o.VoucherID, o.OrderDiscount from `order` as o, `user` as u, `payment` as p, `orderstatus` as s where o.UserID = u.UserID and p.PaymentID = o.PaymentID and s.StatusID = o.OrderStatus and o.OrderID = '$id';";
$result = mysqli_query($con, $sql);

// Tạo một mảng chứa dữ liệu trả về
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Trả về dữ liệu dưới dạng JSON
echo json_encode($data);

// Đóng kết nối
mysqli_close($con);
?>