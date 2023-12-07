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
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id === false || $id <= 0) {
        respondError('Invalid ID');
    }

    $dir = "../uploads/";
    $fileImage = '';

    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // User has uploaded a new image
        $newFileName = time() . '_' . $_FILES['image']['name'];
        $fileImage = $dir . $newFileName;
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check) {
            if (!empty($fileImage)) {
                // Delete the old image (if any)
                $oldImage = getOldImageName($id, $conn);
                if (!empty($oldImage) && file_exists($dir . $oldImage)) {
                    unlink($dir . $oldImage);
                }

                if (!move_uploaded_file($_FILES["image"]["tmp_name"], $fileImage)) {
                    respondError('Error uploading the image');
                }
            }
        }
    }

    // SQL statement for updating data and image
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

    $sql = "UPDATE `data_all` SET ";
    $params = [];

    if (!empty($name)) {
        $sql .= "`name` = :name";
        $params[':name'] = $name;
    }

    if (!empty($fileImage)) {
        if (!empty($name)) {
            $sql .= ", ";
        }
        $sql .= "`image` = :image";
        $params[':image'] = $fileImage;
    }

    $sql .= " WHERE `id` = :id";
    $params[':id'] = $id;

    $stmt = $conn->prepare($sql);

    if ($stmt->execute($params)) {
        echo json_encode([
            'status' => true,
            'message' => 'Update successful'
        ]);
    } else {
        respondError('Failed to update the record');
    }
}

function getOldImageName($id, $conn)
{
    $sql = "SELECT `image` FROM `data_all` WHERE `id` = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['image'])) {
        return $result['image'];
    }

    return ''; // Return empty if no old image or an error occurred fetching data
}
?>
