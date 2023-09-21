<?php
require_once('lib_session.php');
?>
<?php
echo '
<div id="logo-header"></div>
<div id="menu-header">
    <img class="line-header" src=".//assets/Img/hoangImg/imgs/Line.png" style="order: 0;" alt="">
    <p class="child-menu-header" style="width: auto;order: 1;"><a id="navbarHome" class="navbartheA" href="index.php">Trang chủ</a></p>
    <img class="line-header" src=".//assets/Img/hoangImg/imgs/Line.png" style="order: 2;" alt="">
    <p class="child-menu-header" style="width: auto;order: 3;"><a id="navbarProduct" class="navbartheA" href="product.php">Sản phẩm</a></p>
    <img class="line-header" src=".//assets/Img/hoangImg/imgs/Line.png" style="order: 4;" alt="">
    <p class="child-menu-header" style="width: auto;order: 5;"><a id="navbarAbout" class="navbartheA" href="about_us.php">Về chúng tôi</a></p>
    <img class="line-header" src=".//assets/Img/hoangImg/imgs/Line.png" style="order: 6;" alt="">
    <p class="child-menu-header" style="width: auto;order: 7;"><a id="navbarContact" class="navbartheA" href="contact.php">Liên hệ</a></p>
</div>
<div id="avt-and-icons">
    <img id="btnHelp" onclick="btnHelpClicked();" class="icon-header" src=".//assets/img/hoangImg/icons/icons8-help-24.png" style="order: 0;" alt="">
    <img class="line-header" src=".//assets/img/hoangImg/imgs/Line.png" style="order: 1;" alt="">
    <img id="btnCart" onclick="btnCartClicked();" class="icon-header" src=".//assets/img/hoangImg/icons/icons8-shopping-cart-24.png" style="order: 2;" alt="">
    <img class="line-header" src=".//assets/img/hoangImg/imgs/Line.png" style="order: 3;" alt="">
    <script>
    function btnCartClicked(){
        window.location = "cart.php";
       }
    function btnHelpClicked(){
        window.location = "help.php";
       }
    </script>
'; ?>

<!-- Nếu chưa đăng nhập thì hiển thị nút Đăng nhập -->
<?php
//var_dump(isAdminLogged());
if (isAdminLogged()) {
    echo ' 
    <p style="order: 4;color:#fff;">Xin chào ';echo $_SESSION['current_fullName'];
    echo '</p>
    <img id="avt_user" onclick="avtClicked();" src=".//assets/img/hoangImg/icons/icons8-user-64.png" width="34" height="34" style="order: 5;" alt=""></div>
   <div id="menu-options-user" style="position: absolute;
                                      top:37px;
                                      right:0;
                                      background-color:#ccc;
                                      z-index:1000;
                                      order: 7;
                                      width:200px;
                                      height:100px;
                                      display:none;">
   <ul style="list-style-type: none;
              font-size:20px;
              display:flex;
              height:100%;
              flex-direction: column;
              justify-content: space-around;
              background-color: #fff;
              font-family: "Roboto";
              font-style: normal;
              font-weight: normal;
              font-size: 16px;
              line-height: 40px;
              letter-spacing: 0.1px;
              
              ">
   <li style="padding-left:8px;display:flex;flex-direction:row;justify-content:left;margin-left:20px;" ><img style="position:absolute;left:0;" src=".//assets/img/hoangImg/icons/icons8-user-menu-male-24.png" width="22" alt=""></img><a class="the_a_Black_Purple" href="user_information.php">Thông tin tài khoản</a></li>
   <li style="padding-left:8px;display:flex;flex-direction:row;justify-content:left;margin-left:20px;"><img style="position:absolute;left:0;" src=".//assets/img/hoangImg/icons/icons8-purchase-order-48.png" width="22" alt=""></img><a class="the_a_Black_Purple" href="my_order.php?page=1">Đơn hàng của tôi</a></li>
   <li style="padding-left:8px;display:flex;flex-direction:row;justify-content:left;margin-left:20px;"><img style="position:absolute;left:0;" src=".//assets/img/hoangImg/icons/icons8-password-100.png" width="22" alt=""></img><a class="the_a_Black_Purple" href="change_pass.php">Đổi mật khẩu</a></li>
   <li><hr></li>
   <li style="padding-left:8px;display:flex;flex-direction:row;justify-content:left;margin-left:20px;"><img style="position:absolute;left:0;" src=".//assets/img/hoangImg/icons/icons8-logout-48.png" width="22" alt=""></img><a class="the_a_Black_Purple" class="nav-link" href="logout.php?isAdmin=1">Đăng xuất</a></li>
   </ul>
   </div>
   <script lang="javascript">
   var avt_user = document.querySelector("#avt_user");
   var menu_options_user = document.querySelector("#menu-options-user");
   var flag = false;
   function avtClicked() {
    if(flag == true){
        menu_options_user.style.display = "none";
        flag = false;
    }
    else{
        menu_options_user.style.display = "block";
        flag = true;
    }
   }
   </script>
   <script>
   function btnCartClicked(){
       window.location = "cart.php";
      }
   </script>

   ';

} else {
    echo ('<p id="login-signup" style="order: 6;"> <a id="navbarLogin" class="navbartheA" href="login.php">Đăng nhập</a></p></div>
    ');
}
?>