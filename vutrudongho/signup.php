<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vũ Trụ Đồng Hồ</title>
  <link rel="shortcut icon" href="assets/Img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/account_registration_form.css">
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
    <div style="width: 40%;height: 100%;display:flex;flex-direction:column;align-items:center;justify-content:center;">
      <img src="assets/img/hoangImg/logo/logo_tron.png" alt="z416347160358228d6ce2e5edbcf0ee0b207d1a4329bed23772"
        class="containerlogin-z416347160358228d6ce2e5edbcf0ee0b207d1a4329bed2" onclick="">
      <span class="containerlogin-text24 TitleMedium">
        <span>VŨ TRỤ ĐỒNG HỒ</span>
      </span>
      <span class="containerlogin-text26">
        <span>
          <span>Nền tảng thương mại điện tử được yêu thích tại</span>
          <br>
          <span>Thành phố Hồ Chí Minh</span>
        </span>
      </span>
      </div>
      <form style="width: 60%;height: 100%;display:flex;flex-direction:column;align-items:center;justify-content:center;" name="frmdangky" id="" action=".//modules/signup_processing.php" method="POST" onsubmit="return kiemTra();">

        <div class="containerlogin-group1">

          <div class="containerlogin-text LabelMedium" style="position: absolute; display: flex;flex-direction: row;">
            <span>ĐĂNG KÝ</span>
            <!-- <p style="font-size: 12px;line-height: 18.391px; padding-left: 12px;color: red;font-weight: bold;">*Số điện thoại đã được đăng ký cho tài khoản khác.</p> -->
            <?php
            if (isset($_SESSION['error'])) {
              echo '<p style="font-size: 12px;line-height: 18.391px; padding-left: 12px;color: red;font-weight: bold;">' . $_SESSION['error'] . '</p>';
              unset($_SESSION['error']);
            }
            ?>
          </div>
          <div>
            <p style="margin-top: 30px;margin-bottom: 4px;">Họ và tên (*)</p>
            <input name="fullName" type="text"
              style="padding-left: 6px;width:320px; height:36px;  border-style: outset;margin-bottom: 12px; border: 1px solid #674FA3; border-radius: 8px;margin-right: 16px;"
              placeholder="Họ và tên">
          </div>
          <div>
            <div style="display: flex; flex-direction:row ;width: fit-content;">
              <p style="margin-bottom: 4px;">Email </p>
              <p id="error-message"
                style="display: none; color: red;padding-left: 10px;font-size: 12px;font-weight: bold;line-height: 18.391px;">
              </p>
            </div>
            <input id="email" name="email" type="email"
              style="padding-left: 6px;width:320px; height:36px; border-style: outset;margin-bottom: 12px; border: 1px solid #674FA3; border-radius: 8px;"
              placeholder="Email">
          </div>
          <div>
            <div style="display: flex; flex-direction:row ;width: fit-content;">
              <p style="margin-bottom: 4px;">Số điện thoại (*)</p>
              <p id="phoneNumber-message"
                style="display: none; color: red;padding-left: 10px;font-size: 12px;font-weight: bold;line-height: 18.391px;">
              </p>
            </div>
            <input id="numberPhone" name="numberPhone" type="text"
              style="padding-left: 6px;width:320px; height:36px; border-style: outset;margin-bottom: 12px; border: 1px solid #674FA3; border-radius: 8px;"
              placeholder="Số điện thoại">
          </div>
          <div>
            <div style="display: flex; flex-direction:row ;width: fit-content;">
              <p style="margin-bottom: 4px;">Mật khẩu (*)</p>
              <p id="pass-message"
                style="display: none; color: red;padding-left: 10px;font-size: 12px;font-weight: bold;line-height: 18.391px;">
                aa</p>
            </div>

            <input id="password" name="passWord" type="password"
              style="padding-left: 6px;width:320px; height:36px; border-style: outset;margin-bottom: 12px; border: 1px solid #674FA3; border-radius: 8px;"
              placeholder="Mật khẩu" maxlength="20">
          </div>
          <div>
            <div style="display: flex; flex-direction:row ;width: fit-content;">
              <p style="margin-bottom: 4px;">Nhập lại mật khẩu (*)</p>
              <img id="khongtrungkhop" src="assets/img/hoangImg/icons/icons8-cancel-48.png" alt="" width="20px"
                height="20px" style="margin-left: 10px;display: none;">
              <img id="trungkhop" src="assets/img/hoangImg/icons/icons8-ok.gif" alt="" width="20px" height="20px"
                style="margin-left: -20px;display: none;">
            </div>
            <input id="repeatPassword" name="repeatPassword" type="password"
              style="padding-left: 6px;width:320px; height:36px; border-style: outset; border: 1px solid #674FA3; border-radius: 8px;margin-bottom: 20px;"
              placeholder="Nhập lại mật khẩu" maxlength="20">
          </div>

          <div>
            <p style="margin-top: 30px;margin-bottom: 4px;">Tỉnh/Thành phố (*)</p>
            <select id="city" name="tinh"
              style="width:332px; height:36px; border-style: outset;margin-bottom: 12px; border: 1px solid #674FA3; border-radius: 8px;">
              <option value="" selected></option>
            </select>
          </div>
          <div>
            <p style="margin-bottom: 4px;">Quận/Huyện (*)</p>
            <select id="district" name="quanHuyen"
              style="width:332px; height:36px; border-style: outset;margin-bottom: 12px; border: 1px solid #674FA3; border-radius: 8px;">
              <option value="" selected></option>
            </select>
          </div>
          <div>
            <p style="margin-bottom: 4px;">Phường/Xã (*)</p>
            <select id="ward" name="phuongXa"
              style="width:332px; height:36px; border-style: outset;margin-bottom: 12px; border: 1px solid #674FA3; border-radius: 8px;">
              <option value="" selected></option>
            </select>
          </div>
          <div>
            <p style="margin-bottom: 4px;">Địa chỉ nhận hàng (*)</p>
            <input name="diaChiNha" type="text"
              style="padding-left: 6px;width:332px; height:36px; border-style: outset;margin-bottom: 34px; border: 1px solid #674FA3; border-radius: 8px;"
              placeholder="Số nhà, đường">
          </div>
          <div style="width: 332px; display:flex;justify-content: center;">
            <input type="submit" id="btnSubmitLogin" class="containerlogin-text06 LabelLarge" value="Đăng ký">
            </span>
          </div>

        </div>

      </form>
      

    </div>
  </div>

  <!--Start: Footer-->
  <div id="my-footer" style="">
  <?php
    include("components/footer.php");
    ?>
  </div>
  <!--End: Footer-->

  <!--Start check mail-->

  <script>
    // Lấy phần tử input và phần tử thông báo lỗi
    var inputMail = document.getElementById("email");
    var errorMessage = document.getElementById("error-message");

    // Gắn sự kiện input cho phần tử input
    inputMail.addEventListener("input", function () {
      // Kiểm tra định dạng email
      var email = inputMail.value;
      var re = /\S+@\S+\.\S+/;
      var valid = re.test(email);

      // Nếu email không hợp lệ, hiển thị thông báo lỗi
      if (document.frmdangky.email.value.length == 0) {
        errorMessage.style.display = "none";
      }
      else {
        if (!valid) {
          errorMessage.innerText = "Định dạng email chưa đúng";
          errorMessage.style.display = "block";
        } else {
          // Ngược lại, ẩn thông báo lỗi
          errorMessage.style.display = "none";
        }
      }
    });
  </script>
  <!--End checkmail-->

  <!--Start check phone-->
  <script>
    /* ^ là ký tự bắt đầu của biểu thức chính quy.
  (0|\+84) đại diện cho ký tự 0 hoặc chuỗi +84.
  [3|5|7|8|9] đại diện cho một trong những chữ số bắt đầu của số điện thoại Việt Nam.
  [0-9]{8} đại diện cho 8 chữ số còn lại của số điện thoại Việt Nam.
  $ là ký tự kết thúc của biểu thức chính quy.
  Hàm test() sẽ trả về true nếu chuỗi phoneNumber truyền vào khớp với mẫu định dạng số điện thoại Việt Nam, ngược lại sẽ trả về false.
  Bạn có thể sử dụng hàm này để kiểm tra định dạng số điện thoại trong các sự kiện như oninput, onblur của input để người dùng nhập vào số điện thoại đúng định dạng.
*/
    var numberPhone = document.getElementById("numberPhone");
    var numberPhoneMessage = document.getElementById("phoneNumber-message");

    function isValidPhoneNumber(phoneNumber) {
      var pattern = /^(0|\+84)[3|5|7|8|9][0-9]{8}$/;
      return pattern.test(phoneNumber);
    }

    // Gắn sự kiện input cho phần tử input
    numberPhone.addEventListener("input", function () {
      var phoneNumber = numberPhone.value;
      
      // Hiển thị thông báo tương ứng
      if(phoneNumber.trim().length == 0){
        numberPhoneMessage.innerText = ' ';
        numberPhoneMessage.style.display = "block";
      }
      else{
      if (isValidPhoneNumber(phoneNumber) == true) {
        numberPhoneMessage.innerText = "Số điện thoại hợp lệ";
        numberPhoneMessage.style.display = "block";
        numberPhoneMessage.style.color = "#00CC00";
      } 
      else {
        numberPhoneMessage.innerText = "Số điện thoại không hợp lệ";
        numberPhoneMessage.style.display = "block";
      }}
    });
  </script>
  <!--End check phone-->

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
      if(password.length == 0){
        errorMessagepass.innerText = ' ';
        errorMessagepass.style.display = "block";
      }
      else if (password.length < 8 || strength < 2) {
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

      if (document.frmdangky.fullName.value.trim().length == 0 ||

        document.frmdangky.numberPhone.value.length == 0 ||
        document.frmdangky.passWord.value.length == 0 ||
        document.frmdangky.repeatPassword.value.length == 0 ||
        document.frmdangky.tinh.value == -1 ||
        document.frmdangky.quanHuyen.value == -1 ||
        document.frmdangky.phuongXa.value == -1 ||
        document.frmdangky.diaChiNha.value.length == 0) {
        showAlert();
        return false;
      }
      if(document.frmdangky.passWord.value != document.frmdangky.repeatPassword.value){
        Swal.fire({
        title: 'Thông báo!',
        text: 'Mật khẩu và Nhập lại mật khẩu không trùng khớp!',
        icon: 'warning',
        confirmButtonText: 'Xác nhận'
      })
      return false;
      }
      if(document.frmdangky.passWord.value.length < 8){
        Swal.fire({
        title: 'Thông báo!',
        text: 'Mật khẩu tối thiểu 8 ký tự!',
        icon: 'warning',
        confirmButtonText: 'Xác nhận'
      })
      return false;
      }
    }
  </script>
  <!--END: Script check các ô-->

  <!--START: Script hiệu ứng nút con mắt-->
  <script>
    var btn_eye = document.querySelector('#btn-eyes');
    var passwordtxt = document.frm.passWord;
    var flag_eye = false;
    function showHidePass() {
      if (flag_eye == false) {
        passwordtxt.type = 'text';
        flag_eye = true;
      }
      else {
        passwordtxt.type = 'password';
        flag_eye = false;
      }
    }
  </script>
  <!--END: Script hiệu ứng nút con mắt-->
  <script>

  </script>
  <!--START: Script api tỉnh quận huyện xã-->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
  <script>
    const host = "https://provinces.open-api.vn/api/";
    var callAPI = (api) => {
      return axios.get(api)
        .then((response) => {
          renderData(response.data, "city");
        });
    }
    callAPI('https://provinces.open-api.vn/api/?depth=1');
    var callApiDistrict = (api) => {
      return axios.get(api)
        .then((response) => {
          renderData(response.data.districts, "district");
        });
    }
    var callApiWard = (api) => {
      return axios.get(api)
        .then((response) => {
          renderData(response.data.wards, "ward");
        });
    }

    var renderData = (array, select) => {
      let row = ' <option disable value="-1">Chọn</option>';
      array.forEach(element => {
        row += `<option data-id="${element.code}" value="${element.name}">${element.name}</option>`
      });
      document.querySelector("#" + select).innerHTML = row
    }
    $("#city").change(() => {
      callApiDistrict(host + "p/" + $("#city").find(':selected').data('id') + "?depth=2");

    });
    $("#district").change(() => {
      callApiWard(host + "d/" + $("#district").find(':selected').data('id') + "?depth=2");

    });
    $("#ward").change(() => {

    })

  </script>
  <!--END: Script api tỉnh quận huyện xã-->

</body>

</html>