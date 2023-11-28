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


    // Check image format
    $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
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
                $province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
                $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_STRING);
                $other_department = $_POST['other_department'];
                $isActive = $_POST['isActive'];


                if ($_POST['status'] == 'คณะกรรมการ กกท.' || $_POST['status'] == 'ผู้บริหาร กกท.ระดับสูง') {
                    $name_status = 'SAT';
                } elseif ($_POST['status'] == 'คณะกรรมการอำนวยการจัดการแข่งขัน' || $_POST['status'] == 'ผู้บริหาร กกท.') {
                    $name_status = 'A';
                } elseif ($_POST['status'] == 'หัวหน้าคณะนักกีฬา' || $_POST['status'] == 'รองหัวหน้าคณะนักกีฬา' || $_POST['status'] == 'พนักงาน' || $_POST['status'] == 'เจ้าหน้าที่ กกท.' || $_POST['status'] == 'คณะกรรมการจัดการแข่งขัน' || $_POST['status'] == 'ผู้บริหารสมาคมกีฬา') {
                    $name_status = 'B';
                } elseif ($_POST['status'] == 'คณะอนุกรรมการจัดการแข่งขันและเจ้าหน้าที่จัดการแข่งขัน') {
                    $name_status = 'B';
                } elseif ($_POST['status'] == 'กรรมการผู้ตัดสิน') {
                    $name_status = 'C';
                } elseif ($_POST['status'] == 'สื่อมวลชน') {
                    $name_status = 'D';
                } elseif ($_POST['status'] == 'นักกีฬา') {
                    $name_status = 'E';
                } elseif ($_POST['status'] == 'เจ้าหน้าที่ทีม') {
                    $name_status = 'Fo';
                } elseif ($_POST['status'] == 'อาสาสมัคร') {
                    $name_status = 'V';
                } elseif ($_POST['status'] == 'ผู้สังเกตการณ์') {
                    $name_status = 'O';
                } elseif ($_POST['status'] == 'ผู้ให้การสนับสนุน') {
                    $name_status = 'S';
                } elseif ($_POST['status'] == 'แขกรับเชิญ') {
                    $name_status = 'G';
                } else {
                    $name_status = ''; // Handle other cases if needed
                }

                $stmt = $conn->prepare("INSERT INTO personnel ( firstname, lastname, status, name_status, province, department, image, IsActive) 
                VALUES ( :firstname, :lastname, :status, :name_status, :province,  :department, :image , :IsActive )");

                $stmt->bindParam(':firstname', $_POST['firstname'], PDO::PARAM_STR);
                $stmt->bindParam(':lastname', $_POST['lastname'], PDO::PARAM_STR);
                $stmt->bindParam(':status', $_POST['status'], PDO::PARAM_STR);
                $stmt->bindParam(':name_status', $name_status, PDO::PARAM_STR);
                $stmt->bindParam(':province', $_POST['province'], PDO::PARAM_STR);
                $stmt->bindParam(':department', $_POST['department'], PDO::PARAM_STR);
                $stmt->bindValue(':IsActive', $isActive == 'สมัครเรียบร้อย' ? 1 : 0, PDO::PARAM_INT);

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