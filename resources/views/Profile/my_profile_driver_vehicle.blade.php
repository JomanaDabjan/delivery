<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ride Share</title>
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

  <!-- =======================================================
  * Template Name: Moderna - v4.8.0
  * Template URL: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>


  <!-- ======= Header ======= -->
  @include('includes.header')



  <main id="main">

    <section class="profile">

      <div class="container">
        <div class="pro_info">
          <p>Brand:</p>
          <p>Model:</p>
          <p>Lisence Number:</p>
          <p>Passenger Count:</p>
          <p>Max Load Size:</p>
          <p>Max Load Weight:</p>
        </div>


        <div class="profile-group">
          <a href="#editModal" data-toggle="modal" class="btn-profile btn ">Edit My Vehicle Info</a>

        </div>
      </div>

      <!-- edit Modal -->
      <div id="editModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header ">

              <h4>Edit Infomation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">

              <form class="form p-1">
                <div class="form-group">
                  <label for="InputEmail">Brand</label>
                  <input type="text" class="form-control" id="Input" aria-describedby="Help" placeholder="eg. KIA,BMW,Audi ">
                </div>

                <div class="form-group">
                  <label for="InputEmail">Model</label>
                  <input type="text" class="form-control" id="Input" aria-describedby="Help" placeholder="eg. KIA cerato ">
                </div>

                <div class="form-group">
                  <label for="InputEmail">License Number</label>
                  <input type="text" class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="eg. 231456">
                </div>

                <div class="form-group">
                  <label for="InputEmail">Vehicle Color</label>
                  <input type="color" class="form-control" value="#aa1313">
                </div>

                <div class="form-group">
                  <label for="InputEmail">Passenger Count</label>
                  <select class="form-select">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                  </select>

                </div>

                <div class="form-group">
                  <label>Vehicle Type</label>
                  <select class="form-select">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="InputEmail">Max Load Size</label>
                  <input type="text" class="form-control" id="Input" aria-describedby="Help" placeholder="">
                </div>

                <div class="form-group">
                  <label for="InputEmail">Max Load Weight</label>
                  <input type="text" class="form-control" id="Input" aria-describedby="Help" placeholder=" ">
                </div>










            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-commn">Edit</button>
              </form>
            </div>
          </div>
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
</body>

</html>