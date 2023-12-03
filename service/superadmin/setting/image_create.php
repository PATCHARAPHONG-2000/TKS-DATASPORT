<?php
header('Content-Type: application/json');
require_once '../../connect.php';

$Database = new Database();
$conn = $Database->connect();

function respondError($message)
{
    echo json_encode(['error' => $message]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imageon = filter_input(INPUT_POST, 'imageon', FILTER_SANITIZE_STRING);
    $isActive = filter_input(INPUT_POST, 'isActive', FILTER_SANITIZE_NUMBER_INT);

    // ตรวจสอบว่า imageon และ isActive มีค่า
    if ($imageon !== null && $isActive !== null) {
        // SQL query ในการอัปเดตข้อมูล
        $sql = "UPDATE data_all SET IsActive = :isActive WHERE id = :image";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':image', $imageon, PDO::PARAM_INT);
        $stmt->bindParam(':isActive', $isActive, PDO::PARAM_INT);

        $result = $stmt->execute();

        if ($result) {
            // ตอบกลับด้วย JSON
            echo json_encode([
                'status' => true,
                'message' => 'Data updated successfully'
            ]);
        } else {
            // ถ้ามีข้อผิดพลาดในการ execute SQL
            respondError('Error updating data');
        }
    } else {
        // ถ้า imageon หรือ isActive ไม่ได้รับค่า
        respondError('Invalid imageon or isActive');
    }
} else {
    // ถ้าไม่ใช่ POST request
    http_response_code(400);
    echo json_encode([
        'status' => false,
        'message' => 'Invalid request'
    ]);
}
?>
