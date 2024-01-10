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
            <h2>List Menu</h2>
            <br>
            <center>
                <table id="tabel" border="1px solid black" class="table table-striped-columns" style="width:80%;">
                    <thead>
                        <th><h5> No.</h5></th>
                        <th><h5> Nama Pastry</h5></th>
                        <th><h5>Harga</h5></th>
                        <th><h5>Tambah Keranjang</h5></th>
                    </thead>
                    <tbody>
                        @foreach ($pastries as $pastry)
                        <tr>
                            <form method="post" action="{{ url("/user/insertcart/{$pastry->id}") }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="_method" value="PUT">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    <h6>{{ $pastry->nama }}</h6>
                                </td>
                                <td>
                                    <h6>Rp. {{ number_format($pastry->harga, 0, ',', '.') }},-</h6>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-success">+Keranjang</button>
                                </td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </center>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </section><!-- End About Section -->

        @include('user.footer')

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
