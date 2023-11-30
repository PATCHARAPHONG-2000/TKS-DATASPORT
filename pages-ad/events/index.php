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

if (isset($_SESSION['id_city'])) {
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
                                <div class="card-header border-0 pt-4">
                                    <h4>
                                        <i class="nav-icon fa-solid fa-address-card mr-2"></i>
                                        ฝ่ายจัดการแข่งขัน
                                    </h4>
                                </div>

                                <div class="card-body">
                                    <form id="formData" id="originalCardBody" enctype="multipart/form-data" class="mb-4" >
                                        <!-- <form action="../../service/managercard/create.php" method="post" enctype="multipart/form-data" > -->
                                        <div class="card-body" id="originalCardBody">
                                            <div class="row">
                                                <div class="col-md-6 px-1 px-md-5">
                                                    <div class="form-group">
                                                        <label for="firstname">ชื่อ <span
                                                                style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" name="firstname"
                                                            id="firstname" placeholder="ชื่อ" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status">ตำแหน่ง </label>
                                                        <input type="text" class="form-control" name="firstname"
                                                            id="firstname" placeholder="ชื่อ" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 px-1 px-md-5">
                                                    <div class="form-group">
                                                        <label for="lastname">นามสกุล <span
                                                                style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" name="lastname"
                                                            id="lastname" placeholder="นามสกุล" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="customFile">รูปโปรไฟล์ <span
                                                                style="color: red;">*</span></label>
                                                        <div class="custom-file mb-2">
                                                            <input name="image" type="file" class="custom-file-input"
                                                                id="customFile" accept="image/*" required>
                                                            <label class="custom-file-label"
                                                                for="customFile">เลือกรูปภาพ</label>
                                                        </div>
                                                        <a href="../../assets/images/template-profile.psd"
                                                            target="_blank" class="mt-4"><i
                                                                class=" fa-regular fa-circle-down fa-xl ml-2"></i>
                                                            ดาวโหลด
                                                            template-profile</a>
                                                        <p for="" style="font-size: 12px; color: red;"
                                                            class="mt-2 mb-1">*
                                                            ขนาดไฟล์ภาพไม่เกิน 5 MB</p>
                                                        <p for="" style="font-size: 12px; color: red;">*
                                                            ขนาดของรูป สูง : 1280px - กว้าง : 900px</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary btn-block mx-auto w-50"
                                                name="submit">บันทึกข้อมูล</button>
                                        </div>
                                    </form>
                                    <hr class="mb-4" >
                                    <table id="logs" name="select_all_d mt-5"
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
                    ordering: false,
                    columns: [
                        { title: "ลำดับ", className: "align-middle", orderable: false },
                        { title: "ชื่อจริง", className: "align-middle", orderable: false },
                        { title: "นามสกุล", className: "align-middle", orderable: false },
                        { title: "ตำแหน่ง", className: "align-middle", orderable: false },
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
                        search: "ค้นหา",
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