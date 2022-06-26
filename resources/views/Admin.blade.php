<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ride Share</title>
  <meta content="" name="description">
  <meta content="" name="keywords">



  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Favicons -->

  <link href="/assets/img/favicon.png" rel="icon">
 

  <!-- Bootstrap css files -->
  <link rel="stylesheet" href="/assets/css/bootstrap.css">


  <!-- Google Fonts -->
 
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


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
  <link href="/assets/css/sidenav.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Moderna - v4.8.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body id="body-pd">

<div id="app" class="wrapper">
  <!-- ======= Header ======= -->
  <header id="header" class=" fixed-top d-flex align-items-center">

    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo d-flex justify-content-between align-items-center">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <h1 class="text-light"><a href="index.html"><img src="/assets/img/logo_transperent.png" data-aos="fade-right"
              alt="" class="img-fluid"><span>RideShare</span></a></h1>

      </div>

      <nav id="navbar" class="navbar">

        <div class="dropdown">
          <img src="/assets/img/notifications2.svg" class=" dropdown-toggle nav_icon" data-toggle="dropdown"
            role="button" id="dropdownMenuButton" aria-haspopup="true" aria-expanded="false" alt="">
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </div>

        <div class="dropdown">
          <img src="/assets/img/account.svg" class="dropdown-toggle nav_icon" data-toggle="dropdown" role="button"
            aria-haspopup="true" aria-expanded="false" alt="">

          <div class="dropdown-menu">
            <a class="dropdown-item" href="my_profile.html">My Profile</a>
            <a class="dropdown-item" href="sign_out.html">Signout</a>

          </div>
        </div>

      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


  <div class="l-navbar" id="nav-bar">
    <nav class="nav">
      <div>
        <div class="nav_list">
         <div class="space" id="space"></div> 
          <router-link to="/main" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i>
            <span class="nav_name">Dashboard</span> </router-link>
          <router-link to="/users" class="nav_link"> <i class='nav_icon material-icons'>account_circle</i>
            <span class="nav_name">Users</span> </router-link>
          <a href="admin/drivers.html" class="nav_link"> <i class='nav_icon material-icons'>supervisor_account</i>
            <span class="nav_name">Drivers</span> </a>
          <a href="admin/vehicles.html" class="nav_link"> <i class='nav_icon material-icons'>directions_car</i>
            <span class="nav_name">Vehicles</span> </a>
          <a href="admin/trips.html" class="nav_link"> <i class='nav_icon material-icons'>place</i>
            <span class="nav_name">Trips</span> </a>
          <a href="admin/packages.html" class="nav_link"> <i class='nav_icon material-icons'>local_shipping</i>
            <span class="nav_name">Packages</span> </a>
            <a href="admin/management.html" class="nav_link"> <i class='nav_icon material-icons'>settings</i>
              <span class="nav_name">Managment</span> </a>
        </div>
      </div> 
      
    </nav>
  </div>
  <!--Container Main start-->
  <main id="main " class="height-100">
    show some statitcs use some div from template
    <router-view> 
      
    </router-view>
  </main>

  <!-- ======= Footer ======= -->
  @include('includes.footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

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

  <script src="/assets/js/side_bar.js"></script>



  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</div>

</body>

</html>