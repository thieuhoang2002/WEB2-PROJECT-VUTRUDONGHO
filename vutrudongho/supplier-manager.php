<?php
    //Them
    if(isset($_GET['enableQuery'])  && isset($_POST['submit']) && $_POST['submit'] == 'insert') {
        include './connectdb.php';
        $supplier_id = $_POST['supplier-id'];
        $supplier_name = trim($_POST['supplier-name']);
        $supplier_phone = trim($_POST['supplier-phone']);
        $supplier_email = trim($_POST['supplier-email']);
        $supplier_address = trim($_POST['supplier-address']);
        $supplier_status = $_POST['status'];

        $result = mysqli_query($con, "insert into `supplier` (`SupplierID`, `Name`, `NumberPhone`, `Address`, `Email`, `Status`) values ('{$supplier_id}', '{$supplier_name}', '{$supplier_phone}', '{$supplier_address}', '{$supplier_email}', {$supplier_status});");
        mysqli_close($con);
        if($result) {
            echo "<script>
                alert('Thêm nhà cung cấp mới có mã {$supplier_id} thành công!');
                window.location.href = 'supplier-manager.php';
            </script>";
        }
    }

    //Sua
    if(isset($_GET['enableQuery'])  && isset($_POST['submit']) && $_POST['submit'] == 'edit') {
        include './connectdb.php';
        $supplier_id = $_POST['supplier-id'];
        $supplier_name = trim($_POST['supplier-name']);
        $supplier_phone = trim($_POST['supplier-phone']);
        $supplier_email = trim($_POST['supplier-email']);
        $supplier_address = trim($_POST['supplier-address']);
        $supplier_status = $_POST['status'];

        $result = mysqli_query($con, "update `supplier` 
                                      set `Name` = '{$supplier_name}', `NumberPhone` = '{$supplier_phone}', `Address` = '{$supplier_address}', `Email` = '{$supplier_email}', `Status` = {$supplier_status} 
                                      WHERE `supplier`.`SupplierID` = '{$supplier_id}';");
        mysqli_close($con);
        if($result) {
            echo "<script>
                alert('Sửa nhà cung cấp có mã {$supplier_id} thành công!');
                window.location.href = 'supplier-manager.php';
            </script>";
        }
    }
?>

<?php
include './sidebar.php';
include './container-header.php';
$keyWord = !empty($_GET['supplier-search']) ? str_replace("\\", "", $_GET['supplier-search']) : "";
?>

<script>
    eventForSideBar(7);
    setValueHeader("Nhà Cung Cấp");
</script>

<div class="supplier">
    <div class="supplier__header">
        <form class="supplier-header__search" autocomplete="off">
            <input name="supplier-search" type="text" placeholder="Tên, điện thoại,..." value="<?= $keyWord ?>">
            <button name="button-search" type="submit" class="supplier-header-search__link"><span class="material-symbols-outlined">search</span></button>
        </form>
        <?php
            include './connectdb.php';
            $result = mysqli_query($con, "select `SupplierID` from `supplier` order by `SupplierID` desc limit 1");
            mysqli_close($con);
            $row = mysqli_fetch_array($result);
            if($row != null) {
                $num = substr($row['SupplierID'], 6);
                $num++;
                $newSupplierId = 'SU' . str_pad($num, 6, '0', STR_PAD_LEFT);
            } else {
                $newSupplierId = 'SU000001';
            }
        ?>
        <button class="supplier-header__insert" onclick="displayInsertSupplierModal('<?= $newSupplierId ?>');">Thêm nhà cung cấp</button>
    </div>

    <table class="supplier__table">
        <thead>
            <th>Mã</th>
            <th>Tên nhà cung cấp</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Trạng thái</th>
            <th>Sửa</th>
        </thead>
        <tbody>
            <!-- Load danh sach supplierlen tu db -->
            <?php
                include './connectdb.php';
                //Khoi tao cac bien phan trang
                $item_per_page = 8;
                $current_page = !empty($_GET['page']) ? $_GET['page']: 1;
                $offset = ($current_page - 1) * $item_per_page;
                $records = mysqli_query($con, "select * from `supplier` where Name regexp '{$keyWord}' or NumberPhone regexp '{$keyWord}'");
                $num_page = ceil($records->num_rows/$item_per_page);

                $result = mysqli_query($con, "select * from `supplier` where Name regexp '{$keyWord}' or NumberPhone regexp '{$keyWord}' order by SupplierID desc limit {$item_per_page} offset {$offset}");
                
                if($result->num_rows > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr id="<?= $row['SupplierID'] ?>">
                            <td><?= $row['SupplierID'] ?></td>
                            <td><?= $row['Name'] ?></td>
                            <td><?= $row['NumberPhone'] ?></td>
                            <td><?= $row['Email'] ?></td>
                            <td><?= $row['Address'] ?></td>
                            <td><?= $row['Status'] == 1 ? "Hoạt động" : "Ngừng hoạt động" ?></td>
                            <td onclick="displayEditSupplierModal('<?= $row['SupplierID'] ?>');"><span class="brand-table__edit material-symbols-outlined">edit</span></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7" style="padding: 16px;">Không có nhà cung cấp nào để hiển thị!</td>
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
                <a href="?page=1&supplier-search=<?= $keyWord ?>" class="paging__item paging__item--hover">First</a>
            <?php
        }
        for ($num = 1; $num <= $num_page; $num++) {
            if($num != $current_page) {
                if($num > $current_page - 3 && $num < $current_page + 3) {
                ?>
                    <a href="?page=<?= $num ?>&supplier-search=<?= $keyWord ?>" class="paging__item paging__item--hover"><?= $num ?></a>
                <?php
                }
            } else {
                ?>
                <a href="?page=<?= $num ?>&supplier-search=<?= $keyWord ?>" class="paging__item paging__item--active"><?= $num ?></a>
                <?php
            }
        }
        if($current_page < $num_page - 2) {
            ?>
                <a href="?page=<?= $num_page ?>&supplier-search=<?= $keyWord ?>" class="paging__item paging__item--hover">Last</a>
            <?php
        }
        ?>
    </div>

    <div class="modal-supplier">
        <form class="modal-supplier__container" action="supplier-manager.php?enableQuery" method="POST" autocomplete="off">
            <div class="modal-supplier-container__close">
                <span class="material-symbols-outlined">close</span>
            </div>
            <div class="modal-supplier-container__content">
                <p class="modal-supplier-container-content__heading"></p>

                <label for="modal-supplier-container-content-id">Mã</label>
                <input name="supplier-id" type="text" id="modal-supplier-container-content-id" readonly>

                <label for="modal-supplier-container-content-name">Tên nhà cung cấp *</label>
                <input name="supplier-name" type="text" id="modal-supplier-container-content-name">
                <p style="display: none;" class="err modal-supplier-container-content-name__err"></p>

                <label for="modal-supplier-container-content-phone">Số điện thoại *</label>
                <input name="supplier-phone" type="number" id="modal-supplier-container-content-phone" onkeydown="eventKeyDownForInputNumber(event);">
                <p style="display: none;" class="err modal-supplier-container-content-phone__err"></p>

                <label for="modal-supplier-container-content-email">Email *</label>
                <input name="supplier-email" type="email" id="modal-supplier-container-content-email">
                <p style="display: none;" class="err modal-supplier-container-content-email__err"></p>

                <label for="modal-supplier-container-content-address">Địa chỉ *</label>
                <input name="supplier-address" type="text" id="modal-supplier-container-content-address">
                <p style="display: none;" class="err modal-supplier-container-content-address__err"></p>

                <label for="">Trạng thái hoạt động</label>
                <div class="modal-supplier-container-content__status">
                    <label for="modal-supplier-container-content-status-true"><input type="radio" id="modal-supplier-container-content-status-true" name="status" value="1">Hoạt động</label>
                    <label for="modal-supplier-container-content-status-false"><input type="radio" id="modal-supplier-container-content-status-false" name="status" value="0">Ngừng hoạt động</label>
                </div>

                <button type="submit" class="modal-supplier-container-content__btn insert" name="submit" value="insert" onclick="return checkSupplierForm('thêm');">Thêm</button>
                <button type="submit" class="modal-supplier-container-content__btn edit" name="submit" value="edit" onclick="return checkSupplierForm('sửa');" style="display: none;">Sửa</button>
            </div>
        </form>
    </div>
    <script>
        eventCloseModal('modal-supplier', 'modal-supplier__container', 'modal-supplier-container__close');
    </script>
</div>
<?php include './container-footer.php' ?>