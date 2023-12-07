<?php

require_once('../authen.php');

$Database = new Database();
$conn = $Database->connect();


$id = $_GET['id'];
$params = array('id' => $id);
$selectbyidUser = $conn->prepare("SELECT * FROM sport WHERE id = :id");
$selectbyidUser->execute($params);
$sp = $selectbyidUser->fetch(PDO::FETCH_ASSOC);

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
                                                        value="<?php echo $sp['firstname'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">ตำแหน่ง</label>
                                                    <input type="text" class="form-control" name="status" id="status"
                                                        placeholder="ตำแหน่ง" value="<?php echo $sp['status'] ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="province">จังหวัด</label>
                                                    <select class="form-control" disabled name="province" id="province">
                                                        <option value="" disabled selected></option>
                                                        <?php
                                                        echo "<option value='{$sp['province']}' selected>{$sp['province']}</option>";
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 px-1 px-md-5">

                                                <div class="form-group">
                                                    <label for="lastname">นามสกุล</label>
                                                    <input type="text" class="form-control" name="lastname"
                                                        id="lastname" placeholder="นามสกุล"
                                                        value="<?php echo $sp['lastname'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="customFile">รูปโปรไฟล์</label>
                                                    <div class="custom-file mb-2 ">
                                                        <input name="image" type="file" class="custom-file-input"
                                                            id="customFile" accept="image/*">
                                                        <label class="custom-file-label"
                                                            for="customFile">เลือกรูปภาพ</label>
                                                    </div>
                                                    <p for="" style="font-size: 12px; color: red;" class="mt-2 mb-1">*
                                                        ขนาดไฟล์ภาพไม่เกิน 5 MB</p>
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
                resetFileInput();
                return;
            }

            const maxSizeInBytes = 5 * 1024 * 1024; // 5 MB

            // Check image size
            if (file.size > maxSizeInBytes) {
                showFileSizeExceedWarning();
                resetFileInput();
                return;
            }

            // เมื่อไฟล์ถูกต้อง อัปเดตป้ายกำกับด้วยชื่อไฟล์
            const fileName = file.name;
            customFileLabel.html(fileName);
        });

        function resetFileInput() {
            fileInput.value = '';
            customFileLabel.html('');
        }

        function showFileSizeExceedWarning() {
            Swal.fire({
                title: "ขนาดไฟล์เกิน",
                text: "ขนาดไฟล์ภาพของคุณเกิน 5 MB กรุณาเลือกใหม่",
                icon: "warning",
            });
        }



        $(function () {
            $("#formData").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '../../service/sport/update.php',
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