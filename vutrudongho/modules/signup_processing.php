<?php
$fullName = $_REQUEST['fullName'];
$email = $_REQUEST['email'];
$numberPhone = $_REQUEST['numberPhone'];
$passWord = $_REQUEST['passWord'];
$repeatPassWord = $_REQUEST['repeatPassword'];
$tinh = $_REQUEST['tinh'];
$quanHuyen = $_REQUEST['quanHuyen'];
$phuongXa = $_REQUEST['phuongXa'];
$diaChiNha = $_REQUEST['diaChiNha'];

/* echo $fullName = $_REQUEST['fullName'];
echo $email = $_REQUEST['email'];
echo $numberPhone = $_REQUEST['numberPhone'];
echo $passWord = $_REQUEST['passWord'];
echo $repeatPassWord = $_REQUEST['repeatPassword'];
echo $tinh = $_REQUEST['tinh'];
echo $quanHuyen = $_REQUEST['quanHuyen'];
echo $phuongXa = $_REQUEST['phuongXa'];
echo $diaChiNha = $_REQUEST['diaChiNha']; */

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

$sqlPhoneNumber = "SELECT COUNT(*) as count FROM user WHERE NumberPhone = '$numberPhone'";
$resultsqlPhoneNumber = mysqli_query($conn, $sqlPhoneNumber);
$rowPhoneNumber = mysqli_fetch_assoc($resultsqlPhoneNumber);

$sqlEmail = "SELECT COUNT(*) as count FROM user WHERE Email = '$email'";
$resultsqlEmail = mysqli_query($conn, $sqlEmail);
$rowEmail = mysqli_fetch_assoc($resultsqlEmail);

//khai báo biến lưu lỗi
$error = "";
// Nếu số điện thoại đã tồn tại, hiển thị thông báo lỗi và yêu cầu người dùng nhập lại
if (($rowPhoneNumber['count'] > 0 || $rowEmail['count'] > 0) ||($rowPhoneNumber['count'] >0 && $rowEmail['count']>0) ) {
  if($rowPhoneNumber['count'] >0 && $rowEmail['count']>0){
    $error = "Số điện thoại/Email đã tồn tại trong hệ thống, vui lòng nhập lại thông tin.";
  }
  elseif($rowPhoneNumber['count'] > 0){
    $error = "Số điện thoại đã tồn tại trong hệ thống, vui lòng nhập lại thông tin.";
  }
  elseif($rowEmail['count'] > 0){
    $error = "Email đã tồn tại trong hệ thống, vui lòng nhập lại thông tin.";
  }
  session_start();
  $_SESSION['error'] = $error;
  header("Location: ../../signup.php?error=" . urlencode($error));
  exit();
} else {
  $sql2 = sprintf("SELECT COUNT(*)FROM user;");
  $result2 = mysqli_query($conn, $sql2);
  $rows2 = mysqli_fetch_assoc($result2); //1 dòng
//echo ($rows2["COUNT(*)"]);
  $countRowsUS = (int) $rows2["COUNT(*)"];
  $userID = "US000001";
  function checkQuantityUS()
  {
    global $countRowsUS;
    global $userID;
    // Tách "US" và "000001" ra
    $userIDPrefix = substr($userID, 0, 2); // "US"
    $userIDNumber = (int) substr($userID, 2); // 1

    // Tính toán mã mới cho người dùng
    $newUserIDNumber = $countRowsUS + 1;

    // Định dạng lại thành chuỗi "000002"
    $newUserIDNumberString = sprintf('%06d', $newUserIDNumber);

    // Ghép lại "US" và "000002" thành "US000002"
    $newUserID = $userIDPrefix . $newUserIDNumberString;

    // Hiển thị kết quả
    return $newUserID; // "US000002"

  }
  //var_dump(checkQuantityUS());

  $sql = sprintf("INSERT INTO `user` (`UserID`, `FullName`, `NumberPhone`, `Email`, `Password`, `HouseRoadAddress`, `Ward`, `District`, `Province`, `Status`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s',1);", checkQuantityUS(), $fullName, $numberPhone, $email, $passWord, $diaChiNha, $phuongXa, $quanHuyen, $tinh);
  if ($conn->query($sql) === TRUE) {
    		
    session_start();
    $_SESSION['signupSuccess'] = true;

    header('location: ../../login.php');

  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}


mysqli_close($conn);

?>