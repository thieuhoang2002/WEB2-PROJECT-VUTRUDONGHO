<?php
require_once('lib_session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vũ Trụ Đồng Hồ</title>
  <link rel="shortcut icon" href="assets/Img/logo.png" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/home.css">
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
  <!--Start Nut di chuyen-->
  <div id="btnLenXuong" style="position: fixed;z-index: 999;display: flex;flex-direction: column;top:80%;right: 14px;">
    <img id="btn-top" src="assets/img/hoangImg/icons/icons8-slide-up-32.png" alt=""
      style="cursor: pointer;margin-bottom: 10px;">
    <img id="scroll-to-bottom" onclick="scrollToBottom()" src="assets/img/hoangImg/icons/icons8-down-button-32.png"
      alt="" style="cursor: pointer;">
  </div>

  <!--End nut di chuyen-->
  <!--Start: Header-->
  <div id="bar-header">
    <?php
    include("components/header.php");
    ?>
  </div>
  <!--End: Header-->
  <div id="main"
    style="display: flex;flex-direction: column; background-color:#fff; height: fit-content; position: relative; top: 50px;">
    <style>
      #vtdd-logotext {
        display: block;
        width: auto;
        height: 75px;

      }

      #my-footer {
        position: relative;
        top: 50px;
      }
    </style>

    <div id="ỉntroduction" style="display: flex;    background-color: rgba(103, 80, 164, 0.5);
    height: 100px;justify-content: center;">
      <img id="vtdd-logotext" src="assets/img/hoangImg/logo/logo_text_ngang.png" alt="">
    </div>
    <!--Begin: Slider-->
    <div class="slider">
      <div class="slide-wrapper">
        <div class="slide">
          <img class="slide-img" src="assets/img/hoangImg/slider/slide1.png" alt="Slide1" />
        </div>
        <div class="slide">
          <img class="slide-img" src="assets/img/hoangImg/slider/slide2.png" alt="Slide2" />
        </div>
        <div class="slide">
          <img class="slide-img" src="assets/img/hoangImg/slider/slide3.png" alt="Slide3" />
        </div>
      </div>
    </div>
    <!--End: Slider-->
    <div style="background-color: #fff;">
      <p class="bigtitlehome" style="text-align:center ;">CÁC HÃNG ĐỒNG HỒ CHÚNG TÔI ĐANG KINH DOANH</p>
      <div id="productKD" style="margin-top: 30px;margin-left: 50px;margin-right: 50px;">
        <div
          style="width: 200px;height:200px;background-color:rgba(103, 80, 164, 0.5);display: flex;justify-content: center;align-items: center;">
          <div id="pdIphone" style="display:flex ;flex-direction: column;position: relative;">
            <!-- <p onclick="window.location.href='#casioBrandInfo'" class="mediumtitlehome"
              style="cursor: pointer;color:#fff ;text-align: center;background-color: rgba(103, 80, 164, 0.6);position: absolute;width:100% ;top:50%;transform: translateY(-50%);line-height: 1.5;">
              Casio</p> -->
            <div
              style="cursor: pointer;display: flex;width: 180px;height: 28px;position: absolute;top:50%;transform: translateY(-50%);z-index: 10;">
              <a id="theAtrongHoverMauTim" class="btn-11 mediumtitlehome"
                onclick="window.location.href='#casioBrandInfo'">Casio</a>
            </div>
            <div
              style="display: flex;width: 180px;height: 28px;position: absolute;top:50%;transform: translateY(-50%);z-index: 9;background-color: #B3A7D1;">
            </div>
            <img src="assets/img/productImg/118_AEQ-110W-3AVDF-699x699.png" style="opacity: 0.9;" alt=""
              width="180px">
          </div>
        </div>

        <div
          style="width: 200px;height:200px;background-color:rgba(103, 80, 164, 0.5);display: flex;justify-content: center;align-items: center;">
          <div style="width:180px ;height: 180px;background-color: #fff;">
            <div id="pdOppo" style="display:flex ;flex-direction: column;position: relative;">
              <!-- <p onclick="window.location.href='#appleBrandInfo'" class="mediumtitlehome"
                style="cursor: pointer;color:#fff ;text-align: center;background-color: rgba(103, 80, 164, 0.6);position: absolute;width:100% ;top:50%;transform: translateY(-50%);line-height: 1.5;">
                Apple</p> -->
              <div
                style="cursor: pointer;display: flex;width: 180px;height: 28px;position: absolute;top:50%;transform: translateY(-50%);z-index: 10;">
                <a id="theAtrongHoverMauTim2" class="btn-11 mediumtitlehome"
                  onclick="window.location.href='#appleBrandInfo'">Apple</a>
              </div>
              <div
                style="display: flex;width: 180px;height: 28px;position: absolute;top:50%;transform: translateY(-50%);z-index: 9;background-color: #B3A7D1;">
              </div>
              <img src="assets/img/productImg/0011842_midnight_550.png" style="opacity: 0.9;" alt="" width="180px">
            </div>
          </div>
        </div>
        <div
          style="width: 200px;height:2020x;background-color:rgba(103, 80, 164, 0.5);display: flex;justify-content: center;align-items: center;">
          <div id="pdPixel" style="display:flex ;flex-direction: column;position: relative;">
            <!-- <p onclick="window.location.href='#citizenBrandInfo'" class="mediumtitlehome"
              style="cursor: pointer;color:#fff ;text-align: center;background-color: rgba(103, 80, 164, 0.6);position: absolute;width:100% ;top:50%;transform: translateY(-50%);line-height: 1.5;">
              Citizen</p> -->
            <div
              style="cursor: pointer;display: flex;width: 180px;height: 28px;position: absolute;top:50%;transform: translateY(-50%);z-index: 10;">
              <a id="theAtrongHoverMauTim3" class="btn-11 mediumtitlehome"
                onclick="window.location.href='#citizenBrandInfo'">Citizen</a>
            </div>
            <div
              style="display: flex;width: 180px;height: 28px;position: absolute;top:50%;transform: translateY(-50%);z-index: 9;background-color: #B3A7D1;">
            </div>
            <img src="assets/img/productImg/AN8195-58E-699x699.png" style="opacity: 0.9;" alt="" width="180px">
          </div>
        </div>

        <div
          style="width: 200px;height:200px;background-color:rgba(103, 80, 164, 0.5);display: flex;justify-content: center;align-items: center;">
          <div id="pdRealme" style="display:flex ;flex-direction: column;position: relative;">
            <!-- <p onclick="window.location.href='#orientBrandInfo'" class="mediumtitlehome"
              style="cursor: pointer;color:#fff ;text-align: center;background-color: rgba(103, 80, 164, 0.6);position: absolute;width:100% ;top:50%;transform: translateY(-50%);line-height: 1.5;">
              Orient</p> -->
            <div
              style="cursor: pointer;display: flex;width: 180px;height: 28px;position: absolute;top:50%;transform: translateY(-50%);z-index: 10;">
              <a id="theAtrongHoverMauTim4" class="btn-11 mediumtitlehome"
                onclick="window.location.href='#orientBrandInfo'">Orient</a>
            </div>
            <div
              style="display: flex;width: 180px;height: 28px;position: absolute;top:50%;transform: translateY(-50%);z-index: 9;background-color: #B3A7D1;">
            </div>
            <img src="assets/img/productImg/FAC08003A0-1-699x699.png" style="opacity: 0.9;" s alt="" width="180px">
          </div>
        </div>

        <div
          style="width: 200px;height:200px;background-color:rgba(103, 80, 164, 0.5);display: flex;justify-content: center;align-items: center;">
          <div id="pdSamsung" style="display:flex ;flex-direction: column;position: relative;">
            <!-- <p onclick="window.location.href='#seikoBrandInfo'" class="mediumtitlehome"
              style="cursor: pointer;color:#fff ;text-align: center;background-color: rgba(103, 80, 164, 0.6);position: absolute;width:100% ;top:50%;transform: translateY(-50%);line-height: 1.5;">
              Seiko</p> -->
            <div
              style="cursor: pointer;display: flex;width: 180px;height: 28px;position: absolute;top:50%;transform: translateY(-50%);z-index: 10;">
              <a id="theAtrongHoverMauTim5" class="btn-11 mediumtitlehome"
                onclick="window.location.href='#seikoBrandInfo'">Seiko</a>
            </div>
            <div
              style="display: flex;width: 180px;height: 28px;position: absolute;top:50%;transform: translateY(-50%);z-index: 9;background-color: #B3A7D1;">
            </div>
            <img src="assets/img/productImg/SRPG41K1.png" style="opacity: 0.9;" alt="" width="180px">
          </div>
        </div>

      </div>
    </div>


    <div id="casioBrandInfo" style="background-color: rgba(103, 80, 164, 0.4); margin-top: 56px; padding-bottom: 56px;">
      <!--<p class="bigtitlehome" style="text-align:center ;margin-top: 50px;">SẢN PHẨM BÁN CHẠY</p>-->
      <p class="bigtitlehome" style="text-align:center ;margin-top: 50px;">CASIO</p>
      <div id="productBC">
        <div class="clockBrandContent">
          <div class="col30">
            <img src="assets/img/hoangImg/imgs/118_AEQ-110W-3AVDF-699x699.png" alt="" width="250px" alt="">
          </div>
          <p style="text-align: justify;display: flex;align-items: center;" class="col70 smalltitlehome">Đồng hồ Casio
            là một trong những thương hiệu đồng hồ nổi tiếng và được yêu thích trên toàn
            thế giới. Với thiết kế đơn giản, thời trang và đa dạng về chức năng, đồng hồ Casio đã trở thành một lựa chọn
            phổ biến cho các tín đồ thời trang cũng như những người đam mê công nghệ. Không chỉ đơn thuần là một chiếc
            đồng hồ báo giờ, đồng hồ Casio còn tích hợp nhiều tính năng hữu ích như đồng hồ định vị GPS, đồng hồ thông
            minh, đồng hồ chống nước, đồng hồ đo nhịp tim và nhiều tính năng khác. Với chất lượng đáng tin cậy và giá cả
            hợp lý, đồng hồ Casio là một lựa chọn tuyệt vời cho bất kỳ ai đang tìm kiếm một chiếc đồng hồ đa năng và
            thời trang.</p>
        </div>
        <img src="assets/img/hoangImg/imgs/banerCasioBaby.png" alt="" width="250px"
          style="width: 100%;margin-top: 12px;">
        <img src="assets/img/hoangImg/imgs/banerCasioGsock.png" alt="" width="250px"
          style="width: 100%;margin-top: 14px;">

        <hr id="appleBrandInfo" style="margin-top: 50px;margin-bottom: 50px;">

        <p class="bigtitlehome" style="text-align:center ;">APPLE</p>
        <div class="clockBrandContent">
          <div class="col30">
            <img src="assets/img/productImg/0011842_midnight_550.png" alt="" width="250px" alt="">
          </div>
          <p style="text-align: justify;display: flex;align-items: center;" class="col70 smalltitlehome">Apple Watch là
            một trong những sản phẩm đồng hồ thông minh được yêu thích nhất hiện nay. Với thiết kế đẹp mắt, tính năng
            thông minh và tích hợp nhiều chức năng hữu ích, Apple Watch đã trở thành một lựa chọn phổ biến cho những
            người yêu công nghệ. Với khả năng đo nhịp tim, theo dõi hoạt động thể chất, kiểm tra sức khỏe và tích hợp hệ
            thống thông báo từ các ứng dụng trên điện thoại, Apple Watch giúp người dùng có thể quản lý công việc, cuộc
            sống và sức khỏe của mình một cách tiện lợi hơn. Đặc biệt, tính năng định vị GPS và hướng dẫn đường đi cũng
            là điểm nhấn đáng chú ý của Apple Watch, giúp người dùng dễ dàng điều hướng và khám phá thế giới xung quanh
            một cách thuận tiện hơn. Với chất lượng và độ tin cậy của thương hiệu Apple, Apple Watch là một sự lựa chọn
            tuyệt vời cho những ai muốn sở hữu một chiếc đồng hồ thông minh đẳng cấp và hiện đại.</p>
        </div>
        <img src="assets/img/hoangImg/imgs/apple_baner.jpg" alt="" style="width: 100%;margin-bottom: 14px;">
        <img src="assets/img/hoangImg/imgs/apple_banner3.jpg" alt="" style="width: 100%;">

        <hr id="citizenBrandInfo" style="margin-top: 50px;margin-bottom: 50px;">

        <p class="bigtitlehome" style="text-align:center ;">CITIZEN</p>
        <div class="clockBrandContent">
          <div class="col30">
            <img src="assets/img/hoangImg/imgs/AN8195-58E-699x699.png" alt="" width="250px" alt="">
          </div>
          <p style="text-align: justify;display: flex;align-items: center;" class="col70 smalltitlehome">Đồng hồ Citizen
            là một trong những thương hiệu đồng hồ nổi tiếng và được yêu thích trên toàn thế giới. Với hơn 100 năm kinh
            nghiệm trong sản xuất đồng hồ, Citizen đã tạo ra những sản phẩm đồng hồ chất lượng cao, thiết kế đẹp mắt và
            tính năng đa dạng. Đồng hồ Citizen là sự kết hợp tuyệt vời giữa phong cách, chức năng và độ chính xác, với
            khả năng chống nước, chống sốc và tích hợp các chức năng như đo độ sâu, đo tốc độ, đo thời gian, đo khoảng
            cách và nhiều tính năng khác. Đặc biệt, đồng hồ Citizen cũng nổi tiếng với công nghệ Eco-Drive tiên tiến,
            cho phép sử dụng năng lượng ánh sáng để làm năng lượng cho đồng hồ, giúp tiết kiệm pin và bảo vệ môi trường.
            Với chất lượng và độ tin cậy của thương hiệu Citizen, đồng hồ Citizen là sự lựa chọn hoàn hảo cho những ai
            đang tìm kiếm một chiếc đồng hồ đa năng và bền vững.</p>
        </div>
        <img src="assets/img/hoangImg/imgs/citizen_banner1.jpg" alt="" style="width: 100%;margin-bottom: 14px;">
        <img src="assets/img/hoangImg/imgs/citizen_banner2.jpg" alt="" style="width: 100%;margin-bottom: 14px;">
        <img src="assets/img/hoangImg/imgs/citizen_banner4.jpg" alt="" style="width: 100%;">

        <hr id="orientBrandInfo" style="margin-top: 50px;margin-bottom: 50px;">

        <p class="bigtitlehome" style="text-align:center ;">ORIENT</p>
        <div class="clockBrandContent">
          <div class="col30">
            <img src="assets/img/hoangImg/imgs/FAC08003A0-1-699x699.png" alt="" width="250px" alt="">
          </div>
          <p style="text-align: justify;display: flex;align-items: center;" class="col70 smalltitlehome">Đồng hồ Orient
            là một trong những thương hiệu đồng hồ nổi tiếng và được đánh giá cao trong ngành công nghiệp đồng hồ. Với
            hơn 70 năm kinh nghiệm sản xuất đồng hồ, Orient đã tạo ra những sản phẩm đồng hồ chất lượng cao, với thiết
            kế tinh tế và độ chính xác cao. Đồng hồ Orient được sản xuất với các linh kiện chính hãng và được lắp ráp
            bằng tay bởi các thợ đồng hồ tài ba, giúp tăng độ chính xác và độ bền của sản phẩm. Đồng hồ Orient còn nổi
            tiếng với các tính năng đa dạng như đo thời gian, ngày giờ, lịch và tính năng đo độ sâu, giúp người dùng sử
            dụng đồng hồ theo nhiều mục đích khác nhau. Đặc biệt, đồng hồ Orient cũng được trang bị tính năng cộng hưởng
            tự động, cho phép đồng hồ sử dụng chính chuyển động của cổ tay để làm năng lượng cho đồng hồ, giúp tiết kiệm
            năng lượng và kéo dài tuổi thọ của pin. Với chất lượng và độ tin cậy của thương hiệu Orient, đồng hồ Orient
            là sự lựa chọn tuyệt vời cho những ai đang tìm kiếm một chiếc đồng hồ chất lượng cao và đáng tin cậy.</p>
        </div>
        <img src="assets/img/hoangImg/imgs/orient_banner1.jpg" alt="" style="width: 100%;margin-bottom: 14px;">
        <img src="assets/img/hoangImg/imgs/orient_banner2.jpg" alt="" style="width: 100%;">

        <hr id="seikoBrandInfo" style="margin-top: 50px;margin-bottom: 50px;">

        <p class="bigtitlehome" style="text-align:center ;">SEIKO</p>
        <div class="clockBrandContent">
          <div class="col30">
            <img src="assets/img/hoangImg/imgs/SRPG41K1.png" alt="" width="250px" alt="">
          </div>
          <p style="text-align: justify;display: flex;align-items: center;" class="col70 smalltitlehome">Đồng hồ Seiko
            là một trong những thương hiệu đồng hồ nổi tiếng và được yêu thích trên toàn thế giới. Với hơn 130 năm kinh
            nghiệm trong sản xuất đồng hồ, Seiko đã tạo ra những sản phẩm đồng hồ chất lượng cao, với thiết kế đẹp mắt
            và tính năng đa dạng. Đồng hồ Seiko được sản xuất với các linh kiện chính hãng và được lắp ráp bằng tay bởi
            các thợ đồng hồ tài ba, giúp tăng độ chính xác và độ bền của sản phẩm. Đồng hồ Seiko còn nổi tiếng với các
            tính năng đa dạng như đo thời gian, ngày giờ, lịch và tính năng đo độ sâu, giúp người dùng sử dụng đồng hồ
            theo nhiều mục đích khác nhau. Đặc biệt, đồng hồ Seiko cũng được trang bị tính năng cộng hưởng tự động hoặc
            solar, cho phép đồng hồ sử dụng chính chuyển động của cổ tay hoặc ánh sáng để làm năng lượng cho đồng hồ,
            giúp tiết kiệm năng lượng và kéo dài tuổi thọ của pin. Với chất lượng và độ tin cậy của thương hiệu Seiko,
            đồng hồ Seiko là sự lựa chọn hoàn hảo cho những ai đang tìm kiếm một chiếc đồng hồ đa năng và bền vững.</p>
        </div>
        <img src="assets/img/hoangImg/imgs/seiko_banner1.jpg" alt="" style="width: 100%;margin-bottom: 14px;">
        <img src="assets/img/hoangImg/imgs/seiko_banner2.jpg" alt="" style="width: 100%;margin-bottom: 14px;">
        <img src="assets/img/hoangImg/imgs/seiko_banner3.jpg" alt="" style="width: 100%;">

      </div>
    </div>


  </div>

  <!--Start: Footer-->
  <div id="my-footer">
    <?php
    include("components/footer.php");
    ?>
  </div>
  <!--End: Footer-->
  <script>
    var btnTop = document.getElementById("btn-top");
    window.addEventListener("scroll", function () {
      if (window.pageYOffset > 0) {
        btnTop.style.display = "block";
      } else {
        btnTop.style.display = "none";
      }
    });

    btnTop.addEventListener("click", function () {
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    });

    function scrollToBottom() {
      window.scrollTo(0, document.body.scrollHeight);
    }

    var scrollToBottomButton = document.getElementById("scroll-to-bottom");

    window.onscroll = function () {
      if (window.pageYOffset == document.body.scrollHeight - window.innerHeight) {
        scrollToBottomButton.style.display = "none";
      } else {
        scrollToBottomButton.style.display = "block";
      }
    };

  </script>
  <!--start Hiện thanh line-->
  <script>
    var lineHome = document.getElementById("navbarHome");

    lineHome.style.borderBottom = '2px solid #fff';
    lineHome.style.paddingBottom = '1.15px';
  </script>
  <!--end Hiện thanh line-->

  <?php
    if (isset($_SESSION['loginSuccess'])) {
      echo "<script>
      Swal.fire({
        title: 'Thông báo!',
        text: 'Đăng nhập thành công!',
        icon: 'success',
        confirmButtonText: 'Xác nhận'
      })
      </script>";
      unset($_SESSION['loginSuccess']);
    }
  ?>
  <?php
    if (isset($_SESSION['changeUserInfor'])) {
      echo "<script>
      Swal.fire({
        title: 'Thông báo!',
        text: 'Thay đổi thông tin thành công, vui lòng đăng nhập lại!',
        icon: 'success',
        confirmButtonText: 'Xác nhận'
      })
      </script>";
      unset($_SESSION['changeUserInfor']);
    }
  ?>
    <?php
    if (isset($_SESSION['changePassWordSuccess'])) {
      echo "<script>
      Swal.fire({
        title: 'Thông báo!',
        text: 'Đổi mật khẩu thành công, vui lòng đăng nhập lại!',
        icon: 'success',
        confirmButtonText: 'Xác nhận'
      })
      </script>";
      unset($_SESSION['changePassWordSuccess']);
    }
  ?>
   <?php
    if (isset($_SESSION['signupSuccess'])) {
      echo "<script>
      Swal.fire({
        title: 'Thông báo!',
        text: 'Đăng ký tài khoản thành công!',
        icon: 'success',
        confirmButtonText: 'Xác nhận'
      })
      </script>";
      unset($_SESSION['signupSuccess']);
    }
  ?>
</body>

</html>