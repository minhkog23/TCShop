<?php
// send-email.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
use Dotenv\Dotenv;
// Đọc file .env
$dotenv = Dotenv::createImmutable('D:/xampp/htdocs/TCShop/');
$dotenv->load();

function sendOtpEmail($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        // Cấu hình máy chủ SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['GMAIL_USERNAME'];
        $mail->Password = $_ENV['GMAIL_APP_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Người gửi và người nhận
        $mail->setFrom('nguyenminhcong2302@gmail.com', 'TC Badminton');
        $mail->addAddress($email);

        // Nội dung email
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP code for password reset';
        $mail->Body    = "Your OTP code is: <b>{$otp}</b>";

        // Gửi email
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

function generateOtp() {
    return rand(100000, 999999);  // Tạo OTP ngẫu nhiên
}
?>
