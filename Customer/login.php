<!-- header -->
<?php
include '../class/badminton.php';
$kh = new badminton();
?>
<?php
session_start();
// token
// $token =bin2hex(random_bytes(32)); chỉ hổ trợ php 7.0 trở lên
// Đặt ở đầu file PHP, trước khi xuất HTML
if (!isset($_SESSION['token'])) {
    //$_SESSION['token'] = bin2hex(random_bytes(32));//
    $_SESSION['token'] = md5(uniqid(rand(), true)); // Hoặc sử dụng hàm md5 để tạo token
}
$token = $_SESSION['token'];
?>
<?php
$pageTitle = 'Đăng nhập';
include_once 'component/header.php';
?>
<link rel="stylesheet" href="../assets/css/login_KH.css">
<div class="container mt-5">
    <div class="box row">
        <div class="box-login" align="center">
            <h3>Đăng nhập</h3>
            <form id="form_login" method="post">
                <div class="form-group mt-3 mb-3">
                    <label for="txtemail">Email <span style="color:red">*</span></label>
                    <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="Nhập địa chỉ email" required>
                </div>
                <div class="form-group mb-3">
                    <label for="txtpwd">Mật khẩu <span style="color:red">*</span></label>
                    <input type="password" class="form-control" id="txtpwd" name="txtpwd" placeholder="Nhập mật khẩu" required>
                </div>
                <p align="right">Nếu bạn chưa có tài khoản? <a href="signup.php">Đăng ký</a></p>
                <p align="right">Quên mật khẩu? <a href="otp_email/forgot_pass.php">Lấy lại mật khẩu</a></p>
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
                <button type="submit" name="nut_dangnhap" value="Đăng nhập" class="btn btn-primary w-100" style="background-color:#4479d4">Đăng nhập</button>

                <div align="center" style="color: red; margin: 10px 0px;">
                    <?php
                    // Thiết lập số lần thử tối đa
                    $max_temp = 3;
                    $lock_time = 5 * 60; // 5 phút

                    $user = isset($_REQUEST['txtemail']) ? $_REQUEST['txtemail'] : '';

                    // Kiểm tra nếu tài khoản này đã bị khóa
                    if ($user && isset($_SESSION['lock_time'][$user]) && time() - $_SESSION['lock_time'][$user] < $lock_time) {
                        //echo "Tài khoản $user đã bị khóa. Vui lòng thử lại sau " . ($lock_time - (time() - $_SESSION['lock_time'][$user])) . " giây.";
                        echo "<script>swal('Thất bại','Tài khoản $user đã bị khóa. Vui lòng thử lại sau " . ($lock_time - (time() - $_SESSION['lock_time'][$user])) . " giây.','error');</script>";
                        unset($_SESSION['login_attempts'][$user]);
                        unset($_SESSION['lock_time'][$user]);
                    } else if (isset($_REQUEST['nut_dangnhap']) && $_REQUEST['nut_dangnhap'] == 'Đăng nhập' && $_REQUEST['token'] == $_SESSION['token']) {
                        $pass = $_REQUEST['txtpwd'];
                        if ($p->mylogin($user, md5($pass)) != 1) {
                            if ($kh->checkTrung("select * from khachhang where email='$user'") == 0) {
                                echo '<script>swal("Thất bại","Tài khoản không tồn tại","error")</script>';
                            } else {
                                $_SESSION['login_attempts'][$user] = isset($_SESSION['login_attempts'][$user]) ? $_SESSION['login_attempts'][$user] + 1 : 1;
                                // Nếu số lần thử vượt quá giới hạn, khóa tài khoản này
                                if ($_SESSION['login_attempts'][$user] >= $max_temp) {
                                    $_SESSION['lock_time'][$user] = time();
                                    //echo "Quá nhiều lần thử sai. Tài khoản $user đã bị khóa.";
                                    echo "<script>swal('Thất bại','Quá nhiều lần thử sai. Tài khoản $user đã bị khóa.','error');</script>";
                                } else {
                                    //echo "Tên đăng nhập hoặc mật khẩu sai. Bạn còn " . ($max_temp - $_SESSION['login_attempts'][$user]) . " lần thử.";
                                    echo "<script>swal('Thất bại','Tên đăng nhập hoặc mật khẩu sai. Bạn còn " . ($max_temp - $_SESSION['login_attempts'][$user]) . " lần thử.','error');</script>";
                                }
                            }
                        } 
                        else {
                            echo '<script>
                                    swal("Thành công","Đăng nhập thành công","success").then(function(){
                                        window.location="index.php";
                                    });
                                    setTimeout(function(){
                                        window.location="index.php";
                                    }, 2000);           
                                </script>';
                            unset($_SESSION['login_attempts'][$user]);
                            unset($_SESSION['lock_time'][$user]);
                        }
                        // Sau khi xử lý xong, xóa token khỏi session để tránh reuse
                        unset($_SESSION['token']);
                    } else if (isset($_REQUEST['nut_dangnhap']) && $_REQUEST['nut_dangnhap'] == 'Đăng nhập' && $_REQUEST['token'] == $_SESSION['token']) {
                        echo '<script>swal("Thất bại","Vui lòng nhập đầy đủ thông tin","error")</script>';
                    } else if (isset($_REQUEST['nut_dangnhap']) && $_REQUEST['nut_dangnhap'] == 'Đăng nhập' && $_REQUEST['token'] != $_SESSION['token']) {
                        echo '<script>swal("Thất bại","Không gửi lại form cũ","error")</script>';
                        unset($_SESSION['token']);
                    }

                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- footer -->
<?php include_once 'component/footer.php' ?>