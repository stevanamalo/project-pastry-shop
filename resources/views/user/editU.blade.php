<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
</head>
<body>
<h1>Edit Profile</h1>
    <!-- Form untuk mengedit profil -->
    <form method="post" action="{{ route('user.update') }}">
        @csrf
        <label for="username">Username</label>
        <input type="text" name="username" value="{{ \Illuminate\Support\Facades\Cookie::get('username') }}">
        <br>
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ \Illuminate\Support\Facades\Cookie::get('email') }}">
<br>
        <label for="old_password">Old Password</label>
        <input type="password" name="old_password">
<br>
        <label for="new_password">New Password</label>
        <input type="password" name="new_password">
<br>
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password">
<br>
        <label for="birthdate">Tanggal Lahir</label>
        <input type="date" name="birthdate" value="{{ \Illuminate\Support\Facades\Cookie::get('birthdate') }}">
<br>
        <label for="description">Deskripsi</label>
        <textarea name="description">{{ \Illuminate\Support\Facades\Cookie::get('description') }}</textarea>
<br>
        <button type="submit">Save</button>
    </form>
</body>
</html>
