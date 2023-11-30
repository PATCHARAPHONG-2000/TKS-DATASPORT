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
    $dir = "../uploads/";

    $newFileName = time() . '_' . $_FILES['image']['name'];
    $fileImage = $dir . $newFileName;
    $check = getimagesize($_FILES['image']['tmp_name']);

    if (isset($_SESSION['id_city'])) {
        $id_province = $_SESSION['id_city']['province'];
    } else {
        $id_province = 'default_status';
    }

    // Check image format
    $allowedImageTypes = ['image/jpeg', 'image/png'];
    if (!$check || !in_array($check['mime'], $allowedImageTypes)) {
        respondError('Invalid or unreadable image format. Please upload a JPEG, PNG,.');
    }

    try {
        $conn->beginTransaction();

        if ($check) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $fileImage)) {
                $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
                $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
                $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                $name_status = filter_input(INPUT_POST, 'identity', FILTER_SANITIZE_STRING);

                $stmt = $conn->prepare("INSERT INTO personnel ( firstname, lastname, status, name_status,  province, image) 
                VALUES (:firstname, :lastname, :status, :name_status, :province, :image )");

                $stmt->bindParam(':province', $id_province, PDO::PARAM_STR);
                $stmt->bindParam(':firstname', $_POST['firstname'], PDO::PARAM_STR);
                $stmt->bindParam(':lastname', $_POST['lastname'], PDO::PARAM_STR);
                $stmt->bindParam(':status', $_POST['status'], PDO::PARAM_STR);
                $stmt->bindParam(':name_status', $_POST['identity'], PDO::PARAM_STR);
                $stmt->bindParam(':image', $fileImage);
                $stmt->execute();
                $conn->commit();

                echo json_encode([
                    'status' => true,
                    'message' => 'Registration successful'
                ]);
                exit();

            } else {
                respondError('Error uploading image');
            }
        } else {
            respondError('Invalid or unreadable image');
        }

    } catch (Exception $e) {
        $conn->rollBack();
        respondError('Transaction failed: ' . $e->getMessage());
    }
} else {
    respondError('Invalid request method');
}
?>