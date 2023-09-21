<?php
include './sidebar.php';
include './container-header.php';
$keyWord = !empty($_GET['inventory-receiving-voucher-search']) ? str_replace("\\", "", $_GET['inventory-receiving-voucher-search']) : "";
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    eventForSideBar(5);
    setValueHeader("Phiếu Nhập");
</script>

<div class="inventory">
    <div class="inventory__header">
        <form class="inventory-header__search" autocomplete="off">
            <input name="inventory-receiving-voucher-search" type="text" placeholder="Mã phiếu nhập.." value="<?= $keyWord ?>">
            <button name="button-search" type="submit" class="inventory-header-search__link"><span class="material-symbols-outlined">search</span></button>
        </form>
        <?php
            include './connectdb.php';
            $result = mysqli_query($con, "select `InID` from `inventoryreceivingvoucher` order by `InID` desc limit 1");
            mysqli_close($con);
            $row = mysqli_fetch_array($result);
            if($row != null) {
                $num = substr($row['InID'], 8);
                $num++;
                $newInId = 'IN' . str_pad($num, 8, '0', STR_PAD_LEFT);
            } else {
                $newInId = 'IN00000001';
            }
        ?>
        <a class="inventory-header__insert" onclick="displayInsertInventoryReceivingVoucherModal('<?= $newInId ?>');">Thêm phiếu nhập</a>
    </div>

    <table class="inventory__table">
        <thead>
            <th>Mã phiếu nhập</th>
            <th>Mã nhà cung cấp</th>
            <th>Tên nhà cung cấp</th>
            <th>Ngày nhập</th>
            <th>Tổng cộng (VND)</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </thead>
        <tbody>
            <!-- Load danh sach invemtory len tu db -->
            <?php
                include './connectdb.php';
                //Khoi tao cac bien phan trang
                $item_per_page = 8;
                $current_page = !empty($_GET['page']) ? $_GET['page']: 1;
                $offset = ($current_page - 1) * $item_per_page;
                $records = mysqli_query($con, "select i.InID, s.SupplierID, s.Name, i.Date, i.Total from `inventoryreceivingvoucher` as i, `supplier` as s where i.SupplierID = s.SupplierID and i.InID regexp '{$keyWord}'");
                $num_page = ceil($records->num_rows/$item_per_page);

                $result = mysqli_query($con, "select i.InID, s.SupplierID, s.Name, i.Date, i.Total from `inventoryreceivingvoucher` as i, `supplier` as s where i.SupplierID = s.SupplierID and i.InID regexp '{$keyWord}' order by InID desc limit {$item_per_page} offset {$offset}");
                
                if($result->num_rows > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr id="<?= $row['InID'] ?>">
                            <td><?= $row['InID'] ?></td>
                            <td><?= $row['SupplierID'] ?></td>
                            <td><?= $row['Name'] ?></td>
                            <td><?= $row['Date'] ?></td>
                            <td><?= number_format($row['Total']) ?></td>
                            <td><span class="edit material-symbols-outlined" onclick="displayUpdateInventoryReceivingVoucherModal('<?= $row['InID'] ?>', '<?= $row['SupplierID'] ?>_<?= $row['Name'] ?>', '<?= $row['Date'] ?>');">edit</span></td>
                            <td><span class="del material-symbols-outlined" onclick="deleteReceivingVoucher('<?= $row['InID'] ?>');">delete</span></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7" style="padding: 16px;">Không có phiếu nhập nào để hiển thị!</td>
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
                <a href="?page=1&inventory-receiving-voucher-search=<?= $keyWord ?>" class="paging__item paging__item--hover">First</a>
            <?php
        }
        for ($num = 1; $num <= $num_page; $num++) {
            if($num != $current_page) {
                if($num > $current_page - 3 && $num < $current_page + 3) {
                ?>
                    <a href="?page=<?= $num ?>&inventory-receiving-voucher-search=<?= $keyWord ?>" class="paging__item paging__item--hover"><?= $num ?></a>
                <?php
                }
            } else {
                ?>
                <a href="?page=<?= $num ?>&inventory-receiving-voucher-search=<?= $keyWord ?>" class="paging__item paging__item--active"><?= $num ?></a>
                <?php
            }
        }
        if($current_page < $num_page - 2) {
            ?>
                <a href="?page=<?= $num_page ?>&inventory-receiving-voucher-search=<?= $keyWord ?>" class="paging__item paging__item--hover">Last</a>
            <?php
        }
        ?>
    </div>

    <div class="modal-inventory">
        <div class="modal-inventory__container">
            <div class="modal-inventory-container__close">
                <span class="material-symbols-outlined">close</span>
            </div>
            <div class="modal-inventory-container__content">
                <p class="modal-inventory-container-content__heading"></p>

                <div class="modal-inventory-container-content__flex">
                    <div class="modal-inventory-container-content__info">
                        <div>
                            <p class="modal-inventory-container-content-info__inid">Mã phiếu nhập</p>
                            <input class="modal-inventory-container-content-info__inid-re" readonly style="background-color: #e0dfdf; outline: none;">
                        </div>
                        <div>
                            <p class="modal-inventory-container-content-info__supplier">Nhà cung cấp</p>
                            <select name="" id="" class="modal-inventory-container-content-info__supplier-re">
                                <option value="">-- Chọn nhà cung cấp * --</option>
                                <?php
                                    include './connectdb.php';
                                    $result = mysqli_query($con, "select SupplierID, Name from `supplier` where Status = 1");
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $info = $row['SupplierID'] . "_" . $row['Name'];
                                        ?>
                                            <option value="<?= $info ?>"><?= $info ?></option>
                                        <?php
                                    }
                                    mysqli_close($con);
                                ?>
                            </select>
                        </div>
                        <div>
                            <p class="modal-inventory-container-content-info__date">Ngày nhập</p>
                            <input type="date" class="modal-inventory-container-content-info__date-re">
                        </div>
                    </div>

                    <div class="modal-inventory-container-content__search">
                        <input type="text" class="modal-inventory-container-content__search-input" placeholder="Tên sản phẩm..">
                        <ul class="modal-inventory-container-content__search-result">
                        </ul>
                        <script>
                            $(document).ready(function() {
                                $('.modal-inventory-container-content__search-input').on('input', function() {
                                    // Lấy giá trị từ input
                                    var inputValue = $(this).val();

                                    // Nếu giá trị rỗng thì không gọi Ajax
                                    if (inputValue.trim() === '') {
                                        $('.modal-inventory-container-content__search-result').hide();
                                    } else {
                                        $('.modal-inventory-container-content__search-result').show();
                                        $.ajax({
                                            url: 'get-product-search-for-inventory.php',
                                            type: 'GET',
                                            dataType: 'json',
                                            data: {
                                                keyWord: inputValue
                                            },
                                            success: function(data) {
                                                // Hiển thị dữ liệu lấy được
                                                var html = '';
                                                $.each(data, function(index, item) {
                                                    html += `<li class="modal-inventory-container-content-search-result__item" onclick="insertReceivingDetailUi('${item.ProductID}', '${item.ProductName}', '${Number(item.ImportPrice).toLocaleString('en-US')}');">
                                                                <div class="modal-inventory-container-content-search-result-item__img">
                                                                    <img src="./assets/img/productImg/${item.ProductImg}" alt="ảnh đồng hồ">
                                                                </div>
                                                                <div class="modal-inventory-container-content-search-result-item__info">
                                                                    <p>${item.ProductName}</p>
                                                                    <p>Giá nhập: ${Number(item.ImportPrice).toLocaleString('en-US')} VND</p>
                                                                </div>
                                                            </li>`;
                                                });
                                                $('.modal-inventory-container-content__search-result').html(html);
                                            },
                                            error: function() {
                                                alert('Lỗi khi lấy dữ liệu');
                                            }
                                        });
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
                <div class="modal-inventory-container-content__table-wrapper">
                    <table class="modal-inventory-container-content__table">
                        <thead>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá nhập (VND)</th>
                            <th>Số lượng</th>
                            <th>Tổng (VND)</th>
                            <th>Xóa</th>
                        </thead>
    
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="modal-inventory-container-content__total-container">
                    <!-- Thay doi khi mot hang moi duoc them vao -->
                    <!-- Thay doi khi cot totalDetail change -->
                    <p class="modal-inventory-container-content__total">Tổng cộng</p>
                    <p class="modal-inventory-container-content__total-re"></p>
                </div>

                <button class="modal-inventory-container-content__btn insert" onclick="insertReceivingVoucher();">Thêm</button>
                <button class="modal-inventory-container-content__btn edit" style="display: none;" onclick="updateReceivingVoucher();">Sửa</button>
            </div>
        </div>
    </div>

    <script>
        eventCloseModal('modal-inventory', 'modal-inventory__container', 'modal-inventory-container__close');
    </script>
</div>

<?php include './container-footer.php' ?>