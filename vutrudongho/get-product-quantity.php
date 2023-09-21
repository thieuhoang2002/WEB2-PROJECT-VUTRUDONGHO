<?php
// Kết nối cơ sở dữ liệu
include './connectdb.php';

// Kiểm tra kết nối
if (!$con) {
    die('Kết nối không thành công: ' . mysqli_connect_error());
}

// Lấy tham số id từ request GET
$id = $_GET['ProductID'];
$date = $_GET['Date'];

// Truy vấn dữ liệu từ cơ sở dữ liệu với id tương ứng
$sql = "select Quantity from `product_quantity` where ProductID = '$id' and Date(Date) <= '$date' order by Date desc limit 1;";
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