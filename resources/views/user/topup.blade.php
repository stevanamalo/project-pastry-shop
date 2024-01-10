<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PASTRY SHOP</title>
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

  <!-- =======================================================
  * Template Name: Yummy
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>
        @include('user.navbarU')
        <main id="main">

            <!-- ======= About Section ======= -->
            <section id="login" class="Login">
              <div class="container" data-aos="fade-up">
                <br>
                <h3 style="color: #6D4404;">Topup Saldo</h3>
                @if (Session::has('msg'))
                    <div style="background-color: red; padding: 4px; color: white">
                        <h3>{{ Session::get('msg') }}</h3>
                    </div>
                @endif
            </center>
            <div id="formtambah">
                <form method="post" action="{{ url("/user/topup") }}">
                    @csrf
                    <br>
                    <center>
                        <!-- Tambahkan input nominal topup -->
                        Top Up tidak boleh kurang dari 0 atau 0.
                        <br>
                        tidak akan terjadi apa-apa jika inputan kurang dari 0 atau 0.
                        <br><br>
                        <label for="nominal">Nominal Topup:</label>
                        <input type="number" name="nominal" id="nominal" required>
                        <br>
                        <br>
                        <button class="btn btn-success" style="width: 30%;" name="BtnTopup">Top Up Saldo</button>
                        <br>
                        <br>
                    </center>
                </form>
            </div>
            </section><!-- End About Section -->

          <!-- ======= Footer ======= -->
          <br><br><br><br>
          @include('user.footer')

          <!-- End Footer -->

          <a href="#" class="scroll-top d-flex align-items-center justify-content-center"style="background-color:#6D4404;"><i class="bi bi-arrow-up-short" ></i></a>

          <div id="preloader"></div>

          <!-- Vendor JS Files -->
          <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
          <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
          <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
          <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
          <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
          <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
          <script src="{{ asset('assets/js/main.js') }}"></script>


          <!-- Template Main JS File -->
          <script src="assets/js/main.js"></script>

        </body>

        </html>
