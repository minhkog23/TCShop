<?php
session_start();
include '../class/login_admin/login_admin.php';
$lg = new loginAdmin();
?>
<?php
include '../class/admin.php';
$ad = new admin();
?>
<?php
// token
// $token =bin2hex(random_bytes(32)); chỉ hổ trợ php 7.0 trở lên
// Đặt ở đầu file PHP, trước khi xuất HTML
if (!isset($_SESSION['token'])) {
  //$_SESSION['token'] = bin2hex(random_bytes(32));//
  $_SESSION['token'] = md5(uniqid(rand(), true)); // Hoặc sử dụng hàm md5 để tạo token
}
$token = $_SESSION['token'];
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
              <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
              <div class="button input-box">
                <input type="submit" name="nut_dangNhap" value="Đăng nhập">
              </div>

              <div align="center">
                <?php
                $max_temp = 3;
                $lock_time = 5 * 60; // 5 phút
                $user = isset($_REQUEST['txtemail']) ? $_REQUEST['txtemail'] : '';
                // Kiểm tra nếu tài khoản này đã bị khóa
                if ($user && isset($_SESSION['lock_time_admin'][$user]) && time() - $_SESSION['lock_time_admin'][$user] < $lock_time) {
                  $wait = $lock_time - (time() - $_SESSION['lock_time_admin'][$user]);
                  echo "<script>swal('Thất bại','Tài khoản $user đã bị khóa. Vui lòng thử lại sau $wait giây.','error');</script>";
                  unset($_SESSION['login_attempts_admin'][$user]);
                  unset($_SESSION['lock_time_admin'][$user]);
                } else
                if (isset($_POST['nut_dangNhap']) && $_REQUEST['nut_dangNhap'] == 'Đăng nhập' && $_REQUEST['token'] == $_SESSION['token']) {
                  if ($_REQUEST['txtemail'] != '' && $_REQUEST['txtpass'] != '') {
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
                      unset($_SESSION['login_attempts_admin'][$user]);
                      unset($_SESSION['lock_time_admin'][$user]);
                      // Sau khi xử lý xong, xóa token khỏi session để tránh reuse
                      unset($_SESSION['token']);
                    } else {
                      if ($ad->checkTrung("select * from nhanvien where emailNV='$user'") == 0) {
                        echo '<script>swal("Thất bại","Tài khoản không tồn tại","error")</script>';
                      } else {
                        echo '<script>swal("Thất bại","Sai tài khoản hoặc mật khẩu","error")</script>';
                        // Tăng số lần thử đăng nhập
                        $_SESSION['login_attempts_admin'][$user] = isset($_SESSION['login_attempts_admin'][$user]) ? $_SESSION['login_attempts_admin'][$user] + 1 : 1;
                        if ($_SESSION['login_attempts_admin'][$user] >= $max_temp) {
                          $_SESSION['lock_time_admin'][$user] = time();
                          echo "<script>swal('Thất bại','Quá nhiều lần thử sai. Tài khoản $user đã bị khóa.','error');</script>";
                        } else {
                          $left = $max_temp - $_SESSION['login_attempts_admin'][$user];
                          echo "<script>swal('Thất bại','Sai tài khoản hoặc mật khẩu. Bạn còn $left lần thử.','error');</script>";
                        }
                      }
                    }
                  } else {
                    echo '<script>swal("Thất bại","Vui lòng nhập đầy đủ thông tin","error")</script>';
                  }
                } else if (isset($_POST['nut_dangNhap']) && $_REQUEST['nut_dangNhap'] == 'Đăng nhập' && $_REQUEST['token'] != $_SESSION['token']) {
                  echo '<script>swal("Thất bại","Không gửi lại form cũ","error")</script>';
                  unset($_SESSION['token']);
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