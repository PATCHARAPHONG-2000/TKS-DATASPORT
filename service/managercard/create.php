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
        respondError('Invalid or unreadable image format. Please upload a JPEG, PNG, or GIF file.');
    }

    try {
        $conn->beginTransaction();

        if ($check) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $fileImage)) {
                $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
                $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
                $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
                $other_status = $_POST['other_status'];
                $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_STRING);
                $other_department = $_POST['other_department'];

                $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

                if ($status == 'คณะกรรมการ กกท.' || $status == 'ผู้บริหาร กกท.ระดับสูง') {
                    $name_status = 'SAT';
                } elseif ($status == 'คณะกรรมการอำนวยการจัดการแข่งขัน' || $status == 'ผู้บริหาร กกท.') {
                    $name_status = 'A';
                } elseif ($status == 'หัวหน้าคณะนักกีฬา' || $status == 'รองหัวหน้าคณะนักกีฬา' || $status == 'พนักงาน' || $status == 'เจ้าหน้าที่ กกท.' || $status == 'คณะกรรมการจัดการแข่งขัน' || $status == 'ผู้บริหารสมาคมกีฬา') {
                    $name_status = 'B';
                } elseif ($status == 'คณะอนุกรรมการจัดการแข่งขันและเจ้าหน้าที่จัดการแข่งขัน') {
                    $name_status = 'C';
                } elseif ($status == 'กรรมการผู้ตัดสิน') {
                    $name_status = 'D';
                } elseif ($status == 'สื่อมวลชน') {
                    $name_status = 'E';
                } elseif ($status == 'นักกีฬา') {
                    $name_status = 'F';
                } elseif ($status == 'เจ้าหน้าที่ทีม') {
                    $name_status = 'Fo';
                } elseif ($status == 'อาสาสมัคร') {
                    $name_status = 'V';
                } elseif ($status == 'ผู้สังเกตการณ์') {
                    $name_status = 'O';
                } elseif ($status == 'ผู้ให้การสนับสนุน') {
                    $name_status = 'S';
                } elseif ($status == 'แขกรับเชิญ') {
                    $name_status = 'G';
                } else {
                    $name_status = ''; // Handle other cases if needed
                }


                $stmt = $conn->prepare("INSERT INTO personnel ( firstname, lastname, status, name_status, province, department, image) 
                VALUES (:firstname, :lastname, :status, :name_status, :province, :department, :image )");


                $stmt->bindParam(':province', $id_province, PDO::PARAM_STR);
                $stmt->bindParam(':firstname', $_POST['firstname'], PDO::PARAM_STR);
                $stmt->bindParam(':lastname', $_POST['lastname'], PDO::PARAM_STR);
                $stmt->bindParam(':status', $_POST['status'], PDO::PARAM_STR);
                $stmt->bindParam(':name_status', $name_status, PDO::PARAM_STR);
                $stmt->bindParam(':department', $_POST['department'], PDO::PARAM_STR);


                if ($status != 'อื่นๆ') {
                    $stmt->bindParam(':status', $status);
                } else if ($other_status) {
                    $stmt->bindParam(':status', $other_status);
                }

                if ($department != 'อื่นๆ') {
                    $stmt->bindParam(':department', $department, PDO::PARAM_STR);
                } elseif ($other_department) {
                    $stmt->bindParam(':department', $other_department, PDO::PARAM_STR);
                }
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