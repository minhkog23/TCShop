<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
    <form action="" method="POST">
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <input type="submit" value="Verify OTP">
    </form>
    <?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $otp_input = $_REQUEST['otp'];

        // Kiểm tra xem OTP đã hết hạn chưa (3 phút = 180 giây)
        $otp_expiry_time = 3*60;  // 3 phút

        if (time() - $_SESSION['otp_time'] > $otp_expiry_time) {
            echo 'OTP đã hết hạn. Vui lòng yêu cầu mã OTP mới.';
            // Xử lý khi OTP hết hạn, có thể yêu cầu người dùng yêu cầu OTP mới
            unset($_SESSION['otp']);
            unset($_SESSION['otp_time']);
            unset($_SESSION['email_temp']);
        } else {
            // Kiểm tra xem OTP người dùng nhập có đúng không
            if ($otp_input == $_SESSION['otp']) {
                echo 'OTP đã đúng.';
                header('Location: reset_password.php');
                exit();
            } else {
                echo 'Mã OTP không đúng vui lòng kiểm tra lại.';
            }
        }
    }
    ?>
</body>

</html>