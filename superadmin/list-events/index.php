<?php

require_once('../authen.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUPERADMIN || TKS SPORTDATA</title>
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
                                        <i class="fa-regular fa-address-card"></i>
                                        รายชื่อที่เข้าร่วมอีเว้นท์
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table id="logs" class="table table table-striped table-hover" width="100%">
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
        $(function () {
            $.ajax({
                type: "GET",
                url: "../../service/superadmin/index"
            }).done(function (data) {
                let tableData = []
                data.response.forEach(function (item, index) {
                    if (item.firstname !== null && item.lastname !== null) {
                        // เช็คว่า IsActive เท่ากับ 1 หรือ null
                        if (item.IsActive == 1 || item.IsActive == null) {
                            tableData.push([
                                ++index,
                                item.province,
                                item.firstname,
                                item.lastname,
                                item.name_status,
                                item.department,
                                item.events_name,
                                item.area_name,
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
                var table = $('#logs').DataTable({
                    data: tableData,

                    columns: [
                        { title: "ลำดับ", className: "align-middle", orderable: true },
                        { title: "จังหวัด", className: "align-middle", orderable: false},
                        { title: "ชื่อจริง", className: "align-middle", orderable: true },
                        { title: "นามสกุล", className: "align-middle", orderable: true },
                        { title: "ตำแหน่ง", className: "align-middle", orderable: false },
                        { title: "ฝ่าย", className: "align-middle", orderable: false }, // ย่อคอลัมน์ "ฝ่าย"
                        { title: "อีเว้นท์", className: "align-middle", orderable: false },
                        { title: "ภูมิภาค", className: "align-middle", orderable: false },
                        { title: "จัดการ", className: "align-middle", orderable: false }
                    ],

                    initComplete: function () {

                        var column1 = this.api().column(1);
                        $(column1.header()).html('<label for="province">จังหวัด: </label>');
                        var select1 = $('<select id="province" class=" form-control custom-select"><option value="">ทั้งหมด</option></select>')
                            .appendTo($(column1.header()))
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column1.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column1.data().unique().sort().each(function (d) {
                            select1.append('<option value="' + d + '">' + d + '</option>');
                        });

                        var column4 = this.api().column(4);
                        $(column4.header()).html('<label for="positionFilter">ตำแหน่ง: </label>');
                        var select1 = $('<select id="positionFilter" class=" form-control custom-select"><option value="">ทั้งหมด</option></select>')
                            .appendTo($(column4.header()))
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column4.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column4.data().unique().sort().each(function (d) {
                            select1.append('<option value="' + d + '">' + d + '</option>');
                        });

                        // Filter for "ฝ่าย" column
                        var column5 = this.api().column(5);
                        $(column5.header()).html('<label for="position">ฝ่าย: </label>');
                        var select2 = $('<select id="position" class="liseventssuper-province-select form-control custom-select"><option value="">ทั้งหมด</option></select>')
                            .appendTo($(column5.header()))
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column5.search(val ? '^' + val + '$' : '', true, false).draw();
                            });
                        column5.data().unique().sort().each(function (d) {
                            select2.append('<option value="' + d + '">' + d + '</option>');
                        });

                        // // Filter for "จังหวัด" column
                        // var column3 = this.api().column(6);
                        // $(column3.header()).html('<label for="posi">จังหวัด: </label>');
                        // var select3 = $('<select id="posi" class="form-control custom-select"><option value=""></option></select>')
                        //     .appendTo($(column3.header()))
                        //     .on('change', function () {
                        //         var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        //         column3.search(val ? '^' + val + '$' : '', true, false).draw();
                        //     });
                        // column3.data().unique().sort().each(function (d) {
                        //     select3.append('<option value="' + d + '">' + d + '</option>');
                        // });
                    },

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
                                url: "../../service/managercard/delete.php",
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
    </script>
</body>

</html>