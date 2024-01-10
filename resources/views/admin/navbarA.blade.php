<nav   class="navbar navbar-expand-lg bg-dark fixed-top bg-black" style="width:unset" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" style="font-size: 30px;"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link active" aria-current="page"href="{{ url('/admin') }}">Home Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ url('/admin/listuser') }}">List User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ url('/admin/listbaker') }}">List Baker</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ url('/admin/listkaryawan') }}">List Karyawan</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ url('/admin/listfeed') }}">List Feed</a>
          </li> --}}
          {{-- <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ url('/admin/report') }}">Report</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{url("/logout")}}">Logout </a>
          </li>
      </div>
    </div>
  </nav>
