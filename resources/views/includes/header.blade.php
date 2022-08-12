<meta name="csrf-token" content="{{ csrf_token() }}">


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Vendor CSS Files -->
<link href=" {{URL::asset('assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
<link href=" {{URL::asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
<link href=" {{URL::asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<link href=" {{URL::asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
<link href=" {{URL::asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
<link href=" {{URL::asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
<link href=" {{URL::asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

<!-- Bootstrap css files -->
<link rel="stylesheet" href="{{URL::asset('assets/css/bootstrap.css')}}">

<!-- Template Main CSS File -->
<link href="{{URL::asset('assets/css/style.css')}}" rel="stylesheet">

<style>
/* width */
.scrollable-container::-webkit-scrollbar {
  width: 7px;
}

/* Track */
.scrollable-container::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
.scrollable-container::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
.scrollable-container::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
</style>
@if (Request()->is('home'))
<header id="header" class="fixed-top d-flex align-items-center header-transparent">
  @else
  <header id="header" class="fixed-top d-flex align-items-center header-scrolled">
    @endif
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
          <input type="text" id="u_id" value="{{Auth::user()->id}}" hidden>
          @if(Auth::user()->role_type=='USER')
          <li> <a href="{{ route('trips') }}" id="end" class="{{ (request()->is('Trips')) ? 'active' : '' }}">Trips</a></li>
          @else
          <li> <a href="{{ route('trips_driver') }}" id="end" class="{{ (request()->is('Trips_driver')) ? 'active' : '' }}">Trips</a></li>
          @endif

          @else
          <li> <a href="{{ route('login') }}" class="btn-account {{ (request()->is('login')) ? 'd-none' : '' }}">Login</a></li>

          @if (Route::has('register'))
          <li> <a href="{{ route('register') }}" class="btn-account {{ (request()->is('register')) ? 'd-none' : '' }}">Register</a></li>
          @endif
          @endauth
        </ul>

        @auth

        <div class="dropdown dropdown-notifications">

          <a class="nav-link nav-link-label dropdown-toggle nav_icon p-0" href="#" data-toggle="dropdown">



            <span class="badge rounded-pill badge-notification bg-dark notif-count" data-count="{{$count->counts}}">{{$count->counts}}</span>
            <i class="fa fa-bell-o " style="font-size:18px;color:white  "></i>
          </a>
          <div class="dropdown-menu scrollable-container" style="height: 20rem;width: 16rem;overflow-x: hidden;" aria-labelledby="dropdownMenuButton">

            <hr style="margin: unset;">
            @foreach($notifi as $not)
            @if($not->trip_status=='waiting')

            @if($not->trip_type=='passenger')
            <a class="dropdown-item dropped_a" href="{{route('track_trips_user',[$not->trip_id])}}">
              
              <p class="paragraph"> {{$not->message}} {{$not->trip_end}}</p>
              <p class="paragraph date">{{$not->date}}/{{$not->clock}}</p>
            </a>
            <hr style="margin: unset;">
            @endif
            @if($not->trip_type=='package')
            <a class="dropdown-item dropped_a" href="{{route('track_trips_package',[$not->trip_id])}}">
              
              <p class="paragraph"> {{$not->message}} {{$not->trip_end}}</p>
              <p class="paragraph date">{{$not->date}}/{{$not->clock}}</p>
            </a>
            <hr style="margin: unset;">
            @endif
            @if($not->trip_type=='driver')
            <a class="dropdown-item dropped_a" href="{{route('track_trips_driver',[$not->trip_id])}}">
              
              <p class="paragraph"> {{$not->message}} {{$not->trip_end}}</p>
              <p class="paragraph date">{{$not->date}}/{{$not->clock}}</p>
            </a>
            <hr style="margin: unset;">
            @endif
            @endif

            @if($not->trip_status=='cancelled')
            @if(Auth::user()->role_type=='USER')
            <a class="dropdown-item dropped_a" href="{{route('trips')}}">

              <p class="paragraph"> {{$not->message}} {{$not->trip_end}}</p>
              <p class="paragraph">You may search for a new one, Sorry for your inconveince</p>
              <p class="paragraph date">{{$not->date}}/{{$not->clock}}</p>

            </a>
            <hr style="margin: unset;">
            @endif
            @if(Auth::user()->role_type=='DRIVER')
            <a class="dropdown-item dropped_a" href="{{route('trips_driver')}}">

              <p class="paragraph"> {{$not->message}} {{$not->trip_end}}</p>
              <p class="paragraph">You may search for a new one, Sorry for your inconveince</p>
              <p class="paragraph date">{{$not->date}}/{{$not->clock}}</p>
            </a>
            <hr style="margin: unset;">
            @endif
            @endif
            @endforeach
          </div>
        </div>

        <div class="dropdown">
          <img src="{{URL::asset('assets/img/account.svg')}}" class="dropdown-toggle nav_icon" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" alt="">

          <div class="dropdown-menu">
            @if(Auth::user()->role_type=='USER')
            <a class="dropdown-item" href="{{route('my_profile')}}">My Profile</a>
            @else
            <a class="dropdown-item" href="{{route('my_profile_driver')}}">My Profile</a>
            @endif

            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>

          </div>
        </div>
        @endauth

        <i id="end2" class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://js.pusher.com/7.2/pusher.min.js"></script>

  <script>
    var user_id = document.getElementById('u_id').value;
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('f9c5c8ee1acd9cca06db', {
      cluster: 'mt1'
    });
    var channel = pusher.subscribe('new_notification' + user_id);
  </script>

  <script type="text/javascript" src="/assets/js/pusherNotifications.js"></script>