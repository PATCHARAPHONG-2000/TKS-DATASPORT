<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon.ico">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <style>
        body {
            overflow: hidden;
        }

        /* เพิ่มกรอบรอบตาราง */
        #employeeTable {
            background-color: black;
            color: white;
            border: 1px solid #ccc;
            /* สีและความหนาขอบรอบตาราง */
            border-collapse: collapse;
            width: 100%;
        }

        #employeeTable th,
        #employeeTable td {
            border: 1px solid #ccc;
            /* สีและความหนาขอบของเซลล์ */
            padding: 8px;
            text-align: left;
        }

        #employeeTable th {
            background-color: #333;
        }
    </style>
</head>

<body>
    <section class="container-fluid">
        <div class="score text-center" style="font-size: 5rem;">
            <table id="employeeTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="align-middle text-center">ลำดับ</th>
                        <th class="align-middle text-center">ชื่อ</th>
                        <th class="align-middle text-center">นามสกุล</th>
                        <th class="align-middle text-center">คะแนน</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </section>

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            var newData = []; // เก็บข้อมูลใหม่ที่มาถึง

            function updateTable() {
                $('#employeeTable tbody').empty();
                $.each(newData, function(index, score) {
                    var row = '<tr>' +
                        '<td class="align-middle">' + (index + 1) + '</td>' +
                        '<td class="align-middle">' + score.firstname + '</td>' +
                        '<td class="align-middle">' + score.lastname + '</td>' +
                        '<td class="align-middle">' + score.finalsum + '</td>' +
                        '</tr>';

                    $('#employeeTable tbody').append(row);
                });
            }

            var eventSource = new EventSource('../../service/score/index.php');
            eventSource.onmessage = function(event) {
                var data = JSON.parse(event.data);
                newData = data; // เก็บข้อมูลใหม่

                setTimeout(function() {
                    updateTable(); // อัพเดตตาราง
                }, 2000); // 5 วินาที
            };

            $(window).on('beforeunload', function() {
                eventSource.close();
            });
        });
    </script>
</body>

</html>