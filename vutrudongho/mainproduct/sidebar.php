<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Trang sản phẩm</title>
    <script>
        $(document).ready(function() {

            var maxPrice;

            // Lấy dữ liệu từ file get-data.php
            $.ajax({
                url: `./mainproduct/get-max-product-price.php`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // var html = '';
                    $.each(data, function(index, item) {
                        // html += '<p>' + item.maxProductPrice + '</p>';
                        maxPrice = item.maxProductPrice;
                    });
                    // $('#result').html(html);
                    // console.log(maxPrice);

                    $("#slider-range").slider({
                        range: true,
                        min: 0,
                        max: maxPrice,
                        values: [0, maxPrice],
                        slide: function(event, ui) {
                            $("#amount").val("đ" + addPlus(ui.values[0]).toString() + " - đ" + addPlus(ui.values[1]));
                            $('.price_from').val(ui.values[0]);
                            $('.price_to').val(ui.values[1]);
                        }
                    });
                    $("#amount").val("đ" + addPlus($("#slider-range").slider("values", 0)) +
                        " - đ" + addPlus($("#slider-range").slider("values", 1)));
                },
                error: function() {
                    alert('Lỗi khi lấy dữ liệu');
                }
            });
        });

        function addPlus(nStr) {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2');
            }
            return x1 + x2;
        }

        function showsearch() {
            document.getElementById('searchmodel').style.display = 'block';
        }

        function closesearch() {
            document.getElementById('searchmodel').style.display = 'none';

        }
    </script>
</head>
<?php
include 'connect.php';
$brand = mysqli_query($conn, "select * from brand where Status = 1");
$color = mysqli_query($conn, "select DISTINCT Color from product where Status=1 ORDER BY Color ASC");
$range_price = mysqli_query($conn, "select * from brand where Status = 1");
$gender = mysqli_query($conn, "select DISTINCT Gender from product where Status=1 ORDER BY Gender ASC");
$model = mysqli_query($conn, "select DISTINCT Model from product where Status=1");
// $max_price = mysqli_query($conn, "SELECT MAX(PriceToSell) FROM product where Status = 1");
// $row_max = mysqli_fetch_array($max_price);
// $a = intval($row_max[0]);
// var_dump((int)$a);
// $min_price = mysqli_query($conn, "SELECT MIN(PriceToSell) FROM product where status = 1");
// $row_min = mysqli_fetch_array($min_price);
// $b = intval($row_min[0]);
?>

