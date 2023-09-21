<?php
include 'connect.php';
if (isset($_GET['idBrand']) && ($_GET['idBrand'] > 0)) {
    $slug = $_GET['idBrand'];
    $quantity = mysqli_query($conn, "select * from brand where Status = 1 and BrandID = '$slug'");
    $cate = mysqli_fetch_assoc($quantity);
    $data = $cate['BrandName'];
} elseif (isset($_GET['from']) && isset($_GET['to'])) {
    $pricefrom = $_GET['from'];
    $priceto = $_GET['to'];
    $quantity = mysqli_query($conn, "select * from product where Status = 1 and PriceToSell - (PriceToSell*Discount)/100 between $pricefrom and $priceto");
    $from1 = number_format($pricefrom, 0, ",", ".");
    $from2 = number_format($priceto, 0, ",", ".");
    $data = "$from1 đ" . " đến $from2 đ";
} elseif (isset($_GET['color']) && ($_GET['color'] > 0)) {
    $slug = $_GET['color'];
    $quantity = mysqli_query($conn, "select * from product where Status = 1 and Color = '$slug'");
    $cate = mysqli_fetch_assoc($quantity);
    $data = $cate['Color'];
} elseif (isset($_GET['gender']) && ($_GET['gender'] > 0)) {
    $slug = $_GET['gender'];
    $quantity = mysqli_query($conn, "select * from product where Status = 1 and Gender = '$slug'");
    $cate = mysqli_fetch_assoc($quantity);
    $data = $cate['Gender'];
} elseif (isset($_GET['model']) && ($_GET['model'] > 0)) {
    $slug = $_GET['model'];
    $quantity = mysqli_query($conn, "select * from product where Status = 1 and Model = '$slug'");
    $cate = mysqli_fetch_assoc($quantity);
    $data = $cate['Model'];
} elseif (isset($_GET['search']) && ($_GET['search'] > 0)) {
    $search = $_GET['search'];
    $quantity = mysqli_query($conn, "select * from product where Status = 1 and product.ProductName LIKE '%$search%'");
    $data = $search;
} elseif (isset($_GET['nang-cao']) && ($_GET['nang-cao'])) {
    $data = "Tìm kiếm nâng cao";
}

?>
<div class="menu">
    <span name="quantity-sp" class="quantity">Sản phẩm theo:
        <b>
            <?php if (!empty($data)) {
                echo $data;
            } else {
                echo "Tất cả";
            } ?>
        </b>
    </span>
    <!-- <p>Sắp xếp</p> -->
    <form action="" method="GET">
        <div class="dropdown-sort">
            <!-- <button class="drop">Tất cả</button> -->
            <div class="sort">
                <select name="sort_num" class="drop">
                    <option value="all">Tất cả</option>
                    <option class="select-sort" value="thap-cao" <?php if (isset($_GET['sort_num']) && $_GET['sort_num'] == "thap-cao") {
                        echo "selected";
                    } ?>>Giá thấp đến cao</option>
                    <option class="select-sort" value="cao-thap" <?php if (isset($_GET['sort_num']) && $_GET['sort_num'] == "cao-thap") {
                        echo "selected";
                    } ?>>Giá cao đến thấp</option>
                </select>
                <input type="submit" class="input" value="Sắp xếp">
            </div>
        </div>
    </form>
</div>
