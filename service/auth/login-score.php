<?php
session_start();

function respondError($message)
{
    echo json_encode(['error' => $message]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // สมมติว่าคุณมีการตรวจสอบชื่อผู้ใช้และรหัสผ่านที่นี่
    if ($username === 'SCKARATE' && $password === 'SCKARATE') {
        $_SESSION['AD_ROLE'] = 'KARATE';

        echo json_encode([
            'status' => true,
            'role' => 'KARATE',
            'message' => 'Login Success'
        ]);
    } else {
        respondError("Invalid username or password");
    }
}
?>
