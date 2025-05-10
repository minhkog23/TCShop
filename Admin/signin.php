<?php
  include '../class/login_admin/login_admin.php';
  $lg=new loginAdmin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <title> Admin - Đăng nhập </title>
  <link rel="stylesheet" href="../assets/css/login.css">
  <!-- Fontawesome CDN Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="../assets/img/img_login/login.jpg" alt="load">
      </div>
      <div class="back">
        <img class="backImg" src="../assets/img/img_login/login.jpg" alt="load">

      </div>
    </div>
    <div class="forms">
      <div class="form-content">
        <div class="login-form">
          <div class="title">Đăng nhập</div>
          <form method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" name="txtemail" id="txtemail" placeholder="Nhập email">
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="txtpass" id="txtpass" placeholder="Nhập mật khẩu">
              </div>
              <div class="text"><a href="#">Quên mật khẩu ?</a></div>
              <div class="button input-box">
                <input type="submit" name="nut_dangNhap" value="Đăng nhập">
              </div>

              <div align="center">
                <?php
                if (isset($_POST['nut_dangNhap']) && $_REQUEST['nut_dangNhap'] == 'Đăng nhập') {
                  if ($_REQUEST['txtemail'] != '' || $_REQUEST['txtpass'] != '') {
                    $user = $_REQUEST['txtemail'];
                    $pass = $_REQUEST['txtpass'];
                    if ($lg->mylogin_admin($user, md5($pass)) == 1) {
                      echo '<script>
                                swal("Thành công","Đăng nhập thành công","success").then(function(){
                                  window.location="index.php";
                                });
                                setTimeout(function(){
                                  window.location="index.php";
                                }, 2000);
                        </script>';
                    } else {
                      echo '<script>
                                    swal("Thất bại","Sai tài khoản hoặc mật khẩu","error")
                              </script>';
                    }
                  } else {
                    echo '<script>swal("Thất bại","Vui lòng nhập đầy đủ thông tin","error")</script>';
                  }
                }
                ?>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>