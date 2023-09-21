<?php 
    include "connect.php";

    $max_price = mysqli_query($conn, "SELECT MAX(PriceToSell) as maxProductPrice FROM product where Status = 1");

    $data = array();
    while($row = mysqli_fetch_array($max_price)) {
        $data[] = $row;
    }

    echo json_encode($data);

    mysqli_close($conn);
?>