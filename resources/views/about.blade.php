<!DOCTYPE html>

<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ride Share</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <!-- Favicons -->
  <link href="/assets/img/favicon.png" rel="icon">



  <!-- Vendor CSS Files -->
  <link href="/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Moderna - v4.8.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body data-aos-easing="ease-in-out" data-aos-duration="1000" data-aos-delay="0">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-scrolled">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="{{ url('/home') }}"><img src="/assets/img/logo_transperent.png" data-aos="fade-right" alt="" class="img-fluid"><span>RideShare</span></a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{ url('/home') }}">Home</a></li>
          <li><a class="active " href="{{ url('/home/about') }}">About</a></li>
          <li><a href="{{ url('/home/services') }}">Services</a></li>
          <li><a href="{{ url('/home/contact') }}">Contact Us</a></li>
          <li><a class="btn-account" href="{{ url('/home/signup') }}">Signup</a> </li>
          <li><a class="btn-account" href="{{ url('/home/login') }}">Login</a></li>
        

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main id="main">



    <!-- ======= About Section ======= -->
    <section class="about aos-init aos-animate" data-aos="fade-up">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <img src="/assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <h3>We are a nonprofit company that hopes to solve the transportion problems.</h3>
            <p class="fst-italic">
              Offering a simple way to request a ride for passengers and an extra income for drivers .
            </p>
            <ul>
              <li><i class="bi bi-check2-circle"></i> Large network of drivers.</li>
              <li><i class="bi bi-check2-circle"></i> Focused on safety where ever you go .</li>
              <li><i class="bi bi-check2-circle"></i> simple interface for all users.</li>
            </ul>

          </div>
        </div>

      </div>
    </section>
    <section class="about aos-init aos-animate" data-aos="fade-up">
      <div class="container">

        <div class="row">
          <div class="col-lg-6 pt-4 pt-lg-0">

            <h3> Secure and Safer Rides </h3>
            <p class="fst-italic">Features that we have in place to ensure you a safe travel and good delivery experience. </p>
            <ul>
              <li><i class="bi bi-check2-circle"></i> Verified drivers.</li>
              <li><i class="bi bi-check2-circle"></i> Emergency alert button.</li>
              <li><i class="bi bi-check2-circle"></i> Live ride tracking.</li>
            </ul>

          </div>

          <div class="col-lg-6">
            <img src="/assets/img/about2.jpg" class="img-fluid" alt="">
          </div>


        </div>

      </div>
    </section>
    <section class="about aos-init aos-animate" data-aos="fade-up">
      <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <img src="/assets/img/about3.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <h3>Best Delivering Company </h3>
            <p class="fst-italic"> We help clients deliver their packages quickly and affordably</p>


          </div>
        </div>

      </div>
    </section><!-- End About Section -->










  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">



    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/home') }}">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/home/about') }}">About</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/home/services') }}">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>



          <div class="col-lg-6 col-md-6 footer-contact">
            <h4>Contact Us</h4>

            <p><img src="/assets/img/location.svg" alt=""><strong> Address: </strong> A108 Adam Street <br>
              <img src="/assets/img/phone.svg" alt=""><strong> Phone:</strong> +1 5589 55488 55<br>
              <img src="/assets/img/email.svg" alt=""> <strong> Email:</strong> info@example.com<br>
            </p>

          </div>



        </div>
      </div>
    </div>

    <div class="container ">
      <div class="social-links mt-3 text-center">
        <i class="bx bxl-twitter"></i>
        <i class="bx bxl-facebook"></i>
        <i class="bx bxl-instagram"></i>
        <i class="bx bxl-linkedin"></i>
      </div>

    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/purecounter/purecounter.js"></script>
  <script src="/assets/vendor/aos/aos.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="/assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/js/main.js"></script>

</body>

</html>