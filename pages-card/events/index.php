<?php

require_once('../authen.php');

$Database = new Database();
$conn = $Database->connect();

$sql = $conn->prepare("SELECT * FROM data_id");
$sql->execute();

$adm = $conn->prepare("SELECT * FROM data_admin");
$adm->execute();


$per = $conn->prepare("SELECT * FROM personnel");
$per->execute();

$eventsname = null;
$areaname = null;

if (isset($_SESSION['id_city'])) {
    $id_province = $_SESSION['id_city']['province'];
} else {
    $id_province = 'default_status';
}

while ($rowe = $sql->fetch(PDO::FETCH_ASSOC)) {
    if ($id_province == $rowe['province']) {
        $areac = $rowe['area'];
        $event = $rowe['events'];

        while ($rowr = $adm->fetch(PDO::FETCH_ASSOC)) {
            if ($areac === $rowr['area']) {
                if ($rowr['IsActive'] == 1) {
                    $eventsname = $rowr['events'];
                    $areaname = $rowr['area'];

                }
            } elseif ($event === $rowr['area']) {
                if ($rowr['IsActive'] == 1) {
                    $eventsname = $rowr['events'];
                    $areaname = $rowr['area'];

                }
            }
        }
    }
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

                                <div class="card-header border-0 pt-4">
                                    <div style="float: left;">
                                        <h4>
                                            <i class="nav-icon fa-solid fa-address-card"></i>
                                            ตวจสอบรายชื่อ EVENTS
                                        </h4>
                                        <?php if ($eventsname == true) { ?>
                                            <a href="#" class="btn btn-info mt-3" data-toggle="modal"
                                                data-target="#myModal">
                                                <i class="nav-icon fa-solid fa-user-plus"></i>
                                                เพิ่มรายชื่อ
                                            </a>
                                        <?php } else { ?>
                                            <?php echo '<p class="mt-4" style="font-size: 20px; color: red">ยังไม่เปิดรับสมัคร</p>';
                                        } ?>
                                    </div>
                                    <div class="mr-4" style="float: right; font-size: 20px;">
                                        <?php if ($rowr['create_time'] == true) { ?>
                                            เริ่มรับสมัคร :<span style="color: red" >
                                                <?php echo $rowr['create_time'] ?>
                                            </span>
                                            <br>
                                            ถึงวันที่ :<span style="color: red"></span>
                                                <?php echo $rowr['end_time'] ?>
                                            </span>
                                        <?php } ?>
                                    </div>


                                </div>

                                <div class="card-body">
                                    <div class="row mb-4" data-eventsname="<?php echo $eventsname; ?>"
                                        data-areaname="<?php echo $areaname; ?>">
                                        <div class="col-md-6 px-1 px-md-5">
                                            <div class="form-group">
                                                <label for="nameevents">อีเว้นท์</label>
                                                <input type="text" class="form-control" name="nameevents"
                                                    id="nameevents" value="<?php echo $eventsname; ?>" disabled>
                                            </div>
                                        </div>

                                        <div class="col-md-6 px-1 px-md-5">
                                            <div class="form-group">
                                                <label for="area">ภูมิภาค</label>
                                                <input type="text" class="form-control" name="area" id="area"
                                                    value="<?php echo $areaname; ?>" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="myModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content px-md-2">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">เลือกรายชื่อ</h5>
                                                    <a href="#" class="btn btn-info" data-dismiss="modal">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </a>
                                                </div>

                                                <div class="modal-body">
                                                    <table id="employeeTable"
                                                        class="table table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>
                                                                    <input type="checkbox" id="select_all">
                                                                    <label class=" form-check-label "></label>
                                                                </th>
                                                                <th>ID</th>
                                                                <th>First Name</th>
                                                                <th>Last Name</th>
                                                                <th>Status</th>
                                                                <th>Province</th>
                                                                <th>Department</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $counter = 1;
                                                            if ($per->rowCount() > 0) {
                                                                while ($person = $per->fetch(PDO::FETCH_ASSOC)) {

                                                                    if (isset($_SESSION['id_city'])) {
                                                                        $id_province = $_SESSION['id_city']['province'];
                                                                    } else {
                                                                        $id_province = 'default_status';
                                                                    }
                                                                    // เพิ่มเงื่อนไขตรวจสอบค่า IsActive
                                                                    if ($person["IsActive"] == 0 && $person["province"] == $id_province) {
                                                                        ?>
                                                                        <tr id="<?php echo $person["id"]; ?>">
                                                                            <td><input type="checkbox" class="checkbox" name="idc[]"
                                                                                    value="<?php echo $person["id"]; ?>"></td>
                                                                            <td>
                                                                                <?php echo $counter; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $person["firstname"]; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $person["lastname"]; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $person["status"]; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $person["province"]; ?>
                                                                            </td>
                                                                            <td>
                                                                                <?php echo $person["department"]; ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $counter++;
                                                                    }
                                                                }
                                                            } else {
                                                                // ถ้าไม่มีข้อมูล
                                                                ?>
                                                                <tr>
                                                                    <td colspan="7">ยังไม่รายชื่อ</td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" id="add-data"
                                                        class="btn btn-success">ADD</button>
                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="logs" name="select_all_d"
                                        class="table table table-striped table-hover mt-4 " width="100%"
                                        style="color: black">
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
    <script src="../../assets/js/events.js"></script>
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
                searching: false,
                info: true,
            });

            $("#select_all").on("click", function () {
                $(".checkbox").prop("checked", this.checked);
            });

            $(".checkbox").on("click", function () {
                if ($(".checkbox:checked").length === $(".checkbox").length) {
                    $("#select_all").prop("checked", true);
                } else {
                    $("#select_all").prop("checked", false);
                }
            });

            $("#add-data").on("click", function () {
                // รวบรวม ID ของ checkbox ที่ถูกเลือก
                var selectedIds = $(".checkbox:checked")
                    .map(function () {
                        return $(this).val();
                    })
                    .get();


                if (selectedIds.length > 0) {
                    var eventsname = $("#nameevents").val();
                    var areaname = $("#area").val();

                    $.ajax({
                        type: "POST",
                        url: "../../service/managercard/create-information.php",
                        data: { idc: selectedIds, eventsname: eventsname, areaname: areaname },
                        success: function (resp) {
                            Swal.fire({
                                text: "เพิ่มข้อมูลเรียบร้อย",
                                icon: "success",
                                confirmButtonText: "ตกลง",
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.assign("./");
                                }
                            });
                        },
                    });
                } else {
                    // ถ้าไม่มี checkbox ถูกเลือก
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
        $(function () {
            $.ajax({
                type: "GET",
                url: "../../service/managercard/index",
            }).done(function (data) {
                let $data = [];
                let tableData = [];
                data.response.forEach(function (item, index) {
                    // ตรวจสอบว่า IsActive เป็น 1 หรือไม่
                    if (
                        (item.events_name == null || item.area_name == null) &&
                        item.IsActive == 1 &&
                        item.firstname !== null &&
                        item.lastname !== null
                    ) {
                        const displayValue = item.events_name || item.area_name;

                        const deleteButton = item.IsActive === 1
                            ? `<button type="button" class="btn btn-danger" id="delete-${index}" data-id="${item.id}" data-index="${index}">
                        <i class="far fa-trash-alt"></i> ลบ
                    </button>`
                            : `<button type="button" class="btn btn-danger" id="delete-${index}" data-id="${item.id}" data-index="${index}" disabled>
                        <i class="far fa-trash-alt"></i> ลบ
                    </button>`;

                        tableData.push([
                            ++index,
                            item.firstname,
                            item.lastname,
                            item.status,
                            displayValue, // Display either events_name or area_name
                            `<span class="badge badge-success" style="width: 70px; height: 20px; display: flex; justify-content: center; align-items: center; font-size: 13px">เรียร้อย</span>`,
                            `<div class="btn-group" role="group">
                    ${deleteButton}
                </div>`,
                        ]);

                        if (item.IsActive !== 1) {
                            // ตรวจสอบว่าปิดการใช้หรือทำอะไรต่าง ๆ ใน DataTables
                            // เช่น ปิดปุ่มลบ
                            $(`#delete-${index}`).prop('disabled', true);
                            // หรือทำอะไรต่อไปตามที่คุณต้องการ
                        }
                    }
                });
                initDataTables(tableData);
            }).fail(function () {
                Swal.fire({
                    text: "ไม่สามารถเรียกดูข้อมูลได้",
                    icon: "error",
                    confirmButtonText: "ตกลง",
                }).then(function () {
                    location.assign("../dashboard");
                });
            });

            function initDataTables(tableData) {
                var table = $("#logs").DataTable({
                    data: tableData,
                    searching: false,
                    ordering: false,
                    columns: [
                        { title: "ลำดับ", className: "align-middle", orderable: false },
                        { title: "ชื่อจริง", className: "align-middle", orderable: false },
                        { title: "นามสกุล", className: "align-middle", orderable: false },
                        { title: "ตำแหน่ง", className: "align-middle", orderable: false },
                        { title: "อีเว้นท์", className: "align-middle", orderable: false },
                        { title: "สถานะ", className: "align-middle", orderable: false },
                        { title: "จัดการ", className: "align-middle", orderable: false },
                    ],

                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function (row) {
                                    var data = row.data();
                                    return "ผู้ใช้งาน: " + data[1];
                                },
                            }),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                                tableClass: "table",
                            }),
                        },
                    },
                    language: {
                        lengthMenu: "แสดงข้อมูล _MENU_ แถว",
                        zeroRecords: "ยังไม่มีรายชื่อ",
                        info: "แสดงหน้า _PAGE_ จาก _PAGES_",
                        infoEmpty: "ยังไม่มีรายชื่อ",
                        infoFiltered: "(filtered from _MAX_ total records)",
                        paginate: {
                            previous: "ก่อนหน้านี้",
                            next: "หน้าต่อไป",
                        },
                    },
                });

                $(document).on("click", "#delete", function () {
                    let id = $(this).data("id");
                    let index = $(this).data("index");


                    Swal.fire({
                        text: "คุณแน่ใจหรือไม่...ที่จะลบรายการนี้?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "ใช่! ลบเลย",
                        cancelButtonText: "ยกเลิก",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // ทำการ Ajax เรียก PHP script เพื่ออัปเดต IsActive เป็น 1
                            $.ajax({
                                type: "POST",
                                url: "../../service/managercard/update-information.php",
                                data: { id: id },
                            }).done(function (response) {
                                if (response.success) {
                                    Swal.fire({
                                        text: response.message,
                                        icon: "success",
                                        confirmButtonText: "ตกลง",
                                        timer: 500,
                                        timerProgressBar: true,
                                    }).then((result) => {
                                        location.assign("./");
                                    });
                                } else {
                                    Swal.fire({
                                        text: response.error,
                                        icon: "error",
                                        confirmButtonText: "ตกลง",
                                    });
                                }
                            });
                        }
                    });
                });
            }
        });


    </script>
</body>

</html>