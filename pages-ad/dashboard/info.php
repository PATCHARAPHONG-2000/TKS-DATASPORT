<?php

require_once('../authen.php');
$Database = new Database();
$conn = $Database->connect();
    // ดึง ID จาก URL
    $id = $_GET['id'];
    $selectById = $conn->prepare("SELECT * FROM personnel WHERE id = :id");
    $selectById->bindParam(':id', $id);
    $selectById->execute();

    // ดึงข้อมูลแบบ associative array
    $info = $selectById->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($_SESSION['id_city']['province']) ? $_SESSION['id_city']['province'] : ''; ?> | TKS SPORTDATA</title>
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
        <div class="content-wrapper pt-4">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow">
                                <div class="card-header border-0 pt-4">
                                    <h4>
                                    <i class="fa-regular fa-address-book"></i>
                                        ข้อมูลทั้งหมดของ : <?php echo $info['firstname']; ?>
                                        
                                    </h4>
                                    <a href="./" class="btn btn-info mt-3">
                                    <i class="fas fa-list"></i>
                                    กลับหน้าหลัก
                                </a>
                                </div>
                                <div class="card-body px-5">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <div class="card shadow-sm">
                                                <div class="card-header pt-4">
                                                    <h3 class="card-title">
                                                    <i class="fa-regular fa-user"></i>
                                                        ข้อมูลส่วตัว
                                                    </h3>
                                                </div>
                                                <div class="card-body px-5">
                                                    <div class="row mb-3">
                                                        <p class="col-xl-3 text-muted">ชื่อ :</p>
                                                        <div class="col-xl-9">
                                                            <?php echo $info['firstname'] ?>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <p class="col-xl-3 text-muted">นามสกุล :</p>
                                                        <div class="col-xl-9">
                                                           <?php echo $info['lastname'] ?>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <p class="col-xl-3 text-muted">ตำแหน่ง :</p>
                                                        <div class="col-xl-9">
                                                            <?php echo $info['status'] ?>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <p class="col-xl-3 text-muted">จังหวัด :</p>
                                                        <div class="col-xl-9">
                                                            <p><?php echo $info['province'] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <p class="col-xl-3 text-muted">วันที่เพิ่มรายชื่อ :</p>
                                                        <div class="col-xl-9">
                                                            <p><?php echo $info['create_time'] ?></p>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="card shadow-sm">
                                                <div class="card-header pt-4">
                                                    <h3 class="card-title">
                                                    <i class="fa-regular fa-image"></i>
                                                     รูปภาพ
                                                    </h3>
                                                </div>
                                                <div class="card-body px-5">
                                                <img src="../../service/uploads/<?php echo $info['image'] ?>" alt="Profile" style="max-width: 180px;">
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
</body>

</html>