<?php
require_once('../authen.php');
require_once __DIR__ . '../../../assets/vendor/MPDF/autoload.php';

$Database = new Database();
$conn = $Database->connect();

$sql = $conn->prepare("SELECT * FROM data_score ORDER BY finalsum DESC");
$sql->execute();

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

$mpdf = new \Mpdf\Mpdf([
    'fontDir' => array_merge($fontDirs, [
        __DIR__ . '/tmp',
    ]),
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
    'margin-left' => 10,
    'margin-right' => 10,
    'margin-top' => 10,
    'margin-bottom' => 10,
]);

// เพิ่มชื่อ "ตารางคะแนน" ด้านบน
$data = '<p style="font-size:3rem; text-align:center;">ตารางคะแนน</p>';

// เพิ่มตารางข้อมูลทั้งหมด
$data .= '<table width="100%" style="border-collapse: collapse;font-size:12pt;">';
$data .= '<tr>
        <th style="font-weight: bold; font-size:1.5rem; padding:10px; text-align:center; width:10%; border:1px solid #00000;">ลำดับ</th>s
        <th style="font-weight: bold; font-size:1.5rem; padding:10px; text-align:center; width:20%; border:1px solid #00000;">ชื่อ</th>
        <th style="font-weight: bold; font-size:1.5rem; padding:10px; text-align:center; width:20%; border:1px solid #00000;">นามสกุล</th>
        <th style="font-weight: bold; font-size:1.5rem; padding:10px; text-align:center; width:20%; border:1px solid #00000;">คะแนน</th>
        </tr>';

$sql->execute(); // ทำให้ cursor ของ $sql กลับไปที่แถวแรก

$counter = 1; // เริ่มตัวแปรลำดับใหม่

while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
    $data .= '<tr>
        <td style="font-size:1.5rem; padding:10px; text-align:center; border:1px solid #00000;">' . $counter . '</td>
        <td style="font-size:1.5rem; padding:10px; text-align:center; border:1px solid #00000;">' . $row["firstname"] . '</td>
        <td style="font-size:1.5rem; padding:10px; text-align:center; border:1px solid #00000;">' . $row["lastname"] . '</td>
        <td style="font-size:1.5rem; padding:10px; text-align:center; border:1px solid #00000;">' . $row["finalsum"] . '</td>
        </tr>';

    $counter++;
}

$data .= '</table>';

// เขียน HTML ลงใน PDF
$mpdf->WriteHTML($data);

// ปิดเอกสาร PDF
$mpdf->Output("AD-CARD.pdf", \Mpdf\Output\Destination::INLINE);
