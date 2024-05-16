<header class="bg-nav fixed-top">
    <nav class="navbar navbar-expand-md px-4 py-3 rounded-0" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ url('dev/image/logo.png') }}" alt="Logo AIDE">AIDE
            </a>
            <div class="navbar-nav mx-auto d-none d-md-block">
                <div class="nav-item">
                    <span class="nav-link">@yield('title')</span>
                </div>
            </div>
            <div class="navbar-nav ms-md-4 ms-auto ms-md-0">
                @auth
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hai, {{ Str::limit(Auth::user()->name, 5, '...') }}

                    </a>
                    <ul class="dropdown-menu bg-primary p-2">
                        <li><a class="dropdown-item fs-5" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                        <li><a class="dropdown-item fs-5" href="{{ route('profile.edit') }}">Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <button type="button" class="dropdown-item btn btn-danger fs-5 text-center" data-bs-toggle="modal" data-bs-target="#modalLogout">Keluar</button>
                    </ul>
                </div>
                @endauth
                @guest
                <a class="btn btn-primary" href="{{ URL::previous() }}">Kembali</a>
                @endguest
            </div>
        </div>
    </nav>
</header>

@auth
<!-- Modal Logout -->
<div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" action="{{ route('logout') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLogoutLabel">Kembali Kehalaman Awal</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <span>Apakah anda yakin untuk keluar dari halaman monitoring sebagai Admin?</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-auto" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger w-auto">Keluar</button>
            </div>
        </form>
    </div>
</div>
@endauth

