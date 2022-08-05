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

  <!-- Bootstrap css files -->


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

    <section class="trips">


      <div class="trip_info p-4 m-4">


        <div class="section-title">
          <h2>Trip Details</h2>

        </div>

        <div id="trip" class="row">


        </div>
        <div id="button" class="row"></div>
      </div>



    </section>



    <!-- End Modal -->
    <div class="modal fade" id="tripModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div id="trip" class="modal-content">
          <div class="modal-header ">

            <h4>Rate Your Trip</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <form class="rating" method="POST" action="{{ route('end_driver_trip') }}">
              @csrf
              <label>
                <input type="radio" name="stars" value="1" />
                <span class="icon fa fa-star checked"></span>
              </label>
              <label>
                <input type="radio" name="stars" value="2" />
                <span class="icon fa fa-star checked"></span>
                <span class="icon fa fa-star checked"></span>
              </label>
              <label>
                <input type="radio" name="stars" value="3" />
                <span class="icon fa fa-star checked"></span>
                <span class="icon fa fa-star checked"></span>
                <span class="icon fa fa-star checked"></span>
              </label>
              <label>
                <input type="radio" name="stars" value="4" />
                <span class="icon fa fa-star checked"></span>
                <span class="icon fa fa-star checked"></span>
                <span class="icon fa fa-star checked"></span>
                <span class="icon fa fa-star checked"></span>
              </label>
              <label>
                <input type="radio" name="stars" value="5" />
                <span class="icon fa fa-star checked"></span>
                <span class="icon fa fa-star checked"></span>
                <span class="icon fa fa-star checked"></span>
                <span class="icon fa fa-star checked"></span>
                <span class="icon fa fa-star checked"></span>
              </label>

          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-commn">Evaluate Trip</button>

            <input type="text" id="trip_id" name="trip_id" value="21" hidden="true">

            </form>
          </div>


        </div>
      </div>
    </div>

    <!-- Cancel Modal -->
    <div class="modal fade" id="canselModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div id="trip" class="modal-content">
          <div class="modal-header ">

            <h4>Trip Cancellation</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to cancel your trip?</p>

          </div>
          <div class="modal-footer justify-content-center">
            <form method="POST" action="{{ route('cancel_driver_trip') }}">
              @csrf

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Continue</button>
              <button type="submit" class="btn btn-danger">Call off Trip</button>

              <input type="text" id="trip_id" name="trip_id" value="21" hidden="true">

            </form>
          </div>


        </div>
      </div>
    </div>




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


  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCSt4ABayMg8O3n9Hvxb_vrs_1oUfWXuA&callback=initMap&libraries=&v=weekly"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    let map, infoWindow, pos;

    //get driver trip coord
    var trip_start_lat;
    var trip_start_lng;
    var trip_end_lat;
    var trip_end_lng;

    // load data first time 
    $.ajax({
      url: "{{route('get_driver_track')}}",
      type: 'GET',
      dataType: 'json',
      data: {
        id: 21
      },
      success: function(response) {
        var data = response;
        var st = "";
        $.each(data, function(index) {


          if (data[index].trip_status == 'ended' || data[index].trip_status == 'canceled') {
            console.log(data[index].trip_status);
            st += "<p style='text-align: center;'>your trip has ended or got canceled</p>";
            st += "<a  href='{{ url('/home') }}'  class=' btn-trip-book btn mt-3'>Go Home</a>";
          } else {
            //get driver trip coord
            trip_start_lat = data[index].s_lat;
            trip_start_lng = data[index].s_lng;
            trip_end_lat = data[index].e_lat;
            trip_end_lng = data[index].e_lng;

            st += " <div  class='col-md-6'>";
            st += " <div  class='row mt-4'>";
            st += " <div  class='col-md-6 col-sm-6'>";


            st += " <p>Start Time:<br><span id='stime'>" + data[index].start_time + "</span></p>";
            st += " <p>Elapsed Time:<br> <span id='timer'></span></p>";
            st += " <p>Number of Passengers:<br>" + data[index].passengers + "</p>";
            st += " <p>Number of Packages:<br>" + data[index].packages + "</p>";
            st += "</div>";
            st += " <div id='trips' class='col-md-6 col-sm-6'></div></div></div>";
            st += " <div  class='col-md-6'>";



            st += " <div id='map' class='img-fluid' style='height:300px; width:100%;'></div></div>";
          }



        });

        $("#trip").html(st);
        startTime();


        const t_start = {
          lat: parseFloat(trip_start_lat),
          lng: parseFloat(trip_start_lng)
        };

        const t_end = {
          lat: parseFloat(trip_end_lat),
          lng: parseFloat(trip_end_lng)
        };
        var pos;
        var marker = null;

        function autoUpdate() {
          navigator.geolocation.getCurrentPosition(function(position) {
            pos = new google.maps.LatLng(position.coords.latitude,
              position.coords.longitude);

            if (marker) {
              // Marker already created - Move it
              marker.setPosition(pos);
            } else {
              // Marker does not exist - Create it
              marker = new google.maps.Marker({
                position: pos,
                map: map,
                icon: {
                  path: google.maps.SymbolPath.CIRCLE,
                  scale: 10,
                  fillOpacity: 1,
                  strokeWeight: 2,
                  fillColor: '#5384ED',
                  strokeColor: '#ffffff',
                },
              });
            }

            // Center the map on the new position
            //  map.setCenter(pos);
          });

          // Call the autoUpdate() function every 5 seconds
          setTimeout(autoUpdate, 5000);
        }

        autoUpdate();

        // myLocation();
        // The map, centered at current location
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 15,
          center: t_start,
          disableDefaultUI: true,
          zoomControl: true,
          fullscreenControl: true,
        });

        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer({
          map,

        });
        infoWindow = new google.maps.InfoWindow();

        const locationButton = document.createElement("button");

        locationButton.textContent = "Pan to Current Location";
        locationButton.classList.add("custom-map-control-button");
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);

        locationButton.addEventListener("click", () => {
          map.setCenter(pos);
        });




        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
          infoWindow.setPosition(pos);
          infoWindow.setContent(
            browserHasGeolocation ?
            "Error: The Geolocation service failed." :
            "Error: Your browser doesn't support geolocation."
          );
          infoWindow.open(map);
        }



        $.ajax({
          url: "{{route('get_driver_trip')}}",
          type: 'GET',
          dataType: 'json',
          data: {
            id: 21
          },
          success: function(response) {
            var data = response;
            var st = "";
            var locations = [];
            var passengers = 1;
            var packages = 1;
            var ways = [];
            $.each(data, function(index) {
              locations.push([data[index].start_point_latitude, data[index].start_point_longitude, data[index].end_point_latitude, data[index].end_point_longitude]);

              if (data[index].name == 'package') {
                st += "<p>Package" + packages + " cost:" + data[index].trip_cost + "</p>";
                // st += "<p>Start address: " + data[index].start_address + "</p>"
                packages += 1;
              }
              if (data[index].name == 'passenger') {
                st += "<p>Passenger" + passengers + " cost:" + data[index].trip_cost + "</p>";
                // st += "<p>Start address: " + data[index].start_address + "</p>"
                passengers += 1;
              }

            });
            $("#trips").html(st);

            for (var i = 0; i < locations.length; i++) {



              var start = {
                lat: locations[i][0],
                lng: locations[i][1]
              };

              var end = {
                lat: locations[i][2],
                lng: locations[i][3]
              };

              ways.push({
                location: start,
                stopover: true,
              });
              ways.push({
                location: end,
                stopover: true,
              });

            };
            // ways=ways1.concat(ways2);
            displayRoute(
              t_start,
              t_end,
              directionsService,
              directionsRenderer
            );



            function computeTotalDistance(result) {
              let total = 0;
              const myroute = result.routes[0];

              if (!myroute) {
                return;
              }

              for (let i = 0; i < myroute.legs.length; i++) {
                total += myroute.legs[i].distance.value;
              }

              total = total / 1000;
              //document.getElementById("total").innerHTML = total + " km";
              console.log(total);
            }

            function displayRoute(origin, destination, service, display) {
              service
                .route({
                  origin: origin,
                  destination: destination,
                  waypoints: ways,
                  travelMode: google.maps.TravelMode.DRIVING,
                  avoidTolls: true,
                  optimizeWaypoints: true,
                })
                .then((result) => {
                  display.setDirections(result);
                  console.log(result.routes[0]);
                  let total = 0;
                  for (let i = 0; i < result.routes[0].legs.length; i++) {
                    total += result.routes[0].legs[i].distance.value;
                  }

                  total = total / 1000;
                  console.log(total);
                })
                .catch((e) => {
                  alert("Could not display directions due to: " + e);
                });

            }





          },
          error: function() {
            alert('no response');
          }


        });





      },
      error: function() {
        alert('no response');
      }


    });
  </script>

  <script>
    function initMap() {



    }
  </script>

  <script>
    //elapsed time function
    function startTime() {
      var stime = document.getElementById('stime').textContent;

      let starttime = new Date(stime);
      let endtime = new Date();
      let t = endtime - starttime;

      // document.getElementById('diff').value = t;

      //console.log(360000);
      const today = new Date(t);

      let h = today.getHours();
      let m = today.getMinutes();
      let s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);


      setTimeout(startTime, 1000);
      var st = '';
      if (t > -360000) {
        document.getElementById('timer').innerHTML = h + ":" + m + ":" + s;
        st += "<div class='col-3'></div>";
        st += "<br><button id='trip_info'  type='button' href='#tripModal'  data-toggle='modal' class='col-6 btn-trip-book btn mt-3'>End Trip</button>"
        $("#button").html(st);
      } else {
        document.getElementById('timer').innerHTML = "00:00:00";
        st += "<div class='col-3'></div>";
        st += "<br><button id='trip_info'  type='button' href='#canselModal'  data-toggle='modal' class='col-6 btn-trip-book btn mt-3'>Cancel Trip</button>"
        $("#button").html(st);
      }


    }

    function checkTime(i) {
      if (i < 10) {
        i = "0" + i
      }; // add zero in front of numbers < 10
      return i;
    }
  </script>

  <script>
    $(':radio').change(function() {
      console.log('New star rating: ' + this.value);
      document.getElementById("rate").value = this.value;
    });
  </script>

</body>

</html>