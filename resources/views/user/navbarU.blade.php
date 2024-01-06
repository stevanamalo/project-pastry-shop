<nav   class="navbar navbar-expand-lg bg-dark fixed-top bg-black" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" style="font-size: 30px;">PASTRY SHOP</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page"href={{ url('user/dashboard') }}>Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href={{ url('user/profile') }}>Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href={{ url('user/menu') }}>Menu</a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href={{ url('user/membership') }}>Membership</a>
          </li>

          <!-- Tambahkan baris berikut di dalam navbar -->
          <li class="nav-item">
            <a class="nav-link active" aria-current="page">
                Saldo Anda: Rp. {{ number_format($user->saldo, 0, ',', '.') }},-
            </a>
        </li>

            <li class="nav-item">
                <button type="button" class="btn btn-outline-danger">
                    <a style="color: red;" href="{{url("/logout")}}" >Logout </a>
                </button>
              </li>
      </div>
    </div>
  </nav>
