<?php
    //Them
    if(isset($_GET['enableQuery'])  && isset($_POST['submit']) && $_POST['submit'] == 'insert') {
        include './connectdb.php';
        $voucher_id = $_POST['voucher-id'];
        $voucher_name = trim($_POST['voucher-name']);
        $voucher_unit = $_POST['voucher-unit'];
        $voucher_discount= trim($_POST['voucher-discount']);
        $voucher_dateFrom = $_POST['voucher-dateFrom'];
        $voucher_dateTo = $_POST['voucher-dateTo'];
        $voucher_status = $_POST['status'];

        $result = mysqli_query($con, "insert into `voucher` (`VoucherID`, `VoucherName`, `Discount`, `Unit`, `DateFrom`, `DateTo`, `Status`) values ('{$voucher_id}', '{$voucher_name}', '{$voucher_discount}', '{$voucher_unit}', '{$voucher_dateFrom}', '{$voucher_dateTo}', {$voucher_status});");
        mysqli_close($con);
        if($result) {
            echo "<script>
                alert('Thêm mã giảm giá mới có mã {$voucher_id} thành công!');
                window.location.href = 'voucher-manager.php';
            </script>";
        }
    }

    //Sua
    if(isset($_GET['enableQuery'])  && isset($_POST['submit']) && $_POST['submit'] == 'edit') {
        include './connectdb.php';
        $voucher_id = $_POST['voucher-id'];
        $voucher_name = trim($_POST['voucher-name']);
        $voucher_unit = $_POST['voucher-unit'];
        $voucher_discount= trim($_POST['voucher-discount']);
        $voucher_dateFrom = $_POST['voucher-dateFrom'];
        $voucher_dateTo = $_POST['voucher-dateTo'];
        $voucher_status = $_POST['status'];

        $result = mysqli_query($con, "update `voucher` set `VoucherName` = '{$voucher_name}', `Discount` = '{$voucher_discount}', `Unit` = '{$voucher_unit}', `DateFrom` = '{$voucher_dateFrom}', `DateTo` = '{$voucher_dateTo}', `Status` = '{$voucher_status}' where `voucher`.`VoucherID` = '{$voucher_id}';");
        mysqli_close($con);
        if($result) {
            echo "<script>
                alert('Sửa mã giảm giá có mã {$voucher_id} thành công!');
                window.location.href = 'voucher-manager.php';
            </script>";
        }
    }
?>

<?php
include './sidebar.php';
include './container-header.php';
$keyWord = !empty($_GET['voucher-search']) ? str_replace("\\", "", $_GET['voucher-search']) : "";
?>

<script>
    eventForSideBar(8);
    setValueHeader("Mã Giảm Giá");
</script>

