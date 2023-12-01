<?php
header('Content-Type: application/json');

$response = [
    'status' => false,
    'message' => 'An error occurred',
    'response' => []
];

require_once '../connect.php'; // ปรับเส้นทางตามความเหมาะสม

$Database = new Database();
$connect = $Database->connect();

if ($connect) { 
    if (isset($_SESSION['id_city'])) {
        $userStatus = $_SESSION['id_city']['province']; // เช็ค session สำหรับสถานะผู้ใช้

        $query = 'SELECT * FROM personnel WHERE province = :userStatus';
        $stmt = $connect->prepare($query);
        $stmt->bindParam(':userStatus', $userStatus);
        $stmt->execute();

        if ($stmt) {
            $data = array();
            foreach ($stmt->fetchAll() as $row) {
                $data[] = [
                    'id' => $row['id'], 
                    'firstname' => $row['firstname'],
                    'lastname' => $row['lastname'],
                    'status' => $row['status'],
                    'sector' => $row['sector'],
                    'province' => $row['province'],
                    'image' => $row['image'],
                    'IsActive'=> $row['IsActive'],
                    
                ];
            }

            $response = [
                'status' => true,
                'message' => 'Get Data Manager Success',
                'response' => $data
            ];
        } else {
            $response['message'] = 'Failed to retrieve data from the database';
        }
    } else {
        $response['message'] = 'User is not logged in'; // หรือข้อความที่คุณต้องการสำหรับผู้ใช้ที่ไม่ได้ล็อกอิน
    }
}

echo json_encode($response);
?>
