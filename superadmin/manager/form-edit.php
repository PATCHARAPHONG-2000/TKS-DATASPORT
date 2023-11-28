<?php
/**
 * Page Manager Edit Admin
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
require_once('../authen.php');

$Database = new Database();
$conn = $Database->connect();

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
    <title>จัดการผู้ดูแลระบบ | AppzStory</title>
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
                                                    <label for="lastname">นามสกุล</label>
                                                    <input type="text" class="form-control" name="lastname"
                                                        id="lastname" placeholder="นามสกุล"
                                                        value="<?php echo $row['lastname'] ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 px-1 px-md-5">
                                                <div class="form-group">
                                                    <label for="permission">ตำแหน่ง</label>
                                                    <select class="form-control" name="status" id="permission">
                                                        <option value="" disabled selected>ระบุตำแหน่ง</option>
                                                        <?php
                                                        $positions = array("หัวหน้ากรรมการ", "กรรมการ");

                                                        foreach ($positions as $position) {
                                                            $selected = ($position == $row['status']) ? "selected" : "";
                                                            echo "<option value='$position' $selected>$position</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="customFile">รูปโปรไฟล์</label>
                                                    <div class="custom-file">
                                                        <input name="image" type="file" class="custom-file-input"
                                                            id="customFile" accept="image/*">
                                                        <label class="custom-file-label"
                                                            for="customFile">เลือกรูปภาพ</label>
                                                    </div>
                                                    <img src="../../assets/images/avatar5.png" alt="Image Profile"
                                                        class="img-fluid p-3">
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
                            timer: 1500
                        })/* ; */.then((result) => {
                            location.assign('./');
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
                        })/* ; */.then((result) => {
                            location.assign('./');
                        });
                    }
                });

            });
        });

    </script>

</body>

</html>