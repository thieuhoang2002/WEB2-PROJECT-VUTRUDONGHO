<?php
    include 'modules/connectDatabase.php';
    include 'modules/get_product_by_id.php';
    include 'modules/cartFunction.php';
    //include 'lib_session.php';

    session_start();

    if(isset($_SESSION['current_userID'])){
        
        $userID = $_SESSION['current_userID'];
        

        if($conn = connectDatabase()){
            $cart = mysqli_query($conn,"select * from cart where UserID='$userID' ");
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/CSS/cart.css">
    <link rel="stylesheet" href="assets/CSS/header.css">
    <link rel="stylesheet" href="assets/CSS/footer.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="shortcut icon" href="assets/Img/logo.png" type="image/x-icon">
    <title>Giỏ hàng</title>
</head>
<style>
.material-symbols-outlined {
  font-variation-settings:
  'FILL' 0,
  'wght' 600,
  'GRAD' 0,
  'opsz' 48;
}
</style>
<body>
    <div id="bar-header">
        <?php
        include("components/header.php");
        ?>
    </div>
    <div class="cart">
        <div class="cart_body">
            <div class="cart_header">
                <span class="material-symbols-outlined">shopping_bag</span>
                <div>Giỏ hàng</div>
            </div>
            <div class="cart_title">
                <div class="cart_title_stt">STT</div>
                <div class="cart_title_name">Sản phẩm</div>
                <div class="cart_title_Category">Phân loại</div>
                <div class="cart_title_unitprice">Đơn giá</div>
                <div class="cart_title_quantity">Số lượng</div>
                <div class="cart_title_total">Thành tiền</div>
                <div class="cart_title_bin"></div>
            </div>
            <div class="cart_detail">
                <?php
                    $stt = 0;
                    while($item = mysqli_fetch_array($cart)){ 
                        $stt++;
                        $product = get_product_by_id($item["ProductID"]);
                        $inStock = get_quanty_product_byID($item["ProductID"]);
                        if((int)$inStock['Quantity'] !=0){
                            if((int) $item['Quantity'] > (int)$inStock['Quantity']){
                                $item['Quantity'] = $inStock['Quantity'];
                                updateQuantyInCart($userID, $item["ProductID"], $inStock['Quantity']);
                            }
                        }
                        else{
                            mysqli_query($conn,"DELETE from cart where cart.UserID='$userID' and cart.ProductID='". $item["ProductID"]. "'");
                            continue;
                        }

                ?>
                        <div class="cart_item">
                            <div class="cart_item_stt"><?php echo $stt ?></div>
                            <div class="cart_item_name">
                                <img src="assets/Img/productImg/<?php echo $product["ProductImg"] ?>" alt="">
                                <p><?php echo $product["ProductName"] ?></p>
                            </div>
                            <div class="cart_item_category"><?php echo $product["Model"] ?>, <?php echo $product["Color"] ?></div>
                            <div class="cart_item_unitprice" data-id="<?php echo $product["PriceToSell"] ?>"><?php echo number_format($product["PriceToSell"]) ?> đ</div>
                            <div class="cart_item_quantity">
                                <span class="minus_btn material-symbols-outlined" data-id="<?php echo $item["ProductID"] ?>" >indeterminate_check_box</span>
                                <input type="text" name="Quantity" id="quantity" onkeypress="return isNumber(event)" onchange="posNumber(this)" value="<?php echo $item["Quantity"] ?>" data-id="<?php echo $item["ProductID"] ?>">
                                <span class="add_btn material-symbols-outlined" data-id="<?php echo $item["ProductID"] ?>" >add_box</span>
                            </div>
                            <div class="cart_item_total" id="<?php echo $item["ProductID"] ?>" ><?php echo number_format(   $product["PriceToSell"]*$item["Quantity"]   ) ?> đ</div>
                            <span class="material-symbols-outlined red_bin"  onclick="deleteItem('<?php echo $item['ProductID']; ?>', this)">delete</span>
                        </div>

                <?php
                    }
                ?>
            </div>
            <div class="cart_totalprice">
                <p>Tổng cộng:</p>
                <p style="color: #6750A4; font-size: 1.375rem;">0 đ</p>
            </div>
            <div class="button">
                <button class="confirm_button" onclick="payment()">Mua Ngay</button>
            </div>
        </div>
    </div>
    </div>
    <div id="my-footer">
        <?php
        include("components/footer.php");
        ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="./assets/JS/cart.js"></script>
    
</body>
</html>

<?php
    }
    else{
        header("location: login.php");
    }
?>