<div id="main">
    <?php
    include("sidebar.php");
    include 'connect.php';

    $item_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 9;
    $cur_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($cur_page - 1) * $item_page;
    $page = mysqli_query($conn, "select * from product where Status=1 order by ProductID LIMIT " . $item_page . " OFFSET " . $offset);
    $total = mysqli_query($conn, "select * from product where Status=1");
    $total = $total->num_rows;
    $total_page = ceil($total / $item_page);
    //-----
    $sort_option = "";
    $bla = "";
    if (isset($_GET['sort_num'])) {
        $url = $_GET['sort_num'];
        if ($_GET['sort_num'] == "thap-cao") {
            $sort_option = "ASC";
            $bla = "";
        } elseif ($_GET['sort_num'] == "cao-thap") {
            $sort_option = "DESC";
            $bla = "";

        } elseif ($_GET['sort_num'] == "all") {
            $sort_option = "";
            $bla = "ProductID,";
        }
    }
    $sort = "select * from product where Status=1 order by $bla PriceToSell $sort_option LIMIT " . $item_page . " OFFSET " . $offset;
    $run = mysqli_query($conn, $sort);
    ?>
    <div class="maincontent">
        <?php if (isset($_GET['sort_num']) && ($_GET['sort_num'] > 0) && mysqli_num_rows($run) > 0) { ?>
            <?php foreach ($run as $key => $value): ?>
                <div class="card">
                    <div class="product-top">
                        <class="product-thumb">
                            <img src="./assets/Img/productImg/<?php echo $value['ProductImg'] ?>"></img>
                            <button class="info-detail"
                                onclick="location.href='detail_product.php?ProductID=<?php echo $value['ProductID'] ?>'">Xem
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
                            <?php echo number_format($value['PriceToSell'] - $value['PriceToSell'] * $value['Discount'] / 100, 0, ",", ".") ?> đ
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
                    <a class="page-item" href="?page=<?= $first_page ?><?php if (isset($_GET['sort_num']) && ($_GET['sort_num'] > 0))
                                  echo ($url != '') ? "&sort_num=$url" : '' ?>">First</a>
                    <?php
                }
                if ($cur_page > 1) {
                    $prev_page = $cur_page - 1;
                    ?>
                    <a class="page-item" href="?page=<?= $prev_page ?><?php if (isset($_GET['sort_num']) && ($_GET['sort_num'] > 0))
                                  echo ($url != '') ? "&sort_num=$url" : '' ?>">Prev</a>
                <?php }
                ?>

                <?php for ($num = 1; $num <= $total_page; $num++) { ?>
                    <?php if ($num != $cur_page) { ?>
                        <?php if ($num > $cur_page - 2 && $num < $cur_page + 2) { ?>
                            <a class="page-item" href="?page=<?= $num ?><?php if (isset($_GET['sort_num']) && ($_GET['sort_num'] > 0))
                                  echo ($url != '') ? "&sort_num=$url" : '' ?>"><?= $num ?></a>
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
                    <a class="page-item" href="?page=<?= $next_page ?><?php if (isset($_GET['sort_num']) && ($_GET['sort_num'] > 0))
                                  echo ($url != '') ? "&sort_num=$url" : '' ?>">Next</a>
                <?php }
                if ($cur_page < $total_page - 2) {
                    $end_page = $total_page;
                    ?>
                    <a class="page-item" href="?page=<?= $end_page ?><?php if (isset($_GET['sort_num']) && ($_GET['sort_num'] > 0))
                                  echo ($url != '') ? "&sort_num=$url" : '' ?>">Last</a>
                <?php }
                ?>
            </div>
        </div>
    <?php } else { ?>
        <?php foreach ($page as $key => $value): ?>
            <div class="card">
                <div class="product-top">
                    <class="product-thumb">
                        <img src="./assets/Img/productImg/<?php echo $value['ProductImg'] ?>"></img>
                        <button class="info-detail"
                            onclick="location.href='detail_product.php?ProductID=<?php echo $value['ProductID'] ?>'">Xem
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
                            <?php echo number_format($value['PriceToSell'] - $value['PriceToSell'] * $value['Discount'] / 100, 0, ",", ".") ?> đ
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
                <a class="page-item" href="?page=<?= $first_page ?>">First</a>
                <?php
            }
            if ($cur_page > 1) {
                $prev_page = $cur_page - 1;
                ?>
                <a class="page-item" href="?page=<?= $prev_page ?>">Prev</a>
            <?php }
            ?>

            <?php for ($num = 1; $num <= $total_page; $num++) { ?>
                <?php if ($num != $cur_page) { ?>
                    <?php if ($num > $cur_page - 2 && $num < $cur_page + 2) { ?>
                        <a class="page-item" href="?page=<?= $num ?>"><?= $num ?></a>
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
                <a class="page-item" href="?page=<?= $next_page ?>">Next</a>
            <?php }
            if ($cur_page < $total_page - 2) {
                $end_page = $total_page;
                ?>
                <a class="page-item" href="?page=<?= $end_page ?>">Last</a>
            <?php }
            ?>
        </div>
    </div>
<?php } ?>
</div>
