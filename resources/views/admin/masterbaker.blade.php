<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register Baker</title>

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
    <h1>Register Baker</h1>
  </header>

  <div class="container">
    <h2>Register</h2>

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

    <form method="post" action="{{ url("/admin/registerakunbaker") }}">
      @csrf

      <label for="usernameReg">Username</label>
      <input type="text" name="usernameReg" required>

      <label for="emailReg">Email</label>
      <input type="email" name="emailReg" required>

      <label for="namaReg">Nama</label>
      <input type="text" name="namaReg" required>

      <label for="password">Password</label>
      <input type="password" name="password" required>

      <label for="password_confirmation">Confirm Password</label>
      <input type="password" name="password_confirmation" required>

      <label for="tgllahir">Tanggal Lahir</label>
      <input type="date" name="tgllahir" required>
      <button type="submit">Register</button>

      
      <br>

      <a href="{{ url('/admin') }}">Balik ke Home Admin</a>
    </form>


  </div>

</body>

</html>
