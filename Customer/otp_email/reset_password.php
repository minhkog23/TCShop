<?php
include '../../class/khachhang.php';
$khachhang = new khachhang();
?>
<?php
    session_start();
    if(!isset($_SESSION['otp_success'])) {
        header('location:../index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <form action="" method="POST">
        <label for="new_password">Enter new password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <input type="submit" value="Update Password">
    </form>
    <?php
    // reset-password.php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_password = $_REQUEST['new_password'];

        // Cập nhật mật khẩu trong cơ sở dữ liệu (giả lập cơ sở dữ liệu)
        if ($khachhang->themxoasua("update khachhang set matkhau='" . md5($new_password) . "' where email='" . $_SESSION['email_temp'] . "'") == 1) {
            echo '<script>
                            swal("Thành công","Đặt lại mật khẩu thành công","success").then(function(){
                            window.location="../index.php";
                            });
                            setTimeout(function(){
                                window.location="../index.php";
                            }, 2000);
                        </script>';
            exit();
        } else {
            echo 'Có lỗi xảy ra khi cập nhật mật khẩu.';
        }

        // Xóa session OTP và email
        unset($_SESSION['otp']);
        unset($_SESSION['email_temp']);
        unset($_SESSION['otp_success']);
    }
    ?>
</body>

</html>