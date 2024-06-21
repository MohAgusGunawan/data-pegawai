<html>
    @include('layouts.sidebar-style')
  <body><div class="area"></div>
      <nav class="main-menu">
            <ul>
                <li class="has-subnav">
                    <a href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-layer-group fa-2x"></i>
                        <span class="nav-text">
                            Dashboard
                        </span>
                    </a>
                  <li>
                    <a href="{{ route('pegawai') }}">
                        <i class="fa-solid fa-address-book fa-2x"></i>
                        <span class="nav-text">
                           Pegawai
                        </span>
                    </a>
                </li>
                <li>
                   <a href="#">
                    <i class="fa-solid fa-city fa-2x"></i>
                        <span class="nav-text">
                            Departemen
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-street-view fa-2x"></i>
                        <span class="nav-text">
                            Jabatan
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-clock-rotate-left fa-2x"></i>
                        <span class="nav-text">
                            Riwayat
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa-solid fa-hand-holding-dollar fa-2x"></i>
                        <span class="nav-text">
                            Gaji
                        </span>
                    </a>
                </li>
            </ul>
            <ul class="logout">
                <li>
                   <a href="{{ route('login') }}">
                    <i class="fa-solid fa-right-from-bracket fa-2x"></i>
                        <span class="nav-text">
                            Keluar
                        </span>
                    </a>
                </li>  
            </ul>
        </nav>
  </body>
    </html>