<body>
    <div class="side-bar">

        <ul class="list-price">
            <form method="GET">
                <p class="range">
                    <label for="amount" class="label-price-1">Khoảng giá:</label>
                    <input type="text" id="amount" readonly style="border:0; color:#E50914; font-weight:bold;font-size:15px;">
                </p>
                <div id="slider-range">
                    <input type="hidden" class="price_from" name="from" value="<?php if (isset($_GET['from'])) {
                                                                                    echo $_GET['from'];
                                                                                } else {
                                                                                    echo "0";
                                                                                } ?>">
                    <input type="hidden" class="price_to" name="to" value="<?php if (isset($_GET['to'])) {
                                                                                echo $_GET['to'];
                                                                            } else {
                                                                                echo "30000000";
                                                                            } ?>">
                    <input type="submit" class="sort" value="Lọc">
                </div>
            </form>
        </ul>
        <ul class="list-brand">
            <div class="dropdown">
                <button class="dropbtn">Thương hiệu</button>
                <div class="dropdown-content">
                    <?php foreach ($brand as $key => $value) : ?>
                        <a href="?brand=<?php echo $value['BrandName'] ?>&idBrand=<?php echo $value['BrandID'] ?>"><?php echo $value['BrandName'] ?></a>
                    <?php endforeach ?>
                </div>
            </div>
        </ul>
        <ul class="list-color">
            <div class="dropdown">
                <button class="dropbtn">Màu sắc</button>
                <div class="dropdown-content">
                    <?php foreach ($color as $key => $value) : ?>
                        <a href="?color=<?php echo $value['Color'] ?>"><?php echo $value['Color'] ?></a>
                    <?php endforeach ?>
                </div>
            </div>
        </ul>
        <ul class="list-gender">
            <div class="dropdown">
                <button class="dropbtn">Giới tính</button>
                <div class="dropdown-content">
                    <?php foreach ($gender as $key => $value) : ?>
                        <a href="?gender=<?php echo $value['Gender'] ?>"><?php echo $value['Gender'] ?></a>
                    <?php endforeach ?>
                </div>
            </div>
        </ul>
        <ul class="list-model">
            <div class="dropdown">
                <button class="dropbtn">Bộ máy</button>
                <div class="dropdown-content">
                    <?php foreach ($model as $key => $value) : ?>
                        <a href="?model=<?php echo $value['Model'] ?>"><?php echo $value['Model'] ?></a>
                    <?php endforeach ?>
                </div>
            </div>
        </ul>
        <ul class="search-advanced">
            <div class="dropdown">
                <button class="dropbtn" onclick="showsearch()">Tìm kiếm nâng cao</button>
                <div id="searchmodel" class="model2" style="display:none;">
                    <div id="changesearch" style="text-align: center;">
                        <button class="close" onclick="closesearch()">+</button>
                        <form class="form-search-advanced" action="" method="GET">
                            <div class="form-component">
                                <div class="field-search">
                                    <input type="text" placeholder="Tìm kiếm theo tên..." name="keyword" class="textfield">
                                </div>
                            </div>
                            <div class="form-component">
                                <label class="name-component">Thương hiệu</label>
                                <select name="brandname" class="brand-select">
                                    <option value="">-----Thương hiệu-----</option>
                                    <?php foreach ($brand as $key => $value) : ?>
                                        <option value="<?= $value['BrandName'] ?>"><?php echo $value['BrandName'] ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-component">
                                <!-- <form method="GET"> -->
                                <!-- <input type="checkbox" name="is-price-search" value="true"> -->
                                <label for="amount-2" class="label-price">Khoảng giá</label>
                                <input type="text" id="amount-2" readonly style="border:0; color:#E50914; font-weight:bold; font-size:18px; margin-top:5px;">
                                <div id="slider-range-2">
                                    <input type="hidden" class="price_from" name="from-advanced" value="<?php if (isset($_GET['from-advanced'])) {
                                                                                                            echo $_GET['from-advanced'];
                                                                                                        } else {
                                                                                                            echo 0;
                                                                                                        } ?>">
                                    <input type="hidden" class="price_to" name="to-advanced" value="<?php if (isset($_GET['to-advanced'])) {
                                                                                                        echo $_GET['to-advanced'];
                                                                                                    } else {
                                                                                                        echo 300000000;
                                                                                                    } ?>">
                                </div>
                                <!-- </form> -->
                            </div>
                            <div class="form-component">
                                <input type="submit" class="xac-nhan" name="nang-cao" value="Tìm kiếm">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </ul>
    </div>
</body>
<script>
   $(document).ready(function() {

var maxPrice;

// Lấy dữ liệu từ file get-data.php
$.ajax({
    url: './mainproduct/get-max-product-price.php',
    type: 'GET',
    dataType: 'json',
    success: function(data) {
        // var html = '';
        $.each(data, function(index, item) {
            // html += '<p>' + item.maxProductPrice + '</p>';
            maxPrice = item.maxProductPrice;
        });
        // $('#result').html(html);
        // console.log(maxPrice);

        $("#slider-range-2").slider({
            range: true,
            min: 0,
            max: maxPrice,
            values: [0, maxPrice],
            slide: function(event, ui) {
                $("#amount-2").val("đ" + addPlus(ui.values[0]).toString() + " - đ" + addPlus(ui.values[1]));
                $('.price_from').val(ui.values[0]);
                $('.price_to').val(ui.values[1]);
            }
        });
        $("#amount-2").val("đ" + addPlus($("#slider-range-2").slider("values", 0)) +
            " - đ" + addPlus($("#slider-range-2").slider("values", 1)));
    },
    error: function() {
        alert('Lỗi khi lấy dữ liệu');
    }
});
});

    function addPlus(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        }
        return x1 + x2;
    }
</script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


</html>