<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/change_pass.css">
  <link rel="stylesheet" href="assets/css/header.css">
  <link rel="stylesheet" href="assets/css/footer.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap&amp;_cacheOverride=1679484892371"
    data-tag="font">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
    data-tag="font">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body>
  <!--Start: Header-->
  <div id="bar-header">
    <?php
    include("components/header.php");
    ?>
  </div>

  <!--End: Header-->
  <div id="body" style=" height: fit-content;margin-top: 50px;">
    <div class="containerlogin-containerlogin">
    <div style="width: 50%;height: 100%;display:flex;flex-direction:column;align-items:center;justify-content:center;">
      <img src="assets/img/hoangImg/logo/logo_tron.png" alt="z416347160358228d6ce2e5edbcf0ee0b207d1a4329bed23772"
        class="containerlogin-z416347160358228d6ce2e5edbcf0ee0b207d1a4329bed2" onclick="">
      <span class="containerlogin-text24 TitleMedium">
        <span>VŨ TRỤ ĐỒNG HỒ </span>
      </span>
      <span class="containerlogin-text26">
        <span>
          <span>Nền tảng thương mại điện tử được yêu thích tại</span>
          <br>
          <span>Thành phố Hồ Chí Minh</span>
        </span>
      </span>
      </div>
      <form style="width: 50%;height: 100%;display:flex;flex-direction:column;align-items:center;justify-content:center;" name="frmdoipass" id="" action=".//modules/change_password_processing.php" method="POST" onsubmit="return kiemTra();">

        <div class="containerlogin-group1">

          <div class="containerlogin-text LabelMedium" style="display: flex;flex-direction: row; align-items: flex-start;width: 100%;">
            <span class="TitleSmallpass" style="">ĐỔI MẬT KHẨU</span>
            <!-- <p style="font-size: 12px;line-height: 18.391px; padding-left: 12px;color: red;font-weight: bold;">*Số điện thoại đã được đăng ký cho tài khoản khác.</p> -->
            <?php
            if (isset($_SESSION['errorOldPass'])) {
              echo '<p style="font-size: 12px;line-height: 18.391px; padding-left: 12px;color: red;font-weight: bold;">' . $_SESSION['errorOldPass'] . '</p>';
              unset($_SESSION['errorOldPass']);
            }
            ?>
          </div>
          <div style="margin-top: 20px;">
            <div style="display: flex; flex-direction:row ;width: fit-content;">
              <p class="TitleSmallpass" style="margin-bottom: 4px;">Mật khẩu hiện tại (*)</p>
            </div>

            <input id="currentPassword" name="currentPassword" type="password"
              style="padding-left: 6px;width:320px; height:36px; border-style: outset;margin-bottom: 12px; border: 1px solid #674FA3; border-radius: 8px;"
              placeholder="Mật khẩu hiện tại" maxlength="20" value="">
          </div>
          <div style="">
            <div style="display: flex; flex-direction:row ;width: fit-content;">
              <p class="TitleSmallpass" style="margin-bottom: 4px;">Mật khẩu mới (*)</p>
              <p id="pass-message"
                style="display: none; color: red;padding-left: 10px;font-size: 12px;font-weight: bold;line-height: 18.391px;">
                aa</p>
            </div>

            <input id="password" name="passWord" type="password"
              style="padding-left: 6px;width:320px; height:36px; border-style: outset;margin-bottom: 12px; border: 1px solid #674FA3; border-radius: 8px;"
              placeholder="Mật khẩu mới" maxlength="20">
          </div>
          <div style="margin-bottom: 12px;">
            <div style="display: flex; flex-direction:row ;width: fit-content;">
              <p class="TitleSmallpass" style="margin-bottom: 4px;">Nhập lại mật khẩu mới (*)</p>
              <img id="khongtrungkhop" src=".//assets/img/hoangImg/icons/icons8-cancel-48.png" alt="" width="20px"
                height="20px" style="margin-left: 10px;display: none;">
              <img id="trungkhop" src=".//assets/img/hoangImg/icons/icons8-ok.gif" alt="" width="20px" height="20px"
                style="margin-left: -20px;display: none;">
            </div>
            <input id="repeatPassword" name="repeatPassword" type="password"
              style="padding-left: 6px;width:320px; height:36px; border-style: outset; border: 1px solid #674FA3; border-radius: 8px;margin-bottom: 20px;"
              placeholder="Nhập lại mật khẩu mới" maxlength="20">
          </div>
          <div style="width: 332px; display:flex;justify-content: center;">
            <input type="submit" name="btnSubmitSaveNewPass" id="btnSubmitSaveNewPass" class="containerlogin-text06 TitleSmallpass" value="Lưu">
            <input type="button" id="btnSubmitHuySaveNewPass" class="containerlogin-text06 TitleSmallpass" value="Hủy" style="margin-left: 20px;" onclick="returnHome();">

          </div>

        </div>

      </form>
      

    </div>
  </div>

  <!--Start: Footer-->
  <div id="my-footer">
  <?php
    include("components/footer.php");
    ?>
  </div>
  <!--End: Footer-->

   <!--Start Điều hướng-->
   <script>
    function returnHome(){
        window.location = "index.php";
    }
   </script>
   <!--End điều hướng-->

  <!--Start check pass-->
  <script>
    // Lấy phần tử input và phần tử thông báo lỗi
    var input = document.getElementById("password");
    var errorMessagepass = document.getElementById("pass-message");

    // Gắn sự kiện input cho phần tử input
    input.addEventListener("input", function () {
      // Kiểm tra độ mạnh yếu của mật khẩu
      var password = input.value;
      var strength = 0;
      var regex = /[$-/:-?{-~!"^_`\[\]]/;
      strength += regex.test(password) ? 1 : 0;
      regex = /[A-Z]/;
      strength += regex.test(password) ? 1 : 0;
      regex = /[a-z]/;
      strength += regex.test(password) ? 1 : 0;
      regex = /[0-9]/;
      strength += regex.test(password) ? 1 : 0;

      // Hiển thị thông báo tương ứng
      if(password.length === 0){
        errorMessagepass.style.display = "none";
      }
      else{
        if (password.length < 8 || strength < 2) {
        errorMessagepass.innerText = "Mật khẩu yếu";
        errorMessagepass.style.display = "block";
        errorMessagepass.style.color = "#99CC00";
      } else if (password.length < 12 || strength < 3) {
        errorMessagepass.innerText = "Mật khẩu trung bình";
        errorMessagepass.style.display = "block";
        errorMessagepass.style.color = "#33CCFF";
      } else if (password.length < 16 || strength < 3) {
        errorMessagepass.innerText = "Mật khẩu mạnh";
        errorMessagepass.style.display = "block";
        errorMessagepass.style.color = "#00CC99";
      }
      else if (password.length < 21 || strength < 4) {
        errorMessagepass.innerText = "Mật khẩu rất mạnh";
        errorMessagepass.style.display = "block";
        errorMessagepass.style.color = "#00CC00";
      }
      else {
        errorMessagepass.style.display = "none";
      }
      }
      
    });

    //////

    // Lấy phần tử input và phần tử thông báo lỗi

    var passwordRepeat = document.getElementById("repeatPassword");

    // Gắn sự kiện input cho phần tử input
    passwordRepeat.addEventListener("input", function () {
      var khongtrungkhop = document.getElementById("khongtrungkhop");
      var trungkhop = document.getElementById("trungkhop");
      var password = input.value;
      var password2 = passwordRepeat.value;
      // Hiển thị thông báo tương ứng
      if (password2.length == 0) {
        trungkhop.style.display = "none";
        khongtrungkhop.style.display = "none";
      } else if (password2 == password) {
        trungkhop.style.display = "block";
        khongtrungkhop.style.display = "none";
      }
      else {
        trungkhop.style.display = "none";
        khongtrungkhop.style.display = "block";
      }
    });

  </script>


  <!--End check pass-->


  <!--START: Script check các ô-->
  <script>
    function showAlert() {
      Swal.fire({
        title: 'Thông báo!',
        text: 'Bạn chưa điền đầy đủ các thông tin cần thiết!',
        icon: 'warning',
        confirmButtonText: 'Xác nhận'
      })
    }
    function kiemTra() {
      // cau a

      if (document.frmdoipass.currentPassword.value.length == 0 ||
          document.frmdoipass.passWord.value.length == 0 ||
          document.frmdoipass.repeatPassword.value.length == 0  ) {
            showAlert();
            return false;
      }
      if(document.frmdoipass.passWord.value.length < 8){
        Swal.fire({
        title: 'Thông báo!',
        text: 'Mật khẩu mới tối thiểu 8 ký tự!',
        icon: 'warning',
        confirmButtonText: 'Xác nhận'
      })
      return false;
      }

      if(document.frmdoipass.passWord.value != document.frmdoipass.repeatPassword.value){
        Swal.fire({
        title: 'Thông báo!',
        text: 'Mật khẩu mới và Nhập lại mật khẩu mới không trùng khớp!',
        icon: 'warning',
        confirmButtonText: 'Xác nhận'
      })
      return false;
      }
    }
  </script>
  <!--END: Script check các ô-->


</body>

</html>