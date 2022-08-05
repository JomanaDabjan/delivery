<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Book-Trip-Seats-form</title>
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

          <form class="rating" method="POST" action="{{ route('store_passenger') }}">
            @csrf
            <input type="text" id="trip_id" name="trip_id" value="{{$id}}" hidden="true">
            <input type="text" id="start_lat_trip" name="start_lat_trip" value="{{$trip->start_point_latitude}}" hidden="true">
            <input type="text" id="end_lat_trip" name="end_lat_trip" value="{{$trip->end_point_latitude}}" hidden="true">
            <input type="text" id="start_lng_trip" name="start_lng_trip" value="{{$trip->start_point_longitude}}" hidden="true">
            <input type="text" id="end_lng_trip" name="end_lng_trip" value="{{$trip->end_point_longitude}}" hidden="true">

            <div class="form-group row">
              <div class="col-sm-4">
                <label for="seat">Number Of Seats</label>
              </div>
              <div class="col-sm-3"></div>
              <div class="col-sm-5">
                <select class="form-select" id="seat" name="seat" required title="Select Number of Seats">
                  @for($i=1;$i<=$trip->available_seats;$i++)
                    <option>{{$i}}</option>
                    @endfor
                </select>

              </div>

            </div>

            <div class="form-group ">


              <label>
                Drag the markers on the map
                to locate your
                <span style="color: #2ECC71">start point</span>
                and
                <span style="color: #3498DB">end point</span> on the trip route</label>


              <div id="map" class="img-fluid" style="height:200px; width:100%">
              </div>


              <input type="text" id="start_lat" name="start_lat" value="34" required title="please select your start point">
              <input type="text" id="end_lat" name="end_lat" value="34" required title="please select your end point">
              <input type="text" id="start_long" name="start_long" value="37" hidden="true" required>
              <input type="text" id="end_long" name="end_long" value="37" hidden="true" required>


              <input type="text" id="start_address" name="start_address" value="" hidden="true" required>
              <input type="text" id="end_address" name="end_address" value="" hidden="true" required>

            </div>

            <div class=" signup-group">
              <button type="submit" class="btn-trip btn btn-primary ">Book The Trip</button>
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
    //get driver trip coord
    var trip_start_lat = document.getElementById("start_lat_trip").value;
    var trip_start_lng = document.getElementById("start_lng_trip").value;
    var trip_end_lat = document.getElementById("end_lat_trip").value;
    var trip_end_lng = document.getElementById("end_lng_trip").value;

    //init passenger trip coor

    document.getElementById('start_lat').value = trip_start_lat;
    document.getElementById('start_long').value = trip_start_lng;
    document.getElementById('end_lat').value = trip_end_lat;
    document.getElementById('end_long').value = trip_end_lng;

    var start, end;

    // Initialize and add the map
    function initMap() {

      var geocoder = new google.maps.Geocoder;
      var geocoder2 = new google.maps.Geocoder;


      const t_start = {
        lat: parseFloat(trip_start_lat),
        lng: parseFloat(trip_start_lng)
      };

      const t_end = {
        lat: parseFloat(trip_end_lat),
        lng: parseFloat(trip_end_lng)
      };


      // The map, centered at homs
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: t_start,
        disableDefaultUI: true,
        zoomControl: true,
        fullscreenControl: true,
      });


      const green_marker =
        "https://img.icons8.com/android/48/2ECC71/marker.png";

      const blue_marker =
        "https://img.icons8.com/android/48/3498DB/marker.png";

      var end_point = new google.maps.Marker({
        position: t_end,
        map: map,
        title: 'Google Maps',
        draggable: true,
        icon: blue_marker
      });

      var start_point = new google.maps.Marker({
        position: t_start,
        map: map,
        title: 'Google Maps',
        draggable: true,
        icon: green_marker
      });




      google.maps.event.addListener(start_point, 'dragend', function(start_point) {
        start = start_point.latLng;
        document.getElementById('start_lat').value = start.lat();
        document.getElementById('start_long').value = start.lng();

        geocodestart(start);

      });
      google.maps.event.addListener(end_point, 'dragend', function(end_point) {
        end = end_point.latLng;
        document.getElementById('end_lat').value = end.lat();
        document.getElementById('end_long').value = end.lng();
        geocodeend(end);
      });

      const directionsService = new google.maps.DirectionsService();
      const directionsRenderer = new google.maps.DirectionsRenderer({

        map,

      });

      directionsRenderer.addListener("directions_changed", () => {
        const directions = directionsRenderer.getDirections();

      });
      displayRoute(
        t_start,
        t_end,
        directionsService,
        directionsRenderer
      );

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

    function displayRoute(origin, destination, service, display) {
      service
        .route({
          origin: origin,
          destination: destination,

          travelMode: google.maps.TravelMode.DRIVING,
          avoidTolls: true,
        })
        .then((result) => {
          display.setDirections(result);
        })
        .catch((e) => {
          alert("Could not display directions due to: " + e);
        });

    }



    window.initMap = initMap;
  </script>


</body>

</html>