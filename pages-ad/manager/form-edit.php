<?php

require_once('../authen.php');

$Database = new Database();
$conn = $Database->connect();

$id = $_GET['id'];

$sql = $conn->prepare("SELECT * FROM data_id");
$sql->execute();
$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

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
                                                    <label for="firstname">ชื่อจริง</label>
                                                    <input type="text" class="form-control" name="firstname"
                                                        id="firstname" placeholder="ชื่อจริง"
                                                        value="<?php echo $row['firstname'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">ตำแหน่ง</label>
                                                    <select class="form-control" name="status" id="status">
                                                        <option value="" disabled selected>ระบุตำแหน่ง</option>
                                                        <?php

                                                        foreach ($statuss as $status) {
                                                            $selected = ($status == $row['status']) ? "selected" : "";
                                                            echo "<option value='$status' $selected>$status</option>";
                                                        }

                                                        ?>
                                                        <?php foreach ($rows as $status): ?>
                                                            <?php if ($status['status'] !== null): ?>

                                                                <?php
                                                                $selectedstatus = ($row['status'] == $status['status']) ? "selected" : "";
                                                                ?>
                                                                <option value="<?php echo $status['status']; ?>" <?php echo $selectedstatus; ?>>
                                                                    <?php echo $status['status']; ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <option id="other" value="อื่นๆ">อื่นๆ</option>
                                                    </select>
                                                    <input type="text" class="form-control" name="other_status"
                                                        id="other_status" style="display: none;"
                                                        placeholder="ระบุตำแหน่ง">
                                                </div>


                                                <div class="form-group">
                                                    <label for="province">จังหวัด</label>
                                                    <select class="form-control" disabled name="province" id="province">
                                                        <option value="" disabled selected>เลือกจังหวัด</option>
                                                        <?php

                                                        foreach ($statuss as $province) {
                                                            $selected = ($province == $row['province']) ? "selected" : "";
                                                            echo "<option value='$province' $selected>$province</option>";
                                                        }

                                                        ?>
                                                        <?php foreach ($rows as $province): ?>
                                                            <?php if ($province['province'] !== null): ?>

                                                                <?php
                                                                $selectedprovince = ($row['province'] == $province['province']) ? "selected" : "";
                                                                ?>
                                                                <option disabled value="<?php echo $province['province']; ?>"
                                                                    <?php echo $selectedprovince; ?>>
                                                                    <?php echo $province['province']; ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>

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
                                                    <label for="department">ฝ่าย</label>
                                                    <select class="form-control" name="department" id="department">
                                                        <option value disabled selected>เลือกฝ่าย</option>
                                                        <?php

                                                        foreach ($statuss as $department) {
                                                            $selected = ($department == $row['department']) ? "selected" : "";
                                                            echo "<option value='$department' $selected>$department</option>";
                                                        }

                                                        ?>
                                                        <?php foreach ($rows as $department): ?>
                                                            <?php if ($department['department'] !== null): ?>

                                                                <?php
                                                                $selecteddepartment = ($row['department'] == $department['department']) ? "selected" : "";
                                                                ?>
                                                                <option value="<?php echo $department['department']; ?>" <?php echo $selecteddepartment; ?>>
                                                                    <?php echo $department['department']; ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                        <option id="อื่นๆ" value="อื่นๆ">อื่นๆ</option>

                                                    </select>
                                                    <input type="text" class="form-control" name="other_department"
                                                        id="other_department" style="display: none;"
                                                        placeholder="เลือกฝ่าย">
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
                            timer: 1500
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