<div class="container">
            <div class="container__header">
                <p class="container-header__title"></p>
                <div class="container-header__admin-account">
                    <div class="container-header-admin-account__avt"></div>
                    <div class="container-header-admin-account__info">
                        <div class="container-header-admin-account-info__name">
                            <p class="container-header-admin-account-info-name__detail"><?= $_SESSION['FullName'] ?></p>
                            <span class="material-symbols-outlined">expand_more</span>
                        </div>
                        <p class="container-header-admin-account-info__pos">Quản trị viên</p>
                        <ul class="container-header-admin-account-info__subnav">
                            <li><a href="admin-account.php">
                                    <span class="material-symbols-outlined">account_circle</span>
                                    <span>Cập nhật tài khoản</span>
                                </a></li>
                            <li><a href="admin-logout.php" onclick="return confirmLogout();">
                                    <span class="material-symbols-outlined">logout</span>
                                    <span>Đăng xuất</span>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
