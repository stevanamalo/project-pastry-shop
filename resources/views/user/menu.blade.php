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
    Menu bakery
    <br>
    <table id="tabel" border="0px">
        <thead>
            <th>No.</th>
            <th>Nama Pastry</th>
            <th>Harga</th>
            <th>Picture</th>
            <th>action</th>
        </thead>
        <tbody>
            @foreach ($pastries as $pastry)
            <tr>
                <form method="post" action="{{ url("/baker/updatePastry/{$pastry->id}") }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="_method" value="PUT">
                    <td>{{ $loop->index + 1 }}</td>
                    <td><input type="text" value="{{ $pastry->nama }}" name="nama"></td>
                    <td><input type="number" value="{{ $pastry->harga }}" name="harga"></td>
                    <td>
                        @if($pastry->picturepastry)
                            <img src="{{ asset($pastry->picturepastry) }}" alt="Pastry Image" style="max-width: 100px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>
                        <button type="submit" class="editBtn">Order!</button>
                    </td>
                </form>
            </tr>
            @endforeach
        </tbody>
    </table>
<center>
    <!-- Tampilkan informasi lain sesuai kebutuhan -->

</center>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

</body>
</html>