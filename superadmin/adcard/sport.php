<?php

require_once('../authen.php');
$Database = new Database();
$conn = $Database->connect();

$per = $conn->prepare("SELECT * FROM sport");
$per->execute();

if(isset($_SESSION['id_city'])) {
    $id_province = $_SESSION['id_city']['province'];
} else {
    $id_province = 'default_status';
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo isset($_SESSION['id_city']['province']) ? $_SESSION['id_city']['province'] : ''; ?> | TKS SPORTDATA
    </title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon.ico">
    <!-- stylesheet -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/datatable.css">


    <!-- Datatables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

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
                                <div class="card-header border-0 pt-4" style="float: left;">
                                    <h4>
                                        <i class="fa-solid fa-id-card-clip mr-2"></i>
                                        สร้าง AD Card ฝ่ายกีฬา
                                    </h4>
                                    <a href="#" class="btn btn-info mt-3 text-white" type="button" id="print-selected"
                                        target="_blank">
                                        <i class="nav-icon fa-solid fa-print"></i>
                                        Print All
                                    </a>
                                </div>
                                <div class="p-2">
                                    <table id="employeeTable" class="table table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th class="align-middle">
                                                    <input type="checkbox" id="select_all" class="align-middle mt-3">
                                                    <label class=" form-check-label "></label>
                                                </th>
                                                <th class="align-middle">ลำดับ</th>
                                                <th class="align-middle">ประเภทกีฬา</th>
                                                <th class="align-middle">ชื่อ</th>
                                                <th class="align-middle">นามสกุล</th>
                                                <th class="align-middle">ตำแหน่ง</th>
                                                <th class="align-middle">รูป</th>
                                                <th class="align-middle">พิมพ์</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $counter = 1;
                                            if($per->rowCount() > 0) {
                                                while($person = $per->fetch(PDO::FETCH_ASSOC)) { ?>
                                                    <tr id="<?php echo $person["id"]; ?>">
                                                        <td class="align-middle"><input type="checkbox" class="checkbox"
                                                                name="idc[]" value="<?php echo $person["id"]; ?>"></td>
                                                        <td class="align-middle">
                                                            <?php echo $counter; ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?php echo $person["province"]; ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?php echo $person["firstname"]; ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?php echo $person["lastname"]; ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <?php echo $person["status"]; ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <img src="../../service/uploads/<?php echo $person["image"]; ?>"
                                                                alt="Profile" style="max-width: 50px;">
                                                        </td>
                                                        <td class="align-middle">
                                                            <a href="adcard-sport.php?id=<?php echo $person["id"]; ?>"
                                                                target="_blank" class="btn btn-warning text-white"> Print </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $counter++;
                                                }

                                            } else {
                                                ?>
                                                <tr>
                                                    <td colspan="7" class="align-middle">ยังไม่รายชื่อ</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
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
    <!-- datatables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>

        $(document).ready(function () {
            var table = $("#employeeTable").DataTable({
                paging: true,
                ordering: false,
                searching: true,
                info: true,
                className: 'select-checkbox',

                columnDefs: [
                    { width: '10%', targets: 1 },
                    { width: '15%', targets: 2 },
                    { width: '15%', targets: 3 },
                    { width: '15%', targets: 4 },
                    { width: '20%', targets: 5 },
                    { width: '15%', targets: 6 },
                    { width: '10%', targets: 7 }
                ],

                initComplete: function () {
                    var column4 = this.api().column(5);
                    $(column4.header()).html('<label for="posi4">ตำแหน่ง: </label>'); // Update "for" attribute
                    var select4 = $('<select id="posi4" class="form-control custom-select"><option value="">ทั้งหมด</option></select>')
                        .appendTo($(column4.header()))
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column4.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                    column4.data().unique().sort().each(function (d) {
                        select4.append('<option value="' + d + '">' + d + '</option>');
                    });


                    var column5 = this.api().column(2);
                    $(column5.header()).html('<label for="province">ประเภทกีฬา: </label>');
                    var select5 = $('<select id="province" class="form-control custom-select"><option value="">ทั้งหมด</option></select>')
                        .appendTo($(column5.header()))
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
                            column5.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
                    column5.data().unique().sort().each(function (d) {
                        select5.append('<option value="' + d + '">' + d + '</option>');
                    });
                },


            });

            $("#select_all").on("click", function () {
                $(".checkbox").prop("checked", this.checked);

                // ตรวจสอบสถานะของ "Select All" เพื่อกำหนดการใช้งานของปุ่ม "Print Selected"
                if (this.checked) {
                    $("#print-selected").prop("disabled", false);
                } else {
                    $("#print-selected").prop("disabled", true);
                }
            });

            $(".checkbox").on("click", function () {
                if ($(".checkbox:checked").length === $(".checkbox").length) {
                    $("#select_all").prop("checked", true);
                } else {
                    $("#select_all").prop("checked", false);
                }

                // ตรวจสอบสถานะของ "Select All" เพื่อกำหนดการใช้งานของปุ่ม "Print Selected"
                if ($(".checkbox:checked").length > 0) {
                    $("#print-selected").prop("disabled", false);
                } else {
                    $("#print-selected").prop("disabled", true);
                }
            });


            $("#print-selected").on("click", function () {
                var selectedIds = $(".checkbox:checked")
                    .map(function () {
                        return $(this).val();
                    })
                    .get();

                if (selectedIds.length > 0) {
                    var url = "adcard-sport.php?id=" + selectedIds.join(',');
                    window.open(url, '_blank');
                } else {
                    Swal.fire({
                        text: "กรุณาเลือกอย่างน้อยหนึ่งรายการ",
                        icon: "warning",
                        confirmButtonText: "ตกลง",
                    });
                }
            });

            // ตรวจสอบการเลือก checkbox เพื่ออัปเดตสถานะของ select_all
            table.on("draw", function () {
                if ($(".checkbox:checked").length === $(".checkbox").length) {
                    $("#select_all").prop("checked", true);
                } else {
                    $("#select_all").prop("checked", false);
                }
            });
        });
    </script>
</body>

</html>