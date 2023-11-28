<?php
/**
 * Login Page
 *
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
require_once 'service/connect.php';

$Database = new Database();
$conn = $Database->connect();

$sql = $conn->prepare("SELECT * FROM id_users");
$sql->execute();
$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>TKS SOFTVISION</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
    <!-- stylesheet -->

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">

    <!-- Template Main CSS File -->
    <link href="assets/css/home.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body>
    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center"></div>
            <div class="social-links d-none d-md-block">
                <a href="https://www.facebook.com/TKSsoft" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="https://line.me/ti/p/_EFnRUO5tK" class="line"> <i class="bi bi-line"></i></a>
            </div>
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="logo"><a href="./">TKS SOFTVISION</a></h1>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="index.php#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="index.php#about">About</a></li>
                    <li><a class="nav-link scrollto " href="index.php#portfolio">Photo</a></li>
                    <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
                    <li><a class="nav-link scrollto" href="login">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->


    <main id="main">

        <section class="vh-100 province " id="province">
            <div class="container  ">
                <div class="row d-flex justify-content-center ">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card " style="border-radius: 1rem;">
                            <div class="card-body  align-items-center">

                                <form id="formprovince">
                                    <div class="mb-md-5 ">

                                        <h2 class="fw-bold mb-5 mt-2 text-uppercase text-center">จังหวัด</h2>

                                        <div class="form-group">
                                            <label for="id_province" class="form-label"> เลือกจังหวัด</label>
                                            <select class="form-control" name="id_province" id="id_province" required>
                                                <option value="" disabled selected>เลือกจังหวัด</option>
                                                <?php foreach ($rows as $row): ?>
                                                    <option value="<?php echo $row['province']; ?>">
                                                        <?php echo $row['province']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="mt-2 pt-2 text-center">
                                            <button class="btn align-items-center" name="province"
                                                type="submit">OK</button>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3>TKS SOFTVISION</h3>
                            <p>
                                Anusawari Sub-district <br> Bang Khen District <br> Bangkok 10220, Thailand.
                                <br><br><br>
                                <strong>Phone :</strong> 084-083-8587<br>
                                <strong>Email :</strong> tks.softvision.thai@gmail.com<br>
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="index.php#hero">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="index.php#about">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="index.php#portfolio">Photo</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="index.php#contact">Contact</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>TKS</span></strong>. All Rights Reserved
            </div>
            <div class="credits">

            </div>
        </div>
    </footer>
    <!-- End Footer -->


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>

    <!--  -->
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="plugins/toastr/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/login.js"></script>
    <script src="assets/js/reset_pw.js"></script>


    <script>

        $(function () {
            /** Ajax Submit Login */
            $("#formprovince").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "service/auth/check_pin.php",
                    data: $(this).serialize(),
                    dataType: "json",
                }).done(function (resp) {
                    if (resp.error) {
                        console.log(resp);
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: resp.error,
                            confirmButtonColor: "#FF0000", // สีแดง
                        });
                    } else {
                        console.log(resp);
                        let timerInterval;
                        Swal.fire({
                            title: "กรุณารอสักครู่",
                            html: "กำลังตรวจสอบ <b></b> ข้อมูล.",
                            timer: 2000,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                const b = Swal.getHtmlContainer().querySelector("b");
                                timerInterval = setInterval(() => {
                                    b.textContent = Swal.getTimerLeft();
                                }, 100);
                            },
                            willClose: () => {
                                clearInterval(timerInterval);
                            },
                        }).then((result) => {
                            /* Read more about handling dismissals below */
                            if (result.dismiss === Swal.DismissReason.timer) {
                                console.log("เข้าแล้ว");
                                Swal.fire({
                                    title: "กรุณากรอก PIN",
                                    html: `
                                    <div class="container pin mt-4">
                                        <form id="pinForm">
                                            <div class="input-field">
                                                <input type="number" id="digit1" max="9" oninput="moveToNext(this, 'digit2')" />
                                                <input type="number" id="digit2" max="9" oninput="moveToNext(this, 'digit3')" />
                                                <input type="number" id="digit3" max="9" oninput="moveToNext(this, 'digit4')" />
                                                <input type="number" id="digit4" max="9" oninput="moveToNext(this, 'digit5')" />
                                                <input type="number" id="digit5" max="9" oninput="moveToNext(this, 'digit6')" />
                                                <input type="number" id="digit6" max="9" />
                                            </div>
                                        </form>
                                    </div>
                                    `,
                                    showCancelButton: true,
                                    confirmButtonText: "Look up",
                                    showLoaderOnConfirm: true,
                                    preConfirm: (pin) => {
                                        return new Promise((resolve, reject) => {
                                            $.ajax({
                                                url: "service/auth/check_pin.php",
                                                type: "POST",
                                                data: {
                                                    pin: pin,
                                                },
                                                dataType: "json",
                                                success: function (response) {
                                                    if (response.status) {
                                                        console.log(response);
                                                        resolve(response);
                                                    } else {
                                                        console.log(response.message);
                                                        reject(response.message);
                                                    }
                                                },
                                                error: function (xhr, ajaxOptions, thrownError) {
                                                    console.log('aaaaaaaaa0000')
                                                    reject(thrownError);
                                                },
                                            });
                                        }).catch((error) => {
                                            Swal.showValidationMessage(error);
                                        });
                                    },
                                    allowOutsideClick: () => !Swal.isLoading()
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        console.log('aaaaaaaaa')
                                    }
                                });
                            }
                        });
                    }
                });
            });

        });



    </script>


</body>

</html>