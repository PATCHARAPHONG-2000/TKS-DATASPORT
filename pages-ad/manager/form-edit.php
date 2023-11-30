<?php

require_once('../authen.php');

$Database = new Database();
$conn = $Database->connect();


$sql = $conn->prepare("SELECT * FROM data_id");
$sql->execute();
$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

$id = $_GET['id'];
$params = array('id' => $id);
$selectbyidUser = $conn->prepare("SELECT * FROM personnel WHERE id = :id");
$selectbyidUser->execute($params);
$row = $selectbyidUser->fetch(PDO::FETCH_ASSOC);

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
                                    <h4>
                                        <i class="fas fa-user-cog"></i>
                                        แก้ไขข้อมูล
                                    </h4>

                                </div>
                                <form id="formData">
                                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-md-6 px-1 px-md-5">
                                                <div class="form-group">
                                                    <label for="firstname">ชื่อ</label>
                                                    <input type="text" class="form-control" name="firstname"
                                                        id="firstname" placeholder="ชื่อ"
                                                        value="<?php echo $row['firstname'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">ตำแหน่ง</label>
                                                    <input type="text" class="form-control" name="status" id="status"
                                                        placeholder="ตำแหน่ง" value="<?php echo $row['status'] ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="province">จังหวัด</label>
                                                    <select class="form-control" disabled name="province" id="province">
                                                        <option value="" disabled selected></option>
                                                        <?php
                                                        echo "<option value='{$row['province']}' selected>{$row['province']}</option>";
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 px-1 px-md-5">

                                                <div class="form-group">
                                                    <label for="lastname">นามสกุล</label>
                                                    <input type="text" class="form-control" name="lastname"
                                                        id="lastname" placeholder="นามสกุล"
                                                        value="<?php echo $row['lastname'] ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="identity">จังหวัด</label>
                                                    <select class="form-control" name="identity" id="identity">
                                                        <option value="" selected></option>
                                                        <?php
                                                        // แสดง name_status จาก query ข้อมูล personnel
                                                        echo "<option value='{$row['name_status']}' selected>{$row['name_status']}</option>";

                                                        // แสดงตัวเลือก status จาก query ข้อมูล data_id
                                                        foreach ($rows as $name_status) {
                                                            if ($name_status['status'] !== null) {
                                                                $selectedname_status = ($row['status'] == $name_status['status']) ? "selected" : "";
                                                                echo "<option value='{$name_status['status']}' {$selectedname_status}>{$name_status['status']}</option>";
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="customFile">รูปโปรไฟล์</label>
                                                    <div class="custom-file mb-2 ">
                                                        <input name="image" type="file" class="custom-file-input"
                                                            id="customFile" accept="image/*">
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
            $("#formData").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '../../service/managercard/update.php',
                    data: new FormData($('#formData')[0]),
                    processData: false,
                    contentType: false,
                    success: function (resp) {
                        Swal.fire({
                            icon: 'success',
                            title: 'อัพเดทข้อมูลเรียบร้อยแล้ว',
                            showConfirmButton: false,
                            timer: 1000
                        }).then((result) => {
                            location.assign('../dahbord/');
                        });
                    },
                    error: function (xhr, status, error) {
                        // Handle AJAX request errors
                        console.log('XHR:', xhr);
                        console.log('Status:', status);
                        console.log('Error:', error);

                        Swal.fire({
                            icon: 'error',
                            title: 'Update failed. Please try again.',
                            showConfirmButton: false,
                            timer: 1000
                        }).then((result) => {
                            location.assign('../dahbord/');
                        });
                    }
                });

            });
        });

    </script>

</body>

</html>