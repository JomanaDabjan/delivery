<header id="header" class="fixed-top d-flex align-items-center header-scrolled">
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
        <li> <a href="{{ route('login') }}" class="btn-account {{ (request()->is('login')) ? 'd-none' : '' }}">Login</a></li>

        @if (Route::has('register'))
        <li> <a href="{{ route('register') }}" class="btn-account {{ (request()->is('register')) ? 'd-none' : '' }}">Register</a></li>
        @endif
        @endauth
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->