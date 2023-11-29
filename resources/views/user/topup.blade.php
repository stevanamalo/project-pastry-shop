
<!DOCTYPE html>
<html lang="en">
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
    <title>Top Up</title>
</head>
<body>
    <body>
        @include('user.navbarU')
        <div id="container">
            <center>
                <br />
                <br />
                <br />
                <br />
                <h3>Topup Saldo</h3>
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
                        <button class="btn btn-success" style="width: 100%;" name="BtnTopup">Topup Saldo</button>
                        <br>
                        <br>
                    </center>
                </form>
            </div>
        </div>
    </body>

</body>
</html>
