<?php
session_start();
include 'connectDatabase.php';
include 'cartFunction.php';

if(isset($_GET['ProductID']) && isset($_SESSION['current_userID'])){

    $productID = $_GET['ProductID'];
    $userID = $_SESSION['current_userID'];
    $conn = connectDatabase();

    if($conn){
        $result = mysqli_query($conn,"DELETE from cart where cart.UserID='$userID' and cart.ProductID='$productID'");

    }
    closeDatabase($conn);
    echo $result;
}
?>
