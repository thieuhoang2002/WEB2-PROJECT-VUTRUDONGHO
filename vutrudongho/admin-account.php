<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/admin-common.css">
    <link rel="stylesheet" href="./assets/css/admin-account.css">
    <script type="text/javascript" src="./assets/js/admin-js.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Manage Admin Account</title>
</head>
<?php session_start(); //De su dung bien $_SESSION can dat ham session_start() dau trang php ?>
<?php
    //Hieu chinh tai khoan admin
    if(isset($_GET['enableQuery']) && isset($_POST['submit'])) {
        include './connectdb.php';

        $id = $_POST['AdminID'];
        $fullname = trim($_POST['FullName']);
        $email = trim($_POST['Email']);
        $password = trim($_POST['Password']);

        $result = mysqli_query($con, "update `admin` 
                                      set `FullName` = '{$fullname}', `Email` = '{$email}', `Password` = '{$password}' 
                                      where `admin`.`AdminID` = '{$id}';");
        mysqli_close($con);

        var_dump($_POST);

        if($result) {
            $_SESSION['FullName'] = $fullname;
            $_SESSION['Email'] = $email;
            $_SESSION['Password'] = $password;
            echo "<script>
                alert('Cập nhật thông tin quản trị thành công!');
                window.location.href = 'admin-account.php';
            </script>";
        }
    }
?>
<body>
    <form class="admin-account" method="POST" action="admin-account.php?enableQuery" onsubmit="return checkValidateAdminAccountForm();" autocomplete="off">
        <a href="brand-manager.php" class="admin-account__back"><span class="material-symbols-outlined">arrow_back</span></a>
        <div class="admin-account__info">
            <div class="admin-account-info__avatar">
                <div class="admin-account-info-avatar__img"></div>
            </div>
            <div class="admin-account-info__row id">
                <label for="AdminID">Mã</label>
                <input name="AdminID" id="AdminID" type="text" readonly value="<?= $_SESSION['AdminID'] ?>">
            </div>

            <div class="admin-account-info__row name">
                <label for="FullName">Họ tên</label>
                <input name="FullName" id="FullName" type="text" value="<?= $_SESSION['FullName'] ?>">
            </div>
            <p style="display: none;" class="err admin-full-name"></p>

            <div class="admin-account-info__row email">
                <label for="Email">Email</label>
                <input name="Email" id="Email" type="text" value="<?= $_SESSION['Email'] ?>">
            </div>
            <p style="display: none;" class="err admin-email"></p>

            <div class="admin-account-info__row pass">
                <label for="Password">Mật khẩu</label>
                <input name="Password" id="Password" type="text" value="<?= $_SESSION['Password'] ?>">
            </div>
            <p style="display: none;" class="err admin-password"></p>
        </div>
        <div class="admin-account__edit">
            <button type="submit" name="submit" class="admin-account-edit__btn">Lưu thay đổi</button>
        </div>
    </form>
</body>
</html>
