<?php
require_once('../authen.php');

$Database = new Database();
$conn = $Database->connect();

$sql = $conn->prepare("SELECT * FROM data_score");
$sql->execute();
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

// Sort the array based on the 'finalsum' column in descending order
usort($data, function ($a, $b) {
    return $b['finalsum'] - $a['finalsum'];
});

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon.ico">
    <title>
        <?php echo isset($_SESSION['id_Role']['Role']) ? $_SESSION['id_Role']['Role'] : ''; ?> | TKS SPORTDATA
    </title>
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <style>
        body {
            overflow: hidden;
        }
        .form {
            margin-left: 5rem;
            padding: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container-fuild row p-5">
        
        <div class="container col-md-5">
            <h2 class=" text-center mt-4 mb-4">ตารางคะแนน</h2>
            <table id="employeeTable" class="table table table-striped table-hover mt-5">
                <thead>
                    <tr>
                        <th class="align-middle">ลำดับ</th>
                        <th class="align-middle">ชื่อ</th>
                        <th class="align-middle">นามสกุล</th>
                        <th class="align-middle">คะแนน</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $counter = 1;
                    foreach ($data as $score) {
                        ?>
                        <tr id="<?php echo $score["id"]; ?>">
                            <td class="align-middle">
                                <?php echo $counter; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $score["firstname"]; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $score["lastname"]; ?>
                            </td>
                            <td class="align-middle">
                                <?php echo $score["finalsum"]; ?>
                            </td>
                        </tr>
                        <?php
                        $counter++;
                    }
                    ?>
                </tbody>
            </table>
            <div class="mt-5" >
                <a href="pdf" target="_blank" class="btn btn-primary">โหลดตารางคะแนน (pdf)</a>
            </div>
        </div>
    </div>

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>

</body>

</html>