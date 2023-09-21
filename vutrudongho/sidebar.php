<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vutrudongho Admin Page</title>
    <link rel="stylesheet" href="./assets/css/admin-common.css">
    <link rel="stylesheet" href="./assets/css/sidebar.css">
    <link rel="stylesheet" href="./assets/css/container-common.css">
    <link rel="stylesheet" href="./assets/css/container-header.css">
    <link rel="stylesheet" href="./assets/css/container-product.css">
    <link rel="stylesheet" href="./assets/css/brand-manager.css">
    <link rel="stylesheet" href="./assets/css/supplier-manager.css">
    <link rel="stylesheet" href="./assets/css/voucher-manager.css">
    <link rel="stylesheet" href="./assets/css/user-manager.css">
    <link rel="stylesheet" href="./assets/css/inventory-receiving-voucher.css">
    <link rel="stylesheet" href="./assets/css/order-manager.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script type="text/javascript" src="./assets/js/admin-js.js"></script>
</head>

<body>
    <div class="app">
        <div class="sidebar">
            <div class="sidebar__logo">
                <div class="sidebar-logo__img">

                </div>
                <p class="sidebar-logo__name">VUTRUDONGHO</p>
            </div>
            <ul class="sidebar__nav">
                <li class="sidebar-nav__item">
                    <a href="statistic.php" class="sidebar-nav-item__link"><span class="sidebar-nav-item__icon material-symbols-outlined">signal_cellular_alt</span>Thống Kê<span></a>
                </li>
                <li class="sidebar-nav__item">
                    <a href="sale.php" class="sidebar-nav-item__link"><span class="sidebar-nav-item__icon material-symbols-outlined">auto_graph</span>Doanh Thu<span></a>
                </li>
                <li class="sidebar-nav__item">
                    <a href="brand-manager.php" class="sidebar-nav-item__link"><span class="sidebar-nav-item__icon material-symbols-outlined">category</span>Thương Hiệu<span></a>
                </li>
                <li class="sidebar-nav__item">
                    <a href="product-manage.php" class="sidebar-nav-item__link"><span class="sidebar-nav-item__icon material-symbols-outlined">watch</span>Đồng Hồ<span></a>
                </li>
                <li class="sidebar-nav__item">
                    <a href="order-manager.php" class="sidebar-nav-item__link"><span class="sidebar-nav-item__icon material-symbols-outlined">receipt</span>Đơn Hàng<span></a>
                </li>
                <li class="sidebar-nav__item">
                    <a href="inventory-receiving-voucher-manager.php" class="sidebar-nav-item__link"><span class="sidebar-nav-item__icon material-symbols-outlined">receipt_long</span>Phiếu Nhập<span></a>
                </li>
                <li class="sidebar-nav__item">
                    <a href="user-manager.php" class="sidebar-nav-item__link"><span class="sidebar-nav-item__icon material-symbols-outlined">account_circle</span>Người Dùng<span></a>
                </li>
                <li class="sidebar-nav__item">
                    <a href="supplier-manager.php" class="sidebar-nav-item__link"><span class="sidebar-nav-item__icon material-symbols-outlined">forklift</span>Nhà Cung Cấp<span></a>
                </li>
                <li class="sidebar-nav__item">
                    <a href="voucher-manager.php" class="sidebar-nav-item__link"><span class="sidebar-nav-item__icon material-symbols-outlined">bookmark</span>Mã Giảm Giá<span></a>
                </li>
                <li class="sidebar-nav__item">
                    <a href="admin-logout.php" class="sidebar-nav-item__link" onclick="return confirmLogout();"><span class="sidebar-nav-item__icon material-symbols-outlined">power_settings_new</span>Đăng Xuất<span></a>
                </li>
            </ul>
        </div>