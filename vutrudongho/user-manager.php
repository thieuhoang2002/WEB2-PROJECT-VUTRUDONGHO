<?php
    //Them
    if(isset($_GET['enableQuery'])  && isset($_POST['submit']) && $_POST['submit'] == 'insert') {
        include './connectdb.php';
        $user_id = $_POST['user-id'];
        $user_name = trim($_POST['user-name']);
        $user_phone = trim($_POST['user-phone']);
        $user_email= trim($_POST['user-email']);
        $user_password = trim($_POST['user-password']);
        $user_province = explode('/', $_POST['user-province'])[1];
        $user_district = explode('/', $_POST['user-district'])[1];
        $user_ward = explode('/', $_POST['user-ward'])[1];
        $user_houseAndRoadAddress = trim($_POST['user-houseAndRoadAddress']);
        $user_status = $_POST['status'];

        $emails = mysqli_query($con, "select Email from `user`");
        while ($row = mysqli_fetch_assoc($emails)) {
            if($row['Email'] == $user_email) {
                echo "<script>
                    alert('Thêm người dùng không thành công do email đã tồn tại trong hệ thống! Hãy thử một email khác!');
                    window.location.href = 'user-manager.php';
                </script>";
                return;
            }
        }

        $phones = mysqli_query($con, "select NumberPhone from `user`");
        while ($row = mysqli_fetch_assoc($phones)) {
            if($row['NumberPhone'] == $user_phone) {
                echo "<script>
                    alert('Thêm người dùng không thành công do số điện thoại đã tồn tại trong hệ thống! Hãy thử một số điện thoại khác!');
                    window.location.href = 'user-manager.php';
                </script>";
                return;
            }
        }

        $result = mysqli_query($con, "insert into `user` (`UserID`, `FullName`, `NumberPhone`, `Email`, `Password`, `HouseRoadAddress`, `Ward`, `District`, `Province`, `Status`) values ('{$user_id}', '{$user_name}', '{$user_phone}', '{$user_email}', '{$user_password}', '{$user_houseAndRoadAddress}', '{$user_ward}', '{$user_district}', '{$user_province}', {$user_status});");
        mysqli_close($con);
        if($result) {
            echo "<script>
                alert('Thêm người dùng mới có mã {$user_id} thành công!');
                window.location.href = 'user-manager.php';
            </script>";
        }
    }

    //Sua
    if(isset($_GET['enableQuery'])  && isset($_POST['submit']) && $_POST['submit'] == 'edit') {
        include './connectdb.php';
        $user_id = $_POST['user-id'];
        $user_name = trim($_POST['user-name']);
        $user_phone = trim($_POST['user-phone']);
        $user_email= trim($_POST['user-email']);
        $user_password = trim($_POST['user-password']);
        $user_province = explode('/', $_POST['user-province'])[1];
        $user_district = explode('/', $_POST['user-district'])[1];
        $user_ward = explode('/', $_POST['user-ward'])[1];
        $user_houseAndRoadAddress = trim($_POST['user-houseAndRoadAddress']);
        $user_status = $_POST['status'];

        $emails = mysqli_query($con, "select UserID, Email from `user`");
        while ($row = mysqli_fetch_assoc($emails)) {
            if($row['UserID'] != $user_id && $row['Email'] == $user_email) {
                echo "<script>
                    alert('Thêm người dùng không thành công do email đã tồn tại trong hệ thống! Hãy thử một email khác!');
                    window.location.href = 'user-manager.php';
                </script>";
                return;
            }
        }

        $phones = mysqli_query($con, "select UserID, NumberPhone from `user`");
        while ($row = mysqli_fetch_assoc($phones)) {
            if($row['UserID'] != $user_id && $row['NumberPhone'] == $user_phone) {
                echo "<script>
                    alert('Sửa người dùng không thành công do số điện thoại đã tồn tại trong hệ thống! Hãy thử một số điện thoại khác!');
                    window.location.href = 'user-manager.php';
                </script>";
                return;
            }
        }

        $result = mysqli_query($con, "update `user` 
                                      set `FullName` = '{$user_name}', `NumberPhone` = '{$user_phone}', `Email` = '{$user_email}', `Password` = '{$user_password}', `HouseRoadAddress` = '{$user_houseAndRoadAddress}', `Ward` = '{$user_ward}', `District` = '{$user_district}', `Province` = '{$user_province}', `Status` = {$user_status} 
                                      where `user`.`UserID` = '{$user_id}';");
        mysqli_close($con);
        if($result) {
            echo "<script>
                alert('Sửa người dùng có mã {$user_id} thành công!');
                window.location.href = 'user-manager.php';
            </script>";
        }
    }
?>

<?php
include './sidebar.php';
include './container-header.php';
$keyWord = !empty($_GET['user-search']) ? str_replace("\\", "", $_GET['user-search']) : "";
?>

<script>
    eventForSideBar(6);
    setValueHeader("Người Dùng");
</script>

<div class="user">
    <div class="user__header">
        <form class="user-header__search" autocomplete="off">
            <input name="user-search" type="text" placeholder="Từ khóa tên, số điện thoại, email,..." value="<?= $keyWord ?>">
            <button name="button-search" type="submit" class="user-header-search__link"><span class="material-symbols-outlined">search</span></button>
        </form>
        <?php
            include './connectdb.php';
            $result = mysqli_query($con, "select `UserID` from `user` order by `UserID` desc limit 1");
            mysqli_close($con);
            $row = mysqli_fetch_array($result);
            if($row != null) {
                $num = substr($row['UserID'], 6);
                $num++;
                $newUserIdId = 'US' . str_pad($num, 6, '0', STR_PAD_LEFT);
            } else {
                $newUserIdId = 'US000001';
            }
        ?>
        <button class="user-header__insert" onclick="displayInsertUserModal('<?= $newUserIdId ?>');">Thêm người dùng</button>
    </div>

    <table class="user__table">
        <thead>
            <th>Mã</th>
            <th>Tên người dùng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Mật khẩu</th>
            <th>Địa chỉ nhà, tên đường</th>
            <th>Phường (xã, thị trấn)</th>
            <th>Quận (huyện)</th>
            <th>Thành phố (tỉnh)</th>
            <th>Trạng thái</th>
            <th>Sửa</th>
        </thead>
        <tbody>
            <!-- Load danh sach user len tu db -->
            <?php
                include './connectdb.php';
                //Khoi tao cac bien phan trang
                $item_per_page = 8;
                $current_page = !empty($_GET['page']) ? $_GET['page']: 1;
                $offset = ($current_page - 1) * $item_per_page;
                $records = mysqli_query($con, "select * from `user` where FullName regexp '{$keyWord}' or NumberPhone regexp '{$keyWord}' or Email regexp '{$keyWord}'");
                $num_page = ceil($records->num_rows/$item_per_page);

                $result = mysqli_query($con, "select * from `user` where FullName regexp '{$keyWord}' or NumberPhone regexp '{$keyWord}' or Email regexp '{$keyWord}' order by UserID desc limit {$item_per_page} offset {$offset}");
                
                if($result->num_rows > 0) {
                    while($row = mysqli_fetch_array($result)) {
                        ?>
                        <tr id="<?= $row['UserID'] ?>">
                            <td><?= $row['UserID'] ?></td>
                            <td><?= $row['FullName'] ?></td>
                            <td><?= $row['NumberPhone'] ?></td>
                            <td><?= $row['Email'] ?></td>
                            <td><?= $row['Password'] ?></td>
                            <td><?= $row['HouseRoadAddress'] ?></td>
                            <td><?= $row['Ward'] ?></td>
                            <td><?= $row['District'] ?></td>
                            <td><?= $row['Province'] ?></td>
                            <td><?= $row['Status'] == 1 ? "Đang hoạt động" : "Đang khóa" ?></td>
                            <td onclick="displayEditUserModal('<?= $row['UserID'] ?>');"><span class="brand-table__edit material-symbols-outlined">edit</span></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="11" style="padding: 16px;">Không có người dùng nào để hiển thị!</td>
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
                <a href="?page=1&user-search=<?= $keyWord ?>" class="paging__item paging__item--hover">First</a>
            <?php
        }
        for ($num = 1; $num <= $num_page; $num++) {
            if($num != $current_page) {
                if($num > $current_page - 3 && $num < $current_page + 3) {
                ?>
                    <a href="?page=<?= $num ?>&user-search=<?= $keyWord ?>" class="paging__item paging__item--hover"><?= $num ?></a>
                <?php
                }
            } else {
                ?>
                <a href="?page=<?= $num ?>&user-search=<?= $keyWord ?>" class="paging__item paging__item--active"><?= $num ?></a>
                <?php
            }
        }
        if($current_page < $num_page - 2) {
            ?>
                <a href="?page=<?= $num_page ?>&user-search=<?= $keyWord ?>" class="paging__item paging__item--hover">Last</a>
            <?php
        }
        ?>
    </div>

    <div class="modal-user">
        <form class="modal-user__container" action="user-manager.php?enableQuery" method="POST" autocomplete="off">
            <div class="modal-user-container__close">
                <span class="material-symbols-outlined">close</span>
            </div>
            <div class="modal-user-container__content">
                <p class="modal-user-container-content__heading">Thêm Người Dùng Mới</p>

                <label for="modal-user-container-content-id">Mã</label>
                <input name="user-id" type="text" id="modal-user-container-content-id" readonly>

                <label for="modal-user-container-content-name">Tên người dùng *</label>
                <input name="user-name" type="text" id="modal-user-container-content-name">
                <p style="display: none;" class="err modal-user-container-content-name__err"></p>

                <label for="modal-user-container-content-phone">Số Điện Thoại *</label>
                <input name="user-phone" type="number" id="modal-user-container-content-phone" onkeydown="eventKeyDownForInputNumber(event);">
                <p style="display: none;" class="err modal-user-container-content-phone__err">*Trường này không được để trống</p>

                <label for="modal-user-container-content-email">Email *</label>
                <input name="user-email" type="text" id="modal-user-container-content-email">
                <p style="display: none;" class="err modal-user-container-content-email__err">*Trường này không được để trống</p>

                <label for="modal-user-container-content-password">Mật khẩu *</label>
                <input name="user-password" type="text" id="modal-user-container-content-password">
                <p style="display: none;" class="err modal-user-container-content-password__err">*Trường này không được để trống</p>

                <label for="modal-user-container-content-province">Tỉnh (thành phố) *</label>
                <select name="user-province" id="modal-user-container-content-province">
                </select>
                <p style="display: none;" class="err modal-user-container-content-province__err"></p>

                <label for="modal-user-container-content-district">Quận (huyện) *</label>
                <select name="user-district" id="modal-user-container-content-district">
                </select>
                <p style="display: none;" class="err modal-user-container-content-district__err"></p>

                <label for="modal-user-container-content-ward">Phường (xã, thị trấn) *</label>
                <select name="user-ward" id="modal-user-container-content-ward">
                </select>
                <p style="display: none;" class="err modal-user-container-content-ward__err"></p>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script>
                    eventForAddressCombobox();
                    callAPI('https://provinces.open-api.vn/api/?depth=1');
                </script>

                <label for="modal-user-container-content-houseAndRoadAddress">Địa chỉ nhà, tên đường *</label>
                <input name="user-houseAndRoadAddress" type="text" id="modal-user-container-content-houseAndRoadAddress">
                <p style="display: none;" class="err modal-user-container-content-houseAndRoadAddress__err">*Trường này không được để trống</p>

                <label for="">Tình trạng</label>
                <div class="modal-user-container-content__status">
                    <label for="modal-user-container-content-status-true"><input type="radio" id="modal-user-container-content-status-true" name="status" value="1">Hoạt động</label>
                    <label for="modal-user-container-content-status-false"><input type="radio" id="modal-user-container-content-status-false" name="status" value="0">Khóa</label>
                </div>

                <button type="submit" class="modal-user-container-content__btn insert" name="submit" value="insert" onclick="return checkUserForm('thêm');">Thêm</button>
                <button type="submit" class="modal-user-container-content__btn edit" name="submit" value="edit" onclick="return checkUserForm('sửa');">Sửa</button>
            </div>
        </form>
    </div>

    <script>
        eventCloseModal('modal-user', 'modal-user__container', 'modal-user-container__close');
    </script>
</div>

<?php include './container-footer.php' ?>