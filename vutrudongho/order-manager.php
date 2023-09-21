<?php
include './sidebar.php';
include './container-header.php';
//Information to search
$dateFrom = !empty($_GET['date-from']) ? $_GET['date-from'] : date('Y-m-d');
$dateTo = !empty($_GET['date-to']) ? $_GET['date-to'] : date('Y-m-d');
$province = !empty($_GET['order-province']) ? $_GET['order-province'] : "";
$district = !empty($_GET['order-district']) ? $_GET['order-district'] : "";
$ward = !empty($_GET['order-ward']) ? $_GET['order-ward'] : "";
$status = !empty($_GET['order-status']) ? $_GET['order-status'] : "";
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js" integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    eventForSideBar(4);
    setValueHeader("Đơn Hàng");
</script>

<div class="order">
    <form class="order__search" method="GET" action="order-manager.php">
        <div class="order-search__date">
            <label for="">Ngày Lọc</label>
            <input name="date-from" type="date" class="order-search__date-from">
            <span class="material-symbols-outlined">arrow_forward</span>
            <input name="date-to" type="date" class="order-search__date-to">
            <script>
                let today = new Date();
                let dd = String(today.getDate()).padStart(2, '0');
                let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                let yyyy = today.getFullYear();
                today = yyyy + '-' + mm + '-' + dd;
                let date_from = document.querySelector('.order-search__date-from');
                let date_to = document.querySelector('.order-search__date-to');
                date_from.value = today;
                date_to.value = today;
            </script>
        </div>

        <div class="order-search__address">
            <label for="">Tỉnh (Thành)</label>
            <select id="order-province" name="order-province">
            </select>

            <label for="" style="margin-right: 24px;">Quận (Huyện)</label>
            <select id="order-district" name="order-district">
                <option disable value="">-- Chọn --</option>
            </select>

            <label for="" style="margin-right: 24px;">Xã (Phường, Thị Trấn)</label>
            <select id="order-ward" name="order-ward">
                <option disable value="">-- Chọn --</option>
            </select>
        </div>

        <script>
            //API address
            var callAPI = (api) => {
                return axios.get(api)
                    .then((response) => {
                        renderData(response.data, "order-province");
                    });
            }

            var callApiDistrict = (api) => {
                return axios.get(api)
                    .then((response) => {
                        renderData(response.data.districts, "order-district");
                    });
            }
            var callApiWard = (api) => {
                return axios.get(api)
                    .then((response) => {
                        renderData(response.data.wards, "order-ward");
                    });
            }

            var renderData = (array, select) => {
                let row = '<option disable value="">-- Chọn --</option>';
                array.forEach(element => {
                    row += `<option value='${element.code}/${element.name}'>${element.name}</option>`;
                });
                document.querySelector("#" + select).innerHTML = row;
            }

            var eventForAddressCombobox = () => {
                $("#order-province").on('input', function() {
                    if ($("#order-province option:selected").val() != '') {
                        callApiDistrict(host + "p/" + $("#order-province").val().split('/')[0] + "?depth=2");
                    } else {
                        document.querySelector("#order-district").innerHTML = '<option disable value="">-- Chọn --</option>';
                        document.querySelector("#order-ward").innerHTML = '<option disable value="">-- Chọn --</option>';
                    }
                });

                $("#order-district").on('input', function() {
                    if ($("#order-district option:selected").val() != '') {
                        callApiWard(host + "d/" + $("#order-district").val().split('/')[0] + "?depth=2");
                    } else {
                        document.querySelector("#order-ward").innerHTML = '<option disable value="">-- Chọn --</option>';
                    }
                });
            }

            callAPI('https://provinces.open-api.vn/api/?depth=1');
            eventForAddressCombobox();
        </script>

        <div class="order-search__status">
            <label for="">Tình Trạng</label>

            <select name="order-status" id="order-status">
                <option value="">-- Tất cả --</option>
                <?php
                    include "./connectdb.php";
                    $result = mysqli_query($con, "select * from `orderstatus`");
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <option value="<?= $row['StatusID'] ?>_<?= $row['StatusName'] ?>"><?= $row['StatusName'] ?></option>
                        <?php
                    }
                    mysqli_close($con);
                ?>
            </select>

            <button type="submit" name="submit" class="order-search__filter" onclick="return checkOrderDateSearch();">Lọc</button>
        </div>
        <script>
            //Set up
            var queryString = window.location.search;
            var params = new URLSearchParams(queryString);
            if (params.has("submit")) {
                var dateFromUi = document.querySelector('.order-search__date-from');
                var dateToUi = document.querySelector('.order-search__date-to');
                var provinceUi = document.getElementById('order-province');
                var districtUi = document.getElementById('order-district');
                var wardUi = document.getElementById('order-ward');
                var statusUi = document.getElementById('order-status');

                dateFromUi.value = params.get("date-from");
                dateToUi.value = params.get("date-to");

                callAPI('https://provinces.open-api.vn/api/?depth=1').then(() => {
                    provinceUi.value = params.get("order-province");
                    if (provinceUi.value != '') {
                        callApiDistrict(host + "p/" + provinceUi.value.split('/')[0] + "?depth=2").then(() => {
                            districtUi.value = params.get("order-district");
                            if (districtUi.value != '') {
                                callApiWard(host + "d/" + districtUi.value.split('/')[0] + "?depth=2").then(() => {
                                    wardUi.value = params.get("order-ward");
                                });
                            }
                        });
                    }
                });

                statusUi.value = params.get("order-status");
            }
        </script>
    </form>

    <table class="order__table">
        <thead>
            <th>Mã đơn</th>
            <th>Người dùng</th>
            <th>Ngày</th>
            <th>Địa điểm</th>
            <th>Hình thức</th>
            <th>Phí giao hàng</th>
            <th>Tổng cộng</th>
            <th>Mã giảm giá</th>
            <th>Giảm giá</th>
            <th>Thành tiền</th>
            <th>Tình trạng</th>
            <th>Chi tiết</th>
        </thead>
        <tbody>
            <!-- Load danh sach orderlen tu db -->
            <?php
            include './connectdb.php';
            //Khoi tao cac bien phan trang
            $sql = "select * from `order` as o, `payment` as p where o.PaymentID = p.PaymentID and (Date(o.OderDate) between '$dateFrom' and '$dateTo')";
            if ($province != '') {
                $search_province = explode('/', $_GET['order-province'])[1];
                $sql .= " and o.Address like '%$search_province%'";
                if ($district != '') {
                    $search_district = explode('/', $_GET['order-district'])[1];
                    $sql .= " and o.Address like '%$search_district%'";
                    if ($ward != '') {
                        $search_ward = explode('/', $_GET['order-ward'])[1];
                        $sql .= " and o.Address like '%$search_ward%'";
                    }
                }
            }
            if ($status != '') {
                $search_status = explode('_', $_GET['order-status'])[0];
                $sql .= " and o.OrderStatus = '$search_status'";
            }
            $item_per_page = 8;
            $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($current_page - 1) * $item_per_page;
            $records = mysqli_query($con, $sql);
            $num_page = ceil($records->num_rows / $item_per_page);

            $result = mysqli_query($con,  $sql . " order by OrderID desc limit {$item_per_page} offset {$offset};");

            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
            ?>
                    <tr id="<?= $row['OrderID'] ?>">
                        <td><?= $row['OrderID'] ?></td>
                        <td><?= $row['UserID'] ?></td>
                        <td><?= $row['OderDate'] ?></td>
                        <td><?= str_replace("#", ", ", $row['Address']) ?></td>
                        <td paymentid="<?= $row['PaymentID'] ?>"><?= $row['PaymentName'] ?></td>
                        <td><?= number_format($row['ShippingFee']) ?></td>
                        <td><?= number_format($row['OrderTotal']) ?></td>
                        <td><?= $row['VoucherID'] ?></td>
                        <td><?= number_format($row['OrderDiscount']) ?></td>
                        <td><?= number_format($row['OrderTotal'] -  $row['OrderDiscount']) ?></td>
                        <td>
                            <select onchange="updateOrder(this);" orderId="<?= $row['OrderID'] ?>" style="outline: none; padding: 2px; border-radius: 8px; border: 1px solid #ccc; color: rgba(0, 0, 0, 0.7);">
                                <?php
                                    include "./connectdb.php";
                                    $resultt = mysqli_query($con, "select * from `orderstatus`");
                                    while ($roww = mysqli_fetch_array($resultt)) {
                                        if($row['OrderStatus'] == $roww['StatusID']) {
                                            ?>
                                                <option value="<?= $roww['StatusID'] ?>_<?= $roww['StatusName'] ?>" selected><?= $roww['StatusName'] ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?= $roww['StatusID'] ?>_<?= $roww['StatusName'] ?>"><?= $roww['StatusName'] ?></option>
                                            <?php
                                        }
                                        }
                                       
                                ?>
                            </select>
                        </td>
                        <td><span class="material-symbols-outlined" onclick="displayOrderDetailModal('<?= $row['OrderID'] ?>');">visibility</span></td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="12" style="padding: 16px;">Không có đơn hàng nào để hiển thị!</td>
                </tr>
            <?php
            }
            mysqli_close($con);
            ?>
        </tbody>
    </table>

    <div class="paging">
        <?php
        if ($current_page > 3) {
        ?>
            <a href="?page=1&date-from=<?= $dateFrom ?>&date-to=<?= $dateTo ?>&order-province=<?= $province ?>&order-district=<?= $district ?>&order-ward=<?= $ward ?>&order-status=<?= $status ?>" class="paging__item paging__item--hover">First</a>
            <?php
        }
        for ($num = 1; $num <= $num_page; $num++) {
            if ($num != $current_page) {
                if ($num > $current_page - 3 && $num < $current_page + 3) {
            ?>
                    <a href="?page=<?= $num ?>&date-from=<?= $dateFrom ?>&date-to=<?= $dateTo ?>&order-province=<?= $province ?>&order-district=<?= $district ?>&order-ward=<?= $ward ?>&order-status=<?= $status ?>" class="paging__item paging__item--hover"><?= $num ?></a>
                <?php
                }
            } else {
                ?>
                <a href="?page=<?= $num ?>&date-from=<?= $dateFrom ?>&date-to=<?= $dateTo ?>&order-province=<?= $province ?>&order-district=<?= $district ?>&order-ward=<?= $ward ?>&order-status=<?= $status ?>" class="paging__item paging__item--active"><?= $num ?></a>
            <?php
            }
        }
        if ($current_page < $num_page - 2) {
            ?>
            <a href="?page=<?= $num_page ?>&date-from=<?= $dateFrom ?>&date-to=<?= $dateTo ?>&order-province=<?= $province ?>&order-district=<?= $district ?>&order-ward=<?= $ward ?>&order-status=<?= $status ?>" class="paging__item paging__item--hover">Last</a>
        <?php
        }
        ?>
    </div>

    <div class="modal-order">
        <div class="modal-order__container" autocomplete="off">
            <div class="modal-order-container__close">
                <span class="material-symbols-outlined">close</span>
            </div>
            <div class="modal-order-container__content">
                <p class="modal-order-container-content__heading">Chi Tiết Đơn Hàng</p>

                <div class="modal-order-container-content__info">
                    <div class="modal-order-container-content-info__left">
                        <div>
                            <p class="modal-order-container-content-info__inid">Mã đơn hàng</p>
                            <input class="modal-order-container-content-info__inid-re" readonly style="background-color: #e0dfdf; outline: none;">
                        </div>

                        <div>
                            <p class="modal-order-container-content-info__user">Người dùng</p>
                            <input class="modal-order-container-content-info__user-re" readonly style="background-color: #e0dfdf; outline: none;">
                        </div>

                        <div>
                            <p class="modal-order-container-content-info__date">Ngày đặt</p>
                            <input class="modal-order-container-content-info__date-re" readonly style="background-color: #e0dfdf; outline: none;">
                        </div>
                    </div>

                    <div class="modal-order-container-content-info__right">
                        <div>
                            <p class="modal-order-container-content-info__payment">Hình thức</p>
                            <input class="modal-order-container-content-info__payment-re" readonly style="background-color: #e0dfdf; outline: none;">
                        </div>

                        <div>
                            <p class="modal-order-container-content-info__state">Tình trạng</p>
                            <input class="modal-order-container-content-info__state-re" readonly style="background-color: #e0dfdf; outline: none;">
                        </div>

                        <div>
                            <p class="modal-order-container-content-info__address">Địa chỉ</p>
                            <input class="modal-order-container-content-info__address-re" readonly style="background-color: #e0dfdf; outline: none;">
                        </div>
                    </div>
                </div>

                <div class="modal-order-container-content__table-wrapper">
                    <table class="modal-order-container-content__table">
                        <thead>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Tổng (VND)</th>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="modal-order-container-content__total-container">
                    <div>
                        <p class="modal-order-container-content__total">Tổng đơn</p>
                        <p class="modal-order-container-content__total-re">0 VND</p>
                    </div>

                    <div>
                        <p class="modal-order-container-content__fee">Phí giao hàng</p>
                        <p class="modal-order-container-content__fee-re">0 VND</p>
                    </div>

                    <div>
                        <p class="modal-order-container-content__voucher">Mã giảm giá</p>
                        <p class="modal-order-container-content__voucher-re">0 VND</p>
                    </div>

                    <div>
                        <p class="modal-order-container-content__discount">Tổng giảm</p>
                        <p class="modal-order-container-content__discount-re">0 VND</p>
                    </div>

                    <div>
                        <p class="modal-order-container-content__payment">Thành tiền</p>
                        <p class="modal-order-container-content__payment-re">0 VND</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        eventCloseModal('modal-order', 'modal-order__container', 'modal-order-container__close');
    </script>
</div>

<?php include './container-footer.php' ?>