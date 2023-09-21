<?php

try {
    // Kết nối đến cơ sở dữ liệu
    $pdo = new PDO('mysql:host=localhost;dbname=vutrudongho', 'root', '');

    // Lấy tham số id từ request GET
    $reId = $_GET['InID'];
    
    // Bắt đầu transaction
    $pdo->beginTransaction();
    
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    // Cap nhat lai ton kho
    $stmt = $pdo->prepare("select ProductID, Quantity, ReceivingUnitPrice from `receivingdetail` where InID = ?");
    $stmt->execute([$reId]);
    $result = $stmt->fetchAll();
    foreach($result as $row) {
        //Lay so luong hien tai cua san pham
        $stmt = $pdo->prepare('select Quantity from `product_quantity` where ProductID = ? and Date <= NOW() order by Date desc limit 1;');
        $stmt->execute([$row['ProductID']]);
        $current_quantity = $stmt->fetchColumn();

        //Tinh so luong cap nhat
        $update_quantity = $current_quantity - $row['Quantity'];

        $now = date('Y-m-d H:i:s');
        $stmt = $pdo->prepare('insert into `product_quantity` (`ProductID`, `Date`, `Quantity`) values (?, ?, ?);');
        $stmt->execute([$row['ProductID'], $now, $update_quantity]);
    }
    // Xoa chi tiet phieu nhap
    $stmt = $pdo->prepare("delete from `receivingdetail` where InID = ?");
    $stmt->execute([$reId]);

    // Xoa phieu nhap
    $stmt = $pdo->prepare("delete from `inventoryreceivingvoucher` where InID = ?");
    $stmt->execute([$reId]);
    
    // Lưu các thay đổi trong transaction
    $pdo->commit();

    $response = array(
        'status' => 'success',
        'message' => "Xóa phiếu nhập có mã '$reId' thành công!"
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