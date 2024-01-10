<!DOCTYPE html>
<html>

<head>
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
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
</head>
<header>
    @include('template.navbar')
</header>
<br>
<br>
<body id="body" class="body fixed-center" style="width:auto">
    <br>
    <div class="container align-center justify-content-between">
            @if (Session::has('msg'))
        <div style="background-color: red; padding: 4px; color: white">
            <h3>
                {{ Session::get('msg'); }}
            </h3>
            {{-- <h3>
                {{ Session::get('msg2'); }}
            </h3> --}}
        </div>
        @endif

        <div id="isi">
            <center>
                <br>
                <h2>List penjualan</h2>
                <br><br>
                <table class="table table-hover" style="width: 100%;">
                    <thead>
                      <tr>
                        <th scope="col">nama pembeli</th>
                        <th scope="col">nama pastry</th>
                        <th scope="col">jumlah terjual</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualan as $penjualan)
                        <tr>
                            <form method="post" action="" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')   
                                <input type="hidden" name="_method" value="PUT"> 
                                <td><h6>{{ $penjualan->htrans_id }}</h6></td>
                                <td><h6>{{ $penjualan->pastry_id }}</h6></td>
                                <td><h6>{{ $penjualan->quantity }}</h6></td>
                            </form>
                        </tr>  
                        @endforeach
                    </tbody>
                  </table>
            </center>
        </div>
    </div>
    
</body>
@include('Template.footer')
</html>




{{-- <tbody>
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
</tbody> --}}