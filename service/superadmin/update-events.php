<?php
header('Content-Type: application/json');
require_once '../connect.php';

$Database = new Database();
$conn = $Database->connect();

// ดึงข้อมูลทั้งหมดจากฐานข้อมูล
$sql = "SELECT * FROM data_admin";
$stmt = $conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// วนลูปตรวจสอบและทำการอัปเดตตามเงื่อนไข
foreach ($data as $row) {
    $id = $row['id'];
    $end_time = new DateTime($row['end_time']);
    $now = new DateTime();

    // ตรวจสอบว่าถึงวันที่ end_time หรือไม่
    if ($now >= $end_time) {
        // ทำการอัปเดตค่า IsActive เป็น 0 และ create_time, end_time เป็น NULL
        $sqlUpdate = "UPDATE data_admin SET IsActive = 0, create_time = NULL, end_time = NULL WHERE id = :id";
        $stmtUpdate = $conn->prepare($sqlUpdate);
        $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);

        // ทำการอัปเดตเฉพาะในกรณีที่ไม่มีข้อผิดพลาด
        if ($stmtUpdate->execute()) {
            // ทำการเพิ่มข้อมูลการอัปเดตลงในตาราง log_update
            $sqlLog = "INSERT INTO log_update (admin_id, update_time) VALUES (:admin_id, NOW())";
            $stmtLog = $conn->prepare($sqlLog);
            $stmtLog->bindParam(':admin_id', $id, PDO::PARAM_INT);
            $stmtLog->execute();

            // สามารถเพิ่มข้อมูลอื่น ๆ ตามต้องการ

            // ส่งข้อมูล JSON กลับถ้าต้องการ
            echo json_encode(['success' => true, 'message' => 'อัปเดตข้อมูลเรียบร้อย']);
            exit();
        } else {
            // กรณีเกิดข้อผิดพลาดในการอัปเดต
            echo json_encode(['error' => 'ไม่สามารถอัปเดตข้อมูลได้']);
            exit();
        }
    }
}

// ถ้าไม่มีการอัปเดต
echo json_encode(['success' => true, 'message' => 'ไม่มีข้อมูลที่ต้องการอัปเดต']);
?>
