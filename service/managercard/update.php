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

    $dir = "../uploads/";
    $fileImage = '';

    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // ผู้ใช้อัพโหลดรูปภาพใหม่
        $newFileName = time() . '_' . $_FILES['image']['name'];
        $fileImage = $dir . $newFileName;
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check) {
            if (!empty($fileImage)) {
                // ลบรูปภาพเดิม (ถ้ามี)
                $oldImage = getOldImageName($id, $conn); // ฟังก์ชันนี้ควรรีเทิร์นชื่อไฟล์รูปภาพเดิมจากฐานข้อมูล
                if (!empty($oldImage) && file_exists($dir . $oldImage)) {
                    unlink($dir . $oldImage);
                }

                if (!move_uploaded_file($_FILES["image"]["tmp_name"], $fileImage)) {
                    respondError('Error uploading the image');
                }
            }
        }
    }

    // คำสั่ง SQL ในการอัพเดตข้อมูลและภาพ
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);
    $other_status = $_POST['other_status'];
    $province = filter_input(INPUT_POST, 'province', FILTER_SANITIZE_STRING);
    $department = filter_input(INPUT_POST, 'department', FILTER_SANITIZE_STRING);
    $other_department = $_POST['other_department'];
    
    // เพิ่มส่วนนี้เพื่อตรวจสอบและกำหนดค่า $name_status
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

    $sql = "UPDATE `personnel` SET ";
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
        $sql .= "`status` = :status, `name_status` = :name_status";
        $params[':status'] = !empty($other_status) ? $other_status : $status;
        $params[':name_status'] = $name_status;
    }
    
    if (!empty($province)) {
        if (!empty($firstname) || !empty($lastname) || !empty($status) || !empty($other_status)) {
            $sql .= ", ";
        }
        $sql .= "`province` = :province";
        $params[':province'] = $province;
    }
    
    if (!empty($department) || !empty($other_department)) {
        if (!empty($firstname) || !empty($lastname) || !empty($status) || !empty($other_status) || !empty($province)) {
            $sql .= ", ";
        }
        $sql .= "`department` = :department";
        $params[':department'] = !empty($other_department) ? $other_department : $department;
    }
    
    if (!empty($fileImage)) {
        if (!empty($firstname) || !empty($lastname) || !empty($status) || !empty($other_status) || !empty($province) || !empty($department) || !empty($other_department)) {
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


function getOldImageName($id, $conn) {
    $sql = "SELECT `image` FROM `personnel` WHERE `id` = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && isset($result['image'])) {
        return $result['image'];
    }

    return ''; // ถ้าไม่มีรูปภาพเดิมหรือเกิดข้อผิดพลาดในการดึงข้อมูล
}

?>
