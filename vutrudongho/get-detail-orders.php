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
$sql = "select d.ProductID, p.ProductName, d.Quantity, d.UnitPrice from `order_line` as d, `product` as p where d.ProductID = p.ProductID and d.OrderID = '{$id}'";
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