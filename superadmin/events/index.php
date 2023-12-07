<!--<?php

require_once('../authen.php');

$Database = new Database();
$conn = $Database->connect();

$sql = $conn->prepare("SELECT * FROM data_admin");
$sql->execute();
$row = $sql->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUPERADMIN || TKS SPORTDATA</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon.ico">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/datatable.css">

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
                                        <i class="fa-regular fa-calendar"></i>
                                        กำหนดการอีเว้นท์ 
                                    </h4>

                                </div>

                                <form id="formData" id="originalCardBody" enctype="multipart/form-data">
                                     <form action="../../service/managercard/create.php" method="post" enctype="multipart/form-data" > 
                                    <div class="card-body" id="originalCardBody">
                                        <div class="row">
                                            <div class="col-md-6 px-1 px-md-5">

                                                <div class="form-group">
                                                    <label for="events">EVENTS<span style="color: red;">*</span></label>
                                                    <select class="form-control" name="events" id="events" required>
                                                        <option value disabled selected>เลือก EVVENTS</option>
                                                        <?php
                                                        // สร้าง array เพื่อเก็บค่า events ที่ไม่ซ้ำ
                                                        $uniqueEvents = array_unique(array_column($row, 'events'));

                                                        foreach ($uniqueEvents as $event): ?>
                                                            <?php if ($event !== null):

                                                                ?>
                                                                <option data-events="<?php echo $event; ?>">
                                                                    <?php echo $event; ?>
                                                                </option>

                                                            <?php endif; ?>
                                                        <?php endforeach; ?>

                                                         <option value="อื่นๆ">อื่นๆ</option> 
                                                    </select>
                                                     <input type="text" class="form-control" name="other_events"
                                                        id="other_events" style="display: none;"
                                                        placeholder="เลือกฝ่าย"> 
                                                </div> 

                                                <div class="form-group">
                                                    <label for="createtime">วันเริ่มอีเว้นท์</label>
                                                    <input type="date" name="createtime" id="createtime"
                                                        class="form-control" min="<?php echo date('Y-m-d'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 px-1 px-md-5">
                                                <div class="form-group">
                                                    <label for="area">ภูมิภาค <span style="color: red;">*</span></label>
                                                    <select class="form-control" name="area" id="area" required>
                                                        <option value disabled selected>เลือก ภูมิภาค</option>
                                                        <?php foreach ($row as $area): ?>
                                                            <?php if ($area['area'] !== null): ?>
                                                                <option data-area="<?php echo $area['area']; ?>">
                                                                    <?php echo $area['area']; ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                         <option value="อื่นๆ">อื่นๆ</option> 
                                                    </select>
                                                     <input type="text" class="form-control" name="other_area"
                                                        id="other_area" style="display: none;" placeholder="เลือกฝ่าย"> 
                                                </div>

                                                <div class="form-group ">
                                                    <label for="endtime">วันสิ้นสุดอีเว้นท์</label>
                                                    <input type="date" name="endtime" id="endtime" class="form-control"
                                                        min="<?php echo date('Y-m-d'); ?>">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-block mx-auto w-50"
                                            name="submit">บันทึกข้อมูล</button>
                                    </div>
                                </form>
                                <div class="card-body mt-4">
                                    <table id="employeeTable" class="table table table-striped table-hover" width="100%">
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

     scripts 
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>
     datatables 
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script>

        $(function () {
            $.ajax({
                type: "GET",
                url: "../../service/superadmin/data_admin"
            }).done(function (data) {
                let tableData = []
                data.response.forEach(function (item, index) {
                    if (item.firstname !== null && item.lastname !== null) {
                        // เช็คว่า IsActive เท่ากับ 1 หรือ null
                        if (item.IsActive == 1 || item.IsActive == null) {
                            tableData.push([
                                ++index,
                                item.events,
                                item.area,
                                item.create_time,
                                item.end_time,
                                `<div class="btn-group" role="group">
                                    <a href="form-edit.php?id=${item.id}" type="button" class="btn btn-warning text-white">
                                        <i class="far fa-edit"></i> แก้ไข
                                    </a>
                                    <button type="button" class="btn btn-danger" id="delete" data-id="${item.id}" data-index="${index}">
                                        <i class="far fa-trash-alt"></i> ลบ
                                    </button>
                                </div>`
                            ]);
                        }
                    }
                });

                initDataTables(tableData)
            }).fail(function () {
                Swal.fire({
                    text: 'ไม่สามารถเรียกดูข้อมูลได้',
                    icon: 'error',
                    confirmButtonText: 'ตกลง',
                }).then(function () {
                    location.assign('../dashboard')
                })
            })

            function initDataTables(tableData) {
                var table = $('#employeeTable').DataTable({
                    data: tableData,

                    columns: [
                        { title: "ลำดับ", className: "align-middle", orderable: true },
                        { title: "อีเว้นท์", className: "align-middle", orderable: false },
                        { title: "ภูมิภาค", className: "align-middle", orderable: false },
                        { title: "วันที่เริ่มรับสมัคร", className: "align-middle", orderable: false },
                        { title: "หมดเขตรับสมัคร", className: "align-middle", orderable: false },
                        { title: "จัดการ", className: "align-middle", orderable: false }
                    ],

                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function (row) {
                                    var data = row.data();
                                    return 'ผู้ใช้งาน: ' + data[1];
                                }
                            }),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                                tableClass: 'table'
                            })
                        }
                    },
                    language: {
                        "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
                        "zeroRecords": "ยังไม่มีรายชื่อ",
                        "info": "แสดงหน้า _PAGE_ จาก _PAGES_",
                        "infoEmpty": "ยังไม่มีรายชื่อ",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "search": 'ค้นหา',
                        "paginate": {
                            "previous": "ก่อนหน้านี้",
                            "next": "หน้าต่อไป"
                        }
                    }
                });

                $(document).on('click', '#delete', function () {
                    let id = $(this).data('id');
                    let index = $(this).data('index');
                    Swal.fire({
                        text: "คุณแน่ใจหรือไม่...ที่จะลบรายการนี้?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'ใช่! ลบเลย',
                        cancelButtonText: 'ยกเลิก'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "../../service/superadmin/update-events.php",
                                data: { id: id },
                            }).done(function () {
                                Swal.fire({
                                    text: 'รายการของคุณถูกลบเรียบร้อย',
                                    icon: 'success',
                                    confirmButtonText: 'ตกลง',
                                    timer: 500,
                                    timerProgressBar: true,
                                }).then((result) => {
                                    location.assign('./');
                                })
                            });
                        }
                    });
                });
            }
        })


        $(document).ready(function () {
            // เมื่อไฟล์ถูกเลือก อัปเดตป้ายกำกับด้วยชื่อไฟล์
            $('#customFile').on('change', function () {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });
        });

        $(function () {
            $('#formData').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '../../service/superadmin/create-events.php',
                    data: new FormData(this),
                    contentType: false,
                    processData: false
                }).done(function (resp) {
                    Swal.fire({
                        text: 'เพิ่มข้อมูลเรียบร้อย',
                        icon: 'success',
                        confirmButtonText: 'ตกลง',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        location.assign('./');
                    });
                })
            });
        });
    </script>


</body>

</html>
