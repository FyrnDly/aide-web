@extends('layouts.guest')
@section('title', "Landing Page")

@section('content')
<!-- Navbar -->
<header class="container-md-fluid pt-md-3 mb-md-3 px-md-5 bg-nav fixed-top">
    <nav class="navbar navbar-expand-md px-4 py-3" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ url('dev/image/logo.png') }}" alt="Logo AIDE">
                AIDE
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-md-auto mt-md-0 mt-2 text-center text-md-start">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#about">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#goals">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#docum">Dokumentasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tim">Tim</a>
                    </li>
                    @guest
                    <li class="nav-item ms-md-4">
                        <a class="btn btn-primary" href="{{ route('login') }}">Mulai</a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Hai, {{ Str::limit(Auth::user()->name, 5, '...') }}
                        </a>
                        <ul class="dropdown-menu bg-primary p-2">
                            <li><a class="dropdown-item fs-5" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li><a class="dropdown-item fs-5" href="{{ route('profile.edit') }}">Profil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            @if(Auth::user()->role == 'admin' or Auth::user()->role == 'root')
                            <li><a class="dropdown-item fs-5" href="{{ route('admin.index') }}">Admin</a></li>
                            @endif
                            <button type="button" class="dropdown-item btn btn-danger fs-5 text-center" data-bs-toggle="modal" data-bs-target="#modalLogout">Keluar</button>
                        </ul>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Main Content -->
<main data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">
    <div class="banner">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#3b291d" fill-opacity="1" d="M0,0L48,10.7C96,21,192,43,288,74.7C384,107,480,149,576,176C672,203,768,213,864,202.7C960,192,1056,160,1152,144C1248,128,1344,128,1392,128L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
        <div class="container">
            <h1 class="text-center">
                Mulai Revolusi Pertanian Indonesia dengan Langkah Kecil yang Ramah Lingkungan
            </h1>
        </div>
    </div>

    @isset($abouts)
    <section id="about" class="about pb-5 mb-4">
        <h1 class="text-center">Tentang Kami</h1>
        <div class="container-fluid mt-2 px-md-5">
            <div class="row justify-content-center align-items-center">
                @foreach ($abouts as $about)
                <div class="col-lg-5 col-md-6 p-3">
                    <img src="{{ Storage::url($about->path) }}" alt="About" class="img-thumbnail rounded-4">
                </div>
                <div class="col-lg-7 col-md-6 p-3">{!! Str::markdown($about->description) !!}</div>
                @endforeach
            </div>
        </div>
    </section>
    @endisset

    @isset($features)
    <section id="goals" class="goals pb-5">
        <h1 class="text-center">Fitur</h1>
        <div class="container mt-2">
            <div class="row justify-content-center align-items-stretch">
                @foreach ($features as $feature)
                <div class="col-lg-4 col-md-8 p-3">
                    <div class="card text-white bg-primary rounded-4 w-100 h-100">
                        <img class="card-img-top rounded-4" src="{{ Storage::url($feature->path) }}" alt="{{ $feature->name }}">
                        <div class="card-body">
                            <h3 class="card-title text-center">{{ $feature->name }}</h3>
                            <p class="card-text">{!! Str::markdown($feature->description) !!}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endisset

    @isset($documentations)
    <section id="docum" class="docum pb-5">
        <h1 class="text-center">Dokumentasi</h1>
        <div class="container pt-4">
            <div class="row justify-content-center align-items-start">
                <!-- Nav Docum -->
                <div class="col-md-4 col-lg-3 p-2">
                    <div class="nav flex-column me-3" id="docum-tab" role="tablist" aria-orientation="vertical">
                        @foreach ($documentations as $i => $docum)
                        <button @class(['nav-link', 'active'=> $i == 0]) id="docum-{{ $docum->id }}-tab" data-bs-toggle="pill" data-bs-target="#docum-{{ $docum->id }}" type="button" role="tab" aria-controls="docum-{{ $docum->id }}" aria-selected="true">{!! Str::title($docum->name) !!}</button>
                        @endforeach
                    </div>
                </div>

                <!-- Content Docum -->
                <div class="col-md-8 col-lg-9 p-2">
                    <div class="tab-content" id="docum-tabContent">
                        @foreach ($documentations as $i => $docum)
                        <div @class(['tab-pane fade', 'show active'=> $i == 0]) id="docum-{{ $docum->id }}" role="tabpanel" aria-labelledby="docum-{{ $docum->id }}-tab" tabindex="0">
                            <figure class="figure p-lg-4 p-md-3 p-2">
                                <div class="figure-img img-fluid rounded" style="background-image: url('{{ Storage::url($docum->path) }}');"></div>
                                <figcaption class="figure-caption">
                                    {!! Str::markdown($docum->description) !!}
                                </figcaption>
                            </figure>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endisset

    @isset($teams)
    <section id="tim" class="tim pb-5">
        <h1 class="text-center">Anggota Tim</h1>
        <div class="container-fluid px-md-5 pt-4">
            <div class="row justify-content-around align-items-start">
                @foreach ($teams as $team)
                <div class="col-md-4 col-lg-3 col-6 p-md-4 p-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="img-thumbnail" style="background-image: url({{ Storage::url($team->path) }});"></div>
                            <h5 class="card-title">{{ Str::title($team->name) }}</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">{{ Str::upper($team->nim) }}</h6>
                            <a href="{{ $team->linkedin }}" target="_blank" class="card-link">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endisset
</main>
@endsection

@section('add-script')
<!-- Navbar JS -->
<script src="{{ url('dev/script/index.js') }}"></script>
@endsection