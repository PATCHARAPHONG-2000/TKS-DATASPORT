<?php
require_once('../../service/connect.php');
require_once '../../assets/phpspreadsheet/vendor/autoload.php';

$Database = new Database();
$conn = $Database->connect();

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// ดึงข้อมูลจากฐานข้อมูล
$sql = "SELECT * FROM data_score";
$result = $conn->query($sql);

// สร้าง Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// เพิ่มข้อมูลจากฐานข้อมูล
$row = 1;
while ($row_data = $result->fetch(PDO::FETCH_ASSOC)) {
    $column = 1;
    foreach ($row_data as $value) {
        $sheet->setCellValueByColumnAndRow($column, $row, $value);
        $column++;
    }
    $row++;
}

// กำหนดชื่อไฟล์ Excel
$filename = 'คะแนน.xlsx';

// กำหนด header สำหรับการดาวน์โหลดไฟล์ Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// ใช้ Writer เพื่อบันทึก Spreadsheet เป็นไฟล์ Excel
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>
