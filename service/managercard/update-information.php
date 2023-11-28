<?php
header('Content-Type: application/json');
require_once '../connect.php';

$Database = new Database();
$conn = $Database->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    // ตรวจสอบว่า ID ถูกส่งมาหรือไม่
    if (!empty($id)) {
        // ทำการอัปเดตค่า IsActive เป็น 1
        $sql = "UPDATE personnel SET IsActive = 0, area_name = NULL, areas = NULL,events_name = NULL, events = NULL WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'อัปเดตข้อมูลเรียบร้อย']);
            exit();
        } else {
            echo json_encode(['error' => 'ไม่สามารถอัปเดตข้อมูลได้']);
            exit();
        }
    } else {
        echo json_encode(['error' => 'ไม่ได้รับข้อมูล ID']);
        exit();
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
    exit();
}
?>