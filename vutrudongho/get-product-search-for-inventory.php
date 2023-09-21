<?php
    include './connectdb.php';

    $keyWord = str_replace("\\", "", $_GET['keyWord']);

    $result = mysqli_query($con, "select ProductID, ProductName, ProductImg, ImportPrice
                                  from `product`
                                  where ProductName regexp '{$keyWord}' and Status = 1");

    $data = array();
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    echo json_encode($data);

    mysqli_close($con);
?>