<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Yummy Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

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

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Yummy
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  {{-- <style>
    body {
      font-family: 'Open Sans', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #333;
      color: white;
      padding: 10px;
      text-align: center;
    }

    .container {
      margin: 20px auto;
      max-width: 400px;
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .container1 {
      margin: 20px auto;
      max-width: 170px;
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
    }

    button {
      background-color: #333;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .alert {
      background-color: #f44336;
      color: white;
      padding: 10px;
      margin-bottom: 16px;
      border-radius: 4px;
    }
  </style> --}}
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center me-auto me-lg-0">
        <img src="{{ asset('fontt.png') }}" alt="" style="width:160px;">
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{ url('/baker') }}">Home Baker</a></li>
          <li><a href="{{ url('/baker/mastermenu') }}">Menu</a></li>
          <li><a href="{{ url('/baker/mastersupplier') }}">Supplier</a></li>
          <li><a href="{{ url('/baker/masteringredient') }}">Ingredient</a></li>
        </ul>
      </nav>

      <a class="btn-book-a-table" href="{{url("/logout")}}" style="background-color:#6D4404;">Logout</a>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="login" class="Login">
      <div class="container" data-aos="fade-up">
        <header>
            <br>
           <b><h1 style="color: #6D4404;">Master Supplier</h1></b>
          </header>
          <br>
          <div class="container">
            <h2 style="color: #6D4404;">Add New Supplier</h2>
   <form method="post" action="{{ url("/baker/insertsupplier") }}">
      @csrf

      <label for="nama">Name</label>
      <br>
      <input type="text" name="nama" required placeholder="Supplier Name" style="width:275px;">
        <br><br>
        <label for="address">Address</label>
        <br>
        <input type="text" name="address" required placeholder="Supplier Address" style="width:275px;">
          <br><br>
          <label for="address">Phone Number</label>
        <br>
        +620 <input type="text" name="notlp" required placeholder="Supplier Phone Number" style="width:275px;">
          <br><br>
      <button type="submit" type="button" class="btn" style="background-color: #6D4404;color:white;">Add Supplier</button>

      <br>
    </form>
    <br>
    <br>
    @if(session('msg'))
    <div class="alert">
      {{ session('msg') }}
    </div>
    @endif

    @if ($errors->any())
      <div class="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <br><br>
    <h2 style="color: #6D4404;">List Suppliers</h2>
    <table id="tabel" border="1px solid black" class="table table-striped">
      <thead>
        <th>No.</th>
        <th>Nama Supplier</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Ubah</th>
        <th>Hapus</th>
      </thead>
      <tbody >
        @foreach ($suppliers as $supplier)
          <tr>
            <form method="post" action="{{ url("/baker/updateSupplier/{$supplier->id}") }}">
              @csrf
              <input type="hidden" name="_method" value="PUT">
              <td>{{ $loop->index+1 }}</td>
              <td><input type="text" value="{{ $supplier->nama }}" name="nama" style="width:265px;"></td>
              <td><input type="text" value="{{ $supplier->address }}" name="address"  style="width:255px;"></td>
              <td><input type="text" value="+620{{ $supplier->notlp }}" name="notlp" ></td>
              <td>
                <button type="submit" type="button" class="btn btn-success">Ubah</button>
              </td>
            </form>
            <td>
              <form method="post" action="{{ url("/baker/deleteSupplier/{$supplier->id}") }}" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" type="button" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <br>
  </div>
    </section><!-- End About Section -->
    <script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
        </script>

    <!-- ======= Footer ======= -->
    <br><br><br><br>
    <footer id="footer" class="footer">

      <div class="container">
        <div class="row gy-3">
          <div class="col-lg-3 col-md-6 d-flex">
            <i class="bi bi-geo-alt icon"></i>
            <div>
              <h4>Address</h4>
              <p>
                A108 Adam Street <br>
                New York, NY 535022 - US<br>
              </p>
            </div>

          </div>

          <div class="col-lg-3 col-md-6 footer-links d-flex">
            <i class="bi bi-telephone icon"></i>
            <div>
              <h4>Reservations</h4>
              <p>
                <strong>Phone:</strong> +1 5589 55488 55<br>
                <strong>Email:</strong> info@example.com<br>
              </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 footer-links d-flex">
            <i class="bi bi-clock icon"></i>
            <div>
              <h4>Opening Hours</h4>
              <p>
                <strong>Mon-Sat: 11AM</strong> - 23PM<br>
                Sunday: Closed
              </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Follow Us</h4>
            <div class="social-links d-flex">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>

      <div class="container">
        <div class="copyright">
          &copy; Copyright <strong><span>Yummy</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>

    </footer><!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center" style="background-color:#6D4404;"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

  </body>

  </html>
