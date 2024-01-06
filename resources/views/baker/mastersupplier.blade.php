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
    <h1>Master Supplier</h1>
  </header>

  <div class="container">
    <h2>Add New Supplier</h2>

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

    <form method="post" action="{{ url("/baker/insertsupplier") }}">
      @csrf

      <label for="nama">Supplier Name</label>
      <input type="text" name="nama" required>

      <button type="submit">Add Supplier</button>

      <br>

      <a href="{{ url('baker') }}">Back to Baker Home</a>
    </form>

    <h2>Existing Suppliers</h2>
    <table id="tabel" border="1px solid black">
      <thead>
        <th>No.</th>
        <th>Nama Supplier</th>
        <th>Ubah</th>
        <th>Hapus</th>
      </thead>
      <tbody>
        @foreach ($suppliers as $supplier)
          <tr>
            <form method="post" action="{{ url("/baker/updateSupplier/{$supplier->id}") }}">
              @csrf
              <input type="hidden" name="_method" value="PUT">
              <td>{{ $loop->index+1 }}</td>
              <td><input type="text" value="{{ $supplier->nama }}" name="nama"></td>
              <td>
                <button type="submit" class="editBtn">Ubah</button>
              </td>
            </form>
            <td>
              <form method="post" action="{{ url("/baker/deleteSupplier/{$supplier->id}") }}" onsubmit="return confirm('Are you sure?')">
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
  </div>

</body>

</html>
