<?php
ob_start();
header('Content-Type: application/json');

require_once '../connect.php';

$Database = new Database();
$conn = $Database->connect();

function respondError($message)
{
    echo json_encode(['error' => $message]);
    exit();
}

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$otp = filter_input(INPUT_POST, 'otp', FILTER_SANITIZE_STRING);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!$email) {
        respondError('Email ไม่ถูกต้อง');
    }

    $otp_generated = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    $_SESSION['otp'] = $otp_generated;
    $_SESSION['otp_expiry'] = time() + 600;
    $_SESSION['email'] = $email;

    $to = $email;
    $subject = "ยืนยันบัญชีสมาชิกด้วย OTP";
    $message = "ยินดีต้อนรับคุณ:<br>";
    $message .= "=================================<br>";
    $message .= "กรุณากรอก OTP นี้ในเว็บไซต์เพื่อยืนยัน: $otp_generated<br>";
    $message .= "=================================<br>";
    $message .= "YourSite.com<br>";

    $headers = "From: webmaster@yoursite.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=utf-8\r\n";

    if (!mail($to, $subject, $message, $headers)) {
        respondError("Failed to send OTP. Please try again.");
    }

    echo json_encode([
        'status' => true,
        'message' => 'Email successful'
    ]);
    exit();


}


