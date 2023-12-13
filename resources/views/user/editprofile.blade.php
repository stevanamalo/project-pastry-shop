<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <style>
            body {
              font-family: 'Trebuchet MS', sans-serif;

                height: 100vh;
                background: linear-gradient(to bottom, black, gray);
                color: white;
                text-align: center;

                flex-direction: column;
                justify-content: center;
            }
        </style>
    <title>User Home</title>
</head>
<body>
    @include('user.navbarUB')
    <div id="container" >

        <center>
            <br/>
            <br/>

            <br/>
            <br/>
            <h3>Edit profile</h3>
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

        </center>
            <div id="formtambah">
                <form  method="post" action={{url("/user/PUEditProfile")}} enctype="multipart/form-data">
                    @csrf


                <div>
                    nama
                    <input type="text" class="form-control" name="nama" placeholder="nama" value="{{$data->nama }}">

                </div>
                <div>
                    tgl lahir
                    <input type="date" class="form-control" name="tgllahir" placeholder="deskrispsi" value={{$data->tgllahir }}>

                </div>
                <div>
                    old password
                    <input type="password" class="form-control" name="oldpassword" placeholder="password Lama">

                </div>
                <div>
                    new password
                    <input type="password" class="form-control" name="password" placeholder="password">

                </div>
                <div>
                    password confirmation
                    <input type="password" class="form-control" name="password_confirmation" placeholder="password confirmation">

                </div>
                <div>
                    profile picture
                    <input type="file" class="form-control" name="profile_picture" placeholder="profile picture">

                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <center>
                    <button  class="btn btn-danger" style="width: 100%;" name="BtnTambah" >Edit</button>
                    <br>
                    <br>
                </center>
                <br>
                </form>
            </div>

    </div>
</body>
</html>
