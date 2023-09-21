<?php
require_once('../lib_session.php');

$valueID = $_REQUEST['valueID'];
date_default_timezone_set('Asia/Ho_Chi_Minh');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vutrudongho";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}
//echo $valueID;
$sql = sprintf("UPDATE `order` SET `OrderStatus` = 'S05' WHERE `order`.`OrderID` = '%s'", $valueID);
$result = mysqli_query($conn, $sql);



$sql4 = sprintf("SELECT *
                 FROM `order`
                 JOIN `order_line` ON `order`.OrderID = `order_line`.OrderID
                 WHERE `order`.OrderID = '$valueID'");
$result4 = mysqli_query($conn, $sql4);
while ($row = mysqli_fetch_array($result4)) {
    $prdtID = $row['ProductID'];
    $qtt = $row['Quantity'];

    $sqlSP = sprintf("SELECT `Quantity` FROM `product_quantity` WHERE `ProductID` = '$prdtID' ORDER BY `Date` DESC LIMIT 1");
    $resultSP = mysqli_query($conn, $sqlSP);
    $rowSP = mysqli_fetch_assoc($resultSP);
    $quantity = $rowSP['Quantity'];

    $newQ = $qtt + $quantity;

    $now = date('Y-m-d H:i:s');
    $sqlUD = sprintf("INSERT INTO `product_quantity` (`ProductID`, `Date`, `Quantity`) values ('$prdtID', '$now', '$newQ')");
    $resultUD = mysqli_query($conn, $sqlUD);
}
//
session_start();
$_SESSION['cancelSuccess'] = true;
//
header('location: ../my_order.php');

mysqli_close($conn);
?>