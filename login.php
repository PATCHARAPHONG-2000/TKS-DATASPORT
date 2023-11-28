<?php
require_once 'service/connect.php';
$Database = new Database();
$conn = $Database->connect();

$sql = $conn->prepare("SELECT * FROM data_id");
$sql->execute();
$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

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
          <li><a class="nav-link scrollto" href="login">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header>
  <!-- End Header -->

  <main id="main">

    <div id="toast-container" class="position-absolute top-20 end-0 p-3"></div>

    <section class="vh-100 login " id="login">
      <div class="container  ">
        <div class="row d-flex justify-content-center ">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card " style="border-radius: 1rem;">
              <div class="card-body  align-items-center">

                <form id="formLogin">
                  <div class="mb-md-5 ">

                    <h2 class="fw-bold mb-5 text-uppercase text-center">Login</h2>

                    <div class="form-outline form-white mb-4 ">
                      <input type="email" id="email" name="email" class="form-control form-control-lg"
                        placeholder="Email" required />
                    </div>

                    <div class="form-outline form-white mb-4">
                      <input type="password" id="password" name="password" class="form-control form-control-lg"
                        placeholder="Password" required />
                    </div>

                    <p class="small mb-5 pb-lg-2 "><a class="-50" id="resetpassword" href="">Forgot
                        password?</a></p>

                    <div class="mt-4 pt-2 text-center">
                      <button class="btn align-items-center" name="login" type="submit">Login</button>
                      <!-- <input class="btn btn-primary btn-lg" name="login" type="submit" value="Login" /> -->
                    </div>
                  </div>
                </form>
                <div>
                  <p class="mb-0 text-center">Don't have an account?
                    <a href="register" class="-50 fw-bold sign-up-button" id="signUpLink">Sign
                      Up</a>
                  </p>
                </div>

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

    function moveToNext(currentInput, nextInputId) {
      const maxLength = parseInt(currentInput.getAttribute('maxlength'), 10);
      const inputValue = currentInput.value;

      if (inputValue.length >= maxLength) {
        const nextInput = document.getElementById(nextInputId);
        if (nextInput) {
          nextInput.focus();
        }
      }
    }

    $(function () {
      /** Ajax Submit Login */
      $("#formLogin").submit(function (e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: "service/auth/login.php",
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
              title: "กำลังเข้าสู่ระบบ",
              html: "กำลังตรวจสอบ <b></b> ข้อมูล.",
              timer: 1500,
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
                console.log("I was closed by the timer");
                if (resp.email === "admin") {
                  location.href = "pages/";
                } else if (resp.email === "admin-t") {
                  if (resp.role === "superadmin") {
                    location.href = "superadmin/"
                  }else if(resp.role === "karate") {
                    location.href = "Skarate/"  
                  }else if(resp.role === "pencak") {
                    location.href = "Spencak/"  
                  } else if (resp.role === "admin") {
                    Swal.fire({
                      title: "จังหวัด",
                      html: `
                      <div class="form-group mt-4 ">
                        <select class="form-control" name="id_province" id="id_province" required>
                          <option value="" disabled selected>เลือกจังหวัด</option>
                          <?php foreach ($rows as $row): ?>
                            <option data-province="<?php echo $row['province']; ?>">
                              <?php echo $row['province']; ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      `,
                      inputAttributes: {
                        autocapitalize: "off"
                      },
                      showCancelButton: false,
                      confirmButtonText: "OK",
                      showLoaderOnConfirm: true,

                      preConfirm: (id_province) => {
                        const province = document.getElementById('id_province').value;
                        const selectedProvince = $("#id_province option:selected");
                        const dataTypeProvince = selectedProvince.data("province");
                        return new Promise((resolve, reject) => {
                          $.ajax({
                            url: "service/auth/check_pin.php",
                            type: "POST",
                            data: { id_province: dataTypeProvince },
                            dataType: "json",
                            success: function (response) {
                              if (response.status) {
                                resolve(response);
                              } else {
                                console.log('test');
                                reject(response.message);
                              }
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                              console.log(xhr.responseText);
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

                        Swal.fire({
                          title: "กรุณากรอก PIN",
                          input: "text",
                          inputAttributes: {
                            type: "password",
                            maxlength: 6,
                            autocapitalize: "off"
                          },
                          showCancelButton: true,
                          confirmButtonText: "ตกลง",
                          showLoaderOnConfirm: true,
                          preConfirm: (pin) => {
                            window.currentpin = pin;
                            return new Promise((resolve, reject) => {
                              $.ajax({
                                url: "service/auth/check_pin.php",
                                type: "POST",
                                data: { pin: pin },
                                dataType: "json",
                                success: function (response) {
                                  if (response.status) {
                                    resolve(response);
                                  } else {
                                    reject(response.message);
                                  }
                                },
                                error: function (xhr, ajaxOptions, thrownError) {
                                  console.log(xhr.responseText);
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
                            location.href = "pages-card";
                          }
                        });

                      }
                    });
                  } else {
                    // Code for other roles or handle invalid role
                  }

                }
              }
            });
          }
        });
      });

    });



  </script>


</body>

</html>