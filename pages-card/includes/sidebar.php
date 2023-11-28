<?php

$Database = new Database();
$conn = $Database->connect();
function isActive($data)
{
    $array = explode('/', $_SERVER['REQUEST_URI']);
    $key = array_search("pages", $array);
    $name = $array[$key + 1];
    return $name === $data ? 'active' : '';
}

if (isset($_SESSION['id_city'])) {
    $id_province = $_SESSION['id_city']['province'];
} else {
    $id_province = 'default_status';
}

$adm = $conn->prepare("SELECT * FROM data_admin");
$adm->execute();
$rowr = $adm->fetch(PDO::FETCH_ASSOC);

$sql = $conn->prepare("SELECT * FROM data_id");
$sql->execute();
$rowe = $sql->fetch(PDO::FETCH_ASSOC);


?>

<link rel="stylesheet" href="../../assets/css/sidebar.css">
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars fa-2x"></i></a>
        </li>
        <li class="nav-item text-center">
            <p class="nav-link" style="font-size: 20px; font-weight: bold; color: black; " disabled>
                <?php echo isset($_SESSION['id_city']['province']) ? $_SESSION['id_city']['province'] : ''; ?>
            </p>
        </li>
    </ul>

    <!-- <div class="ms-auto order-1 notification">
        <div class="position-relative">
            <a href="#" id="notificationIcon" data-toggle="modal" data-target="#notificationModal">
                <i class="nav-icon fa-regular ms-auto fa-bell fa-2x">
                    <span class="badge bg-danger rounded-circle position-absolute top-0 start-100 translate-middle">
                        5
                    </span>
                </i>
            </a>
        </div>
    </div> -->

</nav>

<div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificationModalLabel">Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Add your notification content here -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Notification 1</h5>
                        <p class="card-text">Some details about notification 1.</p>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Notification 2</h5>
                        <p class="card-text">Some details about notification 2.</p>
                    </div>
                </div>

                <!-- Add more cards as needed -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-info elevation-4">

    <a href="../dashboard/" class="brand-link">
        <img src="../../assets/images/logo.png" alt="Admin Logo" class="brand-image ">
        <span class="brand-text font-weight-light">TKS SPORTDATA</span>
    </a>

    <div class="sidebar mt-3 pb-3 mb-3 d-flex">

        <nav class="mt-3 pb-3 mb-3 d-flex">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                <li class="nav-item">
                    <a href="../dashbord/" class="nav-link ">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>ตรวจสอบรายชื่อ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../manager/form-create" class="nav-link ">
                        <i class="nav-icon fa-solid fa-user-plus"></i>
                        <p>เพิ่มข้อมูลรายชื่อ</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="../events/" class="nav-link ">
                        <i class="nav-icon fa-solid fa-calendar-check"></i>
                        <p>Events</p>
                    </a>
                </li>

            

                <!-- <li class="nav-item">
                        <a href="../taekwondo/ad" class="nav-link ">
                            <i class="nav-icon fa-solid fa-user-plus"></i>
                            <p>สร้าง AD Card</p>
                        </a>
                </li> -->

                <i class=""></i>


                <li class="nav-header">บัญชีของเรา</li>
                <li class="nav-item">
                    <a id="logout" class="nav-link" onclick="confirmLogout()">
                        <i class="nav-icon  fa-solid fa-arrow-right-from-bracket"></i>
                        <p>ออกจากระบบ</p>
                    </a>
                </li>


                <!-- <?php if ($_SESSION['AD_ADMIN'] == 'taekwondo' || $_SESSION['AD_ADMIN'] == 'superadmin') { ?>
                    <li class="nav-item">
                        <a href="../taekwondo/" class="nav-link <?php echo isActive('manager') ?>">
                            <i class="nav-icon fa-solid fa-users"></i>
                            <p>ตรวจสอบรายชื่อ</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../taekwondo/form-create" class="nav-link <?php echo isActive('manager') ?>">
                            <i class="nav-icon fa-solid fa-user-plus"></i>
                            <p>เพิ่มข้อมูลรายชื่อ</p>
                        </a>
                    </li>
                   
                   
                <?php } ?>
                <?php if ($_SESSION['AD_ADMIN'] == 'karate' || $_SESSION['AD_ADMIN'] == 'superadmin') { ?>
                    <li class="nav-item">
                        <a href="../karate/" class="nav-link <?php echo isActive('members') ?>">
                            <i class="nav-icon fa-solid fa-users"></i>
                            <p>KARATE</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../karate/form-create" class="nav-link <?php echo isActive('manager') ?>">
                            <i class="nav-icon fa-solid fa-user-plus"></i>
                            <p>เพิ่มพนักงาน</p>
                        </a>
                    </li>
                    
                <?php } ?>
                <?php if ($_SESSION['AD_ADMIN'] == 'gymnastic' || $_SESSION['AD_ADMIN'] == 'superadmin') { ?>
                    <li class="nav-item">
                        <a href="../gymnastic/" class="nav-link <?php echo isActive('products') ?>">
                            <i class="nav-icon fa-solid fa-user-pen"></i>
                            <p>GYMNASTIC</p>
                        </a>
                    </li>
                <?php } ?>
                <i class=""></i>


                <li class="nav-header">บัญชีของเรา</li>
                <li class="nav-item">
                    <a id="logout" class="nav-link" onclick="confirmLogout()">
                        <i class="nav-icon  fa-solid fa-arrow-right-from-bracket"></i>
                        <p>ออกจากระบบ</p>
                    </a>
                </li> -->


            </ul>
        </nav>
    </div>
</aside>

<script src="https://kit.fontawesome.com/86e67b6ecc.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    function confirmLogout() {
        Swal.fire({
            title: 'ต้องการออกจากระบบหรือไม่?',
            text: 'หากคุณออกจากระบบ คุณจะต้องเข้าสู่ระบบใหม่เพื่อเข้าถึงบัญชีของคุณ',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../logout.php';
            }
        });
    }



</script>