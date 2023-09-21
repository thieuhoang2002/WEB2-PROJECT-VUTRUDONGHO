<?php
    include 'modules/connectDatabase.php';
    include 'modules/get_product_by_id.php';
    session_start();

    // TEST
    //$_SESSION['current_userID'] = "US000001";

    if(isset($_SESSION['current_userID'])){
        $userID = $_SESSION['current_userID'];

        $conn = connectDatabase();

        if($conn){
            $user = mysqli_query($conn,"select * from user where UserID='$userID'");
            $user = mysqli_fetch_array($user);
        }

        if($conn){
            $cart = mysqli_query($conn,"select * from cart where UserID='$userID' ");
        }

        if(mysqli_num_rows($cart) <= 0){
            header("location: cart.php");
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/payment.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Document</title>
</head>
<style>
    .material-symbols-outlined {
      font-variation-settings:
      'FILL' 0,
      'wght' 500,
      'GRAD' 0,
      'opsz' 30
    }
</style>
<body>
    <div class="payment_container">
        <div class="payment_content">
            <div class="payment_content_header">
                <span class="material-symbols-outlined">account_balance_wallet</span>
                Thông Tin Thanh Toán
            </div>
            <div class="delivery_method">
                Phương thức vận chuyển
            </div>
            <div class="address_label">
                <span class="material-symbols-outlined">home_pin</span>
                Địa chỉ nhận hàng</div>
            <div class="user_address">
                <p><?php echo $user['FullName'] ?> - <?php echo $user['NumberPhone'] ?></p>
                <span><?php echo $user['HouseRoadAddress'] ?>, <?php echo $user['Ward'] ?>, <?php echo $user['District'] ?>, <?php echo $user['Province'] ?></span>
                <a href="change_user_information.php">Thay đổi</a>
            </div>
            <div class="delivery_cards">
                <?php 
                    // khai báo phí vận chuyển
                    $fee1 = 0;
                    $fee2 = 0;
                    // Khai báo thời gian dự kiến nhận hàng
                    $date1 = date_create(date("y-m-d"));
                    date_add($date1, date_interval_create_from_date_string("3 days"));
                    $date2 = date_create(date("y-m-d"));
                    date_add($date2, date_interval_create_from_date_string("2 days"));

                    if( $user['Province'] == "Thành phố Hồ Chí Minh" || $user['Province'] == "Thành phố Hà Nội") {
                        $fee1 = 20000; // GHN nội thành = 20k
                        $fee2 = 60000; // GHHT nội thành = 60k
                    }
                    else{
                        $fee1 = 35000;  // GHN ngoại thành = 35k
                        $fee2 = 120000; // GHHT ngoại thành = 120k
                    }
                ?>
                <div class="delivery_card card_active" data-deliveryfee="<?php echo $fee1 ?>">
                    <div class="delivery_title header_active">
                        Giao hàng nhanh
                    </div>
                    <div class="delivery_price">
                        <?php echo number_format($fee1) ?> đ
                    </div>
                    <div class="delivery_time">
                        Nhận hàng vào <?php echo (date_format($date1,"d") . "-" ); 
                                            date_add($date1, date_interval_create_from_date_string("2 days")); 
                                            echo (date_format($date1,"d")); 
                                        ?> 
                        thg <?php echo date("m") ?>
                    </div>
                    <div class="icon_clicked">
                        <span class="material-symbols-outlined">check_small</span>
                    </div>
                </div>
                <div class="delivery_card" data-deliveryfee="<?php echo $fee2 ?>">
                    <div class="delivery_title">
                        Giao hàng hỏa tốc
                    </div>
                    <div class="delivery_price">
                        <?php echo number_format($fee2) ?> đ
                    </div>
                    <div class="delivery_time">
                        Nhận hàng vào <?php echo (date_format($date2,"d") . "-" ); 
                                            date_add($date2, date_interval_create_from_date_string("1 day")); 
                                            echo (date_format($date2,"d")); 
                                        ?> 
                        thg <?php echo date("m") ?>
                    </div>
                    
                </div>
            </div>
            <div class="payment_method">
                Phương thức thanh toán
            </div>
            <div class="payment_cards">
                <div class="payment_cards_row">
                    <div class="payment_card" data-id="PA03">
                        <div class="payment_icon">
                            <span class="material-symbols-outlined">credit_card</span>
                        </div>
                        <div class="payment_name">Thẻ tín dụng/Ghi nợ</div>
                    </div>
                    <div class="payment_card card_active" data-id="PA01">
                        <div class="payment_icon header_active">
                            <span class="material-symbols-outlined">payments</span>
                        </div>
                        <div class="payment_name">Thanh toán khi nhận hàng</div>
                        <div class="icon_clicked"><span class="material-symbols-outlined">check_small</span></div>
                    </div>
                    <div class="payment_card" data-id="PA04">
                        <div class="payment_icon">
                            <img src="assets/Img/icons/momo.png" alt="">
                        </div>
                        <div class="payment_name">Ví điện tử MoMo</div>
                    </div>
                </div>
                <div class="payment_cards_row">
                    <div class="payment_card" data-id="PA05">
                        <div class="payment_icon">
                            <img src="assets/Img/icons/zalopay.png" alt="">
                        </div>
                        <div class="payment_name">Ví điện tử ZaloPay</div>
                    </div>
                    <div class="payment_card" data-id="PA02">
                        <div class="payment_icon">
                            <span class="material-symbols-outlined">account_balance</span>
                        </div>
                        <div class="payment_name">Internet Banking</div>
                    </div>
                    <div class="payment_card" data-id="PA06">
                        <div class="payment_icon">
                            <span class="material-symbols-outlined">qr_code_scanner</span>
                        </div>
                        <div class="payment_name">VNPAY-QR</div>
                    </div>
                </div>
                
            </div>
            <div class="voucher">
                <div class="voucher_name">
                    <div class="voucher_name_container" id="voucher_name_container">
                    </div>
                    <div class="voucher_discount" id="voucher_discount">
                    </div>
                </div>

                <div class="voucher_submit">
                    <input type="text" id="voucher_input" class="voucher_input" placeholder="Nhập mã giảm giá">
                    <button class="submit_button">Áp dụng</button>
                </div>
            </div>
            <form action="modules/place_order.php" method="post">
                <div class="button">
                    <input type="hidden" id="UserID"        name="UserID"       value="<?php echo $userID ?>">
                    <input type="hidden" id="ShippingFee"   name="ShippingFee"  value="">
                    <input type="hidden" id="OrderDiscount" name="OrderDiscount"value="0">
                    <input type="hidden" id="Address"       name="Address"      value="<?php echo $user['HouseRoadAddress'] ?>#<?php echo $user['Ward'] ?>#<?php echo $user['District'] ?>#<?php echo $user['Province'] ?>">
                    <input type="hidden" id="PaymentID"     name="PaymentID"    value="PA01">
                    <input type="hidden" id="VoucherID"     name="VoucherID"    value="NULL">
                    <input type="hidden" id="Total" name="Total" value="">
                    <button class="payment_button">Thanh Toán</button>
                </div>
            </form>
        </div>
        <div class="product_list_container">
            <div class="product_list_header">
                Danh sách sản phẩm
            </div>
            <div class="product_list">
                <?php
                    $sum = 0;
                    
                    while($item = mysqli_fetch_array($cart)){
                        $product = get_product_by_id($item['ProductID']);
                        $productPrice = (int) $product["PriceToSell"] - (int) $product["PriceToSell"]* (int) $product['Discount']/100 ;
                        $sum += $productPrice * (int) $item['Quantity'];
                ?>
                <div class="product_item">
                    <div class="product_item_img"><img src="assets/Img/productImg/<?php echo $product['ProductImg'] ?>" alt=""></div>
                    <div class="product_detail">
                        <div class="product_item_name">
                            <?php echo $product['ProductName'] ?>
                        </div>
                        <div class="product_item_price_category">
                            <div class="product_item_category"><?php echo $product['Model'] ?>, <?php echo $product['Color'] ?></div>
                            <div class="product_item_price">
                                <?php echo number_format( $productPrice ) ?> đ 
                                x 
                                <?php echo $item['Quantity'] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    
                ?>
            </div>
            <div class="payment_detail">
                <div class="payment_detail_pricetotal" data-total='<?php echo $sum ?>'>
                    <span>Tổng tiền hàng:</span>
                    <p> <?php echo number_format($sum) ?> đ</p>
                </div>
                <div class="payment_detail_pricetotal">
                    <span>Phí vận chuyển:</span>
                    <p id="deliveryfee">0 đ</p>
                </div>
                <div class="payment_detail_pricetotal" data-total="0">
                    <span>Khuyến mãi:</span>
                    <p id="discount"> - 0 đ</p>
                </div>
                <div class="payment_detail_total">
                    <span class="payment_detail_total_label">Tổng thanh toán:</span>
                    <p class="payment_detail_total_label_price"> 0 đ</p>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/JS/payment.js"></script>
</body>
</html>

<?php
    }
?>