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
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id === false || $id <= 0) {
        respondError('Invalid ID');
    }

    $dir = "../uploadsport/";
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
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
    $province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);

    $sql = "UPDATE `sport` SET ";
    $params = [];

    if (!empty($firstname)) {
        $sql .= "`firstname` = :firstname";
        $params[':firstname'] = $firstname;
    }

    if (!empty($lastname)) {
        if (!empty($firstname)) {
            $sql .= ", ";
        }
        $sql .= "`lastname` = :lastname";
        $params[':lastname'] = $lastname;
    }

    if (!empty($status) || !empty($other_status)) {
        if (!empty($firstname) || !empty($lastname)) {
            $sql .= ", ";
        }
        $sql .= "`status` = :status";
        $params[':status'] = $status;

    }

    if (!empty($province)) {
        if (!empty($firstname) || !empty($lastname) || !empty($status) || !empty($other_status)) {
            $sql .= ", ";
        }
        $sql .= "`province` = :province";
        $params[':province'] = $province;
    }

    if (!empty($fileImage)) {
        if (!empty($firstname) || !empty($lastname) || !empty($status) || !empty($other_status) || !empty($province)) {
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
    $sql = "SELECT `image` FROM `personnel` WHERE `id` = :id";
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