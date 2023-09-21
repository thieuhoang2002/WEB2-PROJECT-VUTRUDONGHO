<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/admin-common.css">
    <link rel="stylesheet" href="./assets/css/admin-login.css">
    <title>Admin Login</title>
</head>

<?php
    //Dang nhap
    if(isset($_GET['enableQuery']) && isset($_POST['submit'])) {
        session_start();
        include './connectdb.php';

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $success = 0;

        $result = mysqli_query($con, "select * from `admin`");
        mysqli_close($con);

        while($row = mysqli_fetch_array($result)) {
            if($row['Email'] == $username && $row['Password'] == $password) {
                $_SESSION['AdminID'] = $row['AdminID'];
                $_SESSION['FullName'] = $row['FullName'];
                $_SESSION['Email'] = $row['Email'];
                $_SESSION['Password'] = $row['Password'];

                $success = 1;
                break;
            }
        }

        if($success == 1) {
            header("Location: brand-manager.php");
        } else {
            echo "<script>
                    alert('Email hoặc mật khẩu không hợp lệ!');
                    window.location.href = 'admin-login.php';
                </script>";
        }
        
    }
?>

<body>
    <div class="wrapper">
        <div class="background">
        </div>
        <div class="container">
            <form class="login" method="POST" action="admin-login.php?enableQuery" onsubmit="return checkAdminLoginForm();">
                <p class="login__heading">Chào Mừng Bạn Đến Với Trang Quản Trị Viên!</p>

                <label for="username">Email *</label>
                <input name="username" id="username" type="text">
                <p style="display: none;" class="err username">*Email không được để trống</p>

                <label for="password">Mật khẩu *</label>
                <input name="password" id="password" type="password">
                <p style="display: none;" class="err password">*Mật khẩu không được để trống</p>
                
                <button type="submit" name="submit" class="login__btn">Đăng nhập</button>
            </form>
        </div>
    </div>
    <script>
        var checkAdminLoginForm = () => {
            valid = true;

            let username = document.getElementById('username');
            let username_err = document.querySelector('.err.username');
            let password = document.getElementById('password');
            let password_err = document.querySelector('.err.password');

            username_err.style.display = 'none';
            password_err.style.display = 'none';

            if(username.value.trim() == '') {
                username_err.style.display = 'block';
                valid = false;
            }

            if(password.value.trim() == '') {
                password_err.style.display = 'block';
                valid = false;
            }

            return valid;
        }
    </script>
</body>
</html>