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
            <body>
                        <h2>List Menu</h2>
                        <br>
                        <center>
                            <table id="tabel" border="1px solid black" class="table table-striped-columns" style="width:100%;">
                                <thead>
                                    <th style="width:30px;"><center><h5><b>Picture</b> </h5></center></th>
                                    <th><center><h5><b> Nama Pastry</b></h5></center></th>
                                    <th><center><h5><b>Harga</b></h5></center></th>
                                    <th style="width:10%;"><center><h5><b>Tambah Keranjang</b></h5></center></th>
                                </thead>
                                <tbody>
                                    @foreach ($pastries as $pastry)
                                    <tr>
                                        <form method="post" action="{{ url("/user/insertcart/{$pastry->id}") }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="_method" value="PUT">
                                            <td><center>
                                                @if($pastry->picturepastry)
                                                <img src="{{ asset($pastry->picturepastry) }}" alt="Pastry Image" style="width: 200px;">
                                            @else
                                                No Image
                                            @endif
                                            </center>
                                            </td>
                                            <td><center>
                                                <h6>{{ $pastry->nama }}</h6>
                                            </center>
                                            </td>
                                            <td style="margin: auto;"> <center>
                                                <h6>Rp. {{ number_format($pastry->harga, 0, ',', '.') }},-</h6>
                                            </center>
                                            </td>
                                            <td>
                                                <button class="btn btn-outline-success btn-tambah-keranjang" data-id="{{ $pastry->id }}">+Keranjang</button>
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

                        <br>
                        <h2>List Keranjang</h2>
                        <br>
                        <center>
                            <table id="tabel-keranjang" border="1px solid black" class="table table-striped-columns" style="width:80%;">
                                <thead>
                                    <th> <center><h5> Picture</h5></center> </th>
                                    <th><center><h5> Nama Pastry</h5></center></th>
                                    <th><center><h5> Stok Pembelian</h5></center></th>
                                    <th><center><h5> Harga</h5></center></th>
                                </thead>
                                <tbody>
                                    @php $totalHarga = 0; @endphp
                                    @forelse ($keranjang as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <h6>{{ $item['nama'] }}</h6>
                                            </td>
                                            <td>
                                                <h6>{{ $item['stok'] }}</h6>
                                            </td>
                                            <td>
                                                <h6>Rp. {{ number_format($item['harga'], 0, ',', '.') }},-</h6>
                                                @php $totalHarga += $item['harga']; @endphp
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No pastry selected</td>
                                        </tr>
                                    @endforelse
                                    <tr>
                                        <td colspan="3"><strong>Total Harga</strong></td>
                                        <td><strong>Rp. {{ number_format($totalHarga, 0, ',', '.') }},-</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            @if(count($keranjang) > 0)
                                <a href="{{ url("/user/checkout") }}" class="btn btn-primary">Checkout</a>
                            @endif
                        </center>
                      </div>
                    </section><!-- End About Section -->
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
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      <script>
          $(document).ready(function () {
              // Menangani klik tombol "+Keranjang"
              $(".btn-tambah-keranjang").on("click", function () {
                  var pastryId = $(this).data("id");

                  // Kirim AJAX request untuk menambahkan item ke keranjang
                  $.ajax({
                      type: "POST",
                      url: "/user/insertcart",
                      data: { pastry_id: pastryId, _token: "{{ csrf_token() }}" },
                      success: function (response) {
                          if (response.success) {
                              alert("Item berhasil ditambahkan ke keranjang!");
                              // Tambahan: Refresh halaman setelah menambahkan item ke keranjang
                              location.reload();
                          } else {
                              alert("Gagal menambahkan item ke keranjang.");
                          }
                      },
                      error: function () {
                          alert("Terjadi kesalahan saat mengirim request.");
                      }
                  });
              });
          });
      </script>
    </body>

    </html>
