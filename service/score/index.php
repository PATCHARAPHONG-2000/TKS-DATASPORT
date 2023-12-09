<?php
require_once '../connect.php';

$Database = new Database();
$conn = $Database->connect();

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

while (true) {
    $sql = $conn->prepare("SELECT * FROM data_score ORDER BY finalsum DESC");
    $sql->execute();
    $data = [];

    while ($score = $sql->fetch(PDO::FETCH_ASSOC)) {
        $data[] = [
            'id' => $score['id'],
            'firstname' => $score['firstname'],
            'lastname' => $score['lastname'],
            'finalsum' => $score['finalsum']
        ];
    }

    echo "data: " . json_encode($data) . "\n\n";
    ob_flush();
    flush();

}
?>
