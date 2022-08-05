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
</head>

<body>


  <!-- ======= Header ======= -->
  @include('includes.header')



  <main id="main">

    <section class="profile">

      <div class="container">
        <h1 class="text-center">My Booked Trip Details</h1>




        <table class='pro_log'>
          <h2>Seat reserived trips</h2>
          <thead>
            <tr>
              <th>Trip ID</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Driver's Name</th>
              <th>Seats Reserved</th>
              <th>Start Point</th>
              <th>End Point</th>
              <th>Km Distance</th>
              <th>Cost</th>
              <th>Trip Status</th>
            </tr>
          </thead>
          <tbody id="table1">

          </tbody>
        </table>
        <br>



        <table class='pro_log'>
          <h2>Package reserived trips</h2>
          <thead>
            <tr>
              <th>Trip ID</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Start Point</th>
              <th>End Point</th>
              <th>Driver's Name</th>
              <th>Package weight</th>
              <th>Package size</th>
              <th>Receiver name</th>
              <th>Receiver phone</th>
              <th>Package Type</th>
              <th>Cost</th>
              <th>Trip Status</th>
            </tr>
          </thead>
          <tbody id="table2">
          </tbody>
        </table>
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
      url: "{{route('get_seats_log_user')}}",
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        var data = response;
        var st = "";

        $.each(data, function(index) {




          st += " <tr>";
          st += " <td>" + data[index].trip_id + "</td>";
          st += " <td>" + data[index].start_time + "</td>";
          st += " <td>" + data[index].end_time + "</td>";
          st += " <td>" + data[index].user_name + "</td>";
          st += " <td>" + data[index].seats_reserved + "</td>";
          st += " <td>" + data[index].start_address + "</td>";
          st += " <td>" + data[index].end_address + "</td>";
          st += " <td>" + data[index].km_distance + "</td>";
          st += " <td>" + data[index].trip_cost + "</td>";
          st += " <td>" + data[index].name + "</td>";
          st += "               </tr>";

        });


        $("#table1").html(st);






      },
      error: function() {
        alert('no response');
      }


    });

    $.ajax({
      url: "{{route('get_packages_log_user')}}",
      type: 'GET',
      dataType: 'json',
      success: function(response) {
        var data = response;
        var st = "";


        $.each(data, function(index) {






          st += " <tr>";
          st += " <td>" + data[index].trip_id + "</td>";
          st += " <td>" + data[index].start_time + "</td>";
          st += " <td>" + data[index].end_time + "</td>";
          st += " <td>" + data[index].start_address + "</td>";
          st += " <td>" + data[index].end_address + "</td>";
          st += " <td>" + data[index].user_name + "</td>";
          st += " <td>" + data[index].weight + "</td>";
          st += " <td>" + data[index].height + "</td>";
          st += " <td>" + data[index].receiver_name + "</td>";
          st += " <td>" + data[index].receiver_phone + "</td>";
          st += " <td>" + data[index].package_type + "</td>";
          st += " <td>" + data[index].trip_cost + "</td>";
          st += " <td>" + data[index].status + "</td>";

          st += "               </tr>";



        });


        $("#table2").html(st);


















      },
      error: function() {
        alert('no response');
      }


    });
  </script>



</body>

</html>