<div id="main">
    <?php
    include 'connect.php';
    include("sidebar.php");
    $item_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 9;
    $cur_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($cur_page - 1) * $item_page;
    $page = mysqli_query($conn, "select * from product where Status=1 order by ProductID asc LIMIT " . $item_page . " OFFSET " . $offset);
    $url = isset($_GET['gender']) && ($_GET['gender'] > 0) ? $_GET['gender'] : '';
    $total = $conn->prepare("select * from product where Status = 1 and Gender = ?");
    $total->bind_param("s", $url);
    $total->execute();
    $total_a = $total->get_result();
    $total_a = $total_a->num_rows;
    $total_page = ceil($total_a / $item_page);
    $stmt = $conn->prepare("select * from product where Status=1 and Gender = ? order by ProductID asc LIMIT " . $item_page . " OFFSET " . $offset);
    $stmt->bind_param("s", $url);
    $stmt->execute();
    $abc = $stmt->get_result();
    ?>
    <div class="maincontent">
        <?php foreach ($abc as $key => $value): ?>
            <div class="card">
                <div class="product-top">
                    <class="product-thumb">
                        <img src="./assets/img/productImg/<?php echo $value['ProductImg'] ?>"></img>
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
                <a class="page-item" href="?page=<?= $first_page ?>&gender=<?= $url ?>">First</a>
                <?php
            }
            if ($cur_page > 1) {
                $prev_page = $cur_page - 1;
                ?>
                <a class="page-item" href="?page=<?= $prev_page ?>&gender=<?= $url ?>">Prev</a>
            <?php }
            ?>

            <?php for ($num = 1; $num <= $total_page; $num++) { ?>
                <?php if ($num != $cur_page) { ?>
                    <?php if ($num > $cur_page - 2 && $num < $cur_page + 2) { ?>
                        <a class="page-item" href="?page=<?= $num ?>&gender=<?= $url ?>"><?= $num ?></a>
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
                <a class="page-item" href="?page=<?= $next_page ?>&gender=<?= $url ?>">Next</a>
            <?php }
            if ($cur_page < $total_page - 2) {
                $end_page = $total_page;
                ?>
                <a class="page-item" href="?page=<?= $end_page ?>&gender=<?= $url ?>">Last</a>
            <?php }
            ?>
        </div>
    </div>
</div>
