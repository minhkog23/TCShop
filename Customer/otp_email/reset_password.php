<?php
include '../../class/khachhang.php';
$khachhang = new khachhang();
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
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_password = $_REQUEST['new_password'];

        // Cập nhật mật khẩu trong cơ sở dữ liệu (giả lập cơ sở dữ liệu)
        if ($khachhang->themxoasua("update khachhang set matkhau='" . md5($new_password) . "' where email='" . $_SESSION['email_temp'] . "'") == 1) {
            echo 'Mật khẩu đã được cập nhật thành công.';
            // Chuyển hướng về trang đăng nhập
            header('Location: ../login.php');
            exit();
        } else {
            echo 'Có lỗi xảy ra khi cập nhật mật khẩu.';
        }

        // Xóa session OTP và email
        unset($_SESSION['otp']);
        unset($_SESSION['email']);
    }
    ?>
</body>

</html>