<head>


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('landingpage/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('landingpage/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('landingpage/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Arsha - v4.9.1
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    {{-- <div class="container d-flex align-items-center"> --}}
      <nav id="navbar" class="navbar">

        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    {{-- </div> --}}
  </header><!-- End Header -->

  <br><br><br>
  {{-- <section id="hero" class="d-flex align-items-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
          <h1>SimocoRC</h1>
          <h2>System Inventory and Monitoring-Controlling Reefer Container</h2>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#cta" class="btn-get-started scrollto">Login</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
          <img src="{{asset('landingpage/img/hero-img.png')}}" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero --> --}}

  <main id="main">
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
              <h1>SimocoRC</h1>
              <h2>System Inventory and Monitoring-Controlling Reefer Container</h2>
              <div class="d-flex justify-content-center justify-content-lg-start">
                <a href="#cta" class="btn-get-started scrollto">Login</a>
              </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
              <img src="{{asset('landingpage/img/hero-img.png')}}" class="img-fluid animated" alt="">
            </div>
          </div>
        </div>

    </section>
    <!-- End Hero -->
    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
      <div class="container" data-aos="zoom-in">

        {{-- <div class="row"> --}}
            <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
                <div class="container">
                    <div class="row align-items-center">
                        {{-- <div class="col-md-6 col-lg-7">
                            <img src="{{asset('vendors/images/inka1.png')}}" alt="">
                        </div> --}}
                        {{-- <div class="col-md-6 col-lg-5"> --}}
                            <div class="login-box bg-white box-shadow border-radius-10" style="width: 40%">
                                <div class="login-title">
                                    <h2 class="text-center text-primary">Sign In</h2>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="input-group custom">
                                        {{-- <label for="email"></label> --}}
                                        <input for="email" id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                        </div>
                                    </div>
                                    <div class="input-group custom">
                                        <input for="password" id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                        </div>
                                    </div>
                                    <div class="row pb-30">
                                        <div class="col-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="remember">Remember</label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="forgot-password"><a href="{{ url('/forgot-password') }}">Forgot Password</a></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="input-group mb-0">
                                                {{--
                                                    use code for form submit
                                                    <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                                                 --}}
                                                <button class="btn btn-primary btn-lg btn-block" type="submit">Sign In</button>
                                            </div>
                                            <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">OR</div>
                                            <div class="input-group mb-0">
                                                <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('register') }}">Register to Create Account</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        {{-- </div> --}}

      </div>
    </section><!-- End Cta Section -->
  </main><!-- End #main -->

  {{-- <div id="preloader"></div> --}}
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('landingpage/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('landingpage/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('landingpage/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('landingpage/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('landingpage/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('landingpage/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{asset('landingpage/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('landingpage/js/main.js')}}"></script>

</body>
