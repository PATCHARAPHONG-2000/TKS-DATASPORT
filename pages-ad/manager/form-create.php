<?php
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
                                    <h4>
                                        <i class="fa-solid fa-user-plus"></i>
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
                                                    <input type="text" class="form-control" name="status" id="status"
                                                        placeholder="ตำแหน่ง" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="identity">สถานะ <span
                                                            style="color: red;">*</span></label>

                                                    <select class="form-control" name="identity" id="identity" required>
                                                        <option value disabled selected>เลือกสถานะ</option>
                                                        <?php foreach ($row as $status): ?>
                                                            <?php if ($status['status'] !== null): ?>
                                                                <option data-status="<?php echo $status['status']; ?>">
                                                                    <?php echo $status['status']; ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
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
                                                    <label for="customFile">รูปโปรไฟล์ <span
                                                            style="color: red;">*</span></label>
                                                    <div class="custom-file mb-2">
                                                        <input name="image" type="file" class="custom-file-input"
                                                            id="customFile" accept="image/*" required>
                                                        <label class="custom-file-label"
                                                            for="customFile">เลือกรูปภาพ</label>
                                                    </div>
                                                    <a href="../../assets/images/template-profile.psd" target="_blank"
                                                        class="mt-4"><i
                                                            class=" fa-regular fa-circle-down fa-xl ml-2"></i> ดาวโหลด
                                                        template-profile</a>
                                                    <p for="" style="font-size: 12px; color: red;" class="mt-2 mb-1">*
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
        const fileInput = document.getElementById('customFile');
        const customFileLabel = $(fileInput).next('.custom-file-label');

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];

            if (!file) {
                fileInput.value = '';
                customFileLabel.html('');
                return;
            }

            const maxSizeInBytes = 5 * 1024 * 1024; // 5 MB

            // Check image size
            if (file.size > maxSizeInBytes) {
                Swal.fire({
                    title: "ขนาดไฟล์เกิน",
                    text: "ขนาดไฟล์ภาพของคุณเกิน 5 MB กรุณาเลือกใหม่",
                    icon: "warning",
                }).then((result) => {
                    if (result.isConfirmed) {
                        // รีเซ็ต input ที่ใช้เลือกรูปภาพ
                        fileInput.value = '';
                        customFileLabel.html('');
                    }
                });
                return;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                const img = new Image();
                img.src = e.target.result;

                img.onload = function () {
                    const width = this.width;
                    const height = this.height;

                    if (width !== 900 || height !== 1280) {
                        Swal.fire({
                            title: "ขนาดภาพไม่ถูกต้อง",
                            text: "ขนาดรูปภาพไม่ถูกต้อง กรุณาเลือกรูปภาพที่มีขนาดของรูป สูง: 1280px - กว้าง: 900px",
                            icon: "warning",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // รีเซ็ต input ที่ใช้เลือกรูปภาพ
                                fileInput.value = '';
                                customFileLabel.html('');
                            }
                        });
                    } else {
                        // เมื่อไฟล์ถูกต้อง อัปเดตป้ายกำกับด้วยชื่อไฟล์
                        const fileName = fileInput.value.split('\\').pop();
                        customFileLabel.html(fileName);
                    }
                };
            };
            reader.readAsDataURL(file);
        });

        $(function () {
            $('#formData').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '../../service/managercard/create.php',
                    data: new FormData(this),
                    contentType: false,
                    processData: false
                }).done(function (resp) {
                    Swal.fire({
                        text: 'เพิ่มข้อมูลเรียบร้อย',
                        icon: 'success',
                        confirmButtonText: 'ตกลง',
                        showConfirmButton: false,
                        timer: 500
                    }).then((result) => {
                        location.assign('./form-create');
                    });
                })
            });
        });
    </script>


</body>

</html>