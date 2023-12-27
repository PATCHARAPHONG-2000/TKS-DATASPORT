<?php

// require __DIR__ . '/wp-blog-header.php';
require_once __DIR__.'/service/connect.php';


$Database = new Database();
$conn = $Database->connect();

$sql = $conn->prepare("SELECT * FROM data_all WHERE IsActive = 1");
$sql->execute();
$rows = $sql->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TKS SPORTDATA</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/images/favicon.png" rel="icon">
  <link href="assets/images/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/home.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
      </div>
      <div class="social-links d-none d-md-block">
        <a href="https://www.facebook.com/TKSsoft" target="_blank" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://line.me/ti/p/_EFnRUO5tK" target="_blank" class="line"> <i class="bi bi-line"></i></a>
        <a href="login-score" class="karate"><img src="assets/images/karate-icon.png" alt="" style="width: 15px; height:22px;" ></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
      <h1 class="logo"><a href="./">TKS SPORTDATA</a></h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#events">Events</a></li>
          <li><a class="nav-link scrollto " href="#photo">Photo</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link scrollto dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Login
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="login" style="color:black">TKS DATASPORT</a>
              <a class="dropdown-item" href="login_ad" style="color:black">AD Card</a>
            </div>
          </li>

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
      <h1>Welcome to TKS</h1>
      <h2>We are taekwondo organizer
        Please contact us to organize your event
        We will do our best</h2>
      <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
            <img src="assets/images/logo.png" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right">
            <h3>TKS SPORTDATA - Your Technology Partner for Taekwondo Competitions</h3>
            <p class="fst-italic">
              We provide cutting-edge technology solutions and support for Taekwondo competitions worldwide.
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> Our expertise ensures seamless competition management.</li>
              <li><i class="bi bi-check-circle"></i> We strive for excellence, enhancing the Taekwondo experience.</li>
              <li><i class="bi bi-check-circle"></i> Leveraging technology, we deliver efficiency and innovation in
                every aspect of Taekwondo competitions.</li>
            </ul>
            <p>
              At TKS SPORTDATA, we are dedicated to advancing Taekwondo through technology. Our mission is to foster a
              growing community and elevate the sport to new heights. Join us in shaping a brighter future for Taekwondo
              in the tech-savvy world.
            </p>
          </div>

        </div>

      </div>
    </section>

    <section id="why-us" class="why-us">
      <div class="container">
        <div class="row">
          <div class="col-lg-4" data-aos="fade-up">
            <div class="box">
              <span>01</span>
              <h4>Taekwondo Excellence</h4>
              <p>At TKS SPORTDATA, we are passionate about Taekwondo and dedicated to enhancing the sport's experience.
                Our technology solutions ensure seamless Taekwondo competition management.</p>
            </div>
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="150">
            <div class="box">
              <span>02</span>
              <h4>Innovative Solutions</h4>
              <p>We leverage cutting-edge technology to deliver efficiency and innovation to every aspect of Taekwondo
                competitions. Our mission is to elevate Taekwondo to new heights.</p>
            </div>
          </div>
          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="box">
              <span>03</span>
              <h4>About TKS SPORTDATA</h4>
              <p>TKS SPORTDATA is your technology partner for Taekwondo competitions worldwide. Join us in shaping a
                brighter future for Taekwondo in the tech-savvy world.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="clients" class="clients">
      <div class="container" data-aos="zoom-in">

        <div class="row d-flex align-items-center">

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets/images/clients/client-1.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets/images/clients/client-2.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets/images/clients/client-3.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets/images/clients/client-4.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets/images/clients/client-5.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-2 col-md-4 col-6">
            <img src="assets/images/clients/client-6.png" class="img-fluid" alt="">
          </div>

        </div>

      </div>
    </section>

    <section id="events" class="evests">
      <div class="container">
        <div class="section-title">
          <span>Events</span>
          <h2>Events</h2>
          <p></p>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <?php
            foreach($rows as $key => $row) {
              $class = ($key == 0) ? 'active' : '';
              echo '<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="'.$key.'" class="'.$class.'"></button>';
            }
            ?>
          </div>
          <div class="carousel-inner">
            <?php
            foreach($rows as $key => $row) {
              $class = ($key == 0) ? 'active' : '';
              $users = $row['users'];

              if(filter_var($users, FILTER_VALIDATE_EMAIL)) {
                $loginPage = 'login.php';
              } else {
                $loginPage = 'login_ad.php';
              }

              echo '<div class="carousel-item '.$class.'">';
              echo '<a href="'.$loginPage.'"><img src="service/superadmin/uploads/'.$row['image'].'" class="d-block w-100" alt="..."></a>';
              echo '</div>';
            }
            ?>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
    </section>

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        <div class="text-center ">
          <h3 class="text-uppercase">Taekwondo</h3>
          <p>Taekwondo is a Korean martial art, characterized by its emphasis on high,
            fast kicks and spinning kicks,
            and its focus on head-height kicks, jumping and spinning kicks, and fast kicking techniques.</p>
        </div>

      </div>
    </section>

    <section id="photo" class="photo">
      <div class="container">

        <div class="section-title">
          <span>Photo</span>
          <h2>Photo</h2>
          <p>Photographs capturing the ambiaTTnce of the event</p>
        </div>

        <div class="row photo-container" data-aos="fade-up" data-aos-delay="150">

          <div class="col-lg-4 col-md-6 photo-item ">
            <a href="assets/images/BK/BK1.jpg" data-gallery="photoGallery" class="photo-lightbox" title=""
              target="_blank">
              <img src="assets/images/BK/BK1.jpg" class="img-fluid" alt="">
            </a>
            <div class="photo-info">
              <a href="photo-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 photo-item ">
            <a href="assets/images/BK/BK2.jpg" data-gallery="photoGallery" class="photo-lightbox" title=""
              target="_blank">
              <img src="assets/images/BK/BK2.jpg" class="img-fluid" alt="">
            </a>
            <div class="photo-info">
              <a href="photo-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 photo-item ">
            <a href="assets/images/BK/BK3.jpg" data-gallery="photoGallery" class="photo-lightbox" title=""
              target="_blank">
              <img src="assets/images/BK/BK3.jpg" class="img-fluid" alt="">
            </a>
            <div class="photo-info">
              <a href="photo-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 photo-item ">
            <a href="assets/images/BK/BK4.jpg" data-gallery="photoGallery" class="photo-lightbox" title=""
              target="_blank">
              <img src="assets/images/BK/BK4.jpg" class="img-fluid" alt="">
            </a>
            <div class="photo-info">
              <a href="photo-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 photo-item ">
            <a href="assets/images/BK/BK5.jpg" data-gallery="photoGallery" class="photo-lightbox" title=""
              target="_blank">
              <img src="assets/images/BK/BK5.jpg" class="img-fluid" alt="">
            </a>
            <div class="photo-info">
              <a href="photo-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 photo-item ">
            <a href="assets/images/BK/BK6.jpg" data-gallery="photoGallery" class="photo-lightbox" title=""
              target="_blank">
              <img src="assets/images/BK/BK6.jpg" class="img-fluid" alt="">
            </a>
            <div class="photo-info">
              <a href="photo-details.html" class="details-link" title="More Details"><i class="bx bx-link"></i></a>
            </div>
          </div>

        </div>
      </div>
    </section>

    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <span>Contact</span>
          <h2>Contact</h2>
          <!-- <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p> -->
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>Anusawari Sub-district, Bang Khen District, Bangkok 10220, Thailand.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email Us </h3>
              <p>tks.softvision.thai@gmail.com </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p>084-083-8587</p>
            </div>
          </div>

        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-6 ">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247916.2454293916!2d100.56335233496515!3d13.857557459309652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e282b2c819c249%3A0x95fd72e3742fe795!2zNTIg4LiL4Lit4LiiIOC4o-C4suC4oeC4reC4tOC4meC4l-C4o-C4siA3IOC5geC4guC4p-C4h-C4reC4meC4uOC4quC4suC4p-C4o-C4teC4ouC5jCDguYDguILguJXguJrguLLguIfguYDguILguJkg4LiB4Lij4Li44LiH4LmA4LiX4Lie4Lih4Lir4Liy4LiZ4LiE4LijIDEwMjIw!5e0!3m2!1sth!2sth!4v1696500738744!5m2!1sth!2sth"
              frameborder="0" style="border:0; width: 100%; height: 384px;" allowfullscreen="" "
              referrerpolicy=" no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
      </div>
    </section>

  </main>

  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 col-md-6">
            <div class="footer-info">
              <h3>TKS SPORTDATA</h3>
              <p>
                Anusawari Sub-district <br> Bang Khen District <br> Bangkok 10220, Thailand. <br><br><br>
                <strong>Phone :</strong> 084-083-8587<br>
                <strong>Email :</strong> tks.softvision.thai@gmail.com<br>
              </p>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#hero">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#photo">Photo</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#contact">Contact</a></li>
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

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>
  <script async src="https://www.googletagmanager.com/gtag/js?id=GTM-5B9B8LF4"></script>

</body>

</html>