<?php
require_once('../lib_session.php');

$user = $_REQUEST['userName'];
$pass = $_REQUEST['passWord'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vutrudongho";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$sql = sprintf("SELECT * FROM user WHERE NumberPhone='%s'", $user);
$sqlMail = sprintf("SELECT * FROM user WHERE Email='%s'", $user);

$result = mysqli_query($conn, $sql);
$resultMail = mysqli_query($conn, $sqlMail);

//khai báo biến lưu lỗi
$errorLogin = "";
$loginSuccess = "";
if (mysqli_num_rows($result) == 1 || mysqli_num_rows($resultMail) == 1 ) {
	if(mysqli_num_rows($result) == 1){
		$row = mysqli_fetch_assoc($result);
	}
	if(mysqli_num_rows($resultMail) == 1){
		$row = mysqli_fetch_assoc($resultMail);
	}
	$userID = $row['UserID'];
	$fullName = $row['FullName'];
	$numberPhone = $row['NumberPhone'];
	$email = $row['Email'];
	$passwordUser = $row['Password'];
	$houseRoadAddress = $row['HouseRoadAddress'];
	$ward = $row['Ward'];
	$district = $row['District'];
	$province = $row['Province'];
	$status = $row['Status'];
	if ($row['Password'] == $pass) {
		// dang nhap thanh cong
		//echo 'Dang nhap thanh cong';
		if($row['Status'] == 1){
		$_SESSION['current_username'] = $user;
		$_SESSION['isAdmin'] = true;
		$_SESSION['current_userID'] = $userID;
		$_SESSION['current_fullName'] = $fullName;
		$_SESSION['current_numberPhone'] = $numberPhone;
		$_SESSION['current_email'] = $email;
		$_SESSION['current_password'] = $passwordUser;
		$_SESSION['current_houseRoadAddress'] = $houseRoadAddress;
		$_SESSION['current_ward'] = $ward;
		$_SESSION['current_district'] = $district;
		$_SESSION['current_province'] = $province;
		$_SESSION['current_status'] = $status;

		//
		session_start();
        $_SESSION['loginSuccess'] = true;
		//
		header('location: ../../index.php');
	}
		//nếu status = 0 tức là tk bị khóa
		else{
			$errorLogin = "Tài khoản của bạn bị khóa!";
			session_start();
			$_SESSION['errorLogin'] = $errorLogin;
			header("Location: ../../login.php?errorLogin=" . urlencode($errorLogin));
			exit();
		}
	} else {
		//echo 'Sai password';
		$errorLogin = "Thông tin tài khoản chưa chính xác!";
		session_start();
		$_SESSION['errorLogin'] = $errorLogin;
		header("Location: ../../login.php?errorLogin=" . urlencode($errorLogin));
		exit();
	}
} else {
	//echo ('Ko ton tai user ' . $user);
	$errorLogin = "Thông tin tài khoản chưa chính xác!";
		session_start();
		$_SESSION['errorLogin'] = $errorLogin;
		header("Location: ../../login.php?errorLogin=" . urlencode($errorLogin));
		exit();
}

mysqli_close($conn);
?>