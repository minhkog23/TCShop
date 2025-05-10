<?php
session_start();
include '../../class/khachhang.php';
$khachhang = new khachhang();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <form action="" method="POST">
        <label for="email">Enter your email:</label>
        <input type="email" id="email" name="email" required>
        <input type="submit" value="Send OTP">
    </form>
    <?php
    // index.php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_REQUEST['email'];
        // Kiểm tra email tồn tại trong hệ thống (giả lập cơ sở dữ liệu)
        $users = $khachhang->laycot_lap("select email from khachhang");

        if (in_array($email, $users)) {
            // Gửi OTP qua email
            include 'send_email.php';
            $otp = generateOtp();
            sendOtpEmail($email, $otp);
            
            // Lưu OTP vào session
            session_start();
            $_SESSION['otp'] = $otp;
            $_SESSION['otp_time'] = time();
            $_SESSION['email_temp'] = $email;
            header('Location: verify_otp.php');
            exit();
        } else {
            echo 'Email not found in the system.';
        }
    }
    ?>
</body>
</html>
