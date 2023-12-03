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
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    // ตรวจสอบว่า id มีค่า
    if ($id !== null) {
        // ดึงข้อมูลรูปภาพจากฐานข้อมูลเพื่อหาที่อยู่ของไฟล์
        $sqlSelect = "SELECT * FROM data_all WHERE id = :id";
        $stmtSelect = $conn->prepare($sqlSelect);
        $stmtSelect->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtSelect->execute();
        $row = $stmtSelect->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // ลบข้อมูลจากฐานข้อมูล
            $sqlDelete = "DELETE FROM data_all WHERE id = :id";
            $stmtDelete = $conn->prepare($sqlDelete);
            $stmtDelete->bindParam(':id', $id, PDO::PARAM_INT);
            $resultDelete = $stmtDelete->execute();

            if ($resultDelete) {
                // ลบไฟล์รูปภาพที่อยู่ใน plat
                $imagePath = '../uploads/' . $row['image'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }

                // ตอบกลับด้วย JSON
                echo json_encode([
                    'status' => true,
                    'message' => 'Data and image deleted successfully'
                ]);
            } else {
                // ถ้ามีข้อผิดพลาดในการ execute SQL
                respondError('Error deleting data');
            }
        } else {
            respondError('Image not found');
        }
    } else {
        // ถ้า id ไม่ได้รับค่า
        respondError('Invalid id');
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
