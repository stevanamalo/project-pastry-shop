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
    <h1>Ingredients</h1>
  </header>

  <div class="container">
    <h2>Add New Ingredient</h2>

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

    <form method="post" action="{{ url("/baker/insertIngredient") }}">
      @csrf

      <label for="nama">Ingredient Name</label>
      <input type="text" name="nama" required>

      <label for="supplier_id">Supplier</label>
      <select name="supplier_id" required>
        <option value="" disabled selected>Select Supplier</option>
        @foreach ($suppliers as $supplier)
          <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
        @endforeach
      </select>

      <button type="submit">Add Ingredient</button>

      <br>

      <a href="{{ url('/baker') }}">Back to baker Home</a>
    </form>
    <h2>Existing Ingredients</h2>

    <table id="tabel" border="1px solid black">
      <thead>
        <th>No.</th>
        <th>Nama Ingredient</th>
        <th>Supplier</th>
        <th>Ubah</th>
        <th>Hapus</th>
      </thead>
      <tbody>
        @foreach ($ingredients as $ingredient)
          <tr>
            <form method="post" action="{{ url("/baker/updateIngredient/{$ingredient->id}") }}">
              @csrf
              <input type="hidden" name="_method" value="POST">
              <td>{{ $loop->index+1 }}</td>
              <td><input type="text" value="{{ $ingredient->nama }}" name="nama"></td>
              <td>
                <select name="supplier_id" required>
                  @foreach ($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @if($supplier->id == $ingredient->supplier_id) selected @endif>{{ $supplier->nama }}</option>
                  @endforeach
                </select>
              </td>
              <td>
                <button type="submit" class="editBtn">Ubah</button>
              </td>
            </form>
            <td>
              <form method="post" action="{{ url("/baker/deleteIngredient/{$ingredient->id}") }}" onclick="return confirm('Are you sure?')">
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

  </div>

</body>

</html>
