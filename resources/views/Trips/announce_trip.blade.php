<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Announce-Trip</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

 
  <!-- Google Fonts -->



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

</head>

<body>


  <!-- ======= Header ======= -->
  @include('includes.header')

  <main id="main">

    <section class="trip">

      <div class="container">
        <div class="trip_info">




          <div class="section-title">
            <h2>Enter Your Trip Details </h2>

          </div>

          <form class="form needs-validation" novalidate>


            <div class="form-group row">
              <div class="col-4 ">
                <label>
                  Click on the map
                  to locate your end
                  and start point</label>
              </div>

              <div class="col-3 "></div>
              <div class="col-5">
                <img src="/assets/img/map.jfif" class="img-fluid">
              </div>
            </div>


            <input type="text" hidden="true">
            <input type="text" hidden="true">


            <div class="form-group">
              <label for="InputEmail">Start Time:</label>
              <input type="time" class="form-control" id="Input" aria-describedby="Help" placeholder=" " required pattern="[0-9]" title="only numbers allowed">


              <div class="invalid-feedback">
                Please provide a valid Time.
              </div>

            </div>



            <div class="form-group">
              <label for="InputEmail">Availiable Seats</label>
              <select class="form-select" required title="Select Availiable Seats">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
              </select>

              <div class="invalid-feedback">
                Please provide a valid Seats.
              </div>

            </div>


            <div class="form-group">
              <label for="InputEmail">Availiable Packages Size</label>
              <input type="text" class="form-control" id="Input" aria-describedby="Help" placeholder="" required pattern="[0-9]{3,}" title="only numbers allowed">

              <div class="invalid-feedback">
                Please provide a valid Packages Size.
              </div>


            </div>

            <div class="form-group">
              <label for="InputEmail">Availiable Packages Weight</label>
              <input type="text" class="form-control" id="Input" aria-describedby="Help" placeholder=" " required pattern="[0-9]{3,}" title="only numbers allowed">

              <div class="invalid-feedback">
                Please provide a valid Packages Weight.
              </div>

            </div>



            <div class=" signup-group">
              <button type="submit" class="btn-trip btn btn-primary ">Announce The Trip</button>
            </div>


          </form>

          <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
              'use strict';
              window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                  form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                      event.preventDefault();
                      event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                  }, false);
                });
              }, false);
            })();
          </script>

        </div>
      </div>
    </section>





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


</body>

</html>