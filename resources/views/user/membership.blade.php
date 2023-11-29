<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <style>
            body {
              font-family: 'Trebuchet MS', sans-serif;
              margin: 0;
                padding: 0;
                height: 100vh;
                background: linear-gradient(to bottom, black, gray);
                color: white;
                text-align: center;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }
        </style>
    <title>Membership</title>
</head>
<body>
    @include('user.navbarU')
    <div id="container">
        <center>
            <br/>
            <br/>
            <br/>
            <br/>
            <h3>Membership</h3>
            @if (Session::has('msg'))
                <div style="background-color: red; padding: 4px; color: white">
                    <h3>{{ Session::get('msg') }}</h3>
                </div>
            @endif
        </center>
        <div id="formtambah">
            <form method="post" action="{{ url("/user/belimembership") }}">
                @csrf
                <br>
                <br>
                <center>
                    <h5>
                        Saat Saldo User kurang dari 50.000 maka button beli nya akan disable, itu menandakan bahwa user belum memiliki cukup saldo untuk membeli member.
                        <br>
                        TOP UP SEKARANG!
                    </h5>

                    <button class="btn btn-danger" style="width: 100%;" name="BtnTambah" {{ $user->saldo < 50000 ? 'disabled' : '' }}>
                        Klik di sini untuk Beli Membership hanya 50.000 rupiah
                    </button>
                    <br>
                    <br>
                    <!-- Tambahkan link untuk menuju halaman topup -->
                    <a href={{url("user/topup")}} class="btn btn-light">Topup Saldo</a>
                </center>
                <br>
            </form>
        </div>
    </div>
</body>
</html>
