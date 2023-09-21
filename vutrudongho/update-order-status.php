<?php
try {
    // Kết nối đến cơ sở dữ liệu
    $pdo = new PDO('mysql:host=localhost;dbname=vutrudongho', 'root', '');

    // Lấy tham số id từ request GET
    $id = $_GET['OrderID'];
    $status_id = $_GET['OrderStatusID'];
    
    // Bắt đầu transaction
    $pdo->beginTransaction();

    //Lay order status cua order hien tai, xet:
    $stmt = $pdo->prepare("select OrderStatus from `order` where OrderID = ?");
    $stmt->execute([$id]);
    $current_status =  $stmt->fetchColumn();
    //Neu $status_id == "S05" thi thong bao khong cho set lai trang thai don da huy
    if($current_status == 'S05') {
        $response = array(
            'status' => 'error',
            'message' => "Bạn không thể cập nhật do đơn hàng này đã bị hủy!"
        );
        return;
    } else { //Neu $status_id dang != "S05" thi cho phep cap nhat
        $stmt = $pdo->prepare("update `order` set OrderStatus = ? where OrderID = ?;");
        $stmt->execute([$status_id, $id]);
        
        //Tiep tuc xet status moi == 'S05' khong, neu co thi cap nhat lai ton kho
        if($status_id == 'S05') {
            //Lay cac chi tiet
            $stmt = $pdo->prepare("select * from  `order_line` where OrderID = ?");
            $stmt->execute([$id]);
            $result = $stmt->fetchAll();

            //Duyet chi tiet va cap nhat ton kho
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            foreach ($result as $row) {
                //Lay so luong ton kho hien tai cua san pham
                $stmt = $pdo->prepare('select Quantity from `product_quantity` where ProductID = ? and Date <= NOW() order by Date desc limit 1;');
                $stmt->execute([$row['ProductID']]);
                $current_quantity =  $stmt->fetchColumn();

                //Tinh so luong cap nhat
                $update_quantity = $current_quantity + $row['Quantity'];

                //Cap nhat ton kho
                $now = date('Y-m-d H:i:s');
                $stmt = $pdo->prepare('insert into `product_quantity` (`ProductID`, `Date`, `Quantity`) values (?, ?, ?);');
                $stmt->execute([$row['ProductID'], $now, $update_quantity]);
            }
        }
    }
    
    
    // Lưu các thay đổi trong transaction
    $pdo->commit();

    $response = array(
        'status' => 'success',
        'message' => "Cập nhật trạng thái đơn hàng '$id' thành công!"
    );
    
} catch(PDOException $e) {
    // Nếu có lỗi, hoàn tác tất cả các thay đổi trong transaction
    $pdo->rollback();

    $response = array(
        'status' => 'error',
        'message' => $e->getMessage()
    );

} finally {
    // Đóng kết nối
    $pdo = null;
    echo json_encode($response);
}
?>