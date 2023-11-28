<?php
/**
 * AppzStory Back Office Management System Template
 * Delete Api
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
header('Content-Type: application/json');
require_once '../connect.php';

$Database = new Database();
$conn = $Database->connect();

function respondError($message)
{
    echo json_encode(['error' => $message]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id === false || $id <= 0) {
        // กรณี ID ไม่ถูกต้อง
        http_response_code(400);
        echo json_encode(['status' => false, 'message' => 'Invalid ID']);
        exit();
    }

    $stmt = $conn->prepare("SELECT `image` FROM `personnel` WHERE `id` = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $imageToDelete = $result['image'];

        // ลบรูปภาพเดิม (ถ้ามี)
        if (!empty($imageToDelete) && file_exists('../uploads/' . $imageToDelete)) {
            unlink('../uploads/' . $imageToDelete);
        }

        // ลบข้อมูลจากฐานข้อมูล
        $deleteStmt = $conn->prepare("DELETE FROM `personnel` WHERE `id` = :id");
        $deleteStmt->bindParam(':id', $id);
        if ($deleteStmt->execute()) {
            // การลบสำเร็จ
            http_response_code(204);
            echo json_encode(['status' => true, 'message' => 'Delete Success']);
        } else {
            // การลบล้มเหลว
            http_response_code(500);
            echo json_encode(['status' => false, 'message' => 'Delete Failed']);
        }
    } else {
        // ไม่พบข้อมูลที่ต้องการลบ
        http_response_code(404);
        echo json_encode(['status' => false, 'message' => 'Data not found']);
    }
} else {
    // ID หรือคำขอไม่ถูกต้อง
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Invalid request']);
}
?>
