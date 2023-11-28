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

    if (isset($_POST['idc'], $_POST['eventsname'], $_POST['areaname'])) {
        $idc = $_POST['idc'];
        $eventsname = $_POST['eventsname'];
        $areaname = $_POST['areaname'];

        // ทำการทำ SQL UPDATE
        $sql = "UPDATE personnel SET IsActive = 1, area_name = :area_name, areas = :areas, events_name = :events_name, events = :events  WHERE id IN (" . implode(',', $idc) . ")";
        $stmt = $conn->prepare($sql);

        // Adjust conditions for $_POST['eventsname']
        if ($_POST['eventsname'] == 'รอบคัดภาค') {
            $area_name = $eventsname;
            $events_name = null; // Set to null to avoid conflicts
        } elseif ($_POST['eventsname'] !== 'รอบคัดภาค') {
            $events_name = $eventsname;
            $area_name = null; // Set to null to avoid conflicts
        } else {
            $area_name = null; // Handle other cases if needed
            $events_name = null;
        }
        
        if ($_POST['areaname'] == 'รอบคัดภาค 1') {
            $areas = $areaname;
            $events = null; // Set to null to avoid conflicts
        } elseif ($_POST['areaname'] !== 'รอบคัดภาค 1') {
            $events = $areaname;
            $areas = null; // Set to null to avoid conflicts
        } else {
            $areas = null; // Handle other cases if needed
            $events = null;
        }

        // Bind parameters
        $stmt->bindParam(':area_name', $area_name, PDO::PARAM_STR);
        $stmt->bindParam(':events_name', $events_name, PDO::PARAM_STR); // Correctly bind events_name
        $stmt->bindParam(':areas', $areas, PDO::PARAM_STR);
        $stmt->bindParam(':events', $events, PDO::PARAM_STR);
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
        // ถ้าไม่มีค่า idc หรือ eventsname หรือ areaname ถูกส่งมา
        respondError('Missing idc, eventsname, or areaname parameter');
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
