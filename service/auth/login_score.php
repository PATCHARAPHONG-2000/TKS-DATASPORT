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
    $users = $_POST["user"];
    $password = $_POST["password"];

    try {
        // Check the role of the user in the users_t table
        $stmt = $conn->prepare("SELECT * FROM users_s WHERE users = :users");
        $stmt->bindParam(':users', $users);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // User exists in the users_t table, and the password is correct
                $_SESSION['AD_ID'] = $user['id'];
                $_SESSION['AD_USERNAME'] = $user['users'];
                $_SESSION['AD_ROLE'] = $user['Role'];

                $score = [
                    'KARATE',
                    'PCSL',
                    
                ];

                $SC = in_array($user['Role'], $score);

                if ($_SESSION['AD_ROLE'] == $SC) {
                    $_SESSION['id_Role'] = [
                        'Role' => $user['Role'],
                    ];
                    echo json_encode([
                        'status' => true,
                        'users' => 'userad',
                        'role' => $SC ? $user['Role'] : '',
                        'Role' => $_SESSION['id_Role']['Role'],
                        'message' => 'Admin Login Success'
                    ]);
                    exit();
               
                } else {
                    respondError('ไม่มีสิทธิ์เข้าใช้งาน');
                }
            } else {
                respondError('Incorrect password');
            }
        } else {
            respondError('ไม่มี Username นี้ในระบบ');
        }
    } catch (PDOException $e) {
        respondError("An error occurred. Please try again later.");
    }
}
?>
