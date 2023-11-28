<?php
/**
 * Main Sidebar
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
function isActive($data)
{
    $array = explode('/', $_SERVER['REQUEST_URI']);
    $key = array_search("pages", $array);
    $name = $array[$key + 1];
    return $name === $data ? 'active' : '';
}
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars fa-2x"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto ">
        <li class="nav-item d-md-none d-block">
            <a href="../dashboard/">
                <img src="../../assets/images/logo.png" alt="Admin Logo" width="50px" class="img-circle elevation-3">
                <span class="font-weight-light pl-1">TKS SOFTVISION</span>
            </a>
        </li>

    </ul>
</nav>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="../dashboard/" class="brand-link">
        <img src="../../assets/images/logo.png" alt="Admin Logo" class="brand-image ">
        <span class="brand-text font-weight-light">TKS SOFTVISION</span>
    </a>

    <div class="sidebar mt-3 pb-3 mb-3 d-flex">

        <nav class="mt-3 pb-3 mb-3 d-flex">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="../dashboard/" class="nav-link <?php echo isActive('dashboard') ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>หน้าหลัก</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="../manager/" class="nav-link <?php echo isActive('manager') ?>">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>ผู้ดูแลระบบ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../members/" class="nav-link <?php echo isActive('members') ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>รายชื่อลูกค้า</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../products/" class="nav-link <?php echo isActive('products') ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>รายการสินค้า</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="../orders/" class="nav-link <?php echo isActive('orders') ?>">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>รายการสั่งซื้อ</p>
                    </a>
                </li> -->
                <li class="nav-header">บัญชีของเรา</li>
                <li class="nav-item">
                    <a id="logout" class="nav-link" onclick="confirmLogout()">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>ออกจากระบบ</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

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