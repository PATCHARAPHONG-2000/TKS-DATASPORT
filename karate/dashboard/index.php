<?php
require_once('../authen.php');

$Database = new Database();
$conn = $Database->connect();

$sql = $conn->prepare("SELECT * FROM data_score");
$sql->execute();
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

usort($data, function ($a, $b) {
    return $b['finalsum'] - $a['finalsum'];
});

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> TKS SPORTDATA | KARATE</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon.ico">
    <!-- stylesheet -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include_once('../includes/sidebar.php') ?>
        <div class="content-wrapper pt-3">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="container-fuild row">
                                    <div class="container col-md-5 form">
                                        <h2 class="mb-4 text-center">กรอกคะแนน</h2>
                                        <form class="p-2" id="formData" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6 px-1">
                                                    <div class="form-group">
                                                        <label for="firstname">ชื่อ <span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="ชื่อ" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 px-1">
                                                    <div class="form-group">
                                                        <label for="lastname">นามสกุล <span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="นามสกุล" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php for ($i = 1; $i <= 7; $i++) { ?>
                                                <div class="mb-3">
                                                    <label for="number<?php echo $i; ?>" class="form-label">JUDGE
                                                        <?php echo $i; ?>:</label>
                                                    <input type="number" class="form-control" id="number<?php echo $i; ?>" tabindex="<?php echo $i; ?>" step="0.01" min="0" max="10" required onkeydown="moveToNextInput(event, '<?php echo ($i === 7) ? 'number7' : 'number' . ($i + 1); ?>')">
                                                </div>
                                            <?php } ?>
                                            <button type="button" class="btn btn-primary" onclick="checkAndSum()">SUM</button>
                                            <button type="button" class="btn btn-secondary ml-2" onclick="clearTableData()">Clear</button>
                                        </form>
                                    </div>
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
                                        <div class="mt-5">
                                            <a href="excel" target="_blank" class="btn btn-primary">โหลดตารางคะแนน</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('../includes/footer.php') ?>
    </div>

    <!-- scripts -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>

    <script>
        function clearTableData() {
            Swal.fire({
                title: "คุณต้องการลบข้อมูลใช่ไหม",
                text: "คุณจะไม่สามารถย้อนกลับได้! || เช็คให้แน่ใจว่าคุณได้ดาวโหลดตารางคะแนนเรียบร้อยแล้ว",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ใช่, ฉันต้องการลบ!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '../score/delete',
                        dataType: 'json'
                    }).done(function(resp) {
                        Swal.fire({
                            text: 'ลบข้อมูลเรียบร้อย',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                            showConfirmButton: false,
                            timer: 500
                        }).then((result) => {
                            location.assign('./');
                        });
                    });
                }
            });
        }

        function moveToNextInput(event, nextInputId) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById(nextInputId).focus();
            }
        }

        function checkAndSum() {
            const firstName = document.getElementById('firstname').value;
            const lastName = document.getElementById('lastname').value;

            const numbers = Array.from({
                length: 7
            }, (_, i) => parseFloat(document.getElementById(`number${i + 1}`).value));
            const number = [...numbers];
            const sumOfAllNumbers = numbers.reduce((acc, value) => acc + value, 0);
            const minValue = Math.min(...numbers);
            const maxValue = Math.max(...numbers);

            if (numbers.filter(value => value === minValue).length > 1 && numbers.filter(value => value === maxValue)
                .length > 1) {
                const hasMaxValue = numbers.includes(maxValue);
                const hasMinValue = numbers.includes(minValue);
                if (hasMaxValue && hasMinValue) {
                    numbers.splice(numbers.indexOf(minValue), 1);
                    numbers.splice(numbers.indexOf(maxValue), 1);
                }
            } else {
                numbers.splice(numbers.indexOf(minValue), 1);
                numbers.splice(numbers.indexOf(maxValue), 1);
            }

            const finalSum = numbers.reduce((acc, value) => acc + value, 0);
            saveScores(firstName, lastName, number, sumOfAllNumbers, finalSum);
        }

        function saveScores(firstName, lastName, numbers, sumOfAllNumbers, finalSum) {
            $.ajax({
                type: 'POST',
                url: '../../service/score/create.php',
                data: {
                    firstname: firstName,
                    lastname: lastName,
                    scores: numbers,
                    totalSum: sumOfAllNumbers,
                    finalSum: finalSum
                },
                dataType: 'json'
            }).done(function(resp) {
                Swal.fire({
                    text: 'เพิ่มข้อมูลเรียบร้อย',
                    icon: 'success',
                    confirmButtonText: 'ตกลง',
                    showConfirmButton: false,
                    timer: 500
                }).then((result) => {
                    location.assign('./');
                });
            });
        }
    </script>


</body>

</html>