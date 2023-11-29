<?php

header('Content-Type: application/json');
require_once '../connect.php';

$Database = new Database();
$conn = $Database->connect();

function respondError($message)
{
    echo json_encode(['error' => $message]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        // ตรวจสอบบทบาทของผู้ใช้ในตาราง users
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // ผู้ใช้มีในตาราง users และรหัสผ่านถูกต้อง
                $_SESSION['AD_ID'] = $user['id'];
                $_SESSION['AD_USERNAME'] = $user['email'];

                echo json_encode([
                    'status' => true,
                    'email' => 'admin', // เปลี่ยนเป็น 'admin' หรือบทบาทที่เหมาะสม
                    'message' => 'Login Success'
                ]);
                exit();
            } else {
                respondError('รหัสผ่านไม่ถูกต้อง');
            }
        } else {
            respondError('ไม่พบอีเมลนี้ในระบบ กรุณากรอกอีเมลที่ถูกต้อง');
        }
    } catch (PDOException $e) {
        respondError("เกิดข้อผิดพลาดในฐานข้อมูล: กรุณาลองอีกครั้งภายหลัง");
    }
}
