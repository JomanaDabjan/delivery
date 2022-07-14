<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
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

  <!-- Bootstrap css files -->
  <link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.css')}}">

  <!-- Template Main CSS File -->
  <link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Moderna - v4.8.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="antialiased">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="{{ url('/home') }}"><img src="/assets/img/logo_transperent.png" data-aos="fade-right" alt="" class="img-fluid"><span>RideShare</span></a></h1>

      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="{{ (request()->is('home')) ? 'active' : '' }}" href="{{ url('/home') }}">Home</a></li>
          <li><a class="{{ (request()->is('about')) ? 'active' : '' }}" href="{{ url('/about') }}">About</a></li>
          <li><a class="{{ (request()->is('services')) ? 'active' : '' }}" href="{{ url('/services') }}">Services</a></li>
          <li><a class="{{ (request()->is('contact')) ? 'active' : '' }}" href="{{ url('/contact') }}">Contact Us</a></li>
          @auth
          <li> <a href="{{ url('/home') }}" class="{{ (request()->is('contact')) ? 'active' : '' }}">Trips</a></li>
          <div class="dropdown">
            <img src="assets/img/notifications2.svg" class=" dropdown-toggle  nav_icon" data-toggle="dropdown" role="button" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false" alt="">
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>

          <div class="dropdown">
            <img src="assets/img/account.svg" class="dropdown-toggle nav_icon" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" alt="">

            <div class="dropdown-menu">
              <a class="dropdown-item" href="my_profile.html">My Profile</a>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>

            </div>
          </div>
          @else
          <li> <a href="{{ route('login') }}" class="btn-account">Login</a></li>

          @if (Route::has('register'))
          <li> <a href="{{ route('register') }}" class="btn-account">Register</a></li>
          @endif
          @endauth
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->



  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-cntent-center align-items-center ">
    <div id="heroCarousel" class="container carousel carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

      <div class="carousel-item active">
        <div class="carousel-container">
          <h2 class="animate__animated animate__fadeInDown">Welcome to <span>RideShare</span></h2>
        </div>
      </div>




    </div>
  </section><!-- End Hero -->

  <main id="main">



    <!-- ======= about Section ======= -->

    <section class="about aos-init aos-animate">
      <div class="container">


        <div class="section-title" data-aos="fade-up">
          <h2>About Us</h2>

        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-6">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
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
    </section><!-- End about Section -->



    <!-- ======= Services Section ======= -->
    <section class="services">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Services</h2>

        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-md-5">
            <img src="assets/img/service_1.svg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-4">
            <h3>Get in the Driver seat and earn money on the go </h3>
            <p class="fst-italic">
              Share your ride with users on our site or deliver packages for them .
            </p>
            <ul>
              <li><i class="bi bi-check"></i> keep your own trip track and earn money on your way.</li>
              <li><i class="bi bi-check"></i>annouce your trip details to allow passenger to go with you or send thier packages.</li>
            </ul>
          </div>
        </div>

        <br><br>

        <div class="row" data-aos="fade-up">
          <div class="col-md-5 order-1 order-md-2">
            <img src="assets/img/service_2.svg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-5 order-2 order-md-1">
            <h3>Request a ride where ever you are </h3>
            <p class="fst-italic">Have a care free ride with our drivers.
            </p>
            <p>
              Choose from a varity of trips to suite your requirments, Ensure to arrive on time while having a safe and comfortable ride
            </p>
          </div>
        </div>

        <br><br>

        <div class="row" data-aos="fade-up">
          <div class="col-md-5">
            <img src="assets/img/service_3.svg" class="img-fluid" alt="">
          </div>
          <div class="col-md-7 pt-5">
            <h3>Deliver your packages to anywhare you want</h3>
            <p>Ensure a fast secure delivery.</p>
            <ul>
              <li><i class="bi bi-check"></i> Track your packages on the go.</li>
              <li><i class="bi bi-check"></i> Have a person to person delivery expriences.</li>
              <li><i class="bi bi-check"></i> Put your fragile and valuable items in safe hands.</li>
            </ul>
          </div>
        </div>



      </div>
    </section><!-- End Services Section -->

    <!-- ======= app Section ======= -->

    <section class="app aos-init aos-animate">
      <div class="container">


        <div class="section-title" data-aos="fade-up">
          <h2>Our App</h2>

        </div>

        <div class="row" data-aos="fade-up">

          <div class="col-lg-6  pt-5 ">
            <h3>Download our mobile app for easier use</h3>
            <p class="fst-italic">
              have an quick access to our platform with the app.
            </p>
            <div class="text-center p-5"> <button class="btn-download  ">Download</button> </div>

          </div>
          <div class="col-lg-6">
            <img src="assets/img/download.svg" class="img-fluid" alt="">
          </div>
        </div>

      </div>
    </section><!-- End app Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('includes.footer')

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


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>

</html>