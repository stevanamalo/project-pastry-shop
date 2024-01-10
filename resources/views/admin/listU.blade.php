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
<br>
<header>
    @include('template.navbar')
</header>
<br>
<br>
<body>
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
        <h2>List User </h2>
        <br><br>

        <table class="table table-hover" style="width: 90%;">
            <thead>
              <tr>

                <th scope="col">username</th>
                <th scope="col">nama</th>
                <th scope="col">email</th>
                <th scope="col">tgl lahir</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
            @if ($jumlah > 0)
                        @foreach ($data as $user)
                            @if ($user->role === 'user')
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->tgllahir }}</td>
                                    <td>
                                        <a href="/admin/edituser/{{ $user->username }}">
                                            <button class="btn btn-success">Edit</button>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7"><center>Belum ada User</center></td>
                        </tr>
            @endif
            </tbody>
          </table>
    </center>
</div>
</body>
@include('Template.footer')
</html>
