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
    <title>User Home</title>
</head>
<body>
    @include('user.navbarU')
    <h1>PROFILE, {{$data->username}}!</h1>
    <center><img style="width: 15%;" src="{{ url("/storage/profile/".$data->picture) }}" alt="Profile Picture" width="200"></center>
    <!-- Tampilkan gambar profil dengan path default.png -->
    <p>Nama: {{$data->username}}</p>
    <p>Email: {{$data->email}}</p>
    <p>tgl lahir: {{$data->tgllahir}}</p>
<center>
    <!-- Tampilkan informasi lain sesuai kebutuhan -->
<a href="{{url("/user/HEditProfile")}}"><button class="btn btn-success">Edit Profile</button></a>
</center>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

</body>
</html>
