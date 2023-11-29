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

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['id_province'])) {
            $id_province = $_POST['id_province'];

            $stmt_province = $conn->prepare("SELECT pin FROM data_id WHERE province = :province");
            $stmt_province->bindParam(':province', $id_province, PDO::PARAM_STR);
            $stmt_province->execute();

            $data_province = $stmt_province->fetch(PDO::FETCH_ASSOC);

            if ($data_province) {
                // บันทึกข้อมูลที่ได้จากการเลือกจังหวัดลงใน SESSION
                $_SESSION['id_city'] = [
                    'province' => $id_province,
                    'pin' => $data_province['pin'],
                ];

                echo json_encode([
                    'status' => true,
                    'message' => 'Success',
                ]);
                exit();
            } else {
                
                echo json_encode([
                    'status' => false,
                    'message' => 'PIN ไม่ถูกต้อง',
                ]);
                exit();
            }
        } elseif (isset($_POST['pin'], $_SESSION['id_city'])) {
            if (isset($_POST['pin'], $_SESSION['id_city'])) {
                // รับค่า $_POST['pin'] เป็นตัวอักษร (string)
                $submitted_pin = $_POST['pin'];
                $id_city = $_SESSION['id_city'];

                // เปรียบเทียบ PIN ที่ผู้ใช้ป้อนกับ PIN ที่บันทึกใน SESSION
                if ($submitted_pin == $id_city['pin']) {
                    echo json_encode([
                        'status' => true,
                        'message' => 'Success',
                    ]);
                    exit();
                } else {
                    echo json_encode([
                        'status' => false,
                        'message' => 'PIN ไม่ถูกต้อง',
                    ]);
                    exit();
                }
            } else {
                echo json_encode([
                    'status' => false,
                    'message' => 'กรุณาเลือกจังหวัด'
                ]);
                exit();
            }
        }
    }
} catch (Exception $e) {
    respondError("เกิดข้อผิดพลาด: " . $e->getMessage());
}
?>