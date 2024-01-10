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



        <h2>Edit User </h2>
        <br><br>

        <form method="post" action={{url("/admin/PAEditUser/{$username}") }}>
            @csrf

            <br>
            <label for="nama">nama</label>
            <input type="nama" name="nama" value="{{$data->nama}}">
            <br>




            <label for="hobby">hobby</label>
            <input type="hobby" name="hobby" value="{{$data->hobi}}" >
            <br>

            <label for="deskripsi">Deskripsi Diri</label>
            <textarea name="deskripsi" >{{$data->deskripsi}}</textarea>

            <br>

            <!-- Tambahkan atribut lainnya sesuai kebutuhan -->



            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label" for="nama">Nama</label>
                <div class="col-sm-10">
                  <input type="nama" name="nama" value="{{$data->nama}}" class="form-control">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label"for="hobby">hobby</label>
                <div class="col-sm-10">
                  <input  type="hobby" name="hobby" value="{{$data->hobi}}" class="form-control">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label"for="deskripsi">Deskripsi Diri</label>
                <div class="col-sm-10">
                  <textarea name="deskripsi" >{{$data->deskripsi}}</textarea>
                </div>
              </div>
              <button type="submit" class="btn btn-light">Edit</button>
        </form>
    </center>

</div>




</body>
@include('Template.footer')
</html>
