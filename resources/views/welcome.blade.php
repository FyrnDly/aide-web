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
							<li><hr class="dropdown-divider"></li>
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

	<section id="about" class="about pb-5 mb-4">
		<h1 class="text-center">Tentang Kami</h1>
		<div class="container-fluid mt-2 px-md-5">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-5 col-md-6 p-3">
					<img src="{{ url('dev/image/about_aide.jpg') }}" alt="About" class="img-thumbnail rounded-4">
				</div>
				<div class="col-lg-7 col-md-6 p-3">
					<p><b>AIDE</b> adalah Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis nemo
					labore a voluptas, soluta aliquam numquam ducimus incidunt sint architecto assumenda, cum
					consequatur voluptatibus tempore quibusdam at? Magni, harum rerum.
					Beatae sequi cumque placeat, esse dolor voluptatem est? Repudiandae neque ipsum, impedit aut
					enim ullam suscipit cum, perspiciatis earum, vel obcaecati culpa? Distinctio consequuntur
					nulla voluptatum illum perferendis quaerat delectus.
					Nihil quaerat dicta placeat quos. Iure ut voluptate tenetur ad saepe perspiciatis
					asperiores? Ullam quasi enim obcaecati fugiat ex labore repellat at, temporibus, distinctio
					asperiores quibusdam nobis, ut velit ipsam!
					Ducimus officiis, quod nemo quo aperiam iste quos! Minima modi adipisci sed hic qui numquam
					ea esse, illo fuga? Voluptate molestiae consectetur perferendis voluptatibus quisquam
					commodi consequuntur aperiam deleniti accusantium.
					Ipsa at consequuntur voluptatibus ea quam eum modi laudantium ad commodi quia totam,
					architecto, magni, voluptates officiis dolore illum ut! Sint dolorem animi fugit commodi
					deserunt assumenda ad id dolor!</p>
				</div>
			</div>
		</div>
	</section>

	<section id="goals" class="goals pb-5">
		<h1 class="text-center">Fitur</h1>
		<div class="container mt-2">
			<div class="row justify-content-center align-items-stretch">
				<div class="col-lg-4 col-md-8 p-3">
					<div class="card text-white bg-primary rounded-4 w-100 h-100">
                        <img class="card-img-top rounded-4" src="{{ url('dev/image/monitoring.png') }}" alt="Peminjaman Alat">
                        <div class="card-body">
                            <h3 class="card-title text-center">Monitoring</h3>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt dolor repellendus est
                                dignissimos. Dolorem ipsum quaerat, eveniet, odio quae architecto saepe, similique
                                tenetur suscipit quisquam voluptas velit. Voluptates, neque explicabo.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 p-3">
                    <div class="card text-white bg-primary rounded-4 w-100 h-100">
                        <img class="card-img-top rounded-4" src="{{ url('dev/image/eco-friendly.jpg') }}" alt="Peminjaman Alat">
                        <div class="card-body">
                            <h3 class="card-title text-center">Eco-Friendly</h3>
                            <p class="card-text">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum similique ad dicta
                                autem quaerat, minima asperiores deleniti error beatae dolores vitae quisquam
                                exercitationem incidunt, illo quasi vel doloremque facilis temporibus?
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 p-3">
                    <div class="card text-white bg-primary rounded-4 w-100 h-100">
                        <img class="card-img-top rounded-4" src="{{ url('dev/image/automation-system.jpg') }}" alt="Peminjaman Alat">
                        <div class="card-body">
                            <h3 class="card-title text-center">Automation System</h3>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque officia maxime
                                quibusdam rerum provident tempora modi facilis ratione ab voluptate minima
                                repellendus esse neque, quo non, quia molestias exercitationem nesciunt?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="docum" class="docum pb-5">
        <h1 class="text-center">Dokumentasi</h1>
        <div class="container pt-4">
            <div class="row justify-content-center align-items-start">

                <!-- Nav Docum -->
                <div class="col-md-4 col-lg-3 p-2">
                    <div class="nav flex-column me-3" id="docum-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="docum-diskusi-tab" data-bs-toggle="pill" data-bs-target="#docum-diskusi" type="button" role="tab" aria-controls="docum-diskusi" aria-selected="true">Diskusi Proyek</button>

                        <button class="nav-link" id="docum-survei-tab" data-bs-toggle="pill" data-bs-target="#docum-survei" type="button" role="tab" aria-controls="docum-survei" aria-selected="false">Survei</button>

                        <button class="nav-link" id="docum-desain-tab" data-bs-toggle="pill" data-bs-target="#docum-desain" type="button" role="tab" aria-controls="docum-desain" aria-selected="false">Desain Produk</button>

                        <button class="nav-link" id="docum-bengkel-tab" data-bs-toggle="pill" data-bs-target="#docum-bengkel" type="button" role="tab" aria-controls="docum-bengkel" aria-selected="false">Pembuatan Kerangka</button>

                        <button class="nav-link" id="docum-rangkaian-tab" data-bs-toggle="pill" data-bs-target="#docum-rangkaian" type="button" role="tab" aria-controls="docum-rangkaian" aria-selected="false">Pembuatan Rangkaian</button>

                        <button class="nav-link" id="docum-sensor-tab" data-bs-toggle="pill" data-bs-target="#docum-sensor" type="button" role="tab" aria-controls="docum-sensor" aria-selected="false">Konfigurasi Sensor Kamera</button>

                        <button class="nav-link" id="docum-intergrasi-tab" data-bs-toggle="pill" data-bs-target="#docum-intergrasi" type="button" role="tab" aria-controls="docum-sensor" aria-selected="false">Intergrasi Produk</button>

                    </div>
                </div>

                <!-- Content Docum -->
                <div class="col-md-8 col-lg-9 p-2">
                    <div class="tab-content" id="docum-tabContent">
                        <div class="tab-pane fade show active" id="docum-diskusi" role="tabpanel" aria-labelledby="docum-diskusi-tab" tabindex="0">
                            <figure class="figure p-lg-4 p-md-3 p-2">
                                <div class="figure-img img-fluid rounded" style="background-image: url('{{ url('dev/image/gallery/discusion.jpg') }}');"></div>
                                <figcaption class="figure-caption">
                                    Proyek ini dimulai dari diskusi yang dilakukan untuk mengikuti kegiatan
                                    Program Kreativitas Mahasiswa (PKM) dengan mengambil latar belakang dari
                                    bidang pertanian tepatnya tanama padi yang menjadi fokus
                                    dalam <i>Swasembada Indonesia</i>.
                                </figcaption>
                            </figure>
                        </div>

                        <div class="tab-pane fade" id="docum-survei" role="tabpanel" aria-labelledby="docum-survei-tab" tabindex="0">
                            <figure class="figure p-lg-4 p-md-3 p-2">
                                <div class="figure-img img-fluid rounded" style="background-image: url('{{ url('dev/image/gallery/survei.jpg') }}');"></div>
                                <figcaption class="figure-caption">
                                    Melakukan survei secara langsung kelapangan untuk mengetahui secara jelas
                                    terkait permasalahan yang terjadi dilapangan dan mencari solusi yang efektif
                                    serta ramah terhadap lingkungan pertumbuhan padi
                                </figcaption>
                            </figure>
                        </div>

                        <div class="tab-pane fade" id="docum-desain" role="tabpanel" aria-labelledby="docum-desain-tab" tabindex="0">
                            <figure class="figure p-lg-4 p-md-3 p-2">
                                <div class="figure-img img-fluid rounded" style="background-image: url('{{ url('dev/image/gallery/desain.png') }}');"></div>
                                <figcaption class="figure-caption">
                                    Berdasarkan permasalahan yang diketahui, maka dimulai proses pembuatan produk
                                    yang dimulai dari pembuatan desain 3D untuk produk
                                </figcaption>
                            </figure>
                        </div>

                        <div class="tab-pane fade" id="docum-bengkel" role="tabpanel" aria-labelledby="docum-bengkel-tab" tabindex="0">
                            <figure class="figure p-lg-4 p-md-3 p-2">
                                <div class="figure-img img-fluid rounded" style="background-image: url('{{ url('dev/image/gallery/kerangka.jpg') }}');"></div>
                                <figcaption class="figure-caption">
                                    Berdasarkan desain produk dilakukan pembuatan kerangka dari alat melalui proses
                                    cut-off sampai dengan proses las di Lab Bengkel
                                </figcaption>
                            </figure>
                        </div>

                        <div class="tab-pane fade" id="docum-rangkaian" role="tabpanel" aria-labelledby="docum-rangkaian-tab" tabindex="0">
                            <figure class="figure p-lg-4 p-md-3 p-2">
                                <div class="figure-img img-fluid rounded" style="background-image: url('{{ url('dev/image/gallery/rangkaian.jpg') }}');"></div>
                                <figcaption class="figure-caption">
                                    Membuat rangkaian arduino pada robot yang diintergrasikan dengan motor drive
                                    untuk sistem gerak yang digunakan
                                </figcaption>
                            </figure>
                        </div>

                        <div class="tab-pane fade" id="docum-sensor" role="tabpanel" aria-labelledby="docum-sensor-tab" tabindex="0">
                            <figure class="figure p-lg-4 p-md-3 p-2">
                                <div class="figure-img img-fluid rounded" style="background-image: url('{{ url('dev/image/gallery/tof.jpg')}}');"></div>
                                <figcaption class="figure-caption">
                                    Membuat pemodelan navigasi pada raspeberry menggunakan Sensor Arducam ToF Camera
                                    yang terintergrasi dengan arduino untuk sistem navigasi robot secara otomatis
                                </figcaption>
                            </figure>
                        </div>

                        <div class="tab-pane fade" id="docum-intergrasi" role="tabpanel" aria-labelledby="docum-intergrasi-tab" tabindex="0">
                            <figure class="figure p-lg-4 p-md-3 p-2">
                                <div class="figure-img img-fluid rounded" style="background-image: url('{{ url('dev/image/gallery/intergrasi.jpg') }}');"></div>
                                <figcaption class="figure-caption">
                                    Menghubungkan setiap perangkat mulai dari rangkaian arduion, raspeberry pi, dan
                                    sensor dengan kerangka produk
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="tim" class="tim pb-5">
        <h1 class="text-center">Anggota Tim</h1>
        <div class="container-fluid px-md-5 pt-4">
            <div class="row justify-content-around align-items-start">
                <div class="col-md-4 col-lg-3 col-6 p-md-4 p-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="img-thumbnail" style="background-image: url({{ url('dev/image/tim/profile1.jpg') }});">
                            </div>
                            <h5 class="card-title">Nama</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">NIM</h6>
                            <a href="#" class="card-link">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 col-6 p-md-4 p-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="img-thumbnail" style="background-image: url({{ url('dev/image/tim/profile1.jpg') }});">
                            </div>
                            <h5 class="card-title">Nama</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">NIM</h6>
                            <a href="#" class="card-link">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 col-6 p-md-4 p-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="img-thumbnail" style="background-image: url({{ url('dev/image/tim/profile1.jpg') }});">
                            </div>
                            <h5 class="card-title">Nama</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">NIM</h6>
                            <a href="#" class="card-link">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 col-6 p-md-4 p-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="img-thumbnail" style="background-image: url({{ url('dev/image/tim/profile1.jpg') }});">
                            </div>
                            <h5 class="card-title">Nama</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">NIM</h6>
                            <a href="#" class="card-link">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 col-6 p-md-4 p-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="img-thumbnail" style="background-image: url({{ url('dev/image/tim/profile1.jpg') }});">
                            </div>
                            <h5 class="card-title">Nama</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">NIM</h6>
                            <a href="#" class="card-link">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 col-6 p-md-4 p-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="img-thumbnail" style="background-image: url({{ url('dev/image/tim/profile1.jpg') }});">
                            </div>
                            <h5 class="card-title">Nama</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">NIM</h6>
                            <a href="#" class="card-link">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 col-6 p-md-4 p-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="flex">
                                <div class="img-thumbnail" style="background-image: url({{ url('dev/image/tim/profile1.jpg') }});">
                                </div>
                            </div>
                            <h5 class="card-title">Nama</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">NIM</h6>
                            <a href="#" class="card-link">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 col-6 p-md-4 p-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="img-thumbnail" style="background-image: url({{ url('dev/image/tim/profile1.jpg') }});">
                            </div>
                            <h5 class="card-title">Nama</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">NIM</h6>
                            <a href="#" class="card-link">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('add-script')
<!-- Navbar JS -->
<script src="{{ url('dev/script/index.js') }}"></script>
@endsection