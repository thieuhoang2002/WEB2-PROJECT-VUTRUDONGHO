<?php
session_start();
include 'connectDatabase.php';
include 'cartFunction.php';

if(isset($_GET['ProductID']) && isset($_GET['Quantity'])){

    $productID = $_GET['ProductID'];
    $quantity = $_GET['Quantity'];

    echo updateQuantyInCart($_SESSION['current_userID'], $productID, $quantity);

}




?>
