<!-- header -->
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
                <button type="submit" name="nut_dangnhap" value="Đăng nhập" class="btn btn-primary w-100" style="background-color:#4479d4">Đăng nhập</button>
                <div align="center">
                    <?php
                    if (isset($_REQUEST['nut_dangnhap']) && $_REQUEST['nut_dangnhap'] == 'Đăng nhập') {
                        $user = $_REQUEST['txtemail'];
                        $pass = $_REQUEST['txtpwd'];
                        if ($p->mylogin($user, md5($pass)) != 1) {
                            echo '<script>swal("Thất bại","Sai tài khoản hoặc mật khẩu","error")</script>';
                        } else {
                            echo '<script>
                                    swal("Thành công","Đăng nhập thành công","success").then(function(){
                                                window.location="index.php";
                                    });
                                    setTimeout(function(){
                                        window.location="index.php";
                                    }, 2000);
                                                    
                                </script>';
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- footer -->
<?php include_once 'component/footer.php' ?>