<?php
    //Them
    if(isset($_GET['enableQuery'])  && isset($_POST['submit']) && $_POST['submit'] == 'insert') {
        include "./connectdb.php";
        //Get brandId from brandName
        $result = mysqli_query($con, "select BrandID from `brand` where BrandName = '{$_POST['brand']}'");
        $row = mysqli_fetch_array($result);
        //Tao cac attr cua mot san pham
        $brandId = $row['BrandID'];
        $productId = $_POST['product-id'];
        $productName = trim($_POST['product-name']);
        $pathImg = $_FILES['product-img']['name'];
        $model = $_POST['model'] == "Khác" ? trim($_POST['orther-model-input']): $_POST['model'];
        $color = $_POST['color'] == "Khác" ? trim($_POST['orther-color-input']): $_POST['color'];
        $gender = $_POST['gender'];
        $importPprice = trim($_POST['import-price']);
        $priceToSell = trim($_POST['price-to-sell']);
        $discount = trim($_POST['discount']) == "" ? 0: trim($_POST['discount']);
        $desc = trim($_POST['desc']);
        $status = trim($_POST['product-status']);

        //Them vao db
        $result1 = mysqli_query($con, "insert into `product` (`ProductID`, `BrandID`, `ProductName`, `PriceToSell`, `ImportPrice`, `Discount`, `Model`, `Color`, `Gender`, `Description`, `ProductImg`, `Status`, `CanDel`) values ('{$productId}', '{$brandId}', '{$productName}', {$priceToSell}, {$importPprice}, {$discount}, '{$model}', '{$color}', '{$gender}', '{$desc}', '{$pathImg}', {$status}, 1)");

        //Cap nhat ton kho
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = date('Y-m-d H:i:s');
        $result2 = mysqli_query($con, "insert into `product_quantity` (`ProductID`, `Date`, `Quantity`) values ('{$productId}', '{$now}', 0);");

        mysqli_close($con);
        if($result1 && $result2) {
            //Di chuyen anh den thu muc productImg
            //upload file
            $target_dir = "assets/img/productImg/";
            $target_file = $target_dir . basename($pathImg);
            move_uploaded_file($_FILES["product-img"]["tmp_name"], $target_file);
            echo "<script>
                alert('Thêm đồng hồ mới có mã {$productId} thành công!');
                window.location.href = 'product-manage.php';
            </script>";
        }
    }

    //Sua
    if(isset($_GET['enableQuery'])  && isset($_POST['submit']) && $_POST['submit'] == 'edit') {
        include "./connectdb.php";
        //Get brandId from brandName
        $result = mysqli_query($con, "select BrandID from `brand` where BrandName = '{$_POST['brand']}'");
        $row = mysqli_fetch_array($result);
        //Tao cac attr cua mot san pham
        $brandId = $row['BrandID'];
        $productId = $_POST['product-id'];
        $productName = trim($_POST['product-name']);
        $pathImg = $_FILES['product-img']['name'];
        $model = $_POST['model'] == "Khác" ? trim($_POST['orther-model-input']): $_POST['model'];
        $color = $_POST['color'] == "Khác" ? trim($_POST['orther-color-input']): $_POST['color'];
        $gender = $_POST['gender'];
        $importPprice = trim($_POST['import-price']);
        $priceToSell = trim($_POST['price-to-sell']);
        $discount = trim($_POST['discount']) == "" ? 0: trim($_POST['discount']);
        $desc = trim($_POST['desc']);
        $status = trim($_POST['product-status']);

        if($pathImg == '') {
            $sql = "update `product` 
                    set `BrandID` = '{$brandId}', `ProductName` = '{$productName}', `PriceToSell` = {$priceToSell}, `ImportPrice` = {$importPprice}, `Discount` = {$discount}, `Model` = '{$model}', `Color` = '{$color}', `Gender` = '{$gender}', `Description` = '{$desc}', `Status` = {$status} 
                    where `product`.`ProductID` = '{$productId}';";
        } else {
            $sql = "update `product` 
                    set `BrandID` = '{$brandId}', `ProductName` = '{$productName}', `PriceToSell` = {$priceToSell}, `ImportPrice` = {$importPprice}, `Discount` = {$discount}, `Model` = '{$model}', `Color` = '{$color}', `Gender` = '{$gender}', `Description` = '{$desc}',`ProductImg` = '{$pathImg}' , `Status` = {$status} 
                    where `product`.`ProductID` = '{$productId}';";
        }

        //Update to db
        $result = mysqli_query($con, $sql);
        mysqli_close($con);
        if($result) {
            if($pathImg != '') {
                //Di chuyen anh den thu muc productImg
                //upload file
                $target_dir = "assets/img/productImg/";
                $target_file = $target_dir . basename($pathImg);
                move_uploaded_file($_FILES["product-img"]["tmp_name"], $target_file);
            }
            echo "<script>
                alert('Sửa đồng hồ có mã {$productId} thành công!');
                window.location.href = 'product-manage.php';
            </script>";
        }
     }

    //Xoa
    if(isset($_GET['action']) && $_GET['action'] = 'del' && !empty($_GET['product-id'])) {
        //Them vao db
        include "./connectdb.php";
        $result2 = mysqli_query($con, "delete from `product_quantity` where ProductID = '{$_GET['product-id']}'");
        $result3 = mysqli_query($con, "delete from `cart` where ProductID = '{$_GET['product-id']}'");
        $result1 = mysqli_query($con, "delete from `product` where ProductID = '{$_GET['product-id']}'");
        mysqli_close($con);
        if($result1 && $result2 && $result3) {
            echo "<script>
                alert('Xóa sản phẩm có mã {$_GET['product-id']} thành công!');
                window.location.href = 'product-manage.php';
            </script>";
        }
    }
