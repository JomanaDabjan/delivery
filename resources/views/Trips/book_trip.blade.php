<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Ride Share</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Favicons -->

  <link href="/assets/img/favicon.png" rel="icon">
  <link href="/assets/img/apple-touch-icon.png" rel="apple-touch-icon">




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


</head>

<body>


  <!-- ======= Header ======= -->
  @include('includes.header')




  <main id="main">

    <section class="trip_book">

      @if (Session::has('success'))
      <div class="alert alert-success" style="width: fit-content;margin: auto;" role="alert">
        {{Session::get('success')}}
      </div>
      <br>
      @endif

      
      @if (Session::has('error'))
      <div class="alert alert-danger" style="width: fit-content;margin: auto;" role="alert">
        {{Session::get('error')}}
      </div>
      <br>
      @endif

      <div class="section-title">
        <h2>Choose a Trip </h2>
      </div>

      <form class="form container">
        <div class="form-group row">
          <div class="col-lg-2 col-md-1  ">
          </div>
          <div class=" col-lg-4 col-md-6  row ">
            <div class="col-lg-4 col-md-4 ">
              <label for="filter" class="m-1">Filter By</label>
            </div>
            <div class="col-lg-6 col-md-6">
              <select class="form-select" id="filters" onchange="filter()">
                <option value="" hidden></option>
                <option value="start_address">Start point</option>
                <option value="start_time"> Start time</option>
                <option value="available_seats">Available seats</option>
                <option value="available_size">Available size</option>

              </select>
            </div>
          </div>



          <div class="col-lg-1 col-md-1"></div>
          <div class="col-lg-3 col-md-4 ">
            <div class="input-group">
              <input type="text" id="search_box" class="form-control" placeholder="Search">
              <div class="input-group-append">
                <button class="btn btn-secondary" onclick="search_fun();" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </div>
            </div>
          </div>
          <div class="col-lg-2">

          </div>

        </div>
      </form>


      <hr class="solid">


      <div id="amr" class="row ml-4 mr-4">

        <div href="#tripModal" type="button" data-book-id="" class="trip_card col-md-6 col-xl-3 col-lg-4 " data-toggle="modal">
          <div class="card p-2" style="width: 18rem;  margin: auto;">
            <div id="map23" class="card-img-top  rounded-top" style=" width:16rem; height:16rem;align-self: center;">
            </div>

            <div class="card-body">
              <p class="card-text card-icon">

                <i class="material-icons card-icon">location_on</i> <span></span> Destination:</span><br>
                <i class="material-icons card-icon">access_time</i> <span>Start Time:</span><br>
                <i class="material-icons card-icon">directions_car</i> <span>Vehicle type:</span><br>
              </p>
            </div>
          </div>
        </div>



      </div>

      <!-- Modal -->
      <div class="modal fade" id="tripModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div id="trip" class="modal-content">

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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    // load data first time 
    $.ajax({
      url: "{{route('gettrips')}}",
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        var data = response;
        var st = "";
        var maps = [];
        var locations = [];
        var m_id = [];
        $.each(data, function(index) {

          locations.push([data[index].start_point_latitude, data[index].start_point_longitude, data[index].end_point_latitude, data[index].end_point_longitude]);
          m_id.push(data[index].trip_id);
          st += " <div id='trip_info'  type='button' href='#tripModal'  onclick='openmodal(this," + data[index].trip_id + ")' class='trip_card col-md-6 col-xl-3 col-lg-4 ' data-toggle='modal'>";
          st += "   <div class='card p-2' style='width: 18rem;  margin: auto;'>";
          st += "   <div   id='map" + data[index].trip_id + "' class='card-img-top  rounded-top' style=' width:16rem; height:16rem;align-self: center;'></div>";

          st += "   <div class='card-body'>";
          st += "    <p class='card-text card-icon'>";

          st += "   <i class='material-icons card-icon'>location_on</i> <span></span> Destination:" + data[index].end_address + "</span><br>";
          st += "   <i class='material-icons card-icon'>access_time</i> <span>Start Time:" + data[index].start_time + "</span><br>";
          st += "    <i class='material-icons card-icon'>directions_car</i> <span>Vehicle type:" + data[index].vehicle_type + "</span><br>";
          st += "    </p>    </div>  </div> </div>";

        });


        $("#amr").html(st);

        var maps = [];
        for (var i = 0; i < m_id.length; i++) {



          var start = {
            lat: locations[i][0],
            lng: locations[i][1]
          };

          var end = {
            lat: locations[i][2],
            lng: locations[i][3]
          };

          var mapOptions = {
            center: start,
            scrollwheel: false,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            gestureHandling: "none",
            fullscreenControl: true,

          };

          var map = new google.maps.Map(document.getElementById('map' + m_id[i]), mapOptions);
          maps.push(map);


          var marker1 = new google.maps.Marker({
            map: map,
            position: start,
          });

          var marker2 = new google.maps.Marker({
            map: map,
            position: end,
          });
        };

        window.initMap = initMap;





      },
      error: function() {
        alert('no response');
      }


    });


    //fun for displaying prod details
    function openmodal(f, id) {


      $.ajax({
        url: "{{route('gettripsid')}}",
        type: 'GET',
        dataType: 'json',
        data: {
          id: id
        },
        success: function(response) {

          var data = response;
          var st = "";
          var s_lat;
          var s_lng;
          var e_lat;
          var e_lng;
          $.each(data, function(index) {
            s_lat = data[index].start_point_latitude;
            s_lng = data[index].start_point_longitude;
            e_lat = data[index].end_point_latitude;
            e_lng = data[index].end_point_longitude;
            st += "<div class='modal-header'>";
            st += "    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
            st += "<span aria-hidden='true'>&times;</span>";
            st += "</button>    </div>";
            st += "<div  class='modal-body'>";
            st += "<div id='map' class='rounded' style='width:100%; height:13rem;' ></div>";
            st += "  <div class='row mt-4'>";
            st += "<div class='col-md-6 col-sm-12'>";
            st += "<p>Driver's name:" + data[index].user_name + "</p>";
            st += "<p>Vehicle Type:" + data[index].vehicle_type + "</p>";
            st += "<p>Start Point:" + data[index].start_address + "</p>";
            st += "<p>End Point:" + data[index].end_address + "</p>    </div>";

            st += "<div class=' d-none d-sm-inline-block col-md-1'>";
            st += "<div class='vr ' style='height: 100%;'></div>                </div>";

            st += "<div class='col-md-5 col-sm-12 '>";

            st += "<p>Start Time: " + data[index].start_time + "</p>";
            st += "<p>Aviliable Seats:" + data[index].available_seats + "</p>";
            st += "<p>Aviliable Load Size:" + data[index].available_size + "</p>";
            st += "<p>Aviliable Load Weight:" + data[index].available_weight + "</p>                </div>             </div>            </div>";

            st += "<div class='modal-footer'>";
            st += "<form method='POST' action='{{ route('book_seat') }}'>  <input type='hidden' name='_token' value='{{ csrf_token() }}' /> <input type=text id='id' name='id' value='" + data[index].trip_id + "' hidden='true'>"
            st += " <button type='submit' class='btn-trip-book btn '>Reserve Seat</button></form>"

            st += "<form method='POST' action='{{ route('book_package') }}'>  <input type='hidden' name='_token' value='{{ csrf_token() }}' /> <input type=text id='id' name='id' value='" + data[index].trip_id + "' hidden='true'>"
            st += " <button type='submit' class='btn-trip-book btn '>Send Packages</button></form>"

            st += "    </div>";


          });
          $("#trip").html(st);

          var start = {
            lat: s_lat,
            lng: s_lng
          };

          var end = {
            lat: e_lat,
            lng: e_lng
          };

          var mapOptions = {
            center: start,
            scrollwheel: false,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            zoomControl: true,
            fullscreenControl: true,

          };

          var map = new google.maps.Map(document.getElementById('map'), mapOptions);



          var marker1 = new google.maps.Marker({
            map: map,
            position: start,

          });

          var marker2 = new google.maps.Marker({
            map: map,
            position: end,
          });

        },
        error: function() {
          alert('no response modal', id);
        }

      });

    }

    //filter by
    function filter() {

      var f = document.getElementById("filters").value;


      $.ajax({
        url: "{{route('get_trips_all_by_filter')}}",
        type: 'GET',
        dataType: 'json',
        data: {
          f: f
        },
        success: function(response) {
          var data = response;
          var st = "";
          var maps = [];
          var locations = [];
          var m_id = [];
          $.each(data, function(index) {

            locations.push([data[index].start_point_latitude, data[index].start_point_longitude, data[index].end_point_latitude, data[index].end_point_longitude]);
            m_id.push(data[index].trip_id);
            st += " <div id='trip_info'  type='button' href='#tripModal'  onclick='openmodal(this," + data[index].trip_id + ")' class='trip_card col-md-6 col-xl-3 col-lg-4 ' data-toggle='modal'>";
            st += "   <div class='card p-2' style='width: 18rem;  margin: auto;'>";
            st += "   <div   id='map" + data[index].trip_id + "' class='card-img-top  rounded-top' style=' width:16rem; height:16rem;align-self: center;'></div>";

            st += "   <div class='card-body'>";
            st += "    <p class='card-text card-icon'>";

            st += "   <i class='material-icons card-icon'>location_on</i> <span></span> Destination:" + data[index].end_address + "</span><br>";
            st += "   <i class='material-icons card-icon'>access_time</i> <span>Start Time:" + data[index].start_time + "</span><br>";
            st += "    <i class='material-icons card-icon'>directions_car</i> <span>Vehicle type:" + data[index].vehicle_type + "</span><br>";
            st += "    </p>    </div>  </div> </div>";

          });


          $("#amr").html(st);

          var maps = [];
          for (var i = 0; i < m_id.length; i++) {



            var start = {
              lat: locations[i][0],
              lng: locations[i][1]
            };

            var end = {
              lat: locations[i][2],
              lng: locations[i][3]
            };

            var mapOptions = {
              center: start,
              scrollwheel: false,
              zoom: 15,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              disableDefaultUI: true,
              gestureHandling: "none",
              fullscreenControl: true,

            };

            var map = new google.maps.Map(document.getElementById('map' + m_id[i]), mapOptions);
            maps.push(map);


            var marker1 = new google.maps.Marker({
              map: map,
              position: start,
            });

            var marker2 = new google.maps.Marker({
              map: map,
              position: end,
            });
          };

          window.initMap = initMap;





        },
        error: function() {
          alert('no response');
        }


      });
    }



    //search product by name function
    function search_fun() {


      var k = document.getElementById("search_box").value;

      $.ajax({
        url: "{{route('search')}}",
        type: 'GET',
        dataType: 'json',
        data: {
          k: k
        },
        success: function(response) {
          var data = response;
          var st = "";
          var maps = [];
          var locations = [];
          var m_id = [];


          $.each(data, function(index) {

            locations.push([data[index].start_point_latitude, data[index].start_point_longitude, data[index].end_point_latitude, data[index].end_point_longitude]);
            m_id.push(data[index].trip_id);
            st += " <div id='trip_info'  type='button' href='#tripModal'  onclick='openmodal(this," + data[index].trip_id + ")' class='trip_card col-md-6 col-xl-3 col-lg-4 ' data-toggle='modal'>";
            st += "   <div class='card p-2' style='width: 18rem;  margin: auto;'>";
            st += "   <div   id='map" + data[index].trip_id + "' class='card-img-top  rounded-top' style=' width:16rem; height:16rem;align-self: center;'></div>";

            st += "   <div class='card-body'>";
            st += "    <p class='card-text card-icon'>";

            st += "   <i class='material-icons card-icon'>location_on</i> <span></span> Destination:" + data[index].end_address + "</span><br>";
            st += "   <i class='material-icons card-icon'>access_time</i> <span>Start Time:" + data[index].start_time + "</span><br>";
            st += "    <i class='material-icons card-icon'>directions_car</i> <span>Vehicle type:" + data[index].vehicle_type + "</span><br>";
            st += "    </p>    </div>  </div> </div>";

          });

          if (!$.trim(data))
            st += "<p style=' text-align: center;'>No results!</p>";

          $("#amr").html(st);

          var maps = [];
          for (var i = 0; i < m_id.length; i++) {



            var start = {
              lat: locations[i][0],
              lng: locations[i][1]
            };

            var end = {
              lat: locations[i][2],
              lng: locations[i][3]
            };

            var mapOptions = {
              center: start,
              scrollwheel: false,
              zoom: 15,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              disableDefaultUI: true,
              gestureHandling: "none",
              fullscreenControl: true,

            };

            var map = new google.maps.Map(document.getElementById('map' + m_id[i]), mapOptions);
            maps.push(map);


            var marker1 = new google.maps.Marker({
              map: map,
              position: start,
            });

            var marker2 = new google.maps.Marker({
              map: map,
              position: end,
            });
          };

          window.initMap = initMap;





        },
        error: function() {
          alert('no response');
        }


      });

    }
  </script>

  <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCSt4ABayMg8O3n9Hvxb_vrs_1oUfWXuA&callback=initMap&libraries=&v=weekly"></script>
  <script>
    function initMap() {
      // The location of homs

    }
  </script>







</body>

</html>