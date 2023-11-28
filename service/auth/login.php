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

        // ตรวจสอบบทบาทของผู้ใช้ในตาราง users-t
        $stmtT = $conn->prepare("SELECT * FROM users_t WHERE email = :email");
        $stmtT->bindParam(':email', $email);
        $stmtT->execute();

        $userT = $stmtT->fetch(PDO::FETCH_ASSOC);

        if ($user || $userT) {
            if ($user && password_verify($password, $user['password'])) {
                // ผู้ใช้มีในตาราง users และรหัสผ่านถูกต้อง
                $_SESSION['AD_ID'] = $user['id'];
                $_SESSION['AD_USERNAME'] = $user['email'];

                echo json_encode([
                    'status' => true,
                    'email' => 'admin',
                    // เปลี่ยนเป็น 'admin'
                    'message' => 'Admin Login Success'
                ]);
                exit();
            } elseif ($userT && password_verify($password, $userT['password'])) {
                // ตรวจสอบ Role ของผู้ใช้ในตาราง users_t

                $_SESSION['AD_ID'] = $userT['id'];
                $_SESSION['AD_USERNAME'] = $userT['email'];
                $_SESSION['AD_ROLE'] = $userT['Role'];

                if ($_SESSION['AD_ROLE'] == 'superadmin') {

                    echo json_encode([
                        'status' => true,
                        'email' => 'admin-t',
                        'role' => 'superadmin',
                        'message' => 'Admin Login Success'
                    ]);
                    exit();
                } else if ($_SESSION['AD_ROLE'] == 'admin') {
                    echo json_encode([
                        'status' => true,
                        'email' => 'admin-t',
                        'role' => 'admin',
                        'message' => 'Admin Login Success'
                    ]);
                    exit();
                } else if ($_SESSION['AD_ROLE'] == 'karate') {
                    echo json_encode([
                        'status' => true,
                        'email' => 'admin-t',
                        'role' => 'karate',
                        'message' => 'Admin Login Success'
                    ]);
                    exit();
                } else if ($_SESSION['AD_ROLE'] == 'pencak') {
                    echo json_encode([
                        'status' => true,
                        'email' => 'admin-t',
                        'role' => 'pencak',
                        'message' => 'Admin Login Success'
                    ]);
                    exit();
                } else {

                    respondError('ไม่มีสิทธิ์เข้าใช้งาน');
                }

            } else {
                respondError('รหัสผ่านไม่ถูกต้อง กรุณากรอกรหัสผ่านอีกครั้ง');
            }
        } else {
            respondError('ไม่พบอีเมลนี้ในระบบ กรุณากรอกอีเมลอีกครั้ง');
        }
    } catch (PDOException $e) {
        respondError("Database Error: " . $e->getMessage());
    }
}
