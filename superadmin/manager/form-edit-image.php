<?php
require_once('../authen.php');
$Database = new Database();
$conn = $Database->connect();

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    $params = array('id' => $id);
    $selectbyidUser = $conn->prepare("SELECT * FROM data_all WHERE id = :id");
    $selectbyidUser->execute($params);
    $row = $selectbyidUser->fetch(PDO::FETCH_ASSOC);
} else {
    // Handle the case where no 'id' is provided.
    // You might want to redirect the user or show an error message.
    exit('Invalid ID.');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการผู้ดูแลระบบ | TKS SPORTDATA</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon.ico">
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
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 px-1 px-md-5">
                                                <div class="form-group">
                                                    <label for="name">ชื่อ</label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        placeholder="ชื่อ" value="<?php echo $row['name'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 px-1 px-md-5">
                                                <div class="form-group">
                                                    <label for="customFile">รูปแบร์นเนอร์ <span
                                                            style="color: red;">*</span></label>
                                                    <div class="custom-file mb-2">
                                                        <input name="image" type="file" class="custom-file-input"
                                                            id="customFile" accept="image/*">
                                                        <label class="custom-file-label"
                                                            for="customFile">เลือกรูปภาพ</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="imagePreview" class="text-center mx-auto mt-3"></div>
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

    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>

    <script>
        function displayFileName() {
            var input = document.getElementById('customFile');
            var fileName = input.files[0].name;
            var label = document.querySelector('.custom-file-label');
            label.innerText = fileName;

            var preview = document.getElementById('imagePreview');
            preview.innerHTML = '';
            var img = document.createElement('img');
            img.src = URL.createObjectURL(input.files[0]);
            img.style.maxWidth = '50%';
            img.style.height = 'auto';
            preview.appendChild(img);
        }

        // Call the displayFileName() function when the file input changes
        document.getElementById('customFile').addEventListener('change', displayFileName);

        $(function () {
            $("#formData").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '../../service/superadmin/setting/image-update.php',
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
                            location.assign('../setting/image.php');
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log('XHR:', xhr);
                        console.log('Status:', status);
                        console.log('Error:', error);

                        Swal.fire({
                            icon: 'error',
                            title: 'Update failed. Please try again.',
                            showConfirmButton: false,
                            timer: 1000
                        }).then((result) => {
                            location.assign('../setting/image.php');
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>