<div class="voucher">
    <div class="voucher__header">
        <form class="voucher-header__search" autocomplete="off">
            <input name="voucher-search" type="text" placeholder="Từ khóa tên.." value="<?= $keyWord ?>">
            <button name="button-search" type="submit" class="voucher-header-search__link"><span class="material-symbols-outlined">search</span></button>
        </form>
        <?php
            include './connectdb.php';
            $result = mysqli_query($con, "select `VoucherID` from `voucher` order by `VoucherID` desc limit 1");
            mysqli_close($con);
            $row = mysqli_fetch_array($result);
            if($row != null) {
                $num = substr($row['VoucherID'], 3);
                $num++;
                $newVoucherId = 'VO' . str_pad($num, 3, '0', STR_PAD_LEFT);
            } else {
                $newVoucherId = 'VO001';
            }
        ?>
        <button class="voucher-header__insert" onclick="displayInsertVoucherModal('<?= $newVoucherId ?>');">Thêm mã giảm giá </button>
    </div>

    <table class="voucher__table">
        <thead>
            <th>Mã</th>
            <th>Tên mã giảm giá</th>
            <th>Đơn vị tính</th>
            <th>Giảm</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Hiển thị</th>
            <th>Sửa</th>
        </thead>
        <tbody>
            <!-- Load danh sach voucher len tu db -->
            <?php
                include './connectdb.php';
                //Khoi tao cac bien phan trang
                $item_per_page = 8;
                $current_page = !empty($_GET['page']) ? $_GET['page']: 1;
                $offset = ($current_page - 1) * $item_per_page;
                $records = mysqli_query($con, "select * from `voucher` where VoucherName regexp '{$keyWord}'");
                $num_page = ceil($records->num_rows/$item_per_page);

                $result = mysqli_query($con, "select * from `voucher` where VoucherName regexp '{$keyWord}' order by VoucherID desc limit {$item_per_page} offset {$offset}");
                
                if($result->num_rows > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr id="<?= $row['VoucherID'] ?>">
                            <td><?= $row['VoucherID'] ?></td>
                            <td><?= $row['VoucherName'] ?></td>
                            <td><?= $row['Unit'] ?></td>
                            <td><?= $row['Discount'] ?></td>
                            <td><?= $row['DateFrom'] ?></td>
                            <td><?= $row['DateTo'] ?></td>
                            <td><?= $row['Status'] == 1 ? "Hiện" : "Ẩn" ?></td>
                            <td onclick="displayEditVoucherModal('<?= $row['VoucherID'] ?>');"><span class="brand-table__edit material-symbols-outlined">edit</span></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="9" style="padding: 16px;">Không có mã giảm giá nào để hiển thị!</td>
                    </tr>
                <?php
                }
                mysqli_close($con);
            ?>
        </tbody>
    </table>

    <div class="paging">
        <?php
        if($current_page > 3) {
            ?>
                <a href="?page=1&voucher-search=<?= $keyWord ?>" class="paging__item paging__item--hover">First</a>
            <?php
        }
        for ($num = 1; $num <= $num_page; $num++) {
            if($num != $current_page) {
                if($num > $current_page - 3 && $num < $current_page + 3) {
                ?>
                    <a href="?page=<?= $num ?>&voucher-search=<?= $keyWord ?>" class="paging__item paging__item--hover"><?= $num ?></a>
                <?php
                }
            } else {
                ?>
                <a href="?page=<?= $num ?>&voucher-search=<?= $keyWord ?>" class="paging__item paging__item--active"><?= $num ?></a>
                <?php
            }
        }
        if($current_page < $num_page - 2) {
            ?>
                <a href="?page=<?= $num_page ?>&voucher-search=<?= $keyWord ?>" class="paging__item paging__item--hover">Last</a>
            <?php
        }
        ?>
    </div>

    <div class="modal-voucher">
        <form class="modal-voucher__container" action="voucher-manager.php?enableQuery" method="POST" autocomplete="off">
            <div class="modal-voucher-container__close">
                <span class="material-symbols-outlined">close</span>
            </div>
            <div class="modal-voucher-container__content">
                <p class="modal-voucher-container-content__heading"></p>

                <label for="modal-voucher-container-content-id">Mã</label>
                <input name="voucher-id" type="text" id="modal-voucher-container-content-id" readonly>

                <label for="modal-voucher-container-content-name">Tên mã giảm giá *</label>
                <input name="voucher-name" type="text" id="modal-voucher-container-content-name">
                <p style="display: none;" class="err modal-voucher-container-content-name__err"></p>

                <select name="voucher-unit" id="modal-voucher-container-content-unit">
                        <option value="Đơn vị giảm">-- Đơn vị giảm * --</option>
                        <option value="%">%</option>
                        <option value="VND">VND</option>
                </select>
                <p style="display: none;" class="err modal-voucher-container-content-unit__err">*Hãy chọn một đơn vị giảm trong combox-box này</p>
                
                <label for="modal-voucher-container-content-discount">Giá trị giảm *</label>
                <input name="voucher-discount" type="number" id="modal-voucher-container-content-discount">
                <p style="display: none;" class="err modal-voucher-container-content-discount__err"></p>

                <label for="modal-voucher-container-content-dateFrom">Ngày bắt đầu *</label>
                <input name="voucher-dateFrom" type="date" id="modal-voucher-container-content-dateFrom">
                <p style="display: none;" class="err modal-voucher-container-content-dateFrom__err"></p>

                <label for="modal-voucher-container-content-dateTo">Ngày kết thúc *</label>
                <input name="voucher-dateTo" type="date" id="modal-voucher-container-content-dateTo">
                <p style="display: none;" class="err modal-voucher-container-content-dateTo__err"></p>

                <label for="">Hiển thị</label>
                <div class="modal-voucher-container-content__status">
                    <label for="modal-voucher-container-content-status-true"><input type="radio" id="modal-voucher-container-content-status-true" name="status" value="1">Hiện</label>
                    <label for="modal-voucher-container-content-status-false"><input type="radio" id="modal-voucher-container-content-status-false" name="status" value="0">Ẩn</label>
                </div>

                <button type="submit" class="modal-voucher-container-content__btn insert" name="submit" value="insert" onclick="return checkVoucherForm('thêm');">Thêm</button>
                <button type="submit" class="modal-voucher-container-content__btn edit" name="submit" value="edit" onclick="return checkVoucherForm('sửa');">Sửa</button>
            </div>
        </form>
    </div>

    <script>
        eventCloseModal('modal-voucher', 'modal-voucher__container', 'modal-voucher-container__close');
    </script>
</div>

<?php include './container-footer.php' ?>