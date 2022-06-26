<header id="header" class="fixed-top d-flex align-items-center header-scrolled">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1 class="text-light"><a href="{{ url('/home') }}"><img src="/assets/img/logo_transperent.png" data-aos="fade-right" alt="" class="img-fluid"><span>RideShare</span></a></h1>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
        <li><a class="{{ (request()->is('home')) ? 'active' : '' }}" href="{{ url('/home') }}">Home</a></li>
          <li><a class="{{ (request()->is('home/about')) ? 'active' : '' }}" href="{{ url('/home/about') }}">About</a></li>
          <li><a class="{{ (request()->is('home/services')) ? 'active' : '' }}" href="{{ url('/home/services') }}">Services</a></li>
          <li><a class="{{ (request()->is('home/contact')) ? 'active' : '' }}" href="{{ url('/home/contact') }}">Contact Us</a></li>
          <li><a class="{{ (request()->is('home/signup')) ? 'd-none' : '' }} btn-account" href="{{ url('/home/signup') }}">Signup</a> </li>
          <li><a class="btn-account {{ (request()->is('home/login')) ? 'd-none' : '' }}" href="{{ url('/home/login') }}">Login</a></li>
        

        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->