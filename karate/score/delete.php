<?php
require_once('../authen.php');

$Database = new Database();
$conn = $Database->connect();

// ตรวจสอบว่ามีคำสั่ง POST ที่ส่งมาหรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ชื่อตารางที่ต้องการลบข้อมูล
    $tableName = "data_score";

    // คำสั่ง SQL สำหรับลบข้อมูลทั้งหมดในตาราง
    $sql = $conn->prepare("DELETE FROM $tableName");
    $result = $sql->execute();

    if ($result) {
        // ลบข้อมูลสำเร็จ
        echo json_encode(array('message' => "ลบข้อมูลในตาราง $tableName เรียบร้อยแล้ว"));
    } else {
        // เกิดข้อผิดพลาดในการลบข้อมูล
        echo json_encode(array('message' => "เกิดข้อผิดพลาดในการลบข้อมูลในตาราง $tableName"));
    }
}
?>
