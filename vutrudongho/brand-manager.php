<?php
    //checkBrandName
    function checkBrandName($brand_id, $brand_name) {
        include './connectdb.php';
        $checkName = true;
        $brands = mysqli_query($con, "select * from `brand` where BrandID != '{$brand_id}'");
        while($row = mysqli_fetch_array($brands)) {
            if(strtolower($row['BrandName']) == strtolower($brand_name)) {
                $checkName = false;
                break;
            }
        }
        mysqli_close($con);
        return $checkName;
    }

    //Them
    if(isset($_GET['enableQuery'])  && isset($_POST['submit']) && $_POST['submit'] == 'insert') {
        include './connectdb.php';
        $brand_id = $_POST['brand-id'];
        $brand_name = trim($_POST['brand-name']);
        $brand_desc = trim($_POST['brand-desc']);
        $brand_status = $_POST['status'];

        if(checkBrandName($brand_id, $brand_name)) {
            $result = mysqli_query($con, "insert into `brand` (`BrandID`, `BrandName`, `Description`, `Status`) values ('{$brand_id}', '{$brand_name}', '{$brand_desc}', {$brand_status});");
            mysqli_close($con);
            if($result) {
                echo "<script>
                    alert('Thêm thương hiệu mới có mã {$brand_id} thành công!');
                    window.location.href = 'brand-manager.php';
                </script>";
            }
        } else {
            echo "<script>
                    alert('Thêm thất bại! Do tên thương hiệu {$brand_name} đã tồn tại!');
                    window.location.href = 'brand-manager.php';
                 </script>";
        }
    }

    //Sua
    if(isset($_GET['enableQuery'])  && isset($_POST['submit']) && $_POST['submit'] == 'edit') {
        include './connectdb.php';
        $checkName = true;
        $brand_id = $_POST['brand-id'];
        $brand_name = trim($_POST['brand-name']);
        $brand_desc = trim($_POST['brand-desc']);
        $brand_status = $_POST['status'];

        if(checkBrandName($brand_id, $brand_name)) {
            $result = mysqli_query($con, "update `brand` 
                                      set `BrandName` = '{$brand_name}', `Description` = '{$brand_desc}', `Status` = {$brand_status}
                                      where `BrandID` = '{$brand_id}';");
            if($brand_status == 0) {
                mysqli_query($con, "update `product` set `Status` = 0 where `BrandID` = '{$brand_id}';");
            }
            mysqli_close($con);
            if($result) {
                echo "<script>
                    alert('Sửa thương hiệu có mã {$brand_id} thành công!');
                    window.location.href = 'brand-manager.php';
                </script>";
            }
        } else {
            echo "<script>
                    alert('Sửa thất bại! Do tên thương hiệu {$brand_name} đã bị trùng với một thương hiệu khác!');
                    window.location.href = 'brand-manager.php';
                 </script>";
        }
    }

?>

<?php
include './sidebar.php';
include './container-header.php';
$keyWord = !empty($_GET['brand-search']) ? str_replace("\\", "", $_GET['brand-search']) : "";
?>

<script>
    eventForSideBar(2);
    setValueHeader("Thương Hiệu");
</script>
<div class="brand">
    <div class="brand__header">
        <form class="brand-header__search" autocomplete="off">
            <input name="brand-search" type="text" placeholder="Từ khóa tên.." value="<?= $keyWord ?>">
            <button name="button-search" type="submit" class="brand-header-search__link"><span class="material-symbols-outlined">search</span></button>
        </form>
        <?php
            include './connectdb.php';
            $result = mysqli_query($con, "select `BrandID` from `brand` order by `BrandID` desc limit 1");
            mysqli_close($con);
            $row = mysqli_fetch_array($result);
            if($row != null) {
                $num = substr($row['BrandID'], 3);
                $num++;
                $newBrandId = 'BR' . str_pad($num, 3, '0', STR_PAD_LEFT);
            } else {
                $newBrandId = 'BR001';
            }
        ?>
        <button class="brand-header__insert" onclick="displayInsertBrandModal('<?= $newBrandId ?>');">Thêm thương hiệu</button>
    </div>

    <table class="brand__table">
        <thead>
            <th>Mã</th>
            <th>Tên thương hiệu</th>
            <th>Mô tả</th>
            <th>Trạng thái</th>
            <th>Cập nhật</th>
        </thead>
        <tbody>
            <!-- Load danh sach brand len tu db -->
            <?php
                include './connectdb.php';
                //Khoi tao cac bien phan trang
                $item_per_page = 8;
                $current_page = !empty($_GET['page']) ? $_GET['page']: 1;
                $offset = ($current_page - 1) * $item_per_page;
                $records = mysqli_query($con, "select * from `brand` where BrandName regexp '{$keyWord}'");
                $num_page = ceil($records->num_rows/$item_per_page);

                $result = mysqli_query($con, "select * from `brand` where BrandName regexp '{$keyWord}' order by BrandID desc limit {$item_per_page} offset {$offset}");
                
                if($result->num_rows > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr id="<?= $row['BrandID'] ?>">
                            <td><?= $row['BrandID'] ?></td>
                            <td><?= $row['BrandName'] ?></td>
                            <td><?= $row['Description'] ?></td>
                            <td><?= $row['Status'] == 1 ? "Hoạt động" : "Ngừng hoạt động" ?></td>
                            <td onclick="displayEditBrandModal('<?= $row['BrandID'] ?>');"><span class="brand-table__edit material-symbols-outlined">edit</span></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5" style="padding: 16px;">Không có thương hiệu nào để hiển thị!</td>
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
                <a href="?page=1&brand-search=<?= $keyWord ?>" class="paging__item paging__item--hover">First</a>
            <?php
        }
        for ($num = 1; $num <= $num_page; $num++) {
            if($num != $current_page) {
                if($num > $current_page - 3 && $num < $current_page + 3) {
                ?>
                    <a href="?page=<?= $num ?>&brand-search=<?= $keyWord ?>" class="paging__item paging__item--hover"><?= $num ?></a>
                <?php
                }
            } else {
                ?>
                <a href="?page=<?= $num ?>&brand-search=<?= $keyWord ?>" class="paging__item paging__item--active"><?= $num ?></a>
                <?php
            }
        }
        if($current_page < $num_page - 2) {
            ?>
                <a href="?page=<?= $num_page ?>&brand-search=<?= $keyWord ?>" class="paging__item paging__item--hover">Last</a>
            <?php
        }
        ?>
    </div>

    <div class="modal-brand">
        <form class="modal-brand__container" action="brand-manager.php?enableQuery" method="POST" autocomplete="off">
            <div class="modal-brand-container__close">
                <span class="material-symbols-outlined">close</span>
            </div>
            <div class="modal-brand-container__content">
                <p class="modal-brand-container-content__heading">Thêm Thương Hiệu Mới</p>

                <label for="modal-brand-container-content-id">Mã</label>
                <input name="brand-id" type="text" id="modal-brand-container-content-id" readonly>

                <label for="modal-brand-container-content-name">Tên thương hiệu *</label>
                <input name="brand-name" type="text" id="modal-brand-container-content-name">
                <p style="display: none;" class="err modal-brand-container-content-name__err"></p>

                <label for="modal-brand-container-content-desc">Mô tả *</label>
                <textarea name="brand-desc" name="" id="modal-brand-container-content-desc" cols="" rows="10"></textarea>
                <p style="display: none;" class="err modal-brand-container-content-desc__err"></p>

                <label for="">Trạng thái hoạt động</label>
                <div class="modal-brand-container-content__status">
                    <label for="modal-brand-container-content-status-true"><input type="radio" id="modal-brand-container-content-status-true" name="status" value="1">Hoạt động</label>
                    <label for="modal-brand-container-content-status-false"><input type="radio" id="modal-brand-container-content-status-false" name="status" value="0">Ngừng hoạt động</label>
                </div>

                <button type="submit" class="modal-brand-container-content__btn insert" name="submit" value="insert" onclick="return checkBrandForm('thêm');">Thêm</button>
                <button type="submit" class="modal-brand-container-content__btn edit" name="submit" value="edit" onclick="return checkBrandForm('sửa');">Sửa</button>
            </div>
        </form>
    </div>
</div>
<script>
    eventCloseModal('modal-brand', 'modal-brand__container', 'modal-brand-container__close');
</script>
<?php include './container-footer.php' ?>