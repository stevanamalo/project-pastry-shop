<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <img src="{{asset('fontt.png')}}" alt="" style="width:160px";>
      </a>

        <nav id="navbar" class="navbar">
            <meta charset="utf-8">
            <meta content="width=device-width, initial-scale=1.0" name="viewport">
        
            <title>Yummy Bootstrap Template - Index</title>
            <meta content="" name="description">
            <meta content="" name="keywords">
        
            <!-- Favicons -->
            <link href="assets/img/favicon.png" rel="icon">
            <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
        
            <!-- Google Fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
        
            <!-- Vendor CSS Files -->
            <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
            <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
            <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
            <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
            <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
            <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
        
            <!-- Template Main CSS File -->
            <link href="assets/css/main.css" rel="stylesheet">

            <ul>
              <li><a href="{{ url('/admin') }}">Home Admin</a></li>
              <li><a href="{{ url('/admin/listuser') }}">List Customer</a></li>
              <li class="dropdown"><a href="#"><span>List Employee</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                    <li><a href="{{ url('/admin/listbaker') }}">List Baker</a></li>
                    <li><a href="{{ url('/admin/listkaryawan') }}">List Karyawan</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="#"><span>Register Employee</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                    <li><a href="{{ url('/admin/masterbaker') }}">Register Baker</a></li>
                    <li><a href="{{ url('/admin/masterkaryawan') }}">Register Karyawan</a></li>
                </ul>
              </li>
              <li><a href="{{ url('/admin/penjualan') }}">penjualan</a></li>
            </ul>
        </nav><!-- .navbar -->

        <a class="btn-book-a-table" href="{{url("/logout")}}" style="background-color:#6D4404;">Logout</a>
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
    </div>
</header>
