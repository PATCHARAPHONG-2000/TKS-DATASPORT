<?php
require_once 'service/connect.php';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>TKS SPORTDATA</title>
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
            <h1 class="logo"><a href="./">TKS SPORTDATA</a></h1>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="index.php#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="index.php#about">About</a></li>
                    <li><a class="nav-link scrollto " href="index.php#portfolio">Photo</a></li>
                    <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Login
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="login" style="color:black">TKS DATASPORT</a>
                            <a class="dropdown-item" href="login_ad" style="color:black">AD Card</a>
                            <a class="dropdown-item" href="login_score" style="color:black">Score</a>
                        </div>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header>
    <!-- End Header -->

    <main id="main">

        <div id="toast-container" class="position-absolute top-20 end-0 p-3"></div>

        <section class="vh-100 login" id="login">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card" style="border-radius: 1rem;">
                            <div class="card-body align-items-center">
                                <form id="formLogin">
                                    <div class="mb-md-5">
                                        <h2 class="fw-bold mb-5 text-uppercase text-center">SCORE</h2>
                                        <div class="form-outline form-white mb-4">
                                            <input type="text" id="user" name="user"
                                                class="form-control form-control-lg" placeholder="USERNAME" required />
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <input type="password" id="password" name="password"
                                                class="form-control form-control-lg" placeholder="PASSWORD" required />
                                        </div>
                                        <div class="mt-4 pt-2 text-center">
                                            <button class="btn align-items-center" name="login"
                                                type="submit">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3>TKS SPORTDATA</h3>
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
                <strong>Copyright &copy; 2023
                    <a href="https://www.facebook.com/PHATCHARAPHONG2000" target="_blank">PATCHARAPHONGDEV</a>.
                </strong> All rights reserved.
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
    <script src="assets/js/reset_pw.js"></script>


    <script>
        $(function () {
            $("#formLogin").submit(function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "service/auth/login_score.php",
                    data: $(this).serialize(),
                    dataType: "json",
                }).done(function (resp) {
                    if (resp.error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: resp.error,
                            confirmButtonColor: "#FF0000", // Red color
                        });
                    } else {
                        if (resp.role === "KARATE") {
                            let timerInterval;
                            Swal.fire({
                                title: "กำลังเข้าสู่ระบบ",
                                html: "กำลังตรวจสอบ <b></b> ข้อมูล.",
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading();
                                    const timer = Swal.getPopup().querySelector("b");
                                    timerInterval = setInterval(() => {
                                        timer.textContent = `${Swal.getTimerLeft()}`;
                                    }, 100);
                                },
                                willClose: () => {
                                    clearInterval(timerInterval);
                                }
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    // The timer was responsible for closing the alert
                                    location.href = "Skarate/";
                                }
                            });

                        } else if (resp.role === "PCSL") {
                            let timerInterval;
                            Swal.fire({
                                title: "กำลังเข้าสู่ระบบ",
                                html: "กำลังตรวจสอบ <b></b> ข้อมูล.",
                                timer: 1000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading();
                                    const timer = Swal.getPopup().querySelector("b");
                                    timerInterval = setInterval(() => {
                                        timer.textContent = `${Swal.getTimerLeft()}`;
                                    }, 100);
                                },
                                willClose: () => {
                                    clearInterval(timerInterval);
                                }
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    location.href = "Spscl/";
                                }
                            });
                        } else {
                            console.log("Role not recognized");
                        }
                    }
                });
            });
        });

    </script>


</body>

</html>


<!-- <script>
        function moveToNextInput(event, nextInputId) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById(nextInputId).focus();
            }
        }
        function checkAndSum() {
            const numbers = [
                parseFloat(document.getElementById('number1').value),
                parseFloat(document.getElementById('number2').value),
                parseFloat(document.getElementById('number3').value),
                parseFloat(document.getElementById('number4').value),
                parseFloat(document.getElementById('number5').value),
                parseFloat(document.getElementById('number6').value),
                parseFloat(document.getElementById('number7').value),
            ];
            const sumOfAllNumbers = numbers.reduce((acc, value) => acc + value, 0);
            console.log(sumOfAllNumbers);

            // 1. ตรวจสอบคะแนนน้อยสุดและมากสุด
            const minValue = Math.min(...numbers);
            const maxValue = Math.max(...numbers);
            console.log(minValue);
            console.log(maxValue);

            // 2. ถ้ามีมากกว่า 1 ช่อง, ลบคะแนนช่องที่มากและน้อยที่สุดออกอย่างละ 1 ช่อง
            if (numbers.filter(value => value === minValue).length > 1 && numbers.filter(value => value === maxValue).length > 1) {
                // ตรวจสอบว่า numbers มีค่าที่มากสุดและน้อยสุด
                const hasMaxValue = numbers.includes(maxValue);
                const hasMinValue = numbers.includes(minValue);

                // ถ้ามีค่าที่มากสุดและน้อยสุด, ให้ลบออก 1 ตัว
                if (hasMaxValue && hasMinValue) {
                    numbers.splice(numbers.indexOf(minValue), 1);
                    numbers.splice(numbers.indexOf(maxValue), 1);

                }
            } else {
                // ถ้าไม่มีค่าที่ซ้ำมากกว่า 1 ครั้ง, ให้ลบค่ามากสุดน้อยสุดออก
                numbers.splice(numbers.indexOf(minValue), 1);
                numbers.splice(numbers.indexOf(maxValue), 1);
            }
            console.log(numbers);

            // 3. นำคะแนนที่เหลือจาก 5 ช่องมาบวกกัน
            const finalSum = numbers.reduce((acc, value) => acc + value, 0);

            // แสดงผลลัพธ์โดยตัดทศนิยมให้เหลือ 2 ตำแหน่ง
            document.getElementById('result').innerHTML = `
                <p>Minimum Value: ${minValue.toFixed(2)}</p>
                <p>Maximum Value: ${maxValue.toFixed(2)}</p>
                <p>Final Sum: ${finalSum.toFixed(2)}</p>
                <p>Max Sum: ${sumOfAllNumbers.toFixed(2)}</p>
            `;


            // เพิ่มข้อมูลคะแนนใน local storage
            localStorage.setItem('finalSum', finalSum.toFixed(2));

        }

        function clearInputs() {
            // คลีร์ค่าใน input fields
            document.getElementById('number1').value = '';
            document.getElementById('number2').value = '';
            document.getElementById('number3').value = '';
            document.getElementById('number4').value = '';
            document.getElementById('number5').value = '';
            document.getElementById('number6').value = '';
            document.getElementById('number7').value = '';

            // คลีร์ค่าที่อยู่ใน Local Storage
            localStorage.removeItem('finalSum');
            localStorage.removeItem('minValue');
            localStorage.removeItem('maxValue');
            localStorage.removeItem('allScores');

            //     // คลีร์ค่าที่แสดงในส่วน "Result"
            document.getElementById('result').innerHTML = '';
        }


    </script> -->