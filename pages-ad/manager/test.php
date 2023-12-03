<?php
require_once('../authen.php');
$Database = new Database();
$conn = $Database->connect();

require_once __DIR__ . '../../../assets/vendor/MPDF/autoload.php';

$id = $_GET['id'];

$params = array('id' => $id);
$selectbyidUser = $conn->prepare("SELECT * FROM personnel WHERE id = :id");
$selectbyidUser->execute($params);
$row = $selectbyidUser->fetch(PDO::FETCH_ASSOC);

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
    'format' => [101.6, 152.4],
    'fontdata' => $fontData + [
        'sarabun' => [
            'R' => 'THSarabunNew.ttf',
            'I' => 'THSarabunNew Italic.ttf',
            'B' => 'THSarabunNew Bold.ttf',
            'BI' => 'THSarabunNew BoldItalic.ttf'
        ]
    ],
    'default_font' => 'sarabun'
]);

$mpdf->AddPageByArray([
    'margin-left' => 0,
    'margin-right' => 0,
    'margin-top' => 0,
    'margin-bottom' => 0,
]);

$data = '
    <div class="mt-4 mb-4 " style="margin: 0; padding: 0; width: 4in; height: 6in; background-color: white;">
        <img src="../../service/uploads/' . $row['image'] . '" alt="" style="margin-left: 2rem; margin-top: 10rem; width: 100px; height: 150px;">
        <div style="margin-left: 2rem; margin-top: -0.1rem; font-size: 1.9rem; width: 25rem; height:auto;">
            <p style="margin: 0;">' . $row['firstname'] . ' ' . $row['lastname'] . '</p>
            <p style="margin: 0; margin-top:-0.8rem">' . $row['status'] . '</p>
            <p style="margin: 0; margin-top:-0.8rem">' . $row['province'] . '</p>
        </div>
    </div>
';
ob_start();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: gray;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="mt-4 mb-4 " style="margin: 0; padding: 0; width: 4in; height: 6in; background-color: white;">
            <img src="../../service/uploads/<?php echo $row['image'] ?>" alt=""
                style="margin-left: 2rem; margin-top: 10rem; width: 100px; height: 150px;">
            <div style="margin-left: 2rem; margin-top: -0.1rem; font-size: 1.9rem; width: 25rem; height:auto;">
                <p style="margin: 0;">
                    <?php echo $row['firstname'] ?>
                    <?php echo $row['lastname'] ?>
                </p>
                <p style="margin: 0; margin-top:-0.8rem">
                    <?php echo $row['status'] ?>
                </p>
                <p style="margin: 0; margin-top:-0.8rem">
                    <?php echo $row['province'] ?>
                </p>
            </div>
        </div>
    </div>

    <?php
    $html = ob_get_contents();
    $mpdf->WriteHTML($data);
    $mpdf->Output("AD-CARD.pdf");
    ob_end_flush();
    ?>
    <div class="container mt-4">
        <a href="AD-CARD.pdf" class="btn btn-primary" target="_blank">โหลดผลการเรียน (pdf)</a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>












<?php 
/**
 **** AppzStory Back Office Management System Template ****
 * Connect Database PHP PDO
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
session_start();
error_reporting(E_ALL); 
date_default_timezone_set('Asia/Bangkok');

/** Class Database สำหรับติดต่อฐานข้อมูล */
class Database {
    /**
     * กำหนดตัวแปรแบบ private
     * Method Connect ใช้สำหรับการเชื่อมต่อ Database
     *
     * @var string|null
     * @return PDO
     */
    private $host = "localhost";
    private $dbname = "tkssport_tks_database";
    private $username = "tkssport_tks_database";
    private $password = "tks_database2566";
    private $conn = null;

    public function connect() {
        try{
            /** PHP PDO */
            $this->conn = new PDO('mysql:host='.$this->host.'; 
                                dbname='.$this->dbname.'; 
                                charset=utf8', 
                                $this->username, 
                                $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $exception){
            echo "ไม่สามารถเชื่อมต่อฐานข้อมูลได้: " . $exception->getMessage();
            exit();
        }
        return $this->conn;
    }
}

/**
 * ประกาศ Instance ของ Class Database
 */
// $Database = new Database();
// $connect = $Database->connect();
// <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel"
//     aria-hidden="true">
//     <div class="modal-dialog" role="document">
//         <div class="modal-content">
//             <div class="modal-header">
//                 <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
//                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                     <span aria-hidden="true">&times;</span>
//                 </button>
//             </div>
//             <div class="modal-body">
//                 <!-- Add your notification content here -->
//                 <div class="card">
//                     <div class="card-body">
//                         <h5 class="card-title">Notification 1</h5>
//                         <p class="card-text">Some details about notification 1.</p>
//                     </div>
//                 </div>

//                 <div class="card mt-3">
//                     <div class="card-body">
//                         <h5 class="card-title">Notification 2</h5>
//                         <p class="card-text">Some details about notification 2.</p>
//                     </div>
//                 </div>

//                 <!-- Add more cards as needed -->
//             </div>

//             <div class="modal-footer">
//                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
//             </div>
//         </div>
//     </div>
// </div>

