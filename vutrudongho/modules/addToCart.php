<?php
include("connectDatabase.php");
include("cartFunction.php");
session_start();


if(isset($_GET['ProductID']) && isset($_SESSION['current_userID'])){


    $userID =  $_SESSION['current_userID'];

    $productID = $_GET['ProductID'];

    //echo $_SESSION['current_userID'];

    $conn = connectDatabase();

    if($conn){
        $cart = mysqli_query($conn,"select * from cart where UserID = '$userID'");
    }

    if(isset($_SESSION)){

        while($item = mysqli_fetch_array($cart)){
            if($item['ProductID'] == $_GET['ProductID']){
                $result = updateQuantyInCart($item['UserID'], $item['ProductID'], ((int) $item['Quantity']) +1 );
                if( $result === true ){
                    echo true;
                    return;
                }
                else if( $result === false){
                    echo false;
                    return;
                }
                else{
                    echo $result;
                    return;
                }
            }
        }
        if(mysqli_query($conn,"Insert into cart (`UserID`, `ProductID`, `Quantity`) VALUES ('$userID', '$productID', '1')")){
            echo true;
            return;
        }
    }
    closeDatabase($conn);
}
else{
    echo 2;
    return;
}

?>