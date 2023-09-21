<div id="main">
    <?php
    include 'connect.php';
    include("sidebar.php");

    $item_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 9;
    $cur_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($cur_page - 1) * $item_page;
    $page = mysqli_query($conn, "select * from product where Status=1 order by ProductID asc LIMIT " . $item_page . " OFFSET " . $offset);
    $total = "select product.* from product inner join brand on product.BrandID=brand.BrandID where product.Status=1";
    // $total = $total->num_rows;
    // $total_page = ceil($total / $item_page);
    $chuoiquery = "select product.* from product inner join brand on product.BrandID=brand.BrandID where product.Status=1";
    if (isset($_GET['nang-cao'])) {
        $search = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $brand = isset($_GET['brandname']) ? $_GET['brandname'] : '';
        $pricefrom = isset($_GET['from-advanced']) ? $_GET['from-advanced'] : '';
        $priceto = isset($_GET['to-advanced']) ? $_GET['to-advanced'] : '';
        if (isset($_GET['keyword']) && !empty($search)) {
            $chuoiquery .= " AND product.ProductName LIKE '%$search%'";
            $total .= " AND product.ProductName LIKE '%$search%'";
        }
        if (isset($_GET['brandname']) && !empty($brand)) {
            $chuoiquery .= " AND brand.BrandName LIKE '%$brand%'";
            $total .= " AND brand.BrandName LIKE '%$brand%'";
        }
        if (isset($_GET['from-advanced']) && isset($_GET['to-advanced'])) {
            $chuoiquery .= " AND product.PriceToSell - (PriceToSell*Discount)/100 between $pricefrom and $priceto";
            $total .= " AND product.PriceToSell - (PriceToSell*Discount)/100 between $pricefrom and $priceto";
        }
        $chuoiquery .= " order by ProductID asc LIMIT " . $item_page . " OFFSET " . $offset;
        $total_a =  mysqli_query($conn, $total);
        $total_a = $total_a->num_rows;
        $total_page = ceil($total_a / $item_page);
        $product = mysqli_query($conn, $chuoiquery);
    }

    ?>
    <?php if (mysqli_num_rows($product) > 0) { ?>
        <div class="maincontent">
            <?php foreach ($product as $key => $value) : ?>
                <div class="card">
                    <div class="product-top">
                        <class="product-thumb">
                            <img src="./assets/img/productImg/<?php echo $value['ProductImg'] ?>"></img>
                            <button class="info-detail" onclick="location.href='detail_product.php?ProductID=<?php echo $value['ProductID'] ?>'">Xem
                                Thêm</button>
                        </class="product-thumb">
                    </div>
                    <p>
                        <?php echo $value['ProductName'] ?>
                    </p>
                    <span class="price">
                        <?php if ($value['Discount'] == 0) { ?>
                            <strong>
                                <?php echo number_format($value['PriceToSell'], 0, ",", ".") ?> đ
                            </strong>
                        <?php } else { ?>
                            <strong>
                                <?php echo number_format($value['PriceToSell'] - $value['PriceToSell'] * $value['Discount'] / 100, 0, ",", ".") ?>
                                đ
                            </strong>
                            <strike>
                                <?php echo number_format($value['PriceToSell'], 0, ",", ".") ?> đ
                            </strike>
                        <?php } ?>
                    </span>
                </div>
            <?php endforeach ?>
            <div class="pagination">
                <?php
                if ($cur_page > 2) {
                    $first_page = 1;
                ?>
                    <a class="page-item" href="?page=<?= $first_page ?><?php echo ($search != '') ? "&keyword=$search" : '' ?><?php echo ($brand != '') ? "&brandname=$brand" : '' ?><?php echo ($pricefrom != '') ? "&from-advanced=$pricefrom" : '' ?><?php echo ($priceto != '') ? "&to-advanced=$priceto" : '' ?>&nang-cao=Tìm+kiếm">First</a>
                <?php
                }
                if ($cur_page > 1) {
                    $prev_page = $cur_page - 1;
                ?>
                    <a class="page-item" href="?page=<?= $prev_page ?><?php echo ($search != '') ? "&keyword=$search" : '' ?><?php echo ($brand != '') ? "&brandname=$brand" : '' ?><?php echo ($pricefrom != '') ? "&from-advanced=$pricefrom" : '' ?><?php echo ($priceto != '') ? "&to-advanced=$priceto" : '' ?>&nang-cao=Tìm+kiếm">Prev</a>
                <?php }
                ?>

                <?php for ($num = 1; $num <= $total_page; $num++) { ?>
                    <?php if ($num != $cur_page) { ?>
                        <?php if ($num > $cur_page - 2 && $num < $cur_page + 2) { ?>
                            <a class="page-item" href="?page=<?= $num ?><?php echo ($search != '') ? "&keyword=$search" : '' ?><?php echo ($brand != '') ? "&brandname=$brand" : '' ?><?php echo ($pricefrom != '') ? "&from-advanced=$pricefrom" : '' ?><?php echo ($priceto != '') ? "&to-advanced=$priceto" : '' ?>&nang-cao=Tìm+kiếm"><?= $num ?></a>
                        <?php } ?>
                    <?php } else { ?>
                        <strong class="cur-page page-item">
                            <?= $num ?>
                        </strong>
                    <?php } ?>
                <?php } ?>
                <?php
                if ($cur_page < $total_page - 1) {
                    $next_page = $cur_page + 1; ?>
                    <a class="page-item" href="?page=<?= $next_page ?><?php echo ($search != '') ? "&keyword=$search" : '' ?><?php echo ($brand != '') ? "&brandname=$brand" : '' ?><?php echo ($pricefrom != '') ? "&from-advanced=$pricefrom" : '' ?><?php echo ($priceto != '') ? "&to-advanced=$priceto" : '' ?>&nang-cao=Tìm+kiếm">Next</a>
                <?php }
                if ($cur_page < $total_page - 2) {
                    $end_page = $total_page;
                ?>
                    <a class="page-item" href="?page=<?= $end_page ?><?php echo ($search != '') ? "&keyword=$search" : '' ?><?php echo ($brand != '') ? "&brandname=$brand" : '' ?><?php echo ($pricefrom != '') ? "&from-advanced=$pricefrom" : '' ?><?php echo ($priceto != '') ? "&to-advanced=$priceto" : '' ?>&nang-cao=Tìm+kiếm">Last</a>
                <?php }
                ?>
            </div>
        </div>
    <?php } else {
    ?>
        <div class="alert-not-found">
            <img src="./assets/Img/icons/icons8-nothing-found-100.png" alt="Not found" class="ic-not-found">
            <p class="not-found">Không tìm thấy sản phẩm</p>
        </div> <?php
            }

                ?>


</div>