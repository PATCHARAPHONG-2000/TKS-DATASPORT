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

    $query = 'SELECT * FROM sport ';
    $stmt = $connect->prepare($query);
    $stmt->execute();

    if ($stmt) {
        $data = array();
        foreach ($stmt->fetchAll() as $row) {
            $data[] = [
                'id' => $row['id'],
                'firstname' => $row['firstname'],
                'lastname' => $row['lastname'],
                'status' => $row['status'],
                'province' => $row['province'],
                'image' => $row['image'],
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