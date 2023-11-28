<?php

/**
 *  Page Manager Create Admin
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
require_once('../authen.php');

$Database = new Database();
$conn = $Database->connect();

$sql = $conn->prepare("SELECT * FROM data_id");
$sql->execute();
$row = $sql->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการผู้ดูแลระบบ | TKS SPORTDATA</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon.ico">
    <!-- stylesheet -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include_once('../includes/sidebar.php') ?>
        <div class="content-wrapper pt-3">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-header border-0 pt-4">
                                    <!-- <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-info ml-auto" id="adButton">
                                            Ad
                                        </button>
                                    </div> -->
                                    <h4>
                                        <i class="fas fa-user-cog"></i>
                                        เพิ่มข้อมูลรายชื่อ
                                    </h4>

                                </div>
                                <form id="formData" id="originalCardBody" enctype="multipart/form-data">
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
                                                    <label for="status">ตำแหน่ง <span
                                                            style="color: red;">*</span></label>

                                                    <select class="form-control" name="status" id="status" required>
                                                        <option value disabled selected>ระบุตำแหน่ง</option>
                                                        <?php foreach ($row as $status): ?>
                                                            <?php if ($status['status'] !== null): ?>
                                                                <option data-status="<?php echo $status['status']; ?>">
                                                                    <?php echo $status['status']; ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>

                                                        <option id="other">อื่นๆ</option>
                                                    </select>
                                                    <input type="text" class="form-control" name="other_status"
                                                        id="other_status" style="display: none;"
                                                        placeholder="ระบุตำแหน่ง">
                                                </div>


                                                <div class="form-group">
                                                    <label for="province">จังหวัดที่อยู่<span
                                                            style="color: red;">*</span></label>
                                                    <select class="form-control" name="province" id="province"
                                                        required>
                                                        <option value="" disabled selected>เลือกจังหวัด</option>
                                                        <?php foreach ($row as $province): ?>
                                                            <?php if ($province['province'] !== null): ?>
                                                                <option data-province="<?php echo $province['province']; ?>">
                                                                    <?php echo $province['province']; ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>

                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="isActive">สถานะการสมัคร Events</label>
                                                    <select class="form-control" name="isActive" id="isActive" required>
                                                        <option value disabled selected>เลือกสถานะการสมัคร</option>
                                                        <option value="ยังไม่สมัคร">ยังไม่สมัคร</option>
                                                        <option value="สมัครเรียบร้อย">สมัครเรียบร้อย</option>
                                                    </select>
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
                                                    <label for="department">ฝ่าย <span
                                                            style="color: red;">*</span></label>
                                                    <select class="form-control" name="department" id="department"
                                                        required>
                                                        <option value disabled selected>เลือกฝ่าย</option>
                                                        <?php foreach ($row as $department): ?>
                                                            <?php if ($department['department'] !== null): ?>
                                                                <option
                                                                    data-department="<?php echo $department['department']; ?>">
                                                                    <?php echo $department['department']; ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <option value="อื่นๆ">อื่นๆ</option>
                                                    </select>
                                                    <input type="text" class="form-control" name="other_department"
                                                        id="other_department" style="display: none;"
                                                        placeholder="เลือกฝ่าย">
                                                </div>

                                                <div class="form-group">
                                                    <label for="customFile">รูปโปรไฟล์ <span
                                                            style="color: red;">*</span></label>
                                                    <div class="custom-file">
                                                        <input name="image" type="file" class="custom-file-input"
                                                            id="customFile" accept="image/*" required>
                                                        <label class="custom-file-label"
                                                            for="customFile">เลือกรูปภาพ</label>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-block mx-auto w-50"
                                            name="submit">บันทึกข้อมูล</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('../includes/footer.php') ?>
    </div>


    <!-- SCRIPTS -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>


    <script>
        function switeStatus() {
            var select = document.getElementById('status');
            var otherStatusInput = document.getElementById('other_status');


            if (select.value === 'อื่นๆ') {
                otherStatusInput.style.display = 'block';
            } else {
                otherStatusInput.style.display = 'none';
            }
        }
        function switedepartment() {
            var select = document.getElementById('department');
            var otherStatusInput = document.getElementById('other_department');


            if (select.value === 'อื่นๆ') {
                otherStatusInput.style.display = 'block';
            } else {
                otherStatusInput.style.display = 'none';
            }
        }

        document.getElementById('department').addEventListener('change', switedepartment);
        document.getElementById('status').addEventListener('change', switeStatus);

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
                    url: '../../service/superadmin/create.php',
                    data: new FormData(this),
                    contentType: false,
                    processData: false
                }).done(function (resp) {
                    Swal.fire({
                        text: 'เพิ่มข้อมูลเรียบร้อย',
                        icon: 'success',
                        confirmButtonText: 'ตกลง',
                        // showConfirmButton: false,
                        // timer: 500
                    }).then((result) => {
                        // location.assign('./form-create');
                    });
                })
            });
        });
    </script>


</body>

</html>