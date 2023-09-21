<?php
    include 'connectDatabase.php';
    include 'get_product_by_id.php';
    include 'cartFunction.php';
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    if(isset($_POST['UserID'])){
        $conn = connectDatabase();
        
        $result = mysqli_query($conn,"SELECT * FROM `order`");
        $countOrder = mysqli_num_rows($result);
        $countOrderString = sprintf('%08d',$countOrder+1);

        $orderID = "OD" . $countOrderString;

        $userID = $_POST['UserID'];
        $orderDate = date("Y-m-d h:i:s");
        //echo $orderDate;
        $shippingFee = $_POST['ShippingFee'];
        $orderDiscount = $_POST['OrderDiscount'];
        $orderTotal = $_POST['Total'];
        $address = $_POST['Address'];
        $paymentID = $_POST['PaymentID'];
        $voucherID = $_POST['VoucherID'];
        echo $voucherID;

        $cart = mysqli_query($conn,"SELECT * FROM `cart` where UserID ='$userID'");

        if($voucherID == "NULL"){
            $sqlOrder = "INSERT INTO `order` (`OrderID`, `UserID`, `OderDate`, `ShippingFee`, `OrderDiscount`, `OrderTotal`, `Address`, `PaymentID`, `VoucherID`, `OrderStatus`) VALUES ('$orderID', '$userID', '$orderDate', '$shippingFee', '$orderDiscount', '$orderTotal', '$address', '$paymentID', $voucherID, 'S01')";
        }
        else{
            $sqlOrder = "INSERT INTO `order` (`OrderID`, `UserID`, `OderDate`, `ShippingFee`, `OrderDiscount`, `OrderTotal`, `Address`, `PaymentID`, `VoucherID`, `OrderStatus`) VALUES ('$orderID', '$userID', '$orderDate', '$shippingFee', '$orderDiscount', '$orderTotal', '$address', '$paymentID', '$voucherID', 'S01')";
        }
    
        try {
            // start Transaction
            $conn->begin_transaction();

            $rs1 = $conn->query($sqlOrder);

            if(!$rs1){
                $conn->rollback();
                header("Location: ../cart.php");
            }
            else{
                $conn->commit();
            }

            while($item = mysqli_fetch_array($cart)){
                $conn->begin_transaction();
                $product = get_product_by_id($item['ProductID']);

                if($product['CanDel'] == 1){
                    $rs2 = $conn->query("Update product set CanDel= 0 where ProductID = '". $product['ProductID'] . "' ");
                    if(!$rs2){
                        $conn->rollback();
                        header("Location: ../cart.php");
                    }
                }

                $Quantity = get_quanty_product_byID($item['ProductID']);
                $inStock = (int) $Quantity['Quantity'];

                
                $lastInStock = $inStock - (int) $item['Quantity'];
                
                if($lastInStock < 0){
                    $conn->rollback();
                    header("Location: ../cart.php");
                }
                else{
                    $rs3 = $conn->query("INSERT INTO `product_quantity` (`ProductID`, `Date`, `Quantity`) VALUES ('". $product['ProductID'] ."', '$orderDate', '$lastInStock')");
                }

                $product_Price = $product["PriceToSell"] - (int) $product["PriceToSell"]* (int) $product['Discount']/100;
                
                $rs4 = $conn->query("INSERT INTO `order_line` (`OrderID`, `ProductID`, `Quantity`, `UnitPrice`) VALUES ('$orderID', '". $product['ProductID'] ."', '". $item['Quantity'] ."', '$product_Price')");

                $rs5 = $conn->query("DELETE from `cart` where UserID ='$userID'");
                // $rs3 &&
                if( $rs3 && $rs4 && $rs5){
                    // commit transaction
                    $conn->commit();
                    header("Location: ../checkout.php",true,303);
                }
                else{
                    $conn->rollback();
                    header("Location: ../cart.php");
                }
            }   
        } catch (Throwable $th) {
            $conn->rollback();
            header("Location: ../cart.php");
        }
    }
?>