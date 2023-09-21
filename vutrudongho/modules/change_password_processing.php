<!--Start php xu ly sua thong tin-->
<?php
require_once('../lib_session.php');
?>
<?php
if (isset($_REQUEST['btnSubmitSaveNewPass'])) {
    $userID = $_SESSION['current_userID'];
    $oldPass = $_REQUEST['currentPassword'];
    $newPass = $_REQUEST['passWord'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vutrudongho";
    //khai báo biến lưu lỗi
    $errorOldPass = "";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    if ($oldPass != $_SESSION['current_password']) {
        $errorOldPass = "Mật khẩu hiện tại chưa đúng. Vui lòng thử lại!";
        session_start();
        $_SESSION['errorOldPass'] = $errorOldPass;
        header("Location: ../../change_pass.php?errorOldPass=" . urlencode($errorOldPass));
        exit();
    }
    elseif($oldPass == $newPass){
        $errorOldPass = "Hãy thử lại. Mật khẩu mới giống mật khẩu cũ!";
        session_start();
        $_SESSION['errorOldPass'] = $errorOldPass;
        header("Location: ../../change_pass.php?errorOldPass=" . urlencode($errorOldPass));
        exit();
    }
    else {
        $sql = sprintf("UPDATE `user` SET `Password` = '%s' WHERE `user`.`UserID` = '%s'", $newPass, $userID);
        if ($conn->query($sql) === TRUE) {
            //echo "The record editted successfully";
            $sqlReview = sprintf("SELECT * FROM `user` WHERE `UserID`='$userID'");
            $result = mysqli_query($conn, $sqlReview);
            $row = mysqli_fetch_assoc($result);
            $newPassWord = $row['Password'];
            $_SESSION['current_password'] = $newPassWord;
            //
		    session_start();
            $_SESSION['changePassWordSuccess'] = true;
		    //
            header("Location: ../../logout.php?isAdmin=1");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    mysqli_close($conn);
} ?>

<!--End php xu ly sua thong tin-->