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

    $query = 'SELECT * FROM data_admin ';
    $stmt = $connect->prepare($query);
    $stmt->execute();

    if ($stmt) {
        $data = array();
        foreach ($stmt->fetchAll() as $row) {
            $data[] = [
                'id' => $row['id'],
                'events' => $row['events'],
                'area' => $row['area'],
                'create_time' => $row['create_time'],
                'end_time' => $row['end_time'],
                'IsActive' => $row['IsActive'],
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

}

echo json_encode($response);
?>