?>

<?php
include './sidebar.php';
include './container-header.php';
$keyWord = !empty($_GET['product-search']) ? str_replace("\\", "", $_GET['product-search']) : "";
?>

<script>
    eventForSideBar(3);
    setValueHeader("Đồng Hồ");
</script>
<div class="container__product">
    <div class="container-product__header">
        <form class="container-product-header__search" autocomplete="off">
            <input name="product-search" type="text" placeholder="Tên, thương hiệu, màu, kiểu máy, giới tính.." value="<?= $keyWord ?>">
            <button name="button-search" type="submit" class="container-product-header-search__link"><span class="material-symbols-outlined">search</span></button>
        </form>
        <?php
            include './connectdb.php';
            $result = mysqli_query($con, "select `ProductID` from `product` order by `ProductID` desc limit 1");
            mysqli_close($con);
            $row = mysqli_fetch_array($result);
            if($row != null) {
                $num = substr($row['ProductID'], 6);
                $num++;
                $newProductId = 'PR' . str_pad($num, 6, '0', STR_PAD_LEFT);
            } else {
                $newProductId = 'PR000001';
            }
        ?>
        <button class="container-product-header__insert" onclick="displayInsertModal('<?= $newProductId ?>');">Thêm đồng hồ</button>
    </div>

    <table class="container-product__table">
        <thead>
            <th>Thương hiệu</th>
            <th>Mã</th>
            <th>Tên đồng hồ</th>
            <th>Ảnh</th>
            <th>Kiểu máy</th>
            <th>Màu sắc</th>
            <th>Giới tính</th>
            <th>Giá nhập</th>
            <th>Giá bán</th>
            <th>Giảm giá (%)</th>
            <th>Mô tả</th>
            <th>Trạng Thái</th>
            <th>Cập nhật</th>
            <th>Xóa</th>
        </thead>
        <tbody>
            <!-- Load danh sach dong ho len tu csdl -->
            <?php
            include './connectdb.php';
            // Khoi tao cac bien phan trang
            // Câu lệnh !empty($_GET['ten_bien']) trong PHP kiểm tra xem biến có tồn tại trong mảng $_GET hay không và có giá trị khác rỗng hay không. Nếu biến tồn tại và có giá trị, thì biểu thức !empty() trả về giá trị true, nếu không nó trả về giá trị false.
            $item_per_page = 8;
            $current_page = !empty($_GET['page']) ? $_GET['page']: 1;
            $offset = ($current_page - 1) * $item_per_page;
            $records = mysqli_query($con, "select b.BrandName, p.ProductID, p.ProductName, p.ProductImg, p.Model, p.Color, p.Gender, p.ImportPrice, p.PriceToSell, p.Discount, p.Description, p.Status, p.CanDel
                                           from `brand` as b, `product` as p
                                           where b.BrandID = p.BrandID and (p.ProductName regexp '{$keyWord}' or b.BrandName = '{$keyWord}' or p.Model = '{$keyWord}' or p.Color = '{$keyWord}' or p.Gender = '{$keyWord}')");
            $num_page = ceil($records->num_rows / $item_per_page);

            $result = mysqli_query($con, "select b.BrandName, p.ProductID, p.ProductName, p.ProductImg, p.Model, p.Color, p.Gender, p.ImportPrice, p.PriceToSell, p.Discount, p.Description, p.Status, p.CanDel
                                          from `brand` as b, `product` as p
                                          where b.BrandID = p.BrandID and (p.ProductName regexp '{$keyWord}' or b.BrandName = '{$keyWord}' or p.Model = '{$keyWord}' or p.Color = '{$keyWord}' or p.Gender = '{$keyWord}') order by p.ProductID desc limit {$item_per_page} offset {$offset}");

            if($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr id="<?= $row['ProductID'] ?>">
                            <td><?= $row['BrandName'] ?></td>
                            <td><?= $row['ProductID'] ?></td>
                            <td><?= $row['ProductName'] ?></td>
                            <td path = "<?= $row['ProductImg'] ?>"><img src="./assets/img/productImg/<?= $row['ProductImg'] ?>" alt="Ảnh đồng hồ"></td>
                            <td><?= $row['Model'] ?></td>
                            <td><?= $row['Color'] ?></td>
                            <td><?= $row['Gender'] ?></td>
                            <td><?= number_format($row['ImportPrice']) ?></td>
                            <td><?= number_format($row['PriceToSell']) ?></td>
                            <td><?= $row['Discount'] ?></td>
                            <td><?= $row['Description'] ?></td>
                            <td><?= $row['Status'] == 1 ? "Kinh doanh" : "Ngừng kinh doanh"?></td>
                            <?php
                                $checkBrand = mysqli_query($con, "select `status` from `brand` where `BrandName` = '{$row['BrandName']}';");
                                $checkBrandResult = mysqli_fetch_array($checkBrand);
                                if($checkBrandResult['status'] == 1) {
                                    ?>
                                        <td><span class="container-product-table__edit-icon material-symbols-outlined" onclick = "displayEditModal('<?= $row['ProductID'] ?>');">edit</span></td>
                                    <?php
                                } else {
                                    ?>
                                        <td title="Không thể sửa do thương hiệu của sản phẩm này đã ngừng hoạt động">
                                            <span class="container-product-table__un-del-icon material-symbols-outlined">block</span>
                                        </td>
                                    <?php
                                }
                            ?>
                            
                            <?php 
                                if($row['CanDel'] == 1) { 
                                ?>
                                    <td><span class="container-product-table__del-icon material-symbols-outlined" onclick="displayPopupDel('<?= $row['ProductID'] ?>');">delete</span></td>
                                <?php 
                                } else {
                                ?>
                                    <td title="Không thể xóa">
                                        <span class="container-product-table__un-del-icon material-symbols-outlined">block</span>
                                    </td>
                                <?php
                                }
                            ?>           
                        </tr>
                    <?php
                }
            } else {
                ?>
                    <tr>
                        <td colspan="12" style="padding: 8px 0;">Không có đồng hồ nào để hiển thị!</td>
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
            $first_page = 1;
            ?>
                <a href="?page=<?= $first_page ?>&product-search=<?= $keyWord ?>" class="paging__item paging__item--hover">First</a>
            <?php
        }
        for ($num = 1; $num <= $num_page; $num++) {
            if($num != $current_page) {
                if($num > $current_page - 3 && $num < $current_page + 3) {
                ?>
                    <a href="?page=<?= $num ?>&product-search=<?= $keyWord ?>" class="paging__item paging__item--hover"><?= $num ?></a>
                <?php
                }
            } else {
                ?>
                <a href="?page=<?= $num ?>&product-search=<?= $keyWord ?>" class="paging__item paging__item--active"><?= $num ?></a>
                <?php
            }
        }
        if($current_page < $num_page - 2) {
            $last_page = $num_page;
            ?>
                <a href="?page=<?= $last_page?>&product-search=<?= $keyWord ?>" class="paging__item paging__item--hover">Last</a>
            <?php
        }
        ?>
    </div>

    <div class="modal">
        <form autocomplete="off" class="modal__product" method="POST" action="product-manage.php?enableQuery" enctype="multipart/form-data">
            <div class="modal-product__container">
                <p class="modal-product-container__heading">Thêm Sản Phẩm Mới</p>

                <div class="modal-product-container__content">
                    <select name="brand" id="modal-product-container-content__brand">
                        <option value="Thương hiệu">-- Thương hiệu * --</option>
                        <?php
                            include "./connectdb.php";
                            $result = mysqli_query($con, "select * from `brand` where status = 1");
                            while($row = mysqli_fetch_array($result)) {
                                ?>
                                    <option value="<?= $row['BrandName'] ?>"><?=$row['BrandName']?></option>
                                <?php
                            }
                            mysqli_close($con);
                        ?>
                    </select>
                    <p style="display: none;" class="err modal-product-container-content__err-brand"></p>

                    <label class="modal-product-container-content_label" for="modal-product-container-content__product-id">Mã sản phẩm</label>

                    <input style="outline: none;" class="modal-product-container-content_input" name="product-id" id="modal-product-container-content__product-id" type="text" readonly>

                    <label class="modal-product-container-content_label" for="modal-product-container-content__product-name">Tên sản phẩm *</label>
                    <input class="modal-product-container-content_input" name="product-name" id="modal-product-container-content__product-name" type="text">
                    <p style="display: none;" class="err modal-product-container-content__err-name"></p>

                    <label class="modal-product-container-content_label mb-8" id="modal-product-container-content__product-img-text">Hình Ảnh *</label>
                    <div class="modal-product-container__img text-center">
                        <label for="modal-product-container-content__product-img">
                            <img src="./assets/img/admin/place-holder-product/image-placeholder.jpg" alt="Ảnh sản phẩm" id="modal-product-container-content__product-img-src">
                        </label>
                        <input type="file" name="product-img" id="modal-product-container-content__product-img" style="display: none;">
                    </div>
                    <p style="display: none;" class="err modal-product-container-content__err-img"></p>

                    <script>
                        var productImg = document.getElementById('modal-product-container-content__product-img');
                        productImg.addEventListener('change', function() {
                            const files = event.target.files;
                            const file = files[0];
                            console.log(URL.createObjectURL(file));
                            let inputImg = document.querySelector('.modal-product-container__img img');
                            inputImg.src = URL.createObjectURL(file);
                        });
                    </script>
                    
                    <select name="model" id="modal-product-container-content__model">
                        <option value="Kiểu máy">-- Kiểu máy * --</option>
                        <?php
                            include "./connectdb.php";
                            $result = mysqli_query($con, "select distinct model from `product`");
                            while($row = mysqli_fetch_array($result)) {
                                ?>
                                    <option value="<?= $row['model'] ?>"><?=$row['model']?></option>
                                <?php
                            }
                            mysqli_close($con);
                        ?>
                        <option value="Khác">Khác</option>
                    </select>
                    <p style="display: none;" class="err modal-product-container-content__err-model"></p>

                    <div class="orther-input-container" id="orther-product-model-input" style="display: none;">
                        <label for="orther-product-model-value">Nhập kiểu máy khác *:</label>
                        <input type="text" id="orther-product-model-value" name="orther-model-input">
                    </div>
                    <p style="display: none;" class="err modal-product-container-content__err-other-model"></p>

                    <script>
                        displayOtherInput('modal-product-container-content__model', 'orther-product-model-input');
                    </script>

                    <select name="color" id="modal-product-container-content__color">
                        <option value="Màu sắc">-- Màu sắc * --</option>
                        <?php
                            include "./connectdb.php";
                            $result = mysqli_query($con, "select distinct color from `product`");
                            while($row = mysqli_fetch_array($result)) {
                                ?>
                                    <option value="<?= $row['color'] ?>"><?=$row['color']?></option>
                                <?php
                            }
                            mysqli_close($con);
                        ?>
                        <option value="Khác">Khác</option>
                    </select>
                    <p style="display: none;" class="err modal-product-container-content__err-color"></p>
                    
                    <div class="orther-input-container" id="orther-product-color-input" style="display: none;">
                        <label for="orther-product-color-value">Nhập màu khác *:</label>
                        <input type="text" id="orther-product-color-value" name="orther-color-input">
                    </div>
                    <p style="display: none;" class="err modal-product-container-content__err-other-color"></p>

                    <script>
                        displayOtherInput('modal-product-container-content__color', 'orther-product-color-input');
                    </script>

                    <select name="gender" id="modal-product-container-content__gender">
                        <option value="Giới tính">-- Giới tính * --</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Unisex">Unisex</option>
                    </select>
                    <p style="display: none;" class="err modal-product-container-content__err-gender"></p>

                    <label class="modal-product-container-content_label" for="modal-product-container-content__import-price">Giá nhập *</label>
                    <input class="modal-product-container-content_input" type="number" min="0" name="import-price" id="modal-product-container-content__import-price" onkeydown="eventKeyDownForInputNumber(event);">
                    <p style="display: none;" class="err modal-product-container-content__err-import-price"></p>

                    <label class="modal-product-container-content_label" for="modal-product-container-content__price-to-sell">Giá bán *</label>
                    <input class="modal-product-container-content_input" type="number" min="0" name="price-to-sell" id="modal-product-container-content__price-to-sell" onkeydown="eventKeyDownForInputNumber(event);">
                    <p style="display: none;" class="err modal-product-container-content__err-price-to-sell"></p>

                    <label class="modal-product-container-content_label" for="modal-product-container-content__discount">Giảm giá (%)</label>
                    <input class="modal-product-container-content_input" type="number" name="discount" id="modal-product-container-content__discount" onkeydown="eventKeyDownForInputNumber(event);">
                    <p style="display: none;" class="err modal-product-container-content__err-discount"></p>

                    <label class="modal-product-container-content_label"  for="modal-product-container-content__desc">Mô tả *</label>
                    <textarea class="modal-product-container-content_input" name="desc" cols="68" rows="10" id="modal-product-container-content__desc" name="desc"></textarea>
                    <p style="display: none;" class="err modal-product-container-content__err-desc"></p>

                    <label class="modal-product-container-content_label mb-8" for="">Trạng thái kinh doanh</label>
                    <div class="modal-product-container-content__status">
                        <label for="product-status-true"><input checked type="radio" id="product-status-true"  name="product-status" value="1">Kinh doanh</label>
                        <label for="product-status-false"><input type="radio" id="product-status-false"  name="product-status" value="0">Ngừng kinh doanh</label>
                    </div>
                </div>

                <button onclick="return checkValidateProductForm('thêm');" name="submit" type="submit" class="modal-product-container__btn insert" value="insert" style="display: none;">Thêm</button>
                <button onclick="return checkValidateProductForm('sửa');" name="submit" type="submit" class="modal-product-container__btn edit" value="edit" style="display: none;">Sửa</button>

                <div class="modal-product-container__close">
                    <span class="material-symbols-outlined">close</span>
                </div>
            </div>
        </form>
    </div>

    <script>
        eventCloseModal('modal', 'modal__product', 'modal-product-container__close');
    </script>
</div>
<?php include './container-footer.php' ?>