<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register karyawan</title>

  <!-- Add your styles here -->
  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #333;
      color: white;
      padding: 10px;
      text-align: center;
    }

    .container {
      margin: 20px auto;
      max-width: 400px;
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .container1 {
      margin: 20px auto;
      max-width: 170px;
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
    }

    button {
      background-color: #333;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .alert {
      background-color: #f44336;
      color: white;
      padding: 10px;
      margin-bottom: 16px;
      border-radius: 4px;
    }
  </style>
</head>


<body>

  <header>
    <h1>Master Menu</h1>
  </header>

  <div class="container">
    @if(session('msg'))
    <div class="alert">
      {{ session('msg') }}
    </div>
    @endif

    @if ($errors->any())
      <div class="alert">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif


     <a href="{{ url('/karyawan')  }}">Back to Karyawan</a>
     <h2>List Pastries</h2>
<table id="tabel" border="1px solid black">
    <thead>
        <th>No.</th>
        <th>Nama Pastry</th>
        <th>Harga</th>
        <th>Ingredients</th>
        <th>Picture</th>
        <th>Stok</th>
        <th>Ubah</th>
        <th>Hapus</th>
    </thead>
    <tbody>
        @foreach ($pastries as $pastry)
        <tr>
            <form method="post" action="{{ url("/karyawan/updatePastrykaryawan/{$pastry->id}") }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="_method" value="PUT">
                <td>{{ $loop->index + 1 }}</td>
                <td><input type="text" value="{{ $pastry->nama }}" name="nama"></td>
                <td><input type="number" value="{{ $pastry->harga }}" name="harga" style="width: 100px;"></td>
                <td>
                    <select name="ingredients_id" required>
                        @foreach ($ingredients as $ingredient)
                        <option value="{{ $ingredient->id }}" @if($ingredient->id == $pastry->ingredients_id) selected @endif>
                            {{ $ingredient->nama }}
                        </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    @if($pastry->picturepastry)
                        <img src="{{ asset($pastry->picturepastry) }}" alt="Pastry Image" style="max-width: 100px;">
                    @else
                        No Image
                    @endif
                    <input type="file" name="new_picturepastry">
                </td>
                <td><input type="number" value="{{ $pastry->Stok }}" name="Stok" style="width: 50px;"></td>
                <td>
                    <button type="submit" class="editBtn">Ubah</button>
                </td>
            </form>
            <td>
                <form method="post" action="{{ url("/baker/deletePastry/{$pastry->id}") }}" onclick="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


     </ul>
  </div>

</body>

</html>
