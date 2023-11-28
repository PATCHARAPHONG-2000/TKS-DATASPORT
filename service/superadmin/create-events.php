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
    $events = filter_input(INPUT_POST, 'events', FILTER_SANITIZE_STRING);
    $area = filter_input(INPUT_POST, 'area', FILTER_SANITIZE_STRING);
    $create_time = filter_input(INPUT_POST, 'createtime', FILTER_SANITIZE_STRING);
    $end_time = filter_input(INPUT_POST, 'endtime', FILTER_SANITIZE_STRING);

    // ตรวจสอบว่า events และ area มีค่า
    if ($events !== null && $area !== null && $create_time !== null && $end_time !== null) { 
        // SQL query ในการอัปเดตข้อมูล
        $sql = "UPDATE data_admin SET IsActive = 1, create_time = :create_time, end_time = :end_time WHERE events = :events AND area = :area";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':events', $events, PDO::PARAM_STR);
        $stmt->bindParam(':area', $area, PDO::PARAM_STR);
        $stmt->bindParam(':create_time', $create_time, PDO::PARAM_STR);
        $stmt->bindParam(':end_time', $end_time, PDO::PARAM_STR);

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
        // ถ้า events หรือ area ไม่ได้รับค่า
        respondError('Invalid events or area');
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
