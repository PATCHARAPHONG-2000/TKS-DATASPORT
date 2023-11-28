<?php

ob_start();
require_once '../connect.php';

$Database = new Database();
$conn = $Database->connect();

function respondError($message)
{
    echo json_encode(['error' => $message]);
    exit();
}

$tell = "081-2345678";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["firstName"], $_POST["lastname"], $_POST["team"], $_POST["gender"], $_POST["email"], $_POST["tell"], $_POST["password"], $_POST["c_password"])) {
        respondError('ข้อมูลไม่ครบถ้วน');
    }

    $firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $team = filter_input(INPUT_POST, 'team', FILTER_SANITIZE_STRING);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $tell = filter_input(INPUT_POST, 'tell', FILTER_SANITIZE_NUMBER_INT);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $c_password = filter_input(INPUT_POST, 'c_password', FILTER_SANITIZE_STRING);


    if (!$email) {
        respondError('Email ไม่ถูกต้อง');
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        respondError("มีอีเมลนี้อยู่ในระบบแล้ว");
    } elseif (!preg_match('/^0[0-9]+$/', $tell)) {
        respondError('รูปแบบเบอร์โทรไม่ถูกต้อง');
    } elseif (strlen($password) < 8 || strlen($password) > 20) {
        respondError('รหัสผ่านต้องมีความยาวระหว่าง 8 ถึง 20 ตัวอักษร');
    } elseif ($password != $c_password) {
        respondError('รหัสผ่านไม่ตรงกัน');
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

    $_SESSION['otp'] = $otp;
    $_SESSION['otp_expiry'] = time() + 600;
    $_SESSION['registration_data'] = [
        'firstName' => $firstName,
        'lastname' => $lastname,
        'team' => $team,
        'gender' => $gender,
        'email' => $email,
        'tell' => $tell,
        'password' => $hashed_password,
        
    ];


    $to = $email;
    $subject = "ยืนยันบัญชีสมาชิกด้วย OTP";
    $message = "ยินดีต้อนรับ: $firstName $lastname<br>";
    $message .= "=================================<br>";
    $message .= "กรุณากรอก OTP นี้ในเว็บไซต์เพื่อยืนยัน: $otp<br>";
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
        'message' => 'Please check your email for the OTP'
    ]);
    exit();

}

ob_end_flush();

?>