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
    @include('admin.navbarA')
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



        <h2>List User </h2>
        <br><br>

        <table class="table table-hover" style="width: 90%;">
            <thead>
              <tr>

                <th scope="col">username</th>
                <th scope="col">nama</th>
                <th scope="col">email</th>
                <th scope="col">tgl lahir</th>
                <th scope="col">deskripsi</th>
                <th scope="col">hobi</th>
                <th scope="col">Aksi</th>




              </tr>
            </thead>
            <tbody>
                @if($jumlah > 0)
                        @for($i=0; $i < count($data); $i++)


                            <tr>

                                <td>{{$data[$i]->username}} </td>
                                <td>{{$data[$i]->nama}} </td>
                                <td>{{$data[$i]->email}} </td>
                                <td>{{$data[$i]->tgllahir}} </td>
                                <td>{{$data[$i]->deskripsi}} </td>
                                <td>{{$data[$i]->hobi}} </td>
                                <td>
                                    <a href="/admin/edituser/{{$data[$i]->username}}"><button class="btn btn-success">Edit</button></a>

                                </td>





                            </tr>

                        @endfor

                    @else
                    <tr>
                        <td colspan=4><center>Belum ada User</center></td>
                    </tr>
                    @endif

            </tbody>
          </table>
    </center>

</div>




</body>
</html>
