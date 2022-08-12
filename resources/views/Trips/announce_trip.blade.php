<!DOCTYPE html>
<html lang="en">

<head>

 <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>




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

          <form method="POST" action="{{ route('store_trip') }}">
            @csrf
            <input type="text" id="id" name="id" value="{{Auth::user()->id}}" hidden="true">
            <div class="form-group ">
              <div>

                <label>
                  Drag the markers on the map
                  to locate your
                  <span style="color: #2ECC71">start point</span>
                  and
                  <span style="color: #3498DB">end point</span> </label>
              </div>

              <div id="map" style="height: 180px; ">
              </div>

              <input type="text" id="start_lat" name="start_lat" value="" required title="please select your start point">
              <input type="text" id="end_lat" name="end_lat" value="" required title="please select your end point">
              <input type="text" id="start_long" name="start_long" value="" hidden="true" required>
              <input type="text" id="end_long" name="end_long" value="" hidden="true" required>

              <input type="text" id="start_address" name="start_address" value="" hidden="true" required>
              <input type="text" id="end_address" name="end_address" value="" hidden="true" required>

            </div>





            <div class="form-group">
              <label for="start_time">Start Time:</label>

              <input type="datetime-local" class="form-control" name="start_time" id="start_time" required>



            </div>



            <div class="form-group">
              <label for="seats">Availiable Seats</label>
              <select class="form-select" id="seats" name="seats" required title="Select Availiable Seats">
                @for($i=1;$i<=$vehicle->passenger_count;$i++)
                  <option>{{$i}}</option>
                  @endfor
              </select>



            </div>


            <div class="form-group">
              <label for="size">Availiable Packages Size</label>
              <input type="text" class="form-control" id="size" name="size" max="{{$vehicle->max_load_size}}" required pattern="[0-9]{3,}" title="only numbers allowed">


            </div>

            <div class="form-group">
              <label for="weight">Availiable Packages Weight</label>
              <input type="text" class="form-control" id="weight" name="weight" max="{{$vehicle->max_load_weight}}" required pattern="[0-9]{3,}" title="only numbers allowed">
            </div>



            <div class=" signup-group">
              <button type="submit" class="btn-trip btn ">Announce The Trip</button>
            </div>


          </form>

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



  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCSt4ABayMg8O3n9Hvxb_vrs_1oUfWXuA&callback=initMap&libraries=&v=weekly" defer></script>
  <script>
    var start, end;
    // Initialize and add the map
    function initMap() {


      var geocoder = new google.maps.Geocoder;
      var geocoder2 = new google.maps.Geocoder;
      // The location of homs
      const homs = {
        lat: 34.730818,
        lng: 36.709527
      };
      // The map, centered at homs
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: homs,
        disableDefaultUI: true,
        zoomControl: true,
        fullscreenControl: true,
      });


      const image1 =
        "https://img.icons8.com/android/48/2ECC71/marker.png";

      const image2 =
        "https://img.icons8.com/android/48/3498DB/marker.png";

      var marker1 = new google.maps.Marker({
        position: homs,
        map: map,
        title: 'Google Maps',
        draggable: true,
        icon: image1
      });
      var marker2 = new google.maps.Marker({
        position: homs,
        map: map,
        title: 'Google Maps',
        draggable: true,
        icon: image2
      });


      google.maps.event.addListener(marker1, 'dragend', function(marker1) {
        start = marker1.latLng;
        document.getElementById('start_lat').value = start.lat();
        document.getElementById('start_long').value = start.lng();


        geocodestart(start);
      });
      google.maps.event.addListener(marker2, 'dragend', function(marker2) {
        end = marker2.latLng;
        document.getElementById('end_lat').value = end.lat();
        document.getElementById('end_long').value = end.lng();

        geocodeend(end);
      });

      function geocodestart(start) {

        geocoder.geocode({
          'location': start
        }, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {


              document.getElementById('start_address').value = results[0].formatted_address;

              console.log(results[0].formatted_address);

            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }

        });

      }

      function geocodeend(end) {

        geocoder2.geocode({
          'location': end
        }, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {

              document.getElementById('end_address').value = results[0].formatted_address;
              console.log(results[0].formatted_address);
              // results[0].formatted_address;

            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }

        });

      }

    }





    window.initMap = initMap;
  </script>

</body>

